@extends('dashboard.master1')

@section('header')
<style>
    .charge-box {
        background: linear-gradient(150deg, #04284d 0%, var(--primary-dark) 60%);
        color: #fff;
        border-radius: 18px;
        padding: 16px 18px;
        margin: 4px 0 16px;
    }

    .charge-box .row-c {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    .charge-box small {
        color: rgba(255, 255, 255, .65);
        font-weight: 600;
        font-size: .82rem;
    }

    .charge-box .amt {
        font-family: 'Fraunces', serif;
        font-size: 1.5rem;
        color: var(--brand-orange);
    }

    .steps-v {
        counter-reset: s;
        display: grid;
        gap: 14px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .steps-v li {
        display: flex;
        gap: 12px;
        font-size: .9rem;
        color: #374151;
        line-height: 1.5;
    }

    .steps-v li::before {
        counter-increment: s;
        content: counter(s);
        width: 26px;
        height: 26px;
        border-radius: 9px;
        background: var(--primary-dark);
        color: #fff;
        font-weight: 700;
        font-size: .78rem;
        display: grid;
        place-items: center;
        flex-shrink: 0;
    }

    .mode-note {
        font-size: .86rem;
        color: var(--text-secondary);
        margin: 0 0 18px;
    }
</style>
@endsection

@section('content')
<div class="pg">
    <a href="/my-giveaway" class="pg-back"><i class="fa-solid fa-arrow-left"></i> My giveaways</a>
    <div class="pg-head">
        <div>
            <h1>New <em>giveaway</em></h1>
            <p>Reward your audience in a few clicks.</p>
        </div>
    </div>

    <div class="grid-v main-side">
        <div class="panel">
            <div class="seg" style="margin-bottom:22px">
                <button type="button" id="raffle_btn_new" class="active">Raffle draw</button>
                <button type="button" id="q_and_a_btn_new">Quiz (Q&amp;A)</button>
            </div>

            <!-- Raffle -->
            <div id="raffle_section">
                <p class="mode-note">Each participant gets a number and winners are picked at random.</p>
                <form id="raffle_form">
                    <div class="f-group">
                        <label class="f-label" for="raffle_name">Giveaway name</label>
                        <input required id="raffle_name" class="f-input" type="text" placeholder="e.g. Weekend special" />
                    </div>
                    <div class="f-row">
                        <div class="f-group">
                            <label class="f-label" for="raffle_part_no">Participants</label>
                            <input required id="raffle_part_no" class="f-input" type="number" min="1" placeholder="Max people" />
                        </div>
                        <div class="f-group">
                            <label class="f-label" for="raffle_no_of_winners">Winners</label>
                            <input required id="raffle_no_of_winners" class="f-input" type="number" min="1" placeholder="How many win" />
                        </div>
                    </div>
                    <div class="f-row">
                        <div class="f-group">
                            <label class="f-label" for="type">Prize type</label>
                            <select class="f-input" id="type">
                                <option value="Data">Data</option>
                                <option value="Airtime">Airtime</option>
                                <option value="Cash">Cash</option>
                            </select>
                        </div>
                        <div class="f-group">
                            <label class="f-label">Prize per winner</label>
                            <div id="data_plan_select">
                                <select id="raffle_winner_price" class="f-input">
                                    <option data-price="180" value="500MB">500MB</option>
                                    <option data-price="290" value="1GB">1GB</option>
                                    <option data-price="590" value="2GB">2GB</option>
                                    <option data-price="850" value="3GB">3GB</option>
                                    <option data-price="1550" value="5GB">5GB</option>
                                    <option data-price="2900" value="10GB">10GB</option>
                                </select>
                            </div>
                            <div id="airtime_plan_input" style="display:none">
                                <input id="raffle_airtime_price" class="f-input" type="number" placeholder="₦ amount" min="100" />
                            </div>
                            <div id="cash_plan_input" style="display:none">
                                <input id="raffle_cash_price" class="f-input" type="number" placeholder="₦ amount" min="500" />
                            </div>
                        </div>
                    </div>
                    <div class="f-group">
                        <label class="f-label" for="raffle_entry_fee">Entry fee <span style="color:var(--text-light);font-weight:500">(optional)</span></label>
                        <div class="f-affix">
                            <span class="pre">₦</span>
                            <input id="raffle_entry_fee" class="f-input" type="number" min="0" placeholder="0" value="0" />
                        </div>
                    </div>

                    <div id="raffle_charge_display" class="charge-box" style="display:none">
                        <input type="hidden" id="raffle_amount" />
                        <div class="row-c">
                            <small>You'll be charged</small>
                            <span class="amt">₦<span id="raffle_estimated_amount">0</span></span>
                        </div>
                    </div>

                    <button type="submit" class="btn-v dark block">Create raffle <i class="fa-solid fa-arrow-right"></i></button>
                </form>
            </div>

            <!-- Q&A -->
            <div id="q_and_a_section" style="display:none">
                <p class="mode-note">Participants answer your questions; the fastest correct answers win.</p>
                <form id="q_form">
                    <div class="f-group">
                        <label class="f-label" for="q_name">Giveaway name</label>
                        <input required id="q_name" class="f-input" type="text" placeholder="e.g. Business quiz" />
                    </div>
                    <div class="f-row">
                        <div class="f-group">
                            <label class="f-label" for="q_no_of_winners">Winners</label>
                            <input required id="q_no_of_winners" class="f-input" type="number" min="1" placeholder="How many win" />
                        </div>
                        <div class="f-group">
                            <label class="f-label" for="q_time">Time limit (mins)</label>
                            <input required id="q_time" class="f-input" type="number" min="1" placeholder="Quiz duration" />
                        </div>
                    </div>
                    <div class="f-row">
                        <div class="f-group">
                            <label class="f-label" for="qtype">Prize type</label>
                            <select class="f-input" id="qtype">
                                <option value="Data">Data</option>
                                <option value="Airtime">Airtime</option>
                                <option value="Cash">Cash</option>
                            </select>
                        </div>
                        <div class="f-group">
                            <label class="f-label">Prize per winner</label>
                            <div id="q_data_plan_select">
                                <select id="q_winner_price" class="f-input">
                                    <option data-price="180" value="500MB">500MB</option>
                                    <option data-price="290" value="1GB">1GB</option>
                                    <option data-price="590" value="2GB">2GB</option>
                                    <option data-price="850" value="3GB">3GB</option>
                                    <option data-price="1550" value="5GB">5GB</option>
                                    <option data-price="2900" value="10GB">10GB</option>
                                </select>
                            </div>
                            <div id="q_airtime_plan_input" style="display:none">
                                <input id="q_airtime_price" class="f-input" type="number" placeholder="₦ amount" min="100" />
                            </div>
                            <div id="q_cash_plan_input" style="display:none">
                                <input id="q_cash_price" class="f-input" type="number" placeholder="₦ amount" min="500" />
                            </div>
                        </div>
                    </div>
                    <div class="f-group">
                        <label class="f-label" for="q_entry_fee">Entry fee <span style="color:var(--text-light);font-weight:500">(optional)</span></label>
                        <div class="f-affix">
                            <span class="pre">₦</span>
                            <input id="q_entry_fee" class="f-input" type="number" min="0" placeholder="0" value="0" />
                        </div>
                    </div>

                    <div id="q_charge_display" class="charge-box" style="display:none">
                        <input type="hidden" id="q_amount" />
                        <div class="row-c">
                            <small>You'll be charged</small>
                            <span class="amt">₦<span id="q_estimated_amount">0</span></span>
                        </div>
                    </div>

                    <button type="submit" class="btn-v dark block">Create quiz <i class="fa-solid fa-arrow-right"></i></button>
                </form>
            </div>
        </div>

        <div class="panel">
            <div class="panel-head">
                <h3>How it works</h3>
            </div>
            <ol class="steps-v">
                <li>Choose a raffle or a quiz, then set the prize and number of winners.</li>
                <li>Confirm with your PIN. The total prize value is charged to your wallet.</li>
                <li>For quizzes, add your questions to activate the link.</li>
                <li>Share the link. Winners receive their prize automatically.</li>
            </ol>
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
