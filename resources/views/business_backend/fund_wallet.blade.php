@extends('business_backend.master')
@section('header')
@endsection
@section('content')


<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Fund <span class='text-danger'>{{ $user->name }}</span> wallet.</h4>
            </div>





        </div>
    </div>
    <!-- end page title -->

    <div class="row">

        <div class="col-xl-12">

            <!-- end row -->

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Fund User Wallet</h4>
                    <div class='alert alert-danger'>You are about to fund {{ $user->name }} wallet, please endeavor he/she has made a payment before funding!</div>
                    <div>
                        <form method='post' action='{{ route("credit_user") }}'
                            enctype='multipart/form-data'>
                            @csrf

                            <div class="mb-3">
                                <label for="heading" class="form-label">Amount</label>
                                <input type='hidden' name='user_id' value='{{ $user->uuid }}'/>
                                <input type="number" id='amount' class="form-control" name="amount" value=""
                                    placeholder="Enter Amount">

                            </div>
                                                 
                            <div class='text-right'>
                                <button type="submit" name='submit_type' value='save'
                                    class="btn btn-primary w-md ">Fund</button>
                            </div>
                        </form>
                    </div>
                    @if(isset($response))
                    <div style='overflow-x:auto;max-width: 100%'>
                        <table style='width:100%' class="table">
                            <thead>
                                <tr>

                                    <th scope="col">S/N</th>
                                    <th scope="col">Reference</th>

                                    <th scope="col">Details</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                   
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>{{ $response['id'] ?? '' }}</td>
                                    <td>Amount : NGN{{ number_format($response['amount']) ?? '' }}, Channel : {{ $response['payment_type'] }}</td>
                                    <td>{{ $response['meta']['originatorname'] ?? '' }}, Account Name : {{ $response['meta']['bankname'] ?? '' }}, Account No: {{ $response['meta']['originatoraccountnumber'] ?? '' }}</td>

                                  
                                    <td>{{ $response['created_at'] ?? '' }}</td>
                                    <td>{{ $response['status'] ?? '' }}</td>
                                    <td>
                                        <a class='btn btn-success'>Print</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
                <!-- end card body -->
            </div>
        </div>


    </div>
    <!-- end row -->


    <!-- end row -->
</div>
@section('script')
<script>
    $(document).ready(function() {
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
                        title: '{{ session("success") ?? '' }}'
                        }) 
           
        @endif
                    })
</script>

@endsection

@endsection