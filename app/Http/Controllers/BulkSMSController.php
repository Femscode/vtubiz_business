<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\ContactGroup;
use Illuminate\Http\Request;
use App\Imports\ContactImport;
use App\Traits\TransactionTrait;
use App\Models\BulkSMSTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class BulkSMSController extends Controller
{
    //
    use TransactionTrait;
    public function index()
    {
        // return the default page
        $data['user'] = $user = Auth::user();
        $data['contacts'] = ContactGroup::where('user_id', $user->id)->latest()->get();
        $data['rate_per_page'] = floatval(config('services.smartsms.cost_per_page') ?? env('SMARTSMS_COST_PER_PAGE', 5.00));
        return view('bulksms.index', $data);
    }
    public function adminContactGroup()
    {
        // return the contact group page
        $data['user'] = $user = Auth::user();
        if ($user->user_type == 'customer' || $user->user_type == 'client_customer') {
            return redirect('/premium-contact_group');
        }
        $data['contacts'] = ContactGroup::where('user_id', $user->id)->latest()->get();
        return view('business_backend.contact_group', $data);
    }
    public function contactGroup()
    {
        // return the contact group page
        $data['user'] = $user = Auth::user();
        $data['contacts'] = ContactGroup::where('user_id', $user->id)->latest()->get();
        return view('dashboard.contact_group', $data);
    }
    public function viewGroup($id)
    {
        // return the contact group page
        $data['user'] = $user = Auth::user();
        
        $data['contact'] = $contact = ContactGroup::find($id);
        $user = Auth::user();
        if($user->id !== $contact->user_id) {
            return redirect()->back()->with('message','Access Denied');
        }
        if ($contact->type == 'import') {
            $data['contacts'] = implode(',', unserialize($contact->contacts));
        } else {
            $data['contacts'] = $contact->contacts;
        }
        return view('bulksms.view_group', $data);
    }
    public function viewDetails($id)
    {
        // return the contact group page
        $data['user'] = $user = Auth::user();
        $data['transaction'] = $contact = Transaction::find($id);
        if ($user->id == $contact->user_id) {
            $data['active'] = 'bulksms';
            if($user->user_type == 'admin') {
                return view('business_backend.view_details', $data);
                
            }
            return view('dashboard.view_details', $data);
        } else {
            return redirect()->back()->with('message', 'Access Denied!');
        }
    }
    public function transactions()
    {
        // rethr the transactions page
        $data['user'] = $user = Auth::user();
        $data['transactions'] = Transaction::where('user_id', $user->id)->latest()->get();
        return view('bulksms.transactions', $data);
    }

    public function saveContacts(Request $rq)
    {
        // dd($rq->all());
        // function to save contacts for future SMS transactions
        try {
            $user = Auth::user();

            $this->validate($rq, [
                'name' => 'required',
                // 'contacts' => 'required',
            ]);

            $data = $rq->all();
            // dd($data);
            $data['user_id'] = $user->id;
            // for imported contacts through excel and csv.
            if ($rq->has('import_file')) {
                $contacts =  Excel::toArray(new ContactImport($user->id, $rq->sender_name, $rq->message),  $rq->import_file)[0];
                $contact = [];

                foreach ($contacts as $subContact) {
                    foreach ($subContact as $value) {
                        if (Str::length($value) == 10) {
                            $value = "0" . $value;
                            $contact[] = $value;
                        } elseif (Str::length($value) == 11 || Str::length($value) == 13 || Str::length($value) == 14) {
                            $contact[] = $value;
                        } else {
                            $value = null;
                        }
                    }
                }

                $data['contacts'] = serialize($contact);

                ContactGroup::create([
                    'user_id' => $user->id,
                    'name' => $data['name'],
                    'contacts' => $data['contacts'],
                    'type' => 'import',
                ]);
            } else {
                //for manually typed contacts.
                ContactGroup::create([
                    'user_id' => $user->id,
                    'name' => $data['name'],
                    'contacts' => $data['contacts'],
                    'type' => 'manual'

                ]);
                // ContactGroup::create($data);
            }

            return redirect()->back()->with('message', 'Contacts created successfully');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteGroup($id)
    {
        // function to delete created contact group.
        $contact = ContactGroup::find($id);
        $user = Auth::user();
        if($user->id !== $contact->user_id) {
            return redirect()->back()->with('message','Access Denied');
        }
        $contact->delete();
        return redirect()->back()->with("message", "Contact group deleted succcesfully!");
    }


    public function formatPhoneNumber($phone)
    {
        $cleaned = preg_replace('/[^0-9]/', '', trim((string)$phone));

        if (empty($cleaned)) {
            return null;
        }

        // 13 or 14 digits starting with 234 (e.g. 2348012345678)
        if (str_starts_with($cleaned, '234') && strlen($cleaned) >= 13) {
            return $cleaned;
        }

        // 11 digits starting with 0 (e.g. 08012345678)
        if (str_starts_with($cleaned, '0') && strlen($cleaned) === 11) {
            return '234' . substr($cleaned, 1);
        }

        // 10 digits (e.g. 8012345678)
        if (strlen($cleaned) === 10) {
            return '234' . $cleaned;
        }

        // Other international formats between 10 and 15 digits
        if (strlen($cleaned) >= 10 && strlen($cleaned) <= 15) {
            return $cleaned;
        }

        return null;
    }

    public function submitSMSForm(Request $rq)
    {
        // Validation for the incoming SMS request
        $this->validate($rq, [
            'sender_name' => 'required',
            'contact_type' => 'required',
            'message' => 'required',
            'message_type' => 'required',
        ]);

        $user = Auth::user();

        // Extract contacts based on type
        $raw_contacts = [];
        if ($rq->contact_type == 'import_file' && $rq->hasFile('import_file')) {
            $importedData = Excel::toArray(new ContactImport($user->id, $rq->sender_name, $rq->message), $rq->file('import_file'))[0] ?? [];
            foreach ($importedData as $row) {
                if (is_array($row)) {
                    foreach ($row as $cell) {
                        if (!empty($cell)) {
                            $raw_contacts[] = (string)$cell;
                        }
                    }
                } elseif (!empty($row)) {
                    $raw_contacts[] = (string)$row;
                }
            }
        } elseif ($rq->contact_type == 'select_group') {
            $contactGroup = ContactGroup::find($rq->selected_group);
            if ($contactGroup) {
                if ($contactGroup->type == 'manual') {
                    $raw_contacts = preg_split('/[\r\n,\s]+/', $contactGroup->contacts, -1, PREG_SPLIT_NO_EMPTY);
                } else {
                    $unserialized = @unserialize($contactGroup->contacts);
                    if (is_array($unserialized)) {
                        foreach ($unserialized as $item) {
                            if (!empty($item)) {
                                $raw_contacts[] = (string)$item;
                            }
                        }
                    }
                }
            }
        } else {
            // manual_input
            $inputVal = $rq->contact_field ?? $rq->manual_contact ?? '';
            $raw_contacts = preg_split('/[\r\n,\s]+/', $inputVal, -1, PREG_SPLIT_NO_EMPTY);
        }

        // Normalize phone numbers to international format (e.g. 23480...)
        $formatted_contacts = [];
        foreach ($raw_contacts as $item) {
            $formatted = $this->formatPhoneNumber($item);
            if (!empty($formatted)) {
                $formatted_contacts[] = $formatted;
            }
        }

        $unique_contact = array_values(array_unique($formatted_contacts));
        $contact_count = count($unique_contact);

        if ($contact_count === 0) {
            return response()->json([
                'success' => false,
                'message' => 'No valid recipient phone numbers found. Please check your contacts.',
            ]);
        }

        // Calculate pages (160 characters per page)
        $message_length = mb_strlen($rq->message);
        $message_count = max(1, (int)ceil($message_length / 160));

        if ($message_count > 6) {
            return response()->json([
                'success' => false,
                'message' => 'Message is too long. SmartSMS supports a maximum of 6 pages (up to 918 characters).',
            ]);
        }

        // Load rate strictly from env (SMARTSMS_COST_PER_PAGE)
        $rate_per_page = floatval(config('services.smartsms.cost_per_page') ?? env('SMARTSMS_COST_PER_PAGE', 5.00));
        $total_charge = $rate_per_page * $contact_count * $message_count;
        $amount = number_format($total_charge, 2, '.', '');

        // Verify balance
        if ($user->balance < $total_charge) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient Funds! Required: ₦' . number_format($total_charge, 2) . ', Available: ₦' . number_format($user->balance, 2),
            ]);
        }

        $defaultSender = env('SMARTSMS_SENDER_NAME', config('services.smartsms.sender_name', 'AwaSkool'));
        $sender = trim($rq->sender_name ?: $defaultSender);
        if (strlen($sender) > 11) {
            $sender = substr($sender, 0, 11);
        }

        $response = [
            'success' => true,
            'message' => 'Details Fetched!',
            'sms' => $rq->message,
            'contacts' => implode(',', $unique_contact),
            'amount' => $amount,
            'rate_per_page' => number_format($rate_per_page, 2, '.', ''),
            'real_amount' => $amount,
            'message_type' => $rq->message_type,
            'sender_name' => $sender,
            'count_recipient' => $contact_count,
            'message_count' => $message_count,
        ];

        if ($rq->schedule_date) {
            $response['schedule'] = trim($rq->schedule_date . ' ' . ($rq->schedule_time ?? '00:00'));
        }

        return response()->json($response);
    }

    public function sendSMS2(Request $rq)
    {
        $this->validate($rq, [
            'amount' => ['required', 'numeric', 'min:0'],
            'pin' => ['required'],
            'contacts' => ['required'],
            'message' => ['required'],
        ]);

        $user = Auth::user();
        $hashed_pin = hash('sha256', $rq->pin);
        if ($user->pin !== $hashed_pin) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect PIN!',
                'auto_refund_status' => 'Nil'
            ]);
        }

        $amount = floatval($rq->amount);
        if ($user->balance < $amount) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient funds in your account!',
                'auto_refund_status' => 'Nil'
            ]);
        }

        $details = "Bulk SMS to " . Str::limit($rq->contacts, 100);
        $check = $this->check_duplicate('check', $user->id, $amount, "Bulk SMS", $details);

        if ($check[0] == true) {
            return response()->json([
                'type' => 'duplicate',
                'success' => false,
                'message' => 'Please confirm the success of ' . $check[1]->details . ' before resuming service usage.',
                'auto_refund_status' => 'Nil'
            ]);
        }

        $username = env('SMARTSMS_USERNAME', config('services.smartsms.username'));
        $apiKey = env('SMARTSMS_API_KEY', config('services.smartsms.api_key'));
        $defaultSender = env('SMARTSMS_SENDER_NAME', config('services.smartsms.sender_name', 'AwaSkool'));

        $sender = trim($rq->sender_name ?: $defaultSender);
        if (strlen($sender) > 11) {
            $sender = substr($sender, 0, 11);
        }

        $recipient_string = $rq->contacts;
        $message = $rq->message;
        $real_amount = $rq->real_amount ?? $amount;
        $message_type = $rq->message_type ?? 'Normal SMS';
        $flash = ($message_type === 'Flash SMS') ? '1' : '0';

        // Parse recipients and build GSM array for SmartSMS
        $contacts_array = array_filter(array_map('trim', explode(',', $recipient_string)));
        $gsm = [];
        $valid_contacts = [];

        foreach ($contacts_array as $idx => $phone) {
            $formatted = $this->formatPhoneNumber($phone);
            if (!empty($formatted)) {
                $valid_contacts[] = $formatted;
                $gsm[] = [
                    'msidn' => $formatted,
                    'msgid' => 'msg_' . time() . '_' . Str::random(6) . '_' . ($idx + 1),
                ];
            }
        }

        if (empty($gsm)) {
            $this->check_duplicate("Delete", $user->id);
            return response()->json([
                'success' => false,
                'message' => 'No valid recipient phone numbers provided.',
            ]);
        }

        $messagePayload = [
            'sender' => $sender,
            'messagetext' => $message,
            'flash' => $flash,
        ];

        if ($rq->filled('schedule')) {
            $messagePayload['schedule'] = $rq->schedule;
        }

        $smartSMSPayload = [
            'SMS' => [
                'auth' => [
                    'username' => $username,
                    'apikey' => $apiKey,
                ],
                'message' => $messagePayload,
                'recipients' => [
                    'gsm' => $gsm,
                ],
            ],
        ];

        $apiUrl = "https://www.smartsms.ng/api/sendsms.json";

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30)->post($apiUrl, $smartSMSPayload);

            $statusCode = $response->status();
            $responseData = $response->json();
            $responseBody = $response->body();

            // Log detailed response to smslog.txt
            @file_put_contents(
                __DIR__ . '/smslog.txt',
                date('Y-m-d H:i:s') . " - SmartSMS Request:\n" . json_encode($smartSMSPayload, JSON_PRETTY_PRINT) . "\nResponse (" . $statusCode . "):\n" . ($responseBody) . "\n----------------------------------------\n",
                FILE_APPEND
            );

            $statusString = strtoupper($responseData['response']['status'] ?? '');
            $isSuccess = ($response->successful() && $statusString === 'SUCCESS');

            if ($isSuccess) {
                if ($rq->filled('schedule')) {
                    $title = 'Successful Scheduled Bulk SMS';
                    $details = 'Scheduled Bulk SMS to be sent to ' . implode(',', $valid_contacts) . ' by ' . $rq->schedule . ', Amount: NGN' . number_format($amount, 2) . '. Message: ' . $message;
                } else {
                    $title = 'Successful Instant Bulk SMS';
                    $details = 'Bulk SMS sent to ' . implode(',', $valid_contacts) . ', Amount: NGN' . number_format($amount, 2) . '. Message: ' . $message;
                }

                $this->create_bulksms_transaction($title, $details, $sender, $message, implode(',', $valid_contacts), $amount, 1, $statusCode, $rq->schedule ?? null, $message_type, $real_amount);
                $this->check_duplicate("Delete", $user->id);

                return response()->json([
                    'success' => true,
                    'message' => $rq->filled('schedule') ? 'Bulk SMS Scheduled Successfully!' : 'Sent Successfully!',
                    'schedule' => $rq->schedule ?? null,
                ]);
            } else {
                $title = "Failed Bulk SMS";
                $details = 'Failed Bulk SMS, recipient: ' . implode(',', $valid_contacts) . ' Amount: NGN0.00, Message: ' . $message;
                $this->create_bulksms_transaction($title, $details, $sender, $message, implode(',', $valid_contacts), 0, 0, $statusCode, $rq->schedule ?? null, $message_type, $real_amount);
                $this->check_duplicate("Delete", $user->id);

                // User-friendly error message without leaking provider units or internals
                $userMsg = 'Unable to send SMS, please try again later or contact support!';
                if ($statusString === 'INVALID_MESSAGE') {
                    $userMsg = 'The message text is invalid or exceeds the allowed length.';
                } elseif ($statusString === 'INVALID_SENDER') {
                    $userMsg = 'The sender name is invalid. Alphanumeric sender names must not exceed 11 characters.';
                } elseif ($statusString === 'MISSING_RECIPIENT') {
                    $userMsg = 'No valid recipient phone numbers found.';
                }

                return response()->json([
                    'success' => false,
                    'message' => $userMsg,
                ]);
            }
        } catch (\Exception $e) {
            @file_put_contents(
                __DIR__ . '/smslog.txt',
                date('Y-m-d H:i:s') . " - SmartSMS Exception:\n" . $e->getMessage() . "\n----------------------------------------\n",
                FILE_APPEND
            );

            $title = "Failed Bulk SMS";
            $details = 'Failed Bulk SMS, recipient: ' . $recipient_string . ' Amount: NGN0.00, Message: ' . $message;
            $this->create_bulksms_transaction($title, $details, $sender, $message, $recipient_string, 0, 0, 500, $rq->schedule ?? null, $message_type, $real_amount);
            $this->check_duplicate("Delete", $user->id);

            return response()->json([
                'success' => false,
                'message' => 'Unable to send SMS, please try again later or contact support!',
            ]);
        }
    }

    public function resendSMS($id)
    {
        $tranx = BulkSMSTransaction::find($id) ?? Transaction::find($id);
        if (!$tranx) {
            return redirect()->back()->with('error', 'Transaction not found');
        }

        $user = Auth::user();
        if ($user->id !== $tranx->user_id) {
            return redirect()->back()->with('message', 'Access Denied');
        }

        $the_work = $this->sendSMS($tranx->sender, $tranx->recipient, $tranx->message, $tranx->amount, $tranx->message_type);

        if ($the_work === true) {
            return redirect()->back()->with('message', 'Bulk SMS sent successfully!');
        } else {
            return redirect()->back()->with('error', 'Error encountered while sending SMS!');
        }
    }

    public function sendSMS($sender, $recipient, $message, $amount, $message_type)
    {
        $username = env('SMARTSMS_USERNAME', config('services.smartsms.username'));
        $apiKey = env('SMARTSMS_API_KEY', config('services.smartsms.api_key'));
        $defaultSender = env('SMARTSMS_SENDER_NAME', config('services.smartsms.sender_name', 'AwaSkool'));

        $sender = trim($sender ?: $defaultSender);
        if (strlen($sender) > 11) {
            $sender = substr($sender, 0, 11);
        }

        $flash = ($message_type === 'Flash SMS') ? '1' : '0';
        $contacts_array = array_filter(array_map('trim', explode(',', $recipient)));
        $gsm = [];
        $valid_contacts = [];

        foreach ($contacts_array as $idx => $phone) {
            $formatted = $this->formatPhoneNumber($phone);
            if (!empty($formatted)) {
                $valid_contacts[] = $formatted;
                $gsm[] = [
                    'msidn' => $formatted,
                    'msgid' => 'msg_' . time() . '_' . Str::random(6) . '_' . ($idx + 1),
                ];
            }
        }

        if (empty($gsm)) {
            return false;
        }

        $smartSMSPayload = [
            'SMS' => [
                'auth' => [
                    'username' => $username,
                    'apikey' => $apiKey,
                ],
                'message' => [
                    'sender' => $sender,
                    'messagetext' => $message,
                    'flash' => $flash,
                ],
                'recipients' => [
                    'gsm' => $gsm,
                ],
            ],
        ];

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30)->post("https://www.smartsms.ng/api/sendsms.json", $smartSMSPayload);

            $statusCode = $response->status();
            $responseData = $response->json();

            @file_put_contents(
                __DIR__ . '/smslog.txt',
                date('Y-m-d H:i:s') . " - SmartSMS sendSMS Response (" . $statusCode . "):\n" . $response->body() . "\n----------------------------------------\n",
                FILE_APPEND
            );

            $statusString = strtoupper($responseData['response']['status'] ?? '');
            if ($response->successful() && $statusString === 'SUCCESS') {
                $user = Auth::user();
                $ref = Str::random(7);
                $details = 'Bulk SMS sent to ' . implode(',', $valid_contacts) . ', Amount: NGN' . number_format($amount, 2) . '. Message: ' . $message;
                $this->create_transaction('Bulk SMS', $ref, $details, 'debit', $amount, $user->id, 1);
                return true;
            } else {
                $user = Auth::user();
                $ref = Str::random(7);
                $details = 'Failed Bulk SMS, recipient: ' . implode(',', $valid_contacts) . ' Amount: NGN0.00, Message: ' . $message;
                $this->create_transaction('Failed Bulk SMS', $ref, $details, 'debit', 0, $user->id, 0);
                return false;
            }
        } catch (\Exception $e) {
            @file_put_contents(
                __DIR__ . '/smslog.txt',
                date('Y-m-d H:i:s') . " - SmartSMS sendSMS Exception:\n" . $e->getMessage() . "\n----------------------------------------\n",
                FILE_APPEND
            );
            return false;
        }
    }

    public function create_bulksms_transaction($title, $details, $sender, $message, $recipient, $amount, $status, $statusCode, $schedule, $message_type, $real_amount)
    {
        $user = Auth::user();
        $company = User::where('id', $user->company_id)->first();

        // Create the transaction
        $tranx = BulkSMSTransaction::create([
            'user_id' => $user->id,
            'company_id' => $user->company_id ?? $user->id,
            'title' => $title,
            'description' => $details,
            'sender' => $sender,
            'message' => $message,
            'recipient' => $recipient,
            'amount' => $amount,
            'status' => $status,
            'status_code' => $statusCode,
            'scheduled_for' => $schedule,
            'before' => $user->balance,
            'admin_before' => $company ? $company->balance : null,
            'message_type' => $message_type
        ]);

        // Charging the user
        if ($status == 1) {
            $user->balance -= $amount;
            $user->save();
            $tranx->after = $user->balance;

            $tranx->save();
            if ($company) {
                $company->save();
            }
        } else {
            $tranx->after = $user->balance;
            if ($company) {
                $tranx->admin_after = $company->balance;
            }
            $tranx->save();
        }
    }
}
