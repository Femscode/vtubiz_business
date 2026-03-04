@extends('dashboard.master1')

@section('header')
<style>
    .giveaway-header {
        margin-bottom: var(--space-lg);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .giveaway-header h1 {
        font-family: 'Fraunces', serif;
        font-size: 2.2rem;
        color: var(--primary-dark);
        margin-bottom: 8px;
    }
    .giveaway-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        box-shadow: var(--shadow-card);
    }
    .type-toggle {
        display: flex;
        background: #FDFCF8;
        padding: 6px;
        border-radius: var(--radius-pill);
        border: 1px solid rgba(0,0,0,0.05);
        margin-bottom: var(--space-lg);
    }
    .type-btn {
        flex: 1;
        padding: 12px;
        border-radius: var(--radius-pill);
        border: none;
        background: transparent;
        color: var(--text-secondary);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        font-family: 'DM Sans', sans-serif;
    }
    .type-btn.active {
        background: var(--primary-dark);
        color: white;
        box-shadow: 0 4px 12px rgba(15, 53, 72, 0.15);
    }
    .guide-box {
        background: #FFF9E6;
        border: 1px dashed var(--accent-yellow);
        border-radius: var(--radius-md);
        padding: 20px;
        margin-bottom: var(--space-md);
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
    .btn-create-final {
        background: var(--primary-dark);
        color: white;
        border: none;
        padding: 16px;
        border-radius: var(--radius-pill);
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.1s;
        width: 100%;
        margin-top: 10px;
        font-size: 1rem;
    }
    .accordion-custom .accordion-item {
        border: none;
        background: transparent;
        margin-bottom: 10px;
    }
    .accordion-custom .accordion-button {
        background: white;
        border-radius: 12px !important;
        box-shadow: none;
        padding: 15px 20px;
        font-weight: 600;
        color: var(--primary-dark);
        border: 1px solid rgba(0,0,0,0.05);
    }
    .accordion-custom .accordion-button:not(.collapsed) {
        color: var(--primary-dark);
        background: white;
        border-color: var(--primary-dark);
    }
</style>
@endsection

@section('content')
<div class="giveaway-header">
    <div>
        <h1>Create Giveaway</h1>
        <p class="text-muted">Set up a fun giveaway for your audience.</p>
    </div>
    <a href='/my-giveaway' class="btn btn-light" style="border-radius: 20px; padding: 10px 20px; font-weight: 600;">
        <i class="fa-solid fa-arrow-left me-2"></i> Back
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="giveaway-card">
            <div class="type-toggle">
                <button id='raffle_btn_new' class="type-btn active">Raffle Draw</button>
                <button id='q_and_a_btn_new' class="type-btn">Questions & Answers</button>
            </div>

            <!-- Raffle Form -->
            <div id='raffle_section'>
                <div class="guide-box">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="serif mb-0" style="color: #856404;"><i class="fa-solid fa-lightbulb me-2"></i> Raffle Draw Guide</h5>
                        <button class="btn btn-sm" id="raffle_guide_toggle" style="color: #856404; font-weight: 600;">Show Guide</button>
                    </div>
                    <div id="raffle_guide_content" style="display: none;" class="mt-3">
                        <div class="accordion accordion-custom" id="raffleAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#r1">How does it work?</button></h2>
                                <div id="r1" class="accordion-collapse collapse" data-bs-parent="#raffleAccordion"><div class="accordion-body text-sm">Assigns each participant a random number and picks winners randomly.</div></div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#r2">How to create?</button></h2>
                                <div id="r2" class="accordion-collapse collapse" data-bs-parent="#raffleAccordion"><div class="accordion-body text-sm">Fill the fields, generate a link, and share with your audience.</div></div>
                            </div>
                        </div>
                    </div>
                </div>

                <form id='raffle_form'>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label-bold">Giveaway Name</label>
                            <input required id='raffle_name' class="form-control-custom" type="text" placeholder="e.g. Weekend Special Giveaway" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-bold">Total Participants</label>
                            <input required id='raffle_part_no' class="form-control-custom" type="number" placeholder="Max people" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-bold">Number of Winners</label>
                            <input required id='raffle_no_of_winners' class="form-control-custom" type="number" placeholder="Expected winners" />
                        </div>
                        <div class="col-md-12">
                            <label class="form-label-bold">Entry Fee (Optional)</label>
                            <input id='raffle_entry_fee' class="form-control-custom" type="number" placeholder="Amount to charge participants" value="0" />
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label-bold">Giveaway Type</label>
                            <select class='form-control-custom' id='type'>
                                <option value='Data'>Data Giveaway</option>
                                <option value='Airtime'>Airtime Giveaway</option>
                                <option value='Cash'>Cash Prize</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label-bold">Prize Value</label>
                            <div id='data_plan_select'>
                                <select id='raffle_winner_price' class="form-control-custom">
                                    <option data-price="180" value="500MB">500MB</option>
                                    <option data-price='290' value="1GB">1GB</option>
                                    <option data-price='590' value="2GB">2GB</option>
                                    <option data-price='850' value="3GB">3GB</option>
                                    <option data-price='1550' value="5GB">5GB</option>
                                    <option data-price='2900' value="10GB">10GB</option>
                                </select>
                            </div>
                            <div id='airtime_plan_input' style='display:none'>
                                <input id='raffle_airtime_price' class='form-control-custom' type='number' placeholder='Amount' min='100' />
                            </div>
                            <div id='cash_plan_input' style='display:none'>
                                <input id='raffle_cash_price' class='form-control-custom' type='number' placeholder='Amount' min='500' />
                            </div>
                        </div>
                    </div>

                    <div id='raffle_charge_display' style='display:none' class='alert alert-success py-3 mt-3' style="border-radius: 12px; border: none; background: rgba(39, 174, 96, 0.1); color: var(--accent-green);">
                        <input type='hidden' id='raffle_amount' />
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="font-weight-bold">Total Charge:</span>
                            <span class="serif font-weight-bold" style="font-size: 1.2rem;">₦<span id='raffle_estimated_amount'>0</span></span>
                        </div>
                    </div>

                    <button type='submit' class='btn-create-final'>Create Raffle Giveaway</button>
                </form>
            </div>

            <!-- Q&A Section -->
            <div id='q_and_a_section' style='display:none'>
                <div class="guide-box">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="serif mb-0" style="color: #856404;"><i class="fa-solid fa-lightbulb me-2"></i> Q & A Guide</h5>
                        <button class="btn btn-sm" id="q_guide_toggle" style="color: #856404; font-weight: 600;">Show Guide</button>
                    </div>
                    <div id="q_guide_content" style="display: none;" class="mt-3">
                        <p class="text-sm opacity-80">Participants must answer questions correctly to claim prizes. First come, first served.</p>
                    </div>
                </div>

                <form id='q_form'>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label-bold">Giveaway Name</label>
                            <input required id='q_name' class="form-control-custom" type="text" placeholder="e.g. Business Quiz" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-bold">Number of Winners</label>
                            <input required id='q_no_of_winners' class="form-control-custom" type="number" placeholder="Max winners" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-bold">Time Limit (Mins)</label>
                            <input required id='q_time' class="form-control-custom" type="number" placeholder="Quiz duration" />
                        </div>
                        <div class="col-md-12">
                            <label class="form-label-bold">Entry Fee (Optional)</label>
                            <input id='q_entry_fee' class="form-control-custom" type="number" placeholder="0" value="0" />
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label-bold">Giveaway Type</label>
                            <select class='form-control-custom' id='qtype'>
                                <option value='Data'>Data Giveaway</option>
                                <option value='Airtime'>Airtime Giveaway</option>
                                <option value='Cash'>Cash Prize</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label-bold">Prize Value</label>
                            <div id='q_data_plan_select'>
                                <select id='q_winner_price' class="form-control-custom">
                                    <option data-price="180" value="500MB">500MB</option>
                                    <option data-price='290' value="1GB">1GB</option>
                                    <option data-price='590' value="2GB">2GB</option>
                                    <option data-price='850' value="3GB">3GB</option>
                                    <option data-price='1550' value="5GB">5GB</option>
                                    <option data-price='2900' value="10GB">10GB</option>
                                </select>
                            </div>
                            <div id='q_airtime_plan_input' style='display:none'>
                                <input id='q_airtime_price' class='form-control-custom' type='number' placeholder='Amount' min='100' />
                            </div>
                            <div id='q_cash_plan_input' style='display:none'>
                                <input id='q_cash_price' class='form-control-custom' type='number' placeholder='Amount' min='500' />
                            </div>
                        </div>
                    </div>

                    <div id='q_charge_display' style='display:none' class='alert alert-success py-3 mt-3' style="border-radius: 12px; border: none; background: rgba(39, 174, 96, 0.1); color: var(--accent-green);">
                        <input type='hidden' id='q_amount' />
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="font-weight-bold">Total Charge:</span>
                            <span class="serif font-weight-bold" style="font-size: 1.2rem;">₦<span id='q_estimated_amount'>0</span></span>
                        </div>
                    </div>

                    <button type='submit' class='btn-create-final'>Create Q&A Giveaway</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Toggle Sections
        $('#raffle_btn_new').click(function() {
            $(this).addClass('active');
            $('#q_and_a_btn_new').removeClass('active');
            $('#raffle_section').show();
            $('#q_and_a_section').hide();
        });

        $('#q_and_a_btn_new').click(function() {
            $(this).addClass('active');
            $('#raffle_btn_new').removeClass('active');
            $('#q_and_a_section').show();
            $('#raffle_section').hide();
        });

        // Toggle Guides
        $('#raffle_guide_toggle').click(function() {
            $('#raffle_guide_content').slideToggle();
            $(this).text($(this).text() == 'Show Guide' ? 'Hide Guide' : 'Show Guide');
        });
        $('#q_guide_toggle').click(function() {
            $('#q_guide_content').slideToggle();
            $(this).text($(this).text() == 'Show Guide' ? 'Hide Guide' : 'Show Guide');
        });

        // Raffle Type Logic
        $("#type").on('change', function() {
            let val = $(this).val();
            $("#data_plan_select, #airtime_plan_input, #cash_plan_input").hide();
            if(val == 'Data') $("#data_plan_select").show();
            else if(val == 'Airtime') $("#airtime_plan_input").show();
            else $("#cash_plan_input").show();
            calculateRaffle();
        });

        function calculateRaffle() {
            let winners = parseInt($("#raffle_no_of_winners").val()) || 0;
            let type = $("#type").val();
            let unitPrice = 0;
            
            if(type == 'Data') unitPrice = $("#raffle_winner_price").find('option:selected').data('price');
            else if(type == 'Airtime') unitPrice = $("#raffle_airtime_price").val() || 0;
            else unitPrice = $("#raffle_cash_price").val() || 0;

            let total = winners * unitPrice;
            if(total > 0) {
                $("#raffle_estimated_amount").text(total.toLocaleString());
                $("#raffle_amount").val(total);
                $("#raffle_charge_display").fadeIn();
            } else {
                $("#raffle_charge_display").hide();
            }
        }

        $("#raffle_no_of_winners, #raffle_winner_price, #raffle_airtime_price, #raffle_cash_price").on('input change', calculateRaffle);

        // Form Submission (Raffle)
        $("#raffle_form").on('submit', function(e) {
            e.preventDefault();
            let amount = $("#raffle_amount").val();
            
            Swal.fire({
                title: 'Confirm Giveaway',
                text: `You will be charged ₦${parseFloat(amount).toLocaleString()}. Enter your 4-digit PIN to proceed.`,
                icon: "warning",
                input: "password",
                inputPlaceholder: "****",
                inputAttributes: { inputmode: "numeric", maxlength: 4, style: "text-align:center; font-size:24px; letter-spacing: 15px" },
                showCancelButton: true,
                confirmButtonText: "Create Giveaway",
                confirmButtonColor: "#0F3548",
                inputValidator: (value) => { if (!/^\d{4}$/.test(value)) return "Please enter a 4-digit PIN"; }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({ title: 'Creating...', didOpen: () => { Swal.showLoading(); } });
                    
                    let fd = new FormData();
                    fd.append("name", $("#raffle_name").val());
                    fd.append("part_no", $("#raffle_part_no").val());
                    fd.append("no_winner", $("#raffle_no_of_winners").val());
                    fd.append("entry_fee", $("#raffle_entry_fee").val());
                    fd.append("winner_price", $("#raffle_winner_price").val());
                    fd.append("winner_real_price", $("#raffle_winner_price").find('option:selected').data('price'));
                    fd.append("amount", $("#raffle_amount").val());
                    fd.append('type', 'raffle');
                    fd.append('giveaway_type', $("#type").val());
                    fd.append('raffle_airtime_price', $("#raffle_airtime_price").val());
                    fd.append('raffle_cash_price', $("#raffle_cash_price").val());
                    fd.append("pin", result.value);

                    axios.post("/createDataGiveaway", fd).then((res) => {
                        if (res.data.success) {
                            Swal.fire("Success", "Giveaway created successfully!", "success").then(() => { window.location.href = '/my-giveaway'; });
                        } else {
                            Swal.fire("Error", res.data.message, "error");
                        }
                    });
                }
            });
        });

        // Q&A Type Logic (Simplified)
        $("#qtype").on('change', function() {
            let val = $(this).val();
            $("#q_data_plan_select, #q_airtime_plan_input, #q_cash_plan_input").hide();
            if(val == 'Data') $("#q_data_plan_select").show();
            else if(val == 'Airtime') $("#q_airtime_plan_input").show();
            else $("#q_cash_plan_input").show();
            calculateQ();
        });

        function calculateQ() {
            let winners = parseInt($("#q_no_of_winners").val()) || 0;
            let type = $("#qtype").val();
            let unitPrice = 0;
            
            if(type == 'Data') unitPrice = $("#q_winner_price").find('option:selected').data('price');
            else if(type == 'Airtime') unitPrice = $("#q_airtime_price").val() || 0;
            else unitPrice = $("#q_cash_price").val() || 0;

            let total = winners * unitPrice;
            if(total > 0) {
                $("#q_estimated_amount").text(total.toLocaleString());
                $("#q_amount").val(total);
                $("#q_charge_display").fadeIn();
            } else {
                $("#q_charge_display").hide();
            }
        }
        $("#q_no_of_winners, #q_winner_price, #q_airtime_price, #q_cash_price").on('input change', calculateQ);

        // Q&A Form Submission
        $("#q_form").on('submit', function(e) {
            e.preventDefault();
            let amount = $("#q_amount").val();
            Swal.fire({
                title: 'Confirm Q&A Giveaway',
                text: `Charge: ₦${parseFloat(amount).toLocaleString()}. Enter PIN.`,
                icon: "warning",
                input: "password",
                inputAttributes: { inputmode: "numeric", maxlength: 4, style: "text-align:center; font-size:24px; letter-spacing: 15px" },
                showCancelButton: true,
                confirmButtonText: "Create",
                confirmButtonColor: "#0F3548",
                inputValidator: (v) => { if (!/^\d{4}$/.test(v)) return "4-digit PIN required"; }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({ title: 'Creating...', didOpen: () => { Swal.showLoading(); } });
                    let fd = new FormData();
                    fd.append("name", $("#q_name").val());
                    fd.append("no_winner", $("#q_no_of_winners").val());
                    fd.append("entry_fee", $("#q_entry_fee").val());
                    fd.append("time", $("#q_time").val());
                    fd.append("winner_price", $("#q_winner_price").val());
                    fd.append("winner_real_price", $("#q_winner_price").find('option:selected').data('price'));
                    fd.append("amount", $("#q_amount").val());
                    fd.append('type', 'question');
                    fd.append('giveaway_type', $("#qtype").val());
                    fd.append('raffle_airtime_price', $("#q_airtime_price").val());
                    fd.append('raffle_cash_price', $("#q_cash_price").val());
                    fd.append("pin", result.value);

                    axios.post("/createDataGiveaway", fd).then((res) => {
                        if (res.data.success) {
                            Swal.fire("Success", "Giveaway created! Now add questions.", "success").then(() => { window.location.href = '/my-giveaway'; });
                        } else {
                            Swal.fire("Error", res.data.message, "error");
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
