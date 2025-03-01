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
        $client = new Google_Client();
        
        $credentialsPath = public_path('gmail_credentials.json');
        if (!file_exists($credentialsPath)) {
            throw new \Exception('Gmail credentials file not found');
        }
        
        try {
            $client->setAuthConfig($credentialsPath);
            $client->addScope(Google_Service_Gmail::GMAIL_READONLY);
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
    
    public function handleGoogleCallback(Request $request)
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
