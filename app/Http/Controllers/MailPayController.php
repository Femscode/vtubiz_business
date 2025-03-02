<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Gmail;
use Google_Service_Gmail_Message;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;




class MailPayController extends Controller
{
    //
    function processCreditAlertEmails() {
        $credentials = json_decode(file_get_contents(public_path('gmail_credentials.json')), true);
        $tokenPath = storage_path('app/gmail_token.json');
        
        try {
            // Get or refresh access token
            if (!file_exists($tokenPath)) {
                return redirect()->away('https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query([
                    'client_id' => $credentials['web']['client_id'],
                    'redirect_uri' => $credentials['web']['redirect_uris'][0],
                    'response_type' => 'code',
                    'scope' => 'https://www.googleapis.com/auth/gmail.readonly',
                    'access_type' => 'offline',
                    'prompt' => 'consent'
                ]));
            }

            $token = json_decode(file_get_contents($tokenPath), true);
            
            // Check if token needs refresh
            if (time() > $token['expires_in']) {
                $response = Http::post('https://oauth2.googleapis.com/token', [
                    'client_id' => $credentials['web']['client_id'],
                    'client_secret' => $credentials['web']['client_secret'],
                    'refresh_token' => $token['refresh_token'],
                    'grant_type' => 'refresh_token'
                ]);
                
                if ($response->successful()) {
                    $token = $response->json();
                    file_put_contents($tokenPath, json_encode($token));
                }
            }

            // Make API request
            $response = Http::withToken($token['access_token'])
                ->get('https://gmail.googleapis.com/gmail/v1/users/me/messages', [
                    'q' => 'subject:"Credit Alert" newer_than:1d'
                ]);

            $messages = $response->json();
            dd($messages);
            
            // Process messages
            if (!empty($messages['messages'])) {
                foreach ($messages['messages'] as $message) {
                    $messageDetails = Http::withToken($token['access_token'])
                        ->get("https://gmail.googleapis.com/gmail/v1/users/me/messages/{$message['id']}")
                        ->json();
                        
                    $emailContent = $this->decodeEmailContent($messageDetails);
                    $transaction = $this->extractTransactionDetails($emailContent);
                    
                    if ($transaction) {
                        $this->creditUserAccount($transaction);
                    }
                }
            }
            
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function handleGoogleCallback(Request $request)
    {
        if (!$request->has('code')) {
            return redirect()->back()->with('error', 'Authorization code not received');
        }

        $credentials = json_decode(file_get_contents(public_path('gmail_credentials.json')), true);
        
        // Exchange code for token
        $response = Http::post('https://oauth2.googleapis.com/token', [
            'client_id' => $credentials['web']['client_id'],
            'client_secret' => $credentials['web']['client_secret'],
            'code' => $request->code,
            'redirect_uri' => $credentials['web']['redirect_uris'][0],
            'grant_type' => 'authorization_code'
        ]);
        
        if ($response->successful()) {
            $token = $response->json();
            $tokenPath = storage_path('app/gmail_token.json');
            file_put_contents($tokenPath, json_encode($token));
            return redirect()->route('process.emails');
        }
        
        return redirect()->back()->with('error', 'Failed to obtain access token');
    }
    private function decodeEmailContent($messageDetails) {
        $parts = $messageDetails['payload']['parts'] ?? [$messageDetails['payload']];
        $content = '';
        
        foreach ($parts as $part) {
            if ($part['mimeType'] === 'text/plain') {
                $content .= base64_decode(str_replace(['-', '_'], ['+', '/'], $part['body']['data']));
            }
        }
        
        return $content;
    }
    function oldprocessCreditAlertEmails() {
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
        } catch(\Exception $e) {
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
    function extractTransactionDetails($emailContent) {
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

    function creditUserAccount($transaction) {
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

    function sendUserNotification($user, $transaction) {
        Mail::to($user->email)->send(new \App\Mail\CreditNotification($transaction));
    }

    protected function schedule(Schedule $schedule) {
        $schedule->call(function () {
            processCreditAlertEmails();
        })->everyFiveMinutes();
    }
}
