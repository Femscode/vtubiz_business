@extends('dashboard.master1')

@section('header')
@endsection 

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Container-->
    <div  id="kt_app_content" class="app-content  flex-column-fluid ">
        <!--begin::Profile Account Information-->
        <div class="row">
            <!--begin::Aside-->
          
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="col-md-12">
                <!--begin::Card-->
                <div class="card card-custom">
                    <h1 class='text-center p-2 mt-4'>Bulk SMS</h1>
                    <form method='post' class="myForm" enctype="multipart/form-data">@csrf
                        <div class="form-group p-4 m-5">


                            <div class="wrap-form-control validate-input" data-validate="Sender Name is required">
                                <label>Sender's Name</label>
                                <input name='sender_name' id='sender_name' class="form-control" type="text"
                                    maxlength="10" name="name" placeholder="Sender's Name">
                                <span class="shadow-form-control"></span>
                            </div>
                            <label><b>Choose Contact Type</b></label>
                            <div class="wrap-form-control validate-input">

                                <input class='contact_type' type="radio" name="contact_type" id="manual_input"
                                    value="manual_input" checked>
                                <label for="contact_type1"><b>
                                        Manual Input</b>
                                </label>
                                <input class='contact_type' type="radio" name="contact_type" id="import_csv"
                                    value="import_file">
                                <label for="contact_type2"><b>
                                        Import from file(csv)</b>
                                </label>
                                <input class='contact_type' type="radio" name="contact_type" id="select_group"
                                    value="select_group">
                                <label for="contact_type2"><b>
                                        Select From Group</b>
                                </label>


                                <span class="shadow-form-control"></span>
                            </div>
                            <input type='hidden' id='schedule_date' name='schedule_date' />
                            <input type='hidden' id='schedule_time' name='schedule_time' />



                            <div style='display:none' id='import_field' class="wrap-form-control validate-input"
                                data-validate="Message is required">


                                <div class="input-group mb-3">
                                    <input accept=".xls, .xlsx, .csv" type="file" class="form-control form-control"
                                        name='import_file' id='import_file'>

                                </div>
                            </div>
                            <div style='display:none' id='select_group_field' class="wrap-form-control validate-input"
                                data-validate="Message is required">


                                <div class="input-group mb-3">
                                    <select id='selected_group' class="form-control" name='selected_group'>
                                        <option value=''>--Select From Group--</option>
                                        @foreach($contacts as $contact)
                                        <option value='{{ $contact->id }}'>{{ $contact->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id='manual_input_field' class="wrap-form-control validate-input"
                                data-validate="Message is required">
                                <label>Recipients</label><br>
                              
                                <textarea class="form-control" name="manual_contact" id='contact_field'
                                    placeholder="Type Contact, seperate by comma or space"></textarea>
                                {{-- <input type="hidden" name="manual_contact" id="appendedNumbersInput"> --}}

                                <span class="shadow-form-control"></span>
                                Total phone numbers: <span id='no_of_recipients'></span><br>
                                <input type='hidden' name='amount' id='amount_field' />
                              
                                <div id="output-container"></div>

                            </div><br>

                            <div class="wrap-form-control validate-input" data-validate="Message is required">
                                <label>Message</label><br>
                                <textarea required class="form-control" name="message" id='sms'
                                    placeholder="Type SMS Message Here..."></textarea>
                                <span id='pages'>0</span> pages
                                <span id='max_char'><b class='text-danger'>Total typed characters <span
                                            id='character'>160</span>.</b></span>
                            </div><br>


                            <div class="wrap-form-control validate-input" data-validate="Sender Name is required">
                                <label>Message Type</label><br>
                                <select id='message_type' required class="form-control form-control" type="text"
                                    name="message_type">
                                    <option value='Normal SMS'>Normal SMS</option>
                                    <option value='Flash SMS'>Flash SMS</option>
                                    <option value='Unicode SMS'>Unicode SMS</option>
                                </select>
                                <span class="shadow-form-control"></span>
                            </div><br>


                            <div class="form-group row ">
                                <div class="btn-group btn-group-example mb-3" role="group">
                                    <button type="submit" class="btn btn-primary w-xs">Send Now</button>
                                    <button id='scheduleSend' type="button" class="btn btn-success w-xs">Schedule For
                                        Later</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Profile Account Information-->
    </div>
    <!--end::Container-->
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