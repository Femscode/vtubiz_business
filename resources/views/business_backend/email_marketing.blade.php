@extends('business_backend.master')
@section('header')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<!-- Include Quill script -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endsection
@section('content')


<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Email Marketing</h4>
            </div>





        </div>
    </div>
    <!-- end page title -->

    <div class="row">

        <div class="col-xl-12">

            <!-- end row -->

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Send Bulk Emails</h4>
                    <div class='alert alert-danger'>You will be able to send emails to only your customers, carrying your logo and brand name.<br>PLEASE NOTE THAT YOU CAN ONLY SEND ONCE IN A DAY.</div>
                    <div>
                        <form id='submitForm' method='post' action='{{ route("send_bulk_email") }}'
                            enctype='multipart/form-data'>
                            @csrf

                            <div class="mb-3">
                                <label for="heading" class="form-label">Subject</label>
                                <input type="text" id='subject' class="form-control" name="subject" value=""
                                    placeholder="Enter Email Subject">

                            </div>
                            <div class="mb-3">
                                <label for="heading" class="form-label">Message</label>
                                <div type="text" id='message' class="form-control" name="message" value=""
                                    placeholder="Enter Message"></div>

                            </div>

                            <div class='alert alert-info'>This message will be sent to @foreach($my_users as $user) {{ $user->email }} , @endforeach</div>



                            <div class='text-right'>
                                <button type="submit" name='submit_type' value='save'
                                    class="btn btn-primary w-md ">Send</button>
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
<script>
    var quill = new Quill('#message', {
      theme: 'snow' // or 'bubble' for a bubble theme
    });

    document.getElementById('submitForm').addEventListener('submit', function () {
        // Get the HTML content from the Quill editor
        var quillContent = quill.root.innerHTML;

        // Create a hidden input field dynamically
        var hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'message'; // Change 'quillContent' to your desired form field name
        hiddenInput.value = quillContent;

        // Append the hidden input to the form
        this.appendChild(hiddenInput);
    });
  </script>
  

@endsection

@endsection