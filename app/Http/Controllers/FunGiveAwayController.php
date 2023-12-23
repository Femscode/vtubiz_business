<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Data;
use App\Models\User;
use App\Models\Cable;
use App\Models\Answer;
use App\Models\Result;
use App\Models\Airtime;
use App\Models\GiveAway;
use App\Models\Question;
use App\Models\DataGroup;
use App\Models\ComingSoon;
use App\Models\Beneficiary;
use App\Models\Electricity;
use App\Models\Examination;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\AirtimeGroup;
use App\Models\ContactGroup;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\DataRecipient;
use Flutterwave\Transactions;
use App\Models\ScheduleAccount;
use App\Models\AirtimeRecipient;
use App\Models\GiveAwayContacts;
use App\Models\GiveawaySchedule;
use App\Models\SchedulePurchase;
use App\Traits\TransactionTrait;
use App\Models\DuplicateTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class FunGiveAwayController extends Controller
{
    use TransactionTrait;
    public function fun_giveaway_data()
    {

        $data['user'] = $user = Auth::user();
        $datas = Data::where('user_id', 0)->get();
        $check_data = Data::where('user_id', $user->id)->first();
        // Data::where('user_id', $user->id)->delete();
        // dd($check_data,$datas[0]);
        if ($user->upgrade == 0) {
            if (!$check_data) {
                foreach ($datas as $data) {
                    Data::create([
                        'user_id' => $user->id,
                        'network' => $data->network,
                        'plan_id' => $data->plan_id,
                        'plan_name' => $data->plan_name,
                        'actual_price' => $data->actual_price,
                        'data_price' => $data->account_price,
                        'account_price' => $data->account_price,
                        'admin_price' => $data->account_price
                    ]);
                }
            }
        } else {
            if (!$check_data) {
                foreach ($datas as $data) {
                    Data::create([
                        'user_id' => $user->id,
                        'network' => $data->network,
                        'plan_id' => $data->plan_id,
                        'plan_name' => $data->plan_name,
                        'actual_price' => $data->actual_price,
                        'data_price' => $data->data_price,
                        'account_price' => $data->data_price,
                        'admin_price' => $data->data_price
                    ]);
                }
            }
        }


        $data['user'] = $user = Auth::user();
        $data['active'] = 'data';
        $data['company'] = User::where('id', $user->company_id)->first();
        $data['beneficiaries'] = Beneficiary::where('user_id', $user->id)->latest()->get();
        if($user->user_type == 'customer' || $user->user_type == 'user' || $user->user_type == 'client_customer') {
            return response()->view('dashboard.create-giveaway', $data);
        
        }

        return response()->view('business_backend.create-giveaway', $data);
    }
    public function createDataGiveaway(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        $company = User::where('id', $user->company_id)->first();
        $hashed_pin = hash('sha256', $request->pin);
        if ($user->pin !== $hashed_pin) {
            $response = [
                'success' => false,
                'message' => 'Incorrect Pin!',
                'auto_refund_status' => 'Nil'
            ];

            return response()->json($response);
        }
        if ($request->has('part_no') && $request->no_winner > $request->part_no) {
            $response = [
                'success' => false,
                'message' => 'Winner\'s cannot be higher than participants.',
                'auto_refund_status' => 'Nil'
            ];

            return response()->json($response);
        }

        //check balance
        if ($request->giveaway_type == "Data") {
            $amount = $request->no_winner * $request->winner_real_price;
        } else {
            if ($request->giveaway_type == 'Airtime') {
                if ($request->giveaway_type == "Cash") {
                    if ($request->type == 'question') {
                        $amount = $request->no_winner * $request->q_cash_price;
                    } else {
                        $amount = $request->no_winner * $request->raffle_cash_price;
                    }
                } else {
                    if ($request->type == 'question') {
                        $amount = $request->no_winner * $request->q_airtime_price;
                    } else {
                        $amount = $request->no_winner * $request->raffle_airtime_price;
                    }
                }
            } else {
                if ($request->giveaway_type == "Cash") {
                    if ($request->type == 'question') {
                        $amount = $request->no_winner * $request->q_cash_price;
                    } else {

                        $amount = $request->no_winner * $request->raffle_cash_price;
                    }
                } else {
                    if ($request->type == 'question') {
                        $amount = $request->no_winner * $request->question_airtime_price;
                    } else {
                        $amount = $request->no_winner * $request->raffle_airtime_price;
                    }
                }
            }
        }

        // dd($amount,$request->all());

        if ($user->balance < $amount || $amount <= 100) {
            $response = [
                'success' => false,
                'message' => 'Insufficient balance for the plan you want to get!',
                'auto_refund_status' => 'Nil'
            ];

            return response()->json($response);
        }
        $rand = Str::random(5);
        if ($request->type == 'raffle') {
            if ($request->giveaway_type == 'Data') {
                $giveaway = GiveAway::create([
                    'user_id' => $user->id,
                    'slug' => str_replace(' ', '-', $request->name . "-" . $rand),
                    'name' => $request->name,
                    'part_no' => $request->part_no,
                    'no_of_winners' => $request->no_winner,
                    'data_price' => $request->winner_price,
                    'estimated_amount' => $amount,
                    'type' => 'raffle_data',
                    'giveaway_type' => 'data',
                ]);
            } elseif ($request->giveaway_type == "Cash") {
                $giveaway = GiveAway::create([
                    'user_id' => $user->id,
                    'slug' => str_replace(' ', '-', $request->name . "-" . $rand),
                    'name' => $request->name,
                    'part_no' => $request->part_no,
                    'no_of_winners' => $request->no_winner,
                    'airtime_price' => $request->raffle_cash_price,
                    'estimated_amount' => $amount,
                    'type' => 'raffle_cash',
                    'giveaway_type' => 'cash',

                ]);
            } else {
                $giveaway = GiveAway::create([
                    'user_id' => $user->id,
                    'slug' => str_replace(' ', '-', $request->name . "-" . $rand),
                    'name' => $request->name,
                    'part_no' => $request->part_no,
                    'no_of_winners' => $request->no_winner,
                    'airtime_price' => $request->raffle_airtime_price,
                    'estimated_amount' => $amount,
                    'type' => 'raffle_airtime',
                    'giveaway_type' => 'airtime',

                ]);
            }
            $availableNumbers = range(1, $giveaway->part_no);
            $existingNumbers = $giveaway->lucky_numbers ?? [];
            $availableNumbers = array_diff($availableNumbers, $existingNumbers);

            $selectedNumbers = array_rand($availableNumbers, $giveaway->no_of_winners);
            $selectedNumbers = array_values($selectedNumbers);

            // Add 1 to each selected number to shift the range from 0-based to 1-based
            $selectedNumbers = array_map(function ($num) {
                return $num + 1;
            }, $selectedNumbers);

            // Add selected numbers to existing numbers
            $existingNumbers = array_merge($existingNumbers, $selectedNumbers);

            $giveaway->update(['lucky_numbers' => $existingNumbers]);
            $giveaway->update(['lucky_numbers_confirm' => $existingNumbers]);
        } else {
            if ($request->giveaway_type == 'Data') {
                $giveaway = GiveAway::create([
                    'user_id' => $user->id,
                    'slug' => str_replace(' ', '-', $request->name . "-" . $rand),
                    'name' => $request->name,
                    'time' => $request->time,
                    'no_of_winners' => $request->no_winner,
                    'max_winners' => $request->no_winner,
                    'data_price' => $request->winner_price,
                    'estimated_amount' => $amount,
                    'type' => 'question_data',
                    'giveaway_type' => 'data',

                ]);
            } elseif ($request->giveaway_type == 'Cash') {
                $giveaway = GiveAway::create([
                    'user_id' => $user->id,
                    'slug' => str_replace(' ', '-', $request->name . "-" . $rand),
                    'name' => $request->name,
                    'time' => $request->time,
                    'no_of_winners' => $request->no_winner,
                    'max_winners' => $request->no_winner,
                    'airtime_price' => $request->q_cash_price,
                    'estimated_amount' => $amount,
                    'type' => 'question_cash',
                    'giveaway_type' => 'cash',

                ]);
            } else {
                $giveaway = GiveAway::create([
                    'user_id' => $user->id,
                    'slug' => str_replace(' ', '-', $request->name . "-" . $rand),
                    'name' => $request->name,
                    'time' => $request->time,
                    'no_of_winners' => $request->no_winner,
                    'max_winners' => $request->no_winner,
                    'airtime_price' => $request->q_airtime_price,
                    'estimated_amount' => $amount,
                    'type' => 'question_airtime',
                    'giveaway_type' => 'airtime',

                ]);
            }
        }
        $client_reference = $giveaway->slug . "_" . Str::random(5);
        $details = "Giveaway Link : https://vtubiz.com/" . $giveaway->slug . " | Amount: NGN" . $amount;
        $trans_id = $this->create_transaction('Giveaway', $client_reference, $details, 'debit', $amount, $user->id, 1);

        $response = [
            'success' => true,
            'message' => 'Giveaway Created Successfully!',
            'auto_refund_status' => 'Nil'
        ];
        return $response;
    }
    public function my_giveaway()
    {
        $data['user'] = $user = Auth::user();

        $data['giveaway'] = GiveAway::where('user_id', $user->id)
            ->latest()->get();
            if($user->user_type == 'customer' || $user->user_type == 'user' || $user->user_type == 'client_customer') {
                $data['active'] = 'giveaway';
                return response()->view('dashboard.my-giveaway', $data);
            
            }
        return view('business_backend.my-giveaway', $data);
    }
    public function giveawayHome($slug)
    {
        $data['giveaway'] = $giveaway = GiveAway::where('slug', $slug)->first();
        $data['userId'] = Str::random(10);
        return view('giveaway.home', $data);
    }
    public function saveGiveAwayContacts(Request $request)
    {

        $this->validate($request, [
            'giveaway_id' => 'required',
            'user_id' => 'required',
            'name' => 'required',
            'phone' => 'required'
        ]);
        $data['giveaway'] = $giveaway = GiveAway::find($request->giveaway_id);
        if (session()->has('participate_' . $giveaway->slug)) {
            return redirect()->back()->with('message', 'You have already participated in this giveaway');
        }
        $part = $data['participant'] = GiveAwayContacts::create([
            'giveaway_id' => $request->giveaway_id,
            'user_id' => $request->user_id,
            'name' => $request->name,
            'phone' => $request->phone
        ]);

        if ($giveaway->type == 'question_data' || $giveaway->type == 'question_airtime' ||  $giveaway->type == 'question_cash') {

            $data['time'] = $time = $giveaway->time;
            // dd($time,$giveaway);
            $data['giveawayQuestions'] = $testQuestions = Question::where('test_id', $giveaway->id)->with('answers')->get();
            // $data['authUserHasPlayedtest'] = $authUserHasPlayedtest = Result::where(['user_id' => $authUser, 'test_id' => $giveaway->id])->get();

            //has user played particular test
            // $wasCompleted = Result::where('user_id', $authUser)->whereIn('test_id', (new GiveAway)->hasTestAttempted())->pluck('test_id')->toArray();

            session()->put('participate_' . $giveaway->slug, $giveaway->slug);
            if ($giveaway->max_winners == 0) {
                return redirect()->back()->with('message', 'Giveaway ended already!');
            }


            return view('business_backend.testpage', $data);
        }
        $existingNumbers = $giveaway->all_numbers ?? [];
        if(count($giveaway->all_numbers ?? []) / $giveaway->part_no == 1) {
            return redirect()->back()->with('message','Giveaway Ended Already!');
        }
        if (count($existingNumbers) >= $giveaway->part_no) {
            $data['rand_no'] =  "xxx";
            $data['won'] = 0;
        } else {

            do {
                $randomNumber = mt_rand(1, $giveaway->part_no);
            } while (in_array($randomNumber, $existingNumbers));

            $existingNumbers[] = $randomNumber;
            $data['rand_no'] =  $randomNumber;
            $giveaway->update(['all_numbers' => $existingNumbers]);

            if (in_array($randomNumber, $giveaway->lucky_numbers)) {
                $part->is_win = 1;
                $part->lucky_number = $randomNumber;
                $part->save();
                $data['won'] = 1;
            } else {
                $part->lucky_number = $randomNumber;
                $part->save();
                $data['won'] = 0;
            }
        }
        session()->put('participate_' . $giveaway->slug, $giveaway->slug);
        $data['lucky_winners'] = GiveAwayContacts::where('giveaway_id', $giveaway->id)
            ->where('is_win', 1)->latest()->get();
        return view('giveaway.contest', $data);
    }
    public function claim_price($giveaway_id, $user_id, $rand_no)
    {
        $giveaway = GiveAway::find($giveaway_id);
        if ($giveaway->type == 'question_data' || $giveaway->type == 'question_airtime' || $giveaway->type == 'question_cash') {
        } else {

            if (!in_array($rand_no, $giveaway->lucky_numbers)) {
                return redirect()->back()->with('message', 'You didnt qualify for this giveaway');
            }
        }

        $data['participant'] = GiveAwayContacts::where('user_id', $user_id)->first();


        $data['giveaway_id']  = $giveaway_id;
        $data['giveaway'] = GiveAway::find($giveaway_id);

        $data['rand_no'] = $rand_no;
        $data['won'] = 1;
        $data['mtn'] = $mtn = Data::where('user_id', 0)->where('network', 1)->where('plan_name', 'like', '%' . $giveaway->data_price . '%')->first();
        $data['glo'] = $glo = Data::where('user_id', 0)->where('network', 2)->where('plan_name', 'like', '%' . $giveaway->data_price . '%')->first();
        $data['airtel'] = $airtel = Data::where('user_id', 0)->where('network', 3)->where('plan_name', 'like', '%' . $giveaway->data_price . '%')->first();
        $data['n_mobile'] = $n_mobile = Data::where('user_id', 0)->where('network', 4)->where('plan_name', 'like', '%' . $giveaway->data_price . '%')->first();
        //    dd($mtn, $airtel, $glo, $n_mobile);
        if ($giveaway->type == 'question_data' || $giveaway->type == 'question_airtime' || $giveaway->type == 'question_cash') {
            if ($giveaway->max_winners > 0) {
                $giveaway->max_winners -= 1;
                $giveaway->save();
            } else {
                return false;
            }
        }

        return view('giveaway.claim_price', $data);
    }

    public function createGiveawaySchedule(Request $request)
    {
        $giveaway = GiveAway::find($request->giveaway_id);
       
        
        $data = Data::where('plan_id', $request->plan_id)->first();

        $giveaway = GiveAway::find($request->giveaway_id);
        $rand_no = $request->rand_no;

        if (session()->has('claimed_vtubiz_' . $giveaway->slug)) {
            return false;
        }
        if ($giveaway->type == 'raffle_data' || $giveaway->type == 'raffle_airtime' || $giveaway->type == 'raffle_cash') {
            $luckyNumbersConfirm = $giveaway->lucky_numbers_confirm;
            // dd($luckyNumbersConfirm,$rand_no,$request->all());

            if (in_array($rand_no, $luckyNumbersConfirm)) {
                $res = array_diff($giveaway->lucky_numbers_confirm, [$rand_no]);
                // dd($res);
                $giveaway->update(['lucky_numbers_confirm' => $res]);
            } else {
                return false;
            }
        }
        if ($giveaway->giveaway_type == 'data') {
            $giveaway = GiveawaySchedule::create([
                'giveaway_id' => $request->giveaway_id,
                'name' => $request->name,
                'participant_id' => $request->participant_id,
                'phone' => $request->phone,
                'type' => 'data',
                'network' => $data->network,
                'plan_id' => $request->plan_id,
                'plan_name' => $data->plan_name
            ]);
        } elseif ($giveaway->giveaway_type == 'cash') {
           GiveawaySchedule::create([
                'giveaway_id' => $request->giveaway_id,
                'name' => $request->name,
                'participant_id' => $request->participant_id,
                'phone' => $request->phone,
                'type' => 'cash',
                'amount' => $giveaway->airtime_price,
                'account_name' => $request->account_name,
                'account_no' => $request->account_no,
                'bank_code' => $request->bank_code,
                'bank_name' => $request->bank_name,
            ]);
            ScheduleAccount::create([
                'giveaway_id' => $request->giveaway_id,
                'user_id' => $giveaway->user_id,
                'name' => $request->name,
                'account_name' => $request->account_name,
                'account_no' => $request->account_no,
                'bank_name' => $request->bank_name,
                'bank_code' => $request->bank_code,
                'amount' => $giveaway->airtime_price,
            ]);
        } else {
            GiveawaySchedule::create([
                'giveaway_id' => $request->giveaway_id,
                'name' => $request->name,
                'participant_id' => $request->participant_id,
                'phone' => $request->phone,
                'type' => 'airtime',
                'amount' => $giveaway->airtime_price,
                'network' => $request->airtime_network,
            ]);
        }
        session()->put('claimed_vtubiz_' . $giveaway->slug, $giveaway->slug);
        return true;
    }
    public function giveaway_participants($slug)
    {
        $data['giveaway'] = $giveaway = GiveAway::where('slug', $slug)->first();
        $data['participants'] = GiveAwayContacts::where('giveaway_id', $giveaway->id)->latest()->get();
        $data['user'] = $user = Auth::user();
        if($user->user_type == 'customer' || $user->user_type == 'user' || $user->user_type == 'client_customer') {
            $data['active'] = 'giveaway';
            return response()->view('dashboard.giveaway_participants', $data);
        
        }
        
        return view('business_backend.giveaway_participants', $data);
    }
    public function giveaway_transactions($slug)
    {
        $data['giveaway'] = $giveaway = GiveAway::where('slug', $slug)->first();
        $data['participants'] = GiveAwayContacts::where('giveaway_id', $giveaway->id)->latest()->get();
        $data['transactions'] = GiveawaySchedule::where('giveaway_id', $giveaway->id)->latest()->get();
        $data['user'] = $user = Auth::user();
        if($user->user_type == 'customer' || $user->user_type == 'user' || $user->user_type == 'client_customer') {
            $data['active'] = 'giveaway';
            return response()->view('dashboard.giveaway_transactions', $data);
        
        }

        return view('business_backend.giveaway_transactions', $data);
    }
    public function addQuestion($slug)
    {
        $data['giveaway'] = $giveaway = GiveAway::where('slug', $slug)->first();
        $data['user'] = $user = Auth::user();
        $data['questions'] = Question::where('test_id', $giveaway->id)->get();
        $giveaway = GiveAway::where('slug', $slug)->first();
        $data['tests'] = GiveAway::with('my_questions')->where('id', $giveaway->id)->get();
        if($user->user_type == 'customer' || $user->user_type == 'user' || $user->user_type == 'client_customer') {
            $data['active'] = 'giveaway';
            return response()->view('dashboard.question', $data);
        
        }
        return view('business_backend.question', $data);
    }
    public function storequestion(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'test' => ['required'],
            'question' => ['required', 'min:10'],
            'correct_answer' => ['required']

        ]);
        $data = $request->all();
        // dd($data);
        $question = (new Question)->storeQuestion($data);
        // dd($data);
        $answer = (new Answer)->storeAnswer($data, $question);
        return redirect()->back()->with('message', 'Question Created Successfully');
        return redirect()->route('question.index')->with('message', 'Question created successfully!');
    }



    public function submittest(Request $request)
    {

        $questionId = $request['questionId'];
        $answerId = $request['answerId'];
        $userId = $request['userId'];
        $data['active'] = 'test';
        $testId = $request['testId'];

        $question_id  = Answer::where('id', $answerId)->pluck('question_id')[0];
        // dd($question_id);
        $data['active'] = 'test';
        return $userQuestionAnswer = Result::updateOrCreate(
            ['user_id' => $userId, 'test_id' => $testId, 'question_id' => $question_id],
            ['answer_id' => $answerId]

        );
    }
    public function finishtest(Request $request)
    {

        $attemptTest  = [];
        $authUser = $request->userId;
        $user = Result::where('user_id', $authUser)->get();
        $user->is_attempted = 1;
        foreach ($user as $u) {
            array_push($attemptTest, $u->test_id);
        }
        return $attemptTest;
    }

    public function checkuserresult($userId, $testId)
    {

        // $user = User::get();
        // $userId = $request->userId;
        // $testId = $request->testId;
        $participant = GiveAwayContacts::find($userId);
        $data['giveaway'] = $giveaway = GiveAway::find($testId);
        // dd('here',session()->has('participate_' . $giveaway->id));

        // if (session()->has('participate_' . $giveaway->id)) {
        //     return redirect()->back()->with('message', 'You have already participated in this giveaway');
        // }

        $results = Result::where('user_id', $userId)->where('test_id', $testId)->get();
        $totalQuestions = Question::where('test_id', $testId)->count();
        $attemptQuestion = Result::where('test_id', $testId)->where('user_id', $userId)->count();
        $Test = Giveaway::where('id', $testId)->get();

        // dd($Test);

        $ans = [];
        foreach ($results as $answer) {
            array_push($ans, $answer->answer_id);
        }
        $userCorrectedAnswer = Answer::whereIn('id', $ans)->where('is_correct', 1)->count();
        $userWrongAnswer = $totalQuestions - $userCorrectedAnswer;
        if ($attemptQuestion) {
            $percentage = ($userCorrectedAnswer / $totalQuestions) * 100;
        } else {
            $percentage = 0;
        }
        if($percentage == 100) {
            $participant->is_win = 1;
            $participant->save();
        }
        $user = Auth::user();
        $test = Giveaway::find($testId);
        // dd($userCorrectedAnswer,'corrent',$userWrongAnswer,'wrong',$totalQuestions,'all questions',$attemptQuestion,'attempted questions');
       
        return view('business_backend.viewresult', compact('user', 'participant', 'giveaway', 'results', 'totalQuestions', 'attemptQuestion', 'userCorrectedAnswer', 'userWrongAnswer', 'percentage', 'Test', 'test'));
    }


    public function confirm_account_details(Request $request)
    {
        // dd($request->all());
        $url = "https://api.paystack.co/transferrecipient";

        $fields = [
            'type' => "nuban",
            'name' => "",
            'account_number' => $request->account_no,
            'bank_code' => $request->bank_code,
            'currency' => "NGN"
        ];

        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer sk_live_dc09eacf4aed817703251640abf8bd4b4f0d007f",
            "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        $res_json = json_decode($result, true);
        if ($res_json['status'] == true) {
            return $res_json;
        }
        return false;
        dd($res_json);
    }

    public function delete_question($id)
    {
        $user = Auth::user();
        $question = Question::find($id);
        $giveaway = GiveAway::find($question->give_away_id);

        if ($user->id == $giveaway->user_id || $user->email == 'fasanyafemi@gmail.com') {
            $answers = Answer::where('question_id', $question->id)->delete();
            $question->delete();
            return redirect()->back()->with('message', 'Question Deleted Successfully!');
        } else {
            return redirect()->back()->with('message', 'Access Denied!');
        }
    }
    public function delete_giveaway($slug)
    {
        $giveaway = GiveAway::where('slug', $slug)->first();
        $user = Auth::user();
        if ($user->id == $giveaway->user_id || $user->email == 'fasanyafemi@gmail.com') {
            $contacts = GiveAwayContacts::where('giveaway_id', $giveaway->id)->delete();
            $schedules = GiveawaySchedule::where('giveaway_id', $giveaway->id)->delete();
            $giveaway->delete();
            return redirect()->back()->with('message', 'Giveaway Deleted Successfully!');
        } else {
            return redirect()->back()->with('message', 'Permission Denied!');
        }
    }
    public function run_schedule_giveaway() {
        $this->run_data_giveaway();
    }
}
