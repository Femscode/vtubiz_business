@extends('dashboard.master1')

@section('header')
<style>
    .ctype {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 10px;
    }

    .ctype .choice {
        margin: 0;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        padding: 14px;
    }

    .ctype .choice input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .ctype .choice {
        position: relative;
    }

    .counter-row {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        font-size: .8rem;
        color: var(--text-secondary);
        margin-top: 8px;
    }

    .counter-row b {
        color: var(--ink);
    }

    /* Phone preview */
    .sms-phone {
        background: #F2F1EC;
        border-radius: 22px;
        padding: 18px;
    }

    .sms-from {
        text-align: center;
        font-size: .78rem;
        color: var(--text-secondary);
        margin-bottom: 12px;
    }

    .sms-from b {
        display: block;
        color: var(--ink);
        font-size: .95rem;
        letter-spacing: .02em;
    }

    .sms-bubble {
        background: #fff;
        border-radius: 18px 18px 18px 6px;
        padding: 12px 14px;
        font-size: .9rem;
        line-height: 1.5;
        color: var(--ink);
        white-space: pre-wrap;
        word-break: break-word;
        box-shadow: var(--shadow-sm);
        max-height: 260px;
        overflow: auto;
    }

    .sms-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 14px;
    }

    .sms-stats div {
        background: #FAFAF8;
        border-radius: 14px;
        padding: 12px 14px;
    }

    .sms-stats small {
        display: block;
        font-size: .72rem;
        color: var(--text-secondary);
        font-weight: 600;
    }

    .sms-stats b {
        font-family: 'Fraunces', serif;
        font-size: 1.3rem;
        font-weight: 500;
    }

    @media (max-width: 600px) {
        .ctype {
            grid-template-columns: minmax(0, 1fr);
        }

        .ctype .choice {
            flex-direction: row;
            align-items: center;
        }
    }
</style>
@endsection

