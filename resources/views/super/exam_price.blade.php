@extends('super.master')

@section('header')
@endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Container-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <!--begin::Profile Account Information-->
        <div class="row">

            <!--begin::Content-->
            <div class="col-md-12">
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">Exam Prices
                            </h3>
                            <a href="/reset_all_exam_prices" class="btn btn-success" onclick="return confirm('Are you sure you want to reset all exam prices');">Reset All Exam Prices</a>

                        </div>

                    </div>
                    <div class="card-body">

                        <table class="datatable table table-striped">
                            <thead>
                                <tr>

                                    <th scope="col">Name</th>
                                    <th scope="col">Actual Price</th>
                                    <th scope="col">Real Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($exams as $key => $exam)

                                <tr>
                                    <form action='/update_exam' method='post'>@csrf



                                        <td> <input name='name' class='form-control' value="{{ $exam->name }}" /></td>
                                        <td><input name='actual_amount' class='form-control' value="{{ $exam->actual_amount }}" /></td>
                                        <td><input name='real_amount' class='form-control' value="{{ $exam->real_amount }}" /></td>

                                        <td>
                                            <button type='submit' class=' btn btn-success btn-sm'>Update</button>
                                        </td>
                                    </form>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var oTable = $('.datatable').DataTable({
            ordering: false,
            searching: true
        });

        @if(session('message'))
        Swal.fire('Success!', "{{ session('message') }}", 'success');
        @endif
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

        $('body').on('click', '.update_exam', function() {

            id = $(this).data('id');

            var fd = new FormData;
            fd.append('id', id);

            fd.append('actual_amount', $("#actual_amount").val());
            fd.append('real_amount', $("#real_amount").val());
            fd.append('name', $("#name").val());
            console.log(fd)
            $.ajax({
                type: 'POST',
                url: "{{route('update_exam')}}",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: function($data) {
                    console.log('the data', $data)
                    Swal.close()
                    Toast.fire({
                        icon: 'success',
                        title: 'Exam price updated successfully!'
                    })



                },
                error: function(data) {
                    console.log(data)
                    Swal.close()
                    Swal.fire('Opps!', data.message, 'error')
                }
            })

        });

    })
</script>
@endsection