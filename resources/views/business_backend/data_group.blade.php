@extends('business_backend.master')
@section('header')
@endsection
@section('content')


<div class="container-fluid">

  <!-- start page title -->
  <div class="row">
    <div class="col-12">



      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <div class="modal-body">
              <h4>Create Group</h4>
              <form method='post' action='/createGroup'>@csrf
                <input type='text' class='form-control' name='name' placeholder='e.g My Family' />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Create</button>

            </div>
            </form>
          </div>
        </div>
      </div>





    </div>
  </div>
  <!-- end page title -->

  <div class="row">


    <div class="card mb-xl-10">
      <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Data Group</h4>
            <a class='btn btn-primary' data-bs-toggle="modal" data-bs-target="#exampleModal">Create Group</a>
          </div>

        </div>

      </div>
      <div class="card-body">
        <table class='table m-0'>
          <tr>
            <th>Name</th>
            <th>Total Recipient</th>
            <th>Total Amount</th>
            <th>Action</th>
          </tr>
          @foreach($data_groups as $group)
          <tr>
            <td>{{ $group->name }}</td>
            <td>{{ count($group->recipient) }}</td>
            <td>NGN{{ number_format($group->recipient->sum('amount')) }}</td>
            <td>
              <a href='/data_recipient/{{ $group->uid }}' class='btn sm btn-primary'>Add/View Recipients</a>
              <a data-group_id='{{ $group->uid }}'
                data-total_amount="{{ number_format($group->recipient->sum('amount')) }}"
                class='recharge btn sm btn-success'>Recharge Group</a>
              <a href='/group_transactions/{{ $group->uid }}' class='btn sm btn-info'>Transactions</a>
              <a onclick="return confirm('Are you sure you want to delete this group?')"
                href='/delete_group/{{ $group->uid }}' class='btn sm btn-danger'>Delete Group</a>

            </td>
          </tr>
          @endforeach


        </table>
      </div>
      <!-- end card body -->
    </div>

  </div>
  <!-- end row -->


  <!-- end row -->
</div>
@section('script')
<script>
  $(document).ready(function() {
        $(".recharge").click(function() {
            return Swal.fire({
    title: 'Input your four(4) digit pin to confirm purchase!',
    text: 'Total Price: NGN'+$(this).data('total_amount'),
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Proceed',
    cancelButtonText: 'Cancel',
    input :"password",
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
  }).then((result) => {
    if (result.isConfirmed == false) {
        return Swal.fire('Transaction Declined', '', 'error');
    } else {
           
        Swal.fire({
          title: "Making bulk purchase, please wait...",
          // html: '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>',
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
          didOpen: () => {
            Swal.showLoading();
          },
        });

        let fd = new FormData();
        fd.append("group_id", $(this).data('group_id'));
      
        fd.append("pin", result.value);
        axios
          .post("/recharge_group", fd)
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
                //   location.reload();
                }
              });
            } else {
              Swal.fire({
                icon: "error",
                title: response.data.message,
                // title: "Opps, service currently not available and we are currently working on it, try again in 30Min time😢🙏",
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
        // window.location.href = '/recharge_group/'+$(this).data('group_id')
      return true; // User clicked "Yes"
    
    }
  });
        })
        $("#type").on('change',function() {
            $("#show_notify").show()
            $("#title").val($("#type").find(':selected').data('title'))
            $("#description").val($("#type").find(':selected').data('description'))
            $("#notf_id").val($("#type").find(':selected').val())
        })
        const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })

                @if (session('success'))
        Toast.fire({
                        icon: 'success',
                        title: '{{ session("success") }}'
                        }) 
           
        @endif
                    })
</script>

@endsection

@endsection