@extends('dashboard.master1')

@section('header')
<style>
    .service-header {
        margin-bottom: var(--space-lg);
    }
    .service-header h1 {
        font-family: 'Fraunces', serif;
        font-size: 2.2rem;
        color: var(--primary-dark);
        margin-bottom: 8px;
    }
    .service-card-wrapper {
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
        padding: 12px 16px;
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
    .radio-group-custom {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .radio-item-custom {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }
    .radio-item-custom input {
        accent-color: var(--primary-dark);
        width: 18px;
        height: 18px;
    }
    .radio-item-custom span {
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--text-main);
    }
    .btn-send {
        background: var(--primary-dark);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: var(--radius-pill);
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.1s;
    }
    .btn-schedule {
        background: rgba(39, 174, 96, 0.1);
        color: var(--accent-green);
        border: none;
        padding: 14px 28px;
        border-radius: var(--radius-pill);
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.1s;
    }
    .char-count-box {
        font-size: 0.8rem;
        margin-top: 5px;
        color: var(--text-secondary);
    }
</style>
@endsection 

@section('content')
<div class="service-header">
    <h1>Bulk SMS</h1>
    <p class="text-muted">Reach thousands of people instantly with our reliable SMS gateway.</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="service-card-wrapper">
            <form method='post' class="myForm" enctype="multipart/form-data">@csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-bold">Sender's Name</label>
                        <input required name='sender_name' id='sender_name' class="form-control-custom" type="text" maxlength="11" placeholder="Max 11 characters">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-bold">Message Type</label>
                        <select id='message_type' required class="form-control-custom" name="message_type">
                            <option value='Normal SMS'>Normal SMS</option>
                            <option value='Flash SMS'>Flash SMS</option>
                            <option value='Unicode SMS'>Unicode SMS</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label-bold">Choose Contact Method</label>
                        <div class="radio-group-custom">
                            <label class="radio-item-custom">
                                <input class='contact_type' type="radio" name="contact_type" id="manual_input" value="manual_input" checked>
                                <span>Manual Input</span>
                            </label>
                            <label class="radio-item-custom">
                                <input class='contact_type' type="radio" name="contact_type" id="import_csv" value="import_file">
                                <span>Import CSV/Excel</span>
                            </label>
                            <label class="radio-item-custom">
                                <input class='contact_type' type="radio" name="contact_type" id="select_group" value="select_group">
                                <span>Select Group</span>
                            </label>
                        </div>
                    </div>

                    <input type='hidden' id='schedule_date' name='schedule_date' />
                    <input type='hidden' id='schedule_time' name='schedule_time' />

                    <div class="col-12">
                        <div id='import_field' style='display:none'>
                            <label class="form-label-bold">Upload File</label>
                            <input accept=".xls, .xlsx, .csv" type="file" class="form-control-custom" name='import_file' id='import_file'>
                        </div>

                        <div id='select_group_field' style='display:none'>
                            <label class="form-label-bold">Select Contact Group</label>
                            <select id='selected_group' class="form-control-custom" name='selected_group'>
                                <option value=''>-- Choose a group --</option>
                                @foreach($contacts as $contact)
                                <option value='{{ $contact->id }}'>{{ $contact->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id='manual_input_field'>
                            <label class="form-label-bold">Recipients</label>
                            <textarea class="form-control-custom" style="min-height: 100px;" name="manual_contact" id='contact_field' placeholder="Type numbers separated by comma or space..."></textarea>
                            <div class="char-count-box">
                                <i class="fa-solid fa-users me-1"></i> Total Recipients: <span id='no_of_recipients' class="fw-bold">0</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label-bold">Message Content</label>
                        <textarea required class="form-control-custom" style="min-height: 150px;" name="message" id='sms' placeholder="Type your message here..."></textarea>
                        <div class="d-flex justify-content-between char-count-box">
                            <span><span id='pages' class="fw-bold">0</span> Page(s)</span>
                            <span class='text-danger'>Remaining: <span id='character' class="fw-bold">160</span> characters</span>
                        </div>
                    </div>

                    <div class="col-12 pt-3">
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn-send flex-grow-1">Send SMS Now</button>
                            <button id='scheduleSend' type="button" class="btn-schedule">Schedule Later</button>
                        </div>
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

        @if (session('message'))
        Swal.fire('Success!',"{{ session('message') }}",'success');
    @endif
        $("#u_amount").on('input',function() {
        var amount = parseInt($("#u_amount").val()) * 100;
      
       
        if(parseInt($("#u_amount").val()) < 2500) {
            $("#amount").val((amount) + (0.05 * amount));
          
        }
        else {
            $("#amount").val((amount) + (0.05 * amount) +10000);
          
          
        }
        
        // alert($("#u_amount").val() * 100)
    })
    })

</script>
<script>
    $(document).ready(function() {
      // Swal.fire('very nice work')
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
      $("#sms").on('input', function() {
        var page = parseInt($("#pages").text())
        var recipient = parseInt($("#no_of_recipients").text())
        console.log(page, recipient, 'coole')
        //charge is the amount set by the admin to be charged per each transactions
        var charge = 4
        $("#amount_field").val(page * recipient * charge )
        $("#amount").text(page * recipient * charge)
      
        var sms_length = parseInt($("#sms").val().length / page)
        console.log(sms_length, 'the sms length')
        if(sms_length < 160) {
            $("#character").text(160 - sms_length)
            console.log(sms_length)
           } else {
          
            $("#pages").text(page + 1)
            $("#character").text('')
          
        }
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
                           
                          ` Total Charge : <b>NGN ${response.amount}</b><br><span class='text-danger'>Input your four(4) digit PIN to proceed</span>`,
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
        var page = parseInt($("#pages").text())
        var recipient = parseInt($("#no_of_recipients").text())
        console.log(page, recipient, 'coole')
        //charge is the amount set by the admin to be charged per each transactions
        var charge = 4
        $("#amount_field").val(page * recipient * charge )
        $("#amount").text(page * recipient * charge)
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
        //end copy

    });
  
  })
</script>

@endsection