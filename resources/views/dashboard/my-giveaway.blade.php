@extends('dashboard.master1')
@section('header')
@endsection
@section('content')


<div class="container-fluid">


    <!-- end page title -->

    <div class="row">


        <div class="card mb-xl-12">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                
                <div class="card-title">
                    <div class="page-title-box align-items-center justify-content-between">
                        
                            <div class='col'>
                                <h4 class="mb-sm-0 font-size-18">My Giveaways</h4>
                            </div>
                            <div class='col text-end'>
                                <a href='/create-giveaway' class="btn-sm btn btn-success">Create Giveaway</a>
                                <a onclick="window.history.back()" class="btn-sm btn btn-secondary">Back</a>
                            </div>
                       

                    </div>

                </div>
              
                <!-- end card body -->
            </div>
            <div class="card-body">

                <div style='overflow-x:auto;max-width: 100%'>
                    <table class='datatable table table-responsivetable m-0'>
                        <thead>
                            <tr>
                                <th>Actions</th>
                                <th>Giveaway Details</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($giveaway as $group)
                            <tr>
                                <td>
                                    @if($group->type == 'question_data' || $group->type == 'question_airtime' ||
                                    $group->type ==
                                    'question_cash')
                                    <a href='/add_question/{{ $group->slug }}' class='btn btn-sm btn-primary'>Add
                                        Questions</a>
                                    @endif
                                    {{-- <a href='https://vtubiz.com/{{ $group->slug }}'
                                        class='btn btn-sm btn-primary'>Copy Link</a> --}}

                                    <a href='/giveaway_participant/{{ $group->slug }}'
                                        data-total_amount="{{ number_format($group->estimated_amount) }}"
                                        class='btn btn-sm btn-info'>View
                                        Details</a>
                                    <a onclick="return confirm('Are you sure you want to delete this group?')"
                                        href='/delete_giveaway/{{ $group->slug }}' class='btn btn-sm btn-danger'>Delete
                                        Giveaway</a>

                                </td>

                                <td>
                                    <b>{{ $group->name }} (NGN{{ number_format($group->estimated_amount) }})</b><br>
                                    @if($group->type == "question_data" || $group->type=='question_airtime' ||
                                    $group->type ==
                                    'question_cash')


                                    <h5>Giveaway Live Link : </h5>
                                    @if(count($group->all_questions->all()) == 0)

                                    <span class='text-danger'>Kindly add questions to display the giveaway live
                                        link!</span><br>
                                    @else
                                    <h4> <b>https://vtubiz.com/{{ $group->slug }}</b></h4>
                                    @endif
                                    @else
                                    <h4> <b>https://vtubiz.com/{{ $group->slug }}</b></h4>

                                    @endif

                                </td>


                            </tr>
                            @endforeach
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
        <!-- end row -->


        <!-- end row -->
    </div>
    @section('script')
    <script>
        $(document).ready(function() {
    var oTable = $('.datatable').DataTable({
            ordering: false,
            searching: true
            });   
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
                title: "Purchase successful! Check group transaction table to confirm.",
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