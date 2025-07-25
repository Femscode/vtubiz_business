<?php

namespace App\Http\Controllers;

use App\Models\DuplicateTransaction;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WhatsappController extends Controller
{
    //

    public function resolve_pending()
    {
        //for transactions that are more than 2minuetes
        // $duplicate = DuplicateTransaction::where('created_at', '<=', now()->subMinutes(2))->first();
        $duplicate = DuplicateTransaction::where('notification_status',0)->latest()->first();
        // dd($duplicate);
        // $duplicate = DuplicateTransaction::where('created_at', '<', now()->subMinutes(40))->first();
        $unresolved_transactions = Transaction::where('reference', 'like', 'data_p%')
            ->where('refund_status', 0)
            ->where('notification_status', 0)
            ->where('created_at', '>=', now()->subMinutes(5))
            ->first();
        //You should write a function that send messages to users informing them that we are fixing the issue currently.
        if ($duplicate || $unresolved_transactions) {

            try {
                Mail::raw('Attention is needed on the website.', function ($message) {
                    $message->to(['fasanyafemi@gmail.com','ogungbemioluwagbenga22@gmail.com'])
                        ->subject('Urgent Attention needed on VTUBIZ');
                });
                if($duplicate) {
                    $duplicate->notification_status = 1;
                    $duplicate->save();
                }
                if($unresolved_transactions) {
                    $unresolved_transactions->notification_status = 1;
                    $unresolved_transactions->save();
                }
                return response()->json(['message' => 'sent'], 200);
            } catch (\Exception $e) {
                \Log::error('Email sending error: '. $e->getMessage());
                return response()->json(['message' => 'not sent'], 500);
            }   
            
            $parameters = [
                [
                    'type' => 'body',
                    'parameters' => [
                        'customer_name' => 'VTUBIZ'
                    ]
                ]
            ];
            $success = $this->runWhatsappNotification(
                '09058744473',
                'pending_transaction',
                $parameters
            );
            if ($success) {
                return response()->json([
                    'message' => 'Notification sent successfully',
                ]);
            } else {
                return response()->json([
                    'message' => 'Failed to send notification',
                ], 500);
            }
        } else {
            return response()->json([
               'message' => 'No unresolved transactions found',
            ]);
        }
    }

    private function runWhatsappNotification($phone, $template_name, $parameters)
    {
        // $phone = '09058744473';
        if (substr($phone, 0, 1) === '0') {
            $phone = '+234' . substr($phone, 1);
        }

        // dd($phone);
        $message = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $phone,
            'type' => 'template',
            'template' => [
                'name' => $template_name,
                'language' => ['code' => 'en'],
                'components' => []
            ]
        ];

        // Process and add components based on parameters
        foreach ($parameters as $param) {
            $component = [
                'type' => $param['type'],
                'parameters' => []
            ];

            // Add parameters based on the component type
            if (isset($param['parameters'])) {
                foreach ($param['parameters'] as $key => $value) {
                    $component['parameters'][] = [
                        'type' => 'text',
                        'parameter_name' => $key,
                        'text' => $value
                    ];
                }
            }

            // Add sub_type and index for button components if provided
            if (isset($param['sub_type'])) {
                $component['sub_type'] = $param['sub_type'];
            }
            if (isset($param['index'])) {
                $component['index'] = $param['index'];
            }

            $message['template']['components'][] = $component;
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://graph.facebook.com/v17.0/' . env('WHATSAPP_NUMBER_ID') . '/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($message),
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . env('WHATSAPP_ACCESS_TOKEN'),
                'Content-Type: application/json',
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            \Log::error('WhatsApp API Error: ' . $err);
            return false;
        }

        $responseData = json_decode($response, true);
        if (isset($responseData['error'])) {
            \Log::error('WhatsApp API Response Error: ' . json_encode($responseData['error']));
            return false;
        }

        return true;
    }
}