@section('content')
<div class="pg">
    <div class="pg-head">
        <div>
            <h1>Bulk <em>SMS</em></h1>
            <p>Reach thousands of people in one send.</p>
        </div>
        <div class="pg-actions">
            <a href="/contact_group" class="btn-v ghost"><i class="fa-solid fa-address-book"></i> Contact groups</a>
            <a href="/bulksms_transactions" class="btn-v ghost"><i class="fa-solid fa-clock-rotate-left"></i> History</a>
        </div>
    </div>

    <div class="grid-v main-side">
        <div class="panel">
            <form method="post" class="myForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="schedule_date" name="schedule_date" />
                <input type="hidden" id="schedule_time" name="schedule_time" />

                <div class="f-row">
                    <div class="f-group">
                        <label class="f-label" for="sender_name">Sender name</label>
                        <input required name="sender_name" id="sender_name" class="f-input" type="text" maxlength="11" placeholder="Up to 11 characters">
                    </div>
                    <div class="f-group">
                        <label class="f-label" for="message_type">Message type</label>
                        <select id="message_type" required class="f-input" name="message_type">
                            <option value="Normal SMS">Normal SMS</option>
                            <option value="Flash SMS">Flash SMS</option>
                            <option value="Unicode SMS">Unicode SMS</option>
                        </select>
                    </div>
                </div>

                <div class="f-group">
                    <label class="f-label">Recipients</label>
                    <div class="ctype">
                        <label class="choice" for="manual_input">
                            <input class="contact_type" type="radio" name="contact_type" id="manual_input" value="manual_input" checked>
                            <span class="ic t-blue"><i class="fa-solid fa-keyboard"></i></span>
                            <span><b>Type numbers</b><small>Paste or type</small></span>
                        </label>
                        <label class="choice" for="import_csv">
                            <input class="contact_type" type="radio" name="contact_type" id="import_csv" value="import_file">
                            <span class="ic t-green"><i class="fa-solid fa-file-arrow-up"></i></span>
                            <span><b>Upload file</b><small>CSV or Excel</small></span>
                        </label>
                        <label class="choice" for="select_group">
                            <input class="contact_type" type="radio" name="contact_type" id="select_group" value="select_group">
                            <span class="ic t-purple"><i class="fa-solid fa-address-book"></i></span>
                            <span><b>Contact group</b><small>Saved lists</small></span>
                        </label>
                    </div>
                </div>

                <div class="f-group">
                    <div id="manual_input_field">
                        <textarea class="f-input" style="min-height:96px" name="manual_contact" id="contact_field" placeholder="08012345678, 08098765432"></textarea>
                        <div class="counter-row"><span>Separate numbers with commas, spaces or new lines.</span><span><b id="no_of_recipients">0</b> recipients</span></div>
                    </div>
                    <div id="import_field" style="display:none">
                        <input accept=".xls, .xlsx, .csv" type="file" class="f-input" name="import_file" id="import_file">
                        <div class="f-hint"><i class="fa-solid fa-circle-info"></i> One phone number per row in the first column.</div>
                    </div>
                    <div id="select_group_field" style="display:none">
                        <select id="selected_group" class="f-input" name="selected_group">
                            <option value="">Choose a group</option>
                            @foreach($contacts as $contact)
                                <option value="{{ $contact->id }}">{{ $contact->name }}</option>
                            @endforeach
                        </select>
                        @if(count($contacts) === 0)
                            <div class="f-hint"><i class="fa-solid fa-circle-info"></i> No groups yet. <a href="/contact_group" style="font-weight:600">Create one</a></div>
                        @endif
                    </div>
                </div>

                <div class="f-group">
                    <label class="f-label" for="sms">Message</label>
                    <textarea required class="f-input" style="min-height:150px" name="message" id="sms" placeholder="Type your message"></textarea>
                    <div class="counter-row"><span><b id="pages">0</b> page(s)</span><span><b id="character">160</b> characters left on this page</span></div>
                </div>

                <div style="display:flex;gap:10px;flex-wrap:wrap">
                    <button type="submit" class="btn-v dark" style="flex:1;padding:15px 22px"><i class="fa-solid fa-paper-plane"></i> Send now</button>
                    <button id="scheduleSend" type="button" class="btn-v ghost" style="padding:15px 22px"><i class="fa-regular fa-calendar"></i> Schedule</button>
                </div>
            </form>
        </div>

        <div class="panel">
            <div class="panel-head" style="margin-bottom:14px"><h3>Preview & Cost</h3></div>
            <div class="sms-phone">
                <div class="sms-from">From<b id="preview_sender">SENDER</b></div>
                <div class="sms-bubble" id="preview_text">Your message will appear here.</div>
            </div>
            <div class="sms-stats">
                <div>
                    <small>RATE PER PAGE</small>
                    <b id="preview_rate">₦{{ number_format($rate_per_page ?? 5.00, 2) }}</b>
                </div>
                <div>
                    <small>ESTIMATED TOTAL</small>
                    <b id="preview_total">₦0.00</b>
                </div>
            </div>
            <div class="note-v info" style="margin-top:14px">
                <i class="fa-solid fa-circle-info"></i>
                <div>Rate: <b>₦{{ number_format($rate_per_page ?? 5.00, 2) }}</b> per page. You'll see the total cost and confirm with your PIN before anything is sent.</div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
      // Swal.fire('very nice work')
      const Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3500, timerProgressBar: true });

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  
      $(".myForm").on("submit", async function(e) {
        e.preventDefault();
        $("#schedule_time").val('')
        $("#schedule_date").val('')
  
            submitSMS();
      })
      $("#import_csv").click(function() {
        $("#import_field").show()
        $("#manual_input_field").hide()
        $("#select_group_field").hide()
      })
      $("#manual_input").click(function() {
        $("#manual_input_field").show()
        $("#select_group_field").hide()
        $("#import_field").hide()
      })
      $("#select_group").click(function() {
        $("#manual_input_field").hide()
        $("#select_group_field").show()
        $("#import_field").hide()
      })
      const ratePerPage = {{ $rate_per_page ?? 5.00 }};

      function updateCostPreview() {
        var len = $("#sms").val().length;
        var pages = len === 0 ? 0 : Math.ceil(len / 160);
        var recipients = parseInt($("#no_of_recipients").text()) || 0;
        var est = (pages * recipients * ratePerPage).toFixed(2);
        $("#preview_total").text('₦' + Number(est).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
      }

      $("#sms").on('input', function() {
        var len = $("#sms").val().length;
        var pages = len === 0 ? 0 : Math.ceil(len / 160);
        $("#pages").text(pages);
        $("#character").text(pages === 0 ? 160 : pages * 160 - len);
        $("#preview_text").text($("#sms").val() || 'Your message will appear here.');
        updateCostPreview();
      })

      $("#sender_name").on('input', function() {
        $("#preview_sender").text($(this).val() || 'SENDER');
      })

      $("#scheduleSend").click(function() {
        scheduleSend()
      })
      function scheduleSend() {
          Swal.fire({
              title: 'Schedule Send For Later',
              html: "<input id='sweet_alert_date' class='form-control form-input' min='" + new Date().toISOString().split("T")[0] + "' type='date'/><br><input id='sweet_alert_time' class='form-control form-input' type='time' />",
              showCancelButton: true,
              confirmButtonText: "Send SMS Later",
              preConfirm: () => {
                // Get the selected date from the date picker
                const selectedDate = document.getElementById('sweet_alert_date').value;
                const selectedTime = document.getElementById('sweet_alert_time').value;
                console.log('Selected Date:', selectedDate, selectedTime);
                $("#schedule_date").val(selectedDate)
                $("#schedule_time").val(selectedTime)
              },
          }).then((result) => {
                // If the user confirms, submit the form
                if (result.isConfirmed) {
                   submitSMS()
                }
            });
      }
      function submitSMS() {
        Swal.fire({
                        title: "Fetching response, please wait...",
                        // html: '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                          Swal.showLoading();
                        },
                      });
        
          var fd = new FormData;
          fd.append('sender_name', $("#sender_name").val());
          fd.append('contact_type', $(".contact_type:checked").val());
          fd.append('selected_group', $("#selected_group").val());
          fd.append('contact_field', $("#contact_field").val());
          fd.append('message_type', $('#message_type').val());
          fd.append('message', $('#sms').val());
          var importFileInput = $('#import_file')[0]; // Get the file input element
  
          if (importFileInput  && importFileInput.files.length > 0) {
            fd.append('import_file', importFileInput.files[0]); 
          } 
          var schedule_date = $('#schedule_date').val(); // Get the file input element
  
          if (schedule_date  && schedule_date.length > 0) {
              fd.append('schedule_date', schedule_date); 
              fd.append('schedule_time',  $("#schedule_time").val()); 
          } 
          console.log(fd)
          $.ajax({
              type: 'POST',
              url: "{{route('submitSMSForm')}}",
              data: fd,
              cache: false,
              contentType: false,
              processData: false,
              success: function(response) {
                Swal.close()
                if(response.success == false) {
                  console.log('the data', response)
                
                Toast.fire({
                        icon: 'error',
                        title: response.message
                        })
                }  else {
                  Swal.fire({
                        title: '<strong>Confirm SMS</strong>',
                        icon: 'info',
                        html:
                          `Total Recipients : <b>${response.count_recipient}</b><br> ` +
                          `Total Pages : <b>${response.message_count}</b><br> ` +
                          `Rate Per Page : <b>NGN ${response.rate_per_page}</b><br> ` +
                          `Total Charge : <b>NGN ${response.amount}</b><br><span class='text-danger'>Input your four(4) digit PIN to proceed</span>`,
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText:
                          'Proceed!',
                        cancelButtonText:
                          'Cancel',
                          input: "password",
                        inputAttributes: {
                          inputmode: "numeric",
                          maxlength: 4,
                          autocomplete: "new-password",
                          name: "my-pin",
                          autocapitalize: "off",
                          pattern: "[0-9]*",
                          style: "text-align:center;font-size:24px;letter-spacing: 20px",
                        },
                        preConfirm: () => {
                          const confirmButton = Swal.getConfirmButton();
                          confirmButton.textContent = "Validating ";
                          confirmButton.disabled = true;
                          confirmButton.insertAdjacentHTML(
                            "beforeend",
                            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
                          );
                          return new Promise((resolve) => {
                            // You can perform any necessary validation here, e.g. making a server call.
                            // Once validation is complete, call resolve() to close the modal.
                            setTimeout(() => {
                              resolve();
                            }, 500);
                          });
                        },
                      
                        inputValidator: (text) => {
                          if (!/^\d{4}$/.test(text)) {
                            return "Please enter a four-digit PIN";
                          }
                        },
                    })
                    .then((result) => {
                      if (result.isConfirmed == false) {
                          return;
                        }
                    if (result.isConfirmed) {  
                      if(response.schedule) {
                             Swal.fire({
                             title: "Scheduling SMS, please wait...",
                             // html: '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>',
                             showConfirmButton: false,
                             allowOutsideClick: false,
                             allowEscapeKey: false,
                             didOpen: () => {
                               Swal.showLoading();
                             },
                           });
                        } else {
                              Swal.fire({
                            title: "Sending SMS, please wait...",
                            // html: '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                              Swal.showLoading();
                            },
                          });
                        } 
                     
                      var fd = new FormData;
                        fd.append('sender_name', response.sender_name);
                        fd.append('contacts', response.contacts);
                        fd.append('message', response.sms);
                        fd.append('message_type', response.message_type);
                        fd.append('amount', response.amount);
                        fd.append('real_amount', response.real_amount);
                        fd.append("pin", result.value);
                        if(response.schedule) {
                          fd.append('schedule', response.schedule);
                        }
                      
                        console.log(fd)
                        $.ajax({
                            type: 'POST',
                            url: "{{route('sendSMS2')}}",
                            data: fd,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                              Swal.close()
                              if(response.success == false) {
                                console.log('the data', response)
                              
                                    Swal.fire({
                                      icon: 'error',
                                      title: response.message
                                     
                                      })
                                    } else {
                                      if(response.schedule) {
                                        Swal.fire('Success!','Bulk SMS Scheduled Successfully.','success')
                                      }
                                      else {
                                         Swal.fire('Success!','Bulk SMS Sent Successfully.','success')
  
                                       }
                                    }
                            },
                            error: function(response) {
                            console.log(response)
                             Swal.close()
                             Swal.fire({
                                      icon: 'error',
                                      title: 'Error while sending message, try again later or contact support!'
                                      })
                         }
                });
              }
            });
                          
          }
  
              },
              error: function(response) {
                  console.log(response)
                  Swal.close()
                  Swal.fire('Opps!', 'Error while sending message, try again later or contact support', 'error')
              }
          })
      }
   

      $('#contact_field').on('input', function(e) {
        // Get the input value
        //start copy
        let inputText = e.target.value;
        // var inputText = $(this).val();

        // Remove all characters that are not numbers, spaces, or commas
        inputText = inputText.replace(/[^0-9,\n ]/g, ''); // Allow numbers, commas, spaces, and line breaks

        // Replace line breaks and spaces with commas
        inputText = inputText.replace(/[\n ]+/g, ',');

        // Remove consecutive commas
        inputText = inputText.replace(/,+/g, ',');

        // Remove leading/trailing commas
        // inputText = inputText.replace(/^,|,$/g, '');

        // Update the input value with the modified text
        e.target.value = inputText;

        // Split the input by commas
        var phoneNumbers = inputText.split(',');

        // Remove any leading/trailing whitespace from each phone number
        phoneNumbers = phoneNumbers.map(function(number) {
          return number.trim();
        });

        // Filter out any empty strings
        phoneNumbers = phoneNumbers.filter(function(number) {
          return number !== "";
        });

        // Update the count
        $("#no_of_recipients").text(phoneNumbers.length);
        updateCostPreview();
        //end copy

    });
  
  })
</script>

@endsection