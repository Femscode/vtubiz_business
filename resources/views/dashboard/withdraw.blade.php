@extends('dashboard.master1')

@section('header')
<style>
    .withdraw-header {
        margin-bottom: var(--space-lg);
    }
    .withdraw-header h1 {
        font-family: 'Fraunces', serif;
        font-size: 2.2rem;
        color: var(--primary-dark);
        margin-bottom: 8px;
    }
    .withdraw-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        box-shadow: var(--shadow-card);
    }
    .form-label-bold {
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 8px;
        display: block;
        font-size: 0.9rem;
    }
    .form-control-custom {
        width: 100%;
        padding: 14px 18px;
        border-radius: var(--radius-md);
        border: 1px solid rgba(0,0,0,0.08);
        background: #F9F9F9;
        font-family: 'DM Sans', sans-serif;
        transition: all 0.2s ease;
        margin-bottom: 15px;
    }
    .form-control-custom:focus {
        outline: none;
        border-color: var(--primary-dark);
        background: white;
        box-shadow: 0 0 0 4px rgba(15, 53, 72, 0.05);
    }
    .form-select-custom {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%230F3548' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 18px center;
    }
    .pin-input-group {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin: 20px 0;
    }
    .pin-field {
        width: 50px;
        height: 60px;
        text-align: center;
        font-size: 1.5rem;
        font-weight: 700;
        border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.1);
        background: #F9F9F9;
        font-family: 'Fraunces', serif;
    }
    .pin-field:focus {
        outline: none;
        border-color: var(--primary-dark);
        background: white;
        box-shadow: 0 0 0 4px rgba(15, 53, 72, 0.05);
    }
    .btn-withdraw {
        background: var(--primary-dark);
        color: white;
        border: none;
        padding: 16px;
        border-radius: var(--radius-pill);
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.1s;
        width: 100%;
        font-size: 1rem;
        margin-top: 20px;
    }
    .btn-withdraw:active { transform: scale(0.98); }
    
    .account-details-box {
        background: #FDFCF8;
        border: 1px solid rgba(0,0,0,0.03);
        border-radius: var(--radius-md);
        padding: 20px;
        margin-top: 10px;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')
<div class="withdraw-header">
    <h1>Withdraw Funds</h1>
    <p class="text-muted">Securely transfer funds from your wallet to your linked bank account.</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="withdraw-card">
            <form id="make_transfer">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label-bold">Select Bank</label>
                        <select required class='form-control-custom form-select-custom' id='bank_code'>
                            <option value="">-- Choose your bank --</option>
                            <option value="120001">9mobile 9Payment Service Bank</option>
                            <option value="801">Abbey Mortgage Bank</option>
                            <option value="51204">Above Only MFB</option>
                            <option value="51312">Abulesoro MFB</option>
                            <option value="044">Access Bank</option>
                            <option value="063">Access Bank (Diamond)</option>
                            <option value="602">Accion Microfinance Bank</option>
                            <option value="50036">Ahmadu Bello University Microfinance Bank</option>
                            <option value="120004">Airtel Smartcash PSB</option>
                            <option value="51336">AKU Microfinance Bank</option>
                            <option value="035A">ALAT by WEMA</option>
                            <option value="50926">Amju Unique MFB</option>
                            <option value="51341">AMPERSAND MICROFINANCE BANK</option>
                            <option value="50083">Aramoko MFB</option>
                            <option value="401">ASO Savings and Loans</option>
                            <option value="MFB50094">Astrapolaris MFB LTD</option>
                            <option value="51229">Bainescredit MFB</option>
                            <option value="50117">Banc Corp Microfinance Bank</option>
                            <option value="50931">Bowen Microfinance Bank</option>
                            <option value="FC40163">Branch International Financial Services Limited</option>
                            <option value="565">Carbon</option>
                            <option value="865">CASHCONNECT MFB</option>
                            <option value="50823">CEMCS Microfinance Bank</option>
                            <option value="50171">Chanelle Microfinance Bank Limited</option>
                            <option value="023">Citibank Nigeria</option>
                            <option value="50910">Consumer Microfinance Bank</option>
                            <option value="50204">Corestep MFB</option>
                            <option value="559">Coronation Merchant Bank</option>
                            <option value="FC40128">County Finance Limited</option>
                            <option value="51297">Crescent MFB</option>
                            <option value="50162">Dot Microfinance Bank</option>
                            <option value="050">Ecobank Nigeria</option>
                            <option value="50263">Ekimogun MFB</option>
                            <option value="098">Ekondo Microfinance Bank</option>
                            <option value="50126">Eyowo</option>
                            <option value="51318">Fairmoney Microfinance Bank</option>
                            <option value="070">Fidelity Bank</option>
                            <option value="51314">Firmus MFB</option>
                            <option value="011">First Bank of Nigeria</option>
                            <option value="214">First City Monument Bank</option>
                            <option value="107">FirstTrust Mortgage Bank Nigeria</option>
                            <option value="50315">FLOURISH MFB</option>
                            <option value="501">FSDH Merchant Bank Limited</option>
                            <option value="812">Gateway Mortgage Bank LTD</option>
                            <option value="00103">Globus Bank</option>
                            <option value="100022">GoMoney</option>
                            <option value="50739">Goodnews Microfinance Bank</option>
                            <option value="562">Greenwich Merchant Bank</option>
                            <option value="058">Guaranty Trust Bank</option>
                            <option value="51251">Hackman Microfinance Bank</option>
                            <option value="50383">Hasal Microfinance Bank</option>
                            <option value="030">Heritage Bank</option>
                            <option value="120002">HopePSB</option>
                            <option value="51244">Ibile Microfinance Bank</option>
                            <option value="50439">Ikoyi Osun MFB</option>
                            <option value="50442">Ilaro Poly Microfinance Bank</option>
                            <option value="50457">Infinity MFB</option>
                            <option value="301">Jaiz Bank</option>
                            <option value="50502">Kadpoly MFB</option>
                            <option value="082">Keystone Bank</option>
                            <option value="50200">Kredi Money MFB LTD</option>
                            <option value="50211">Kuda Bank</option>
                            <option value="90052">Lagos Building Investment Company Plc.</option>
                            <option value="50549">Links MFB</option>
                            <option value="031">Living Trust Mortgage Bank</option>
                            <option value="303">Lotus Bank</option>
                            <option value="50563">Mayfair MFB</option>
                            <option value="50304">Mint MFB</option>
                            <option value="50515">Moniepoint MFB</option>
                            <option value="120003">MTN Momo PSB</option>
                            <option value="00107">Optimus Bank Limited</option>
                            <option value="100002">Paga</option>
                            <option value="999991">PalmPay</option>
                            <option value="104">Parallex Bank</option>
                            <option value="311">Parkway - ReadyCash</option>
                            <option value="999992">Paycom</option>
                            <option value="50743">Peace Microfinance Bank</option>
                            <option value="51146">Personal Trust MFB</option>
                            <option value="50746">Petra Mircofinance Bank Plc</option>
                            <option value="076">Polaris Bank</option>
                            <option value="50864">Polyunwana MFB</option>
                            <option value="105">PremiumTrust Bank</option>
                            <option value="101">Providus Bank</option>
                            <option value="51293">QuickFund MFB</option>
                            <option value="502">Rand Merchant Bank</option>
                            <option value="90067">Refuge Mortgage Bank</option>
                            <option value="50767">ROCKSHIELD MICROFINANCE BANK</option>
                            <option value="125">Rubies MFB</option>
                            <option value="51113">Safe Haven MFB</option>
                            <option value="951113">Safe Haven Microfinance Bank Limited</option>
                            <option value="50582">Shield MFB</option>
                            <option value="51062">Solid Allianze MFB</option>
                            <option value="50800">Solid Rock MFB</option>
                            <option value="51310">Sparkle Microfinance Bank</option>
                            <option value="221">Stanbic IBTC Bank</option>
                            <option value="068">Standard Chartered Bank</option>
                            <option value="51253">Stellas MFB</option>
                            <option value="232">Sterling Bank</option>
                            <option value="100">Suntrust Bank</option>
                            <option value="50968">Supreme MFB</option>
                            <option value="302">TAJ Bank</option>
                            <option value="090560">Tanadi Microfinance Bank</option>
                            <option value="51269">Tangerine Money</option>
                            <option value="51211">TCF MFB</option>
                            <option value="102">Titan Bank</option>
                            <option value="100039">Titan Paystack</option>
                            <option value="50840">U&C Microfinance Bank Ltd (U AND C MFB)</option>
                            <option value="MFB51322">Uhuru MFB</option>
                            <option value="50870">Unaab Microfinance Bank Limited</option>
                            <option value="50871">Unical MFB</option>
                            <option value="51316">Unilag Microfinance Bank</option>
                            <option value="032">Union Bank of Nigeria</option>
                            <option value="033">United Bank For Africa</option>
                            <option value="215">Unity Bank</option>
                            <option value="566">VFD Microfinance Bank Limited</option>
                            <option value="035">Wema Bank</option>
                            <option value="057">Zenith Bank</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label-bold">Account Number</label>
                        <input type="number" name="account_no" id='account_no' class="form-control-custom" placeholder="10-digit account number">
                    </div>

                    <div id='show_details' style='display:none'>
                        <div class="account-details-box">
                            <label class="form-label-bold mb-1">Account Name</label>
                            <input type="text" id='account_name' readonly class="form-control-custom bg-transparent border-0 p-0 mb-0 font-weight-bold" style="font-size: 1.1rem; color: var(--accent-green);">
                        </div>

                        <div class="col-12">
                            <label class="form-label-bold">Amount to Withdraw</label>
                            <input required type="number" min='100' name="amount" id='amount' class="form-control-custom" placeholder="₦ 0.00">
                            <p class="text-xs text-muted mb-3"><i class="fa-solid fa-circle-info"></i> A withdrawal charge of ₦100 will be applied.</p>
                            <input type="hidden" id='recipient_code'>
                        </div>

                        <div class="col-12 text-center mt-4">
                            <label class="form-label-bold">Enter Transaction PIN</label>
                            <div id="otp" class="pin-input-group">
                                <input class="pin-field" type="password" id="first" maxlength="1" required />
                                <input class="pin-field" type="password" id="second" maxlength="1" required />
                                <input class="pin-field" type="password" id="third" maxlength="1" required />
                                <input class="pin-field" type="password" id="fourth" maxlength="1" required />
                            </div>
                        </div>
                        
                        <button type="submit" class="btn-withdraw" id="transfer_button">Process Withdrawal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        $("#account_no, #bank_code").on("input change", async function() {
            if($("#account_no").val().length >= 10 && $("#bank_code").val() !== "") {
                Swal.fire({
                    title: "Fetching details...",
                    didOpen: () => { Swal.showLoading(); },
                    allowOutsideClick: false
                });
                
                $("#show_details").hide();
                var fd = new FormData;
                fd.append('account_no', $("#account_no").val());
                fd.append('bank_code', $("#bank_code").val());
                
                $.ajax({
                    type: 'POST',
                    url: "{{route('confirm_account')}}",
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.close();
                        if(response && response.data !== false) {
                            $("#show_details").fadeIn();
                            $("#recipient_code").val(response.data.recipient_code);
                            $("#account_name").val(response.data.details.account_name);
                            Toast.fire({ icon: 'success', title: 'Account found!' });
                        } else {
                            Toast.fire({ icon: 'error', title: 'Invalid account number' });
                        }
                    },
                    error: function() {
                        Swal.close();
                        Toast.fire({ icon: 'error', title: 'Failed to verify account' });
                    }
                });
            }
        });

        $("#make_transfer").on("submit", function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Processing withdrawal...",
                didOpen: () => { Swal.showLoading(); },
                allowOutsideClick: false
            });
            
            var fd = new FormData;
            fd.append('account_name', $("#account_name").val());
            fd.append('account_no', $("#account_no").val());
            fd.append('bank_code', $("#bank_code").val());
            fd.append('amount', $("#amount").val());
            fd.append('recipient_code', $("#recipient_code").val());
            fd.append('first', $("#first").val());
            fd.append('second', $("#second").val());
            fd.append('third', $("#third").val());
            fd.append('fourth', $("#fourth").val());
            
            $.ajax({
                type: 'POST',
                url: "{{route('make_transfer')}}",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: function(res) {
                    if(res.status == true) {
                        Swal.fire('Success!', 'Withdrawal of ₦'+$("#amount").val()+' successful.', 'success')
                        .then(() => { location.reload(); });
                    } else {
                        Swal.fire('Error', res.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'An unexpected error occurred.', 'error');
                }
            });
        });

        // PIN Input Logic
        const inputs = document.querySelectorAll('#otp > *[id]');
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].addEventListener('keydown', function(event) {
                if (event.key === "Backspace") {
                    inputs[i].value = '';
                    if (i !== 0) inputs[i - 1].focus();
                } else if (event.keyCode > 47 && event.keyCode < 58) {
                    inputs[i].value = event.key;
                    if (i !== inputs.length - 1) inputs[i + 1].focus();
                    event.preventDefault();
                }
            });
        }
    });
</script>
@endsection
