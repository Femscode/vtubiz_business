@extends('dashboard.master1')
@section('header')
@endsection
@section('content')

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create Question</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('storequestion')}}" method="POST">@csrf
                    <!--begin::Modal header-->

                    <div class="modal-body py-10 px-lg-17">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_new_address_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_modal_new_address_header"
                            data-kt-scroll-wrappers="#kt_modal_new_address_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Notice-->

                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="required fs-5 fw-bold mb-2">Question Name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input name='test' type='hidden' value='{{ $giveaway->id }}' />
                               
                                <input class="form-control" placeholder="" name="question" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bold mb-2">Options</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <style>
                                    .option-container {
                                        display: flex;
                                        align-items: center;
                                        margin-bottom: 10px;
                                    }

                                    .option-container input[type="radio"] {
                                        margin-left: 10px;
                                    }
                                </style>


                                @for($i = 0; $i < 4; $i++) <div class="option-container">

                                    <input type="text" name="options[]" class="form-control form-small"
                                        placeholder="Option {{ $i + 1 }}" required>
                                    <input required type="radio" name="correct_answer" value="{{ $i }}">
                                    <span>Is correct</span>
                            </div>
                            @endfor


                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Scroll-->
            </div>
            <!--end::Modal body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create question</button>
            </div>
            </form>

        </div>

    </div>
</div>
</div>
<div class="container-fluid">


    <!-- end page title -->

    <div class="row">


        <div class="card mb-xl-10">
            
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <h3 style='color:black'>{{$tests[0]->name}} Questions</h3>

                        <div>
                            <a href="#" class="btn btn-success mb-0" data-bs-toggle="modal"
                            data-bs-target="#exampleModalCenter"><i class="bi bi-plus-circle me-2"></i>Create Questions</a>
            
                            <a href="/my-giveaway" class="btn btn-secondary">Back</a>
                        </div>
                  
            </div>
            <div class="card-body">
                <div class="card-body py-3">
                    <!--begin::Table container-->
                  
                    @foreach($tests as $test)
                    @foreach($test->questions as $ques)

                    <div class="col-xl-12">
                        <!--begin::List Widget 6-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header flex-wrap border-0 flex-wrap">
                              
                                        <h4 class="mb-sm-0 font-size-18">{{$ques->question}}</h4>
                                        <div>
                                            <a onclick='return confirm("Are you sure you want to delete this question?")' class='btn btn-danger btn-sm'
                                                href='/delete_question/{{ $ques->id }}'><i class='fa fa-trash'></i></a>
                                        </div>
                                  
                              

                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-0">
                                <!--begin::Item-->
                                @foreach($ques->answers as $answer)
                                <div class="d-flex align-items-center bg-light-warning rounded p-5 mb-7">
                                    <!--begin::Icon-->
                                    <span class="svg-icon svg-icon-warning me-5">
                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                                    fill="black"></path>
                                                <path
                                                    d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                                    fill="black"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <div class="flex-grow-1 me-2">
                                        <a href="#"
                                            class="fw-bolder text-gray-800 text-hover-primary fs-6">{{$answer->answer}}</a>
                                        {{-- <span class="text-muted fw-bold d-block">Due in 2 Days</span> --}}
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Lable-->
                                    <span class="fw-bolder text-warning py-1">
                                        @if($answer->is_correct)
                                        <span class="text text-success">
                                            correct answer
                                        </span>
                                        @endif
                                        <span>
                                            <!--end::Lable-->
                                </div>
                                @endforeach
                                <!--end::Item-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::List Widget 6-->
                    </div>
                    @endforeach





                    @endforeach
                    <!--end::Table container-->
                </div>
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