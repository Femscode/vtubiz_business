<?php

namespace App\Http\Controllers;

use App\Models\Mailpay;
use App\Models\User;
use App\Traits\TransactionTrait;
use Exception;
use Google_Client;
use Google_Service_Gmail;
use Google_Service_Gmail_Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;




class MailPayController extends Controller
{
    //

    use TransactionTrait;
    function oldprocessCreditAlertEmails()
    {
        $credentials = json_decode(file_get_contents(public_path('gmail_credentials.json')), true);
        $tokenPath = storage_path('app/gmail_token.json');

        try {
            // Check if token file exists
            if (!file_exists($tokenPath)) {
                \Log::info('Token file not found, initiating auth flow');
                $authUrl = 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query([
                    'client_id' => $credentials['web']['client_id'],
                    'redirect_uri' => url('/api/gmail/callback'),
                    'response_type' => 'code',
                    'scope' => 'https://www.googleapis.com/auth/gmail.readonly',
                    'access_type' => 'offline',
                    'prompt' => 'consent'
                ]);

                return redirect()->away($authUrl);
            }

            $token = json_decode(file_get_contents($tokenPath), true);
            \Log::info('Current token:', ['token' => $token]);

            // Check if token needs refresh
            if (!isset($token['expires_in']) || (isset($token['created']) && time() > ($token['created'] + $token['expires_in']))) {
                if (isset($token['refresh_token'])) {
                    $response = Http::post('https://oauth2.googleapis.com/token', [
                        'client_id' => $credentials['web']['client_id'],
                        'client_secret' => $credentials['web']['client_secret'],
                        'refresh_token' => $token['refresh_token'],
                        'grant_type' => 'refresh_token'
                    ]);

                    if ($response->successful()) {
                        $newToken = $response->json();
                        $newToken['refresh_token'] = $token['refresh_token'];
                        $newToken['created'] = time();
                        file_put_contents($tokenPath, json_encode($newToken));
                        $token = $newToken;
                    }
                } else {
                    @unlink($tokenPath);
                    return redirect()->away($authUrl);
                }
            }

            // Get message IDs first
            $response = Http::withToken($token['access_token'])
                ->get('https://gmail.googleapis.com/gmail/v1/users/me/messages', [
                    'q' => 'subject:"Credit Alert" newer_than:1d'
                ]);

            $messages = $response->json();
            $emailContents = [];

            // Fetch full message content for each message
            if (!empty($messages['messages'])) {
                foreach ($messages['messages'] as $message) {
                    $messageDetails = Http::withToken($token['access_token'])
                        ->get("https://gmail.googleapis.com/gmail/v1/users/me/messages/{$message['id']}", [
                            'format' => 'full'
                        ])->json();

                    $content = $this->decodeEmailContent($messageDetails);

                    // Extract sender name from headers
                    // Extract sender name from headers
                    $headers = $messageDetails['payload']['headers'];
                    $sender = 'Moniepoint';  // Default sender
                    $date = '';
                    foreach ($headers as $header) {
                        if ($header['name'] === 'Date') {
                            $date = date('Y-m-d H:i:s', strtotime($header['value']));
                        }
                    }

                    // Extract amount using regex (now handles commas in amount)
                    preg_match('/Credit Amount\s*\n\s*([\d,]+\.\d{2})/s', $content, $amountMatch);
                    $amount = $amountMatch[1] ? str_replace(',', '', $amountMatch[1]) : '0.00';

                    // Extract sender's name
                    preg_match('/Sender\'s Name:\s*\n\s*from (.*?)\s*\n/s', $content, $senderMatch);

                    // Extract narration
                    preg_match('/Narration:\s*\n\s*(.*?)\s*\n/s', $content, $narrationMatch);

                    // Extract transaction date from content
                    preg_match('/Date & Time:\s*\n\s*(.*?)\s*\n/s', $content, $dateMatch);
                    // Extract narration and phone number
                    preg_match('/Narration:\s*\n\s*(.*?)\s*\n/s', $content, $narrationMatch);
                    $narration = $narrationMatch[1] ?? 'No narration';

                    // Extract phone number from narration (matches both formats)
                    preg_match('/(?:^|[^\d])(0\d{10})(?:[^\d]|$)/', $narration, $phoneMatch);
                    $phone_number = $phoneMatch[1] ?? null;

                    $emailContents[] = [
                        'sender' => $senderMatch[1] ?? 'Unknown',
                        'amount' => $amount,
                        'date' => $dateMatch[1] ?? $date,
                        'narration' => $narration,
                        'phone_number' => $phone_number,
                        'raw_content' => $content // keeping for debugging
                    ];
                }
            }

            // return response()->json($emailContents);

            //get user 

            $phone_number = $emailContents['phone_number'] ?? 'Unknown';
            //get user_id from user table
            $user = User::where('phone', $phone_number)->first();

            //insert into Mailpay

            $mailpay = Mailpay::create([
                'user_id' => $user->id ?? 'Unknown',
                'amount' => $emailContents['amount'] ?? '0.00',
                'date' => $emailContents['date'] ?? 'Unknown',
                'narration' => $emailContents['narration'] ?? 'No narration',
                'status' => 0,
            ]);

            return response()->json($emailContents);
            // Get message IDs first
            $response = Http::withToken($token['access_token'])
                ->get('https://gmail.googleapis.com/gmail/v1/users/me/messages', [
                    'q' => 'subject:"Credit Alert" newer_than:1d'
                ]);

            $messages = $response->json();
            $emailContents = [];

            // Fetch full message content for each message
            if (!empty($messages['messages'])) {
                foreach ($messages['messages'] as $message) {
                    $messageDetails = Http::withToken($token['access_token'])
                        ->get("https://gmail.googleapis.com/gmail/v1/users/me/messages/{$message['id']}", [
                            'format' => 'full'
                        ])->json();

                    $emailContents[] = [
                        'id' => $message['id'],
                        'content' => $this->decodeEmailContent($messageDetails)
                    ];
                }
            }

            return response()->json($emailContents);

            // Make API request
            $response = Http::withToken($token['access_token'])
                ->get('https://gmail.googleapis.com/gmail/v1/users/me/messages', [
                    'q' => 'subject:"Credit Alert" newer_than:1d'
                ]);

            return $response->json();
        } catch (\Exception $e) {
            \Log::error('Gmail API Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to process emails: ' . $e->getMessage());
        }
    }

