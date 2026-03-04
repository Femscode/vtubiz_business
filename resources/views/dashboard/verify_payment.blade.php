@extends('dashboard.master1')

@section('header')
<style>
    .verify-header {
        margin-bottom: var(--space-lg);
    }
    .verify-header h1 {
        font-family: 'Fraunces', serif;
        font-size: 2.2rem;
        color: var(--primary-dark);
        margin-bottom: 8px;
    }
    .verify-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        box-shadow: var(--shadow-card);
    }
    .form-control-custom {
        width: 100%;
        padding: 14px 18px;
        border-radius: var(--radius-md);
        border: 1px solid rgba(0,0,0,0.08);
        background: #F9F9F9;
        font-family: 'DM Sans', sans-serif;
        transition: all 0.2s ease;
    }
    .form-control-custom:focus {
        outline: none;
        border-color: var(--primary-dark);
        background: white;
        box-shadow: 0 0 0 4px rgba(15, 53, 72, 0.05);
    }
    .btn-verify {
        background: var(--primary-dark);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: var(--radius-pill);
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.1s;
    }
    .btn-verify:active { transform: scale(0.98); }

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
    }
    .modern-table tbody td {
        padding: 16px 20px;
        font-size: 0.9rem;
        vertical-align: middle;
    }
    .modern-table tbody td:first-child { border-radius: 12px 0 0 12px; }
    .modern-table tbody td:last-child { border-radius: 0 12px 12px 0; }
</style>
@endsection

@section('content')
<div class="verify-header">
    <h1>Verify Payment</h1>
    <p class="text-muted">Track and verify the status of your funding transactions using their reference numbers.</p>
</div>

<div class="verify-card">
    <form method='post' action='{{ route("admin_check_verify_payment") ?? "" }}'>
        @csrf
        <div class="row align-items-end g-3">
            <div class="col-md-9">
                <label class="form-label font-weight-bold mb-2" style="font-size: 0.9rem; color: var(--primary-dark);">Transaction Reference</label>
                <input type="text" value='{{ $ref ?? "" }}' id='reference' class="form-control-custom" name="reference" placeholder="Enter transaction reference">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn-verify w-100">Verify Now</button>
            </div>
        </div>
    </form>

    @if(isset($response))
    <div class="mt-5 pt-4 border-top">
        <h4 class="serif mb-4" style="color: var(--primary-dark);">Verification Result</h4>
        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Details</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-weight: 500;">{{ $response['id'] ?? '' }}</td>
                        <td>
                            <div class="text-xs">
                                <strong>Amount:</strong> ₦{{ number_format($response['amount'] ?? 0, 2) }}<br>
                                <strong>Channel:</strong> {{ $response['payment_type'] ?? 'N/A' }}
                            </div>
                        </td>
                        <td>
                            <div class="text-xs">
                                <strong>Originator:</strong> {{ $response['meta']['originatorname'] ?? 'N/A' }}<br>
                                <strong>Bank:</strong> {{ $response['meta']['bankname'] ?? 'N/A' }}<br>
                                <strong>Account:</strong> {{ $response['meta']['originatoraccountnumber'] ?? 'N/A' }}
                            </div>
                        </td>
                        <td class="text-xs text-muted">
                            {{ $response['created_at'] ?? '' }}
                        </td>
                        <td>
                            <span class="badge" style="background: rgba(39, 174, 96, 0.1); color: var(--accent-green); border-radius: 20px; padding: 6px 12px;">
                                {{ $response['status'] ?? '' }}
                            </span>
                        </td>
                        <td>
                            <a href='#' class="btn btn-sm" style="background: var(--primary-dark); color: white; border-radius: 20px; padding: 5px 15px;">Print</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection

@section('script')
<script>
  $(document).ready(function() {
        var oTable = $('.datatable').DataTable({
            ordering: false,
            searching: true
            });   


            $('#searchTable').on('keyup', function() {
              oTable.search(this.value).draw();
            });

        @if (session('message'))
        Swal.fire('Success!',"{{ session('message') }}",'success');
    @endif
    $("body").on('click','.redo', function() {
        var description = $(this).data('description')
        var title = $(this).data('title')
        var transaction_id = $(this).data('transaction_id')
        console.log($(this).data('amount'),  $("#user_amount").val(), 'price different' )
       if(parseInt( $("#user_amount").val()) > parseInt($(this).data('amount'))) {
       
        Swal.fire({
          title: "You are about to redo " + description,
          html: " <span class='text-warning'>Input your four(4) digit pin to proceed</span> " ,
          icon: "warning",
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
          showCancelButton: true,
          confirmButtonColor: "#ebab21",
          cancelButtonColor: "grey",
          confirmButtonText: "Proceed",
          allowOutsideClick: false,
          allowEscapeKey: false,
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
        }).then((result) => {
          if(result.isConfirmed == false) {
          return;

          }
          console.log(result, 'the result')
        
        Swal.fire({
          title: "Processing transaction, please wait...",
          // html: '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>',
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
          didOpen: () => {
            Swal.showLoading();
          },
        });
        let fd = new FormData();
        fd.append("transaction_id", transaction_id);
        fd.append("pin", result.value);
       
      
        axios
          .post("/redo_transaction", fd)
          .then((response) => {
            console.log(response, 'the res')
            if (response.data.success == "true") {
              Swal.fire({
                icon: "success",
                title: "Purchase successful!",
                showConfirmButton: true, // updated
                confirmButtonColor: "#3085d6", // added
                confirmButtonText: "Ok", // added
                allowOutsideClick: false, // added to prevent dismissing the modal by clicking outside
                allowEscapeKey: false, // added to prevent dismissing the modal by pressing Esc key
              }).then((result) => {
                if (result.isConfirmed) {
                  location.reload();
                }
              });
            } else {
              Swal.fire({
                icon: "error",
                title: response.data.message,
                // text: "Updating...",
                showConfirmButton: true, // updated
                confirmButtonColor: "#3085d6", // added
                confirmButtonText: "Ok", // added
                allowOutsideClick: false, // added to prevent dismissing the modal by clicking outside
                allowEscapeKey: false, // added to prevent dismissing the modal by pressing Esc key
              }).then((result) => {
                if (result.isConfirmed) {
                  // location.reload();
                }
              });
            }
          })
          .catch((error) => {
            console.log(error.message);
            Swal.fire(error.message);
          });
        }) 
      } else {
        Swal.fire({
                title: 'Insufficient balance!,',
                icon: 'info',
                html:
                    'Click ' +
                    '<a href="https://fastpay.cttaste.com/fundwallet">here</a> ' +
                    'to fund your wallet.',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
              
                })
            

            }
     
    })
  
        
    })

</script>
@endsection