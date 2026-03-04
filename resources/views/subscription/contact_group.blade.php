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
        height: 100%;
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
        gap: 15px;
        margin-bottom: 15px;
    }
    .radio-item-custom {
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }
    .radio-item-custom input {
        accent-color: var(--primary-dark);
    }
    .radio-item-custom span {
        font-size: 0.85rem;
        font-weight: 600;
    }
    .btn-create-group {
        background: var(--primary-dark);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: var(--radius-pill);
        font-weight: 600;
        cursor: pointer;
        width: 100%;
        transition: transform 0.1s;
    }
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }
    .modern-table thead th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-light);
        padding: 10px 20px;
        font-weight: 700;
    }
    .modern-table tbody tr {
        background: #FDFCF8;
        transition: transform 0.2s;
    }
    .modern-table tbody td {
        padding: 15px 20px;
        font-size: 0.9rem;
        vertical-align: middle;
    }
    .modern-table tbody td:first-child { border-radius: 12px 0 0 12px; }
    .modern-table tbody td:last-child { border-radius: 0 12px 12px 0; }
</style>
@endsection 

@section('content')
<div class="service-header">
    <h1>Contact Groups</h1>
    <p class="text-muted">Manage your phone number lists for efficient bulk SMS delivery.</p>
</div>

<div class="row g-4">
    <div class='col-lg-4'>
        <div class="service-card-wrapper">
            <h4 class="serif mb-4" style="color: var(--primary-dark);">Create Group</h4>
            <form method='post' action='/saveAdminContact' enctype="multipart/form-data">@csrf
                <label class="form-label-bold">Group Name</label>
                <input type="text" name='name' class="form-control-custom" placeholder="e.g. Monthly Newsletter" required>

                <label class="form-label-bold">Contact Source</label>
                <div class="radio-group-custom">
                    <label class="radio-item-custom">
                        <input type="radio" name="contact_type" id="manual_input" value="manual_input" checked>
                        <span>Manual</span>
                    </label>
                    <label class="radio-item-custom">
                        <input type="radio" name="contact_type" id="import_csv" value="import_file">
                        <span>CSV Import</span>
                    </label>
                </div>

                <div id='manual_input_field'>
                    <label class="form-label-bold">Contacts</label>
                    <textarea name='contacts' class="form-control-custom" id="contact_field" style="min-height: 120px;" placeholder="Enter numbers separated by comma..."></textarea>
                </div>

                <div id='import_field' style='display:none'>
                    <label class="form-label-bold">Upload CSV/Excel</label>
                    <input accept=".xls, .xlsx, .csv" type="file" class="form-control-custom" name='import_file'>
                </div>

                <button type="submit" class="btn-create-group mt-2">Save Group</button>
            </form>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="service-card-wrapper">
            <h4 class="serif mb-4" style="color: var(--primary-dark);">Saved Groups</h4>
            <div class="table-responsive">
                <table class="datatable modern-table">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Group Details</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $key => $contact)
                        <tr>
                            <td class="fw-bold">{{ ++$key }}</td>
                            <td>
                                <div style="font-weight: 600; color: var(--primary-dark);">{{ $contact->name }}</div>
                                <div class="text-xs text-muted text-truncate" style="max-width: 300px;">{{ $contact->contacts }}</div>
                            </td>
                            <td style="text-align: right;">
                                <a onclick='return confirm("Delete this group?")' class='btn btn-sm' style="background: rgba(235, 87, 87, 0.1); color: var(--accent-pink); border-radius: 20px; font-weight: 600; padding: 5px 15px;" href='delete_group/{{ $contact->id }}'>Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
  
        var oTable = $('.datatable').DataTable({
              ordering: false,
              searching: true
              });   
    
        $(".myForm").on("submit", async function(e) {
          $("#schedule_time").val('')
          $("#schedule_date").val('')
          e.preventDefault();
    
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
                             
                            ` Total Charge : <b>NGN ${response.amount}</b>`,
                          showCloseButton: true,
                          showCancelButton: true,
                          focusConfirm: false,
                          confirmButtonText:
                            'Proceed!',
                          cancelButtonText:
                            'Cancel',
                      })
                      .then((result) => {
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
                                        title: 'Error while sending message, try again later or contact support!'
                                       
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