    function processCreditAlertEmails()
    {
        $credentials = json_decode(file_get_contents(public_path('gmail_credentials.json')), true);
        $tokenPath = storage_path('app/gmail_token.json');

        try {
            // Check if token file exists
            if (!file_exists($tokenPath)) {
                \Log::info('Token file not found, initiating auth flow');
                $authUrl = 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query([
                    'client_id' => $credentials['web']['client_id'],
                    'redirect_uri' => url('/api/gmail/callback'),
                    'response_type' => 'code',
                    'scope' => 'https://www.googleapis.com/auth/gmail.readonly',
                    'access_type' => 'offline',
                    'prompt' => 'consent'
                ]);

                return redirect()->away($authUrl);
            }

            $token = json_decode(file_get_contents($tokenPath), true);

            // Check if token needs refresh
            if (!isset($token['expires_in']) || (isset($token['created']) && time() > ($token['created'] + $token['expires_in']))) {
                if (isset($token['refresh_token'])) {
                    $response = Http::post('https://oauth2.googleapis.com/token', [
                        'client_id' => $credentials['web']['client_id'],
                        'client_secret' => $credentials['web']['client_secret'],
                        'refresh_token' => $token['refresh_token'],
                        'grant_type' => 'refresh_token'
                    ]);

                    if ($response->successful()) {
                        $newToken = $response->json();
                        $newToken['refresh_token'] = $token['refresh_token'];
                        $newToken['created'] = time();
                        file_put_contents($tokenPath, json_encode($newToken));
                        $token = $newToken;
                    }
                } else {
                    @unlink($tokenPath);
                    return redirect()->away($authUrl);
                }
            }

            // Get message IDs first

            $threeMinutesAgo = time() - (3 * 60);
            $response = Http::withToken($token['access_token'])
                ->get('https://gmail.googleapis.com/gmail/v1/users/me/messages', [
                    'q' => 'subject:"Credit Alert" after:' . $threeMinutesAgo
                ]);
            $messages = $response->json();
            $processedEmails = [];
            // Process each email
            if (!empty($messages['messages'])) {
                foreach ($messages['messages'] as $message) {
                    $messageDetails = Http::withToken($token['access_token'])
                        ->get("https://gmail.googleapis.com/gmail/v1/users/me/messages/{$message['id']}", [
                            'format' => 'full'
                        ])->json();

                    $content = $this->decodeEmailContent($messageDetails);

                    // Extract date from headers
                    $date = '';
                    foreach ($messageDetails['payload']['headers'] as $header) {
                        if ($header['name'] === 'Date') {
                            $date = date('Y-m-d H:i:s', strtotime($header['value']));
                            break;
                        }
                    }

                    // Extract email data using regex
                    preg_match('/Credit Amount\s*\n\s*([\d,]+\.\d{2})/s', $content, $amountMatch);
                    preg_match('/Sender\'s Name:\s*\n\s*from (.*?)\s*\n/s', $content, $senderMatch);
                    preg_match('/Narration:\s*\n\s*(.*?)\s*\n/s', $content, $narrationMatch);
                    preg_match('/Date & Time:\s*\n\s*(.*?)\s*\n/s', $content, $dateMatch);

                    $narration = $narrationMatch[1] ?? 'No narration';
                    preg_match('/(?:^|[^\d])(0\d{10})(?:[^\d]|$)/', $narration, $phoneMatch);

                    // Find user and create payment record

                    if ($phoneMatch[1] ?? null) {
                        // Check for existing transaction with same details
                        $existingMailpay = Mailpay::where([
                            'amount' => str_replace(',', '', $amountMatch[1] ?? '0.00'),
                            'narration' => $narration,
                            'date' => $dateMatch[1] ?? $date
                        ])->first();

                        if (!$existingMailpay) {
                            $user = User::where('phone', $phoneMatch[1])->first();
                            $amountpaid = str_replace(',', '', $amountMatch[1] ?? '0.00');
                            $details = "Payment of NGN" . number_format($amountpaid, 2) . " from " . ($senderMatch[1] ?? 'Unknown');

                            $mailpay = Mailpay::create([
                                'sender_name' =>  $senderMatch[1] ?? 'Unknown', 
                                'phone' => $phoneMatch[1] ?? null, 
                                'user_id' => $user->id ?? null,
                                'amount' => $amountpaid,
                                'date' => $dateMatch[1] ?? $date,
                                'narration' => $narration,
                                'status' => $user ? 1 : 0,
                            ]);

                            // Only create transaction if user exists
                            if ($user) {
                                $reference = 'mailpay' . $mailpay->id;
                                $this->create_transaction(
                                    'Account Funded Through Transfer',
                                    $reference,
                                    $details,
                                    'credit',
                                    $amountpaid,
                                    $user->id,
                                    1
                                );
                            }
                        }
                    }

                    $processedEmails[] = [
                        'sender' => $senderMatch[1] ?? 'Unknown',
                        'amount' => str_replace(',', '', $amountMatch[1] ?? '0.00'),
                        'date' => $dateMatch[1] ?? $date,
                        'narration' => $narration,
                        'phone_number' => $phoneMatch[1] ?? null,
                    ];
                }
            }

            return response()->json($processedEmails);
        } catch (\Exception $e) {
            \Log::error('Gmail API Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to process emails: ' . $e->getMessage());
        }
    }
    public function handleGoogleCallback(Request $request)
    {
        try {
            if (!$request->has('code')) {
                throw new \Exception('Authorization code not received');
            }

            $credentials = json_decode(file_get_contents(public_path('gmail_credentials.json')), true);

            $response = Http::post('https://oauth2.googleapis.com/token', [
                'client_id' => $credentials['web']['client_id'],
                'client_secret' => $credentials['web']['client_secret'],
                'code' => $request->code,
                'redirect_uri' => url('/api/gmail/callback'), // Updated to match API route
                'grant_type' => 'authorization_code'
            ]);

            if ($response->successful()) {
                $token = $response->json();
                $token['created'] = time();
                $tokenPath = storage_path('app/gmail_token.json');
                file_put_contents($tokenPath, json_encode($token));

                return response()->json([
                    'status' => 'success',
                    'message' => 'Authentication successful'
                ]);
            }

            throw new \Exception('Failed to obtain access token');
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    private function decodeEmailContent($messageDetails)
    {
        $parts = $messageDetails['payload']['parts'] ?? [$messageDetails['payload']];
        $content = '';

        foreach ($parts as $part) {
            if ($part['mimeType'] === 'text/plain') {
                $content .= base64_decode(str_replace(['-', '_'], ['+', '/'], $part['body']['data']));
            }
        }

        return $content;
    }


    public function oldhandleGoogleCallback(Request $request)
    {
        $client = new Google_Client();
        $client->setAuthConfig(public_path('gmail_credentials.json'));

        if ($request->has('code')) {
            $token = $client->fetchAccessTokenWithAuthCode($request->code);

            if (!isset($token['error'])) {
                $tokenPath = storage_path('app/gmail_token.json');
                file_put_contents($tokenPath, json_encode($token));
                return redirect()->route('process.emails');
            }
        }

        return redirect()->back()->with('error', 'Authorization failed');
    }
    function extractTransactionDetails($emailContent)
    {
        // Adjust regex based on your bank's email format
        preg_match('/₦([\d,]+)/', $emailContent, $amountMatch); // Extract amount
        preg_match('/Ref: ([A-Za-z0-9]+)/', $emailContent, $referenceMatch); // Extract ref ID
        preg_match('/Comment: (\d+)/', $emailContent, $userIdMatch); // Extract User ID from comment

        if (!empty($amountMatch) && !empty($userIdMatch)) {
            return [
                'amount' => str_replace(',', '', $amountMatch[1]), // Remove commas
                'user_id' => $userIdMatch[1],
                'reference' => $referenceMatch[1] ?? null,
            ];
        }

        return null;
    }

    function creditUserAccount($transaction)
    {
        $user = User::where('unique_id', $transaction['user_id'])->first();

        if ($user) {
            // Record transaction in DB
            Transaction::create([
                'user_id' => $user->id,
                'amount' => $transaction['amount'],
                'transaction_reference' => $transaction['reference'],
                'status' => 'successful',
            ]);

            // Update user wallet balance
            $user->wallet_balance += $transaction['amount'];
            $user->save();

            // Notify user via email or in-app notification
            sendUserNotification($user, $transaction);
        } else {
            Log::error('Transaction failed: User not found', $transaction);
        }
    }

    function sendUserNotification($user, $transaction)
    {
        Mail::to($user->email)->send(new \App\Mail\CreditNotification($transaction));
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            processCreditAlertEmails();
        })->everyFiveMinutes();
    }
}
