<?php

namespace App\Http\Controllers;

use App\Models\Mailpay;
use Exception;
use Google_Client;
use Google_Service_Gmail;
use Google_Service_Gmail_Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;




class MailPayController extends Controller
{
    //
   

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

                    // Extract amount using regex
                    preg_match('/Credit Amount\s*\n\s*(\d+(?:\.\d{2})?)/s', $content, $amountMatch);

                    // Extract sender's name
                    preg_match('/Sender\'s Name:\s*\n\s*from (.*?)\s*\n/s', $content, $senderMatch);

                    // Extract narration
                    preg_match('/Narration:\s*\n\s*(.*?)\s*\n/s', $content, $narrationMatch);

                    // Extract transaction date from content
                    preg_match('/Date & Time:\s*\n\s*(.*?)\s*\n/s', $content, $dateMatch);

                    $emailContents[] = [
                        'sender' => $senderMatch[1] ?? 'Unknown',
                        'amount' => $amountMatch[1] ?? '0.00',
                        'date' => $dateMatch[1] ?? $date,
                        'narration' => $narrationMatch[1] ?? 'No narration',
                        'raw_content' => $content // keeping for debugging
                    ];
                }
            }

            return response()->json($emailContents);

            //get user 

            $phone_number = '09058744473';
            //get user_id from user table
            $user = User::where('phone_number', $phone_number)->first();

            //insert into Mailpay

            $mailpay = Mailpay::create([
                'user_id' => $user->id?? 'Unknown',
                'amount' => $emailContents['amount']?? '0.00',
                'date' => $emailContents['date']?? 'Unknown',
                'narration' => $emailContents['narration']?? 'No narration',
                'status' => 0,
            ]);

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
    function oldprocessCreditAlertEmails()
    {
        $client = new Google_Client();

        $credentialsPath = public_path('gmail_credentials.json');
        if (!file_exists($credentialsPath)) {
            throw new \Exception('Gmail credentials file not found');
        }

        try {
            $client->setAuthConfig($credentialsPath);
            $client->addScope([
                'https://www.googleapis.com/auth/gmail.readonly',
                'https://www.googleapis.com/auth/gmail.modify'
            ]);
            $client->setAccessType('offline');
            $client->setPrompt('consent');

            $tokenPath = storage_path('app/gmail_token.json');

            // If no token exists, get authorization URL
            if (!file_exists($tokenPath)) {
                $authUrl = $client->createAuthUrl();
                return redirect($authUrl);
            }

            // Rest of the token handling code
            if (file_exists($tokenPath)) {
                $accessToken = json_decode(file_get_contents($tokenPath), true);
                $client->setAccessToken($accessToken);
            }

            if ($client->isAccessTokenExpired()) {
                if ($client->getRefreshToken()) {
                    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                    file_put_contents($tokenPath, json_encode($client->getAccessToken()));
                } else {
                    // Delete invalid token file and redirect to auth
                    @unlink($tokenPath);
                    $authUrl = $client->createAuthUrl();
                    return redirect($authUrl);
                }
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        $service = new Google_Service_Gmail($client);
        $user = 'me'; // Authenticated Gmail user

        // Search for "credit alert" emails (modify based on your bank's format)
        $messages = $service->users_messages->listUsersMessages($user, [
            'q' => 'subject:"Credit Alert" newer_than:1d' // Last 1 day alerts
        ]);

        dd($messages);
        if ($messages->getMessages()) {
            foreach ($messages->getMessages() as $message) {
                $msg = $service->users_messages->get($user, $message->getId());
                $payload = $msg->getPayload();
                $headers = $payload->getHeaders();

                // Extract email content
                $bodyData = $payload->getBody()->getData();
                $emailContent = base64_decode($bodyData);

                // Extract Amount, User ID from email body
                $transaction = extractTransactionDetails($emailContent);

                if ($transaction) {
                    creditUserAccount($transaction);
                }
            }
        }
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
