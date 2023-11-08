@extends('business_backend.master')
@section('header')
@endsection
@section('content')


<div class="container-fluid">




    <div class="row">

            <div class="card md-xl-10">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h2 class="fw-bolder">BulkSMS Transactions
                        </h2>
                    </div>

                </div>
                <div class="card-body">
                    <form method='post' action='{{ route("save_admin_data") }}'>@csrf


                       
                            <div style='overflow-x:auto;max-width: 100%'>
                                <table style='width:100%' class="datatable table table-responsive mb-0 fixed-solution">
                                    <thead>
                                        <tr>
                                            <th scope="col">Customer</th>

                                            <th scope="col">Title </th>
                                            <th scope="col">Amount </th>
                                            <th scope="col">Details</th>
                                            <th scope="col">Before/After</th>
                                            <th scope="col">Status</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>

                                    @foreach($transactions as $key => $tranx)
                                    @if($tranx->status == 2)
                                    <tr class='alert alert-warning'>
                                        <td>{{ $tranx->user->name }}<br>
                                            <a href='https://wa.me/234{{ substr($tranx->user->phone,1) }}'>{{
                                                $tranx->user->phone }}</a>
                                        </td>
                                        <td>{{ $tranx->title }}</td>
                                        <td>₦{{ number_format($tranx->amount) }}</td>

                                        <td>{{ $tranx->description }}</td>
                                        <td>Pending Schedule Purchase</td>
                                        <td><a class='btn btn-warning btn-sm'>Pending</a></td>
                                        <td> <a class='btn btn-success'>Verify</a></td>

                                    </tr>
                                    @elseif($tranx->status == 0)

                                    <tr class='alert alert-danger'>
                                        <td>{{ $tranx->user->name }}<br>
                                            <a href='https://wa.me/234{{ substr($tranx->user->phone,1) }}'>{{
                                                $tranx->user->phone }}</a>
                                        </td>
                                        <td>{{ $tranx->title }}</td>
                                        <td>₦{{ number_format($tranx->amount,2) }}</td>
                                        <td>{{ $tranx->description }}</td>
                                        <td>₦{{ number_format($tranx->admin_before) }} / ₦{{
                                            number_format($tranx->admin_after) }}</td>
                                        <td>
                                            @if($tranx->status == 1)
                                            <span class='btn-sm btn btn-success'>Success</span>
                                            @else
                                            <span class='btn-sm btn btn-danger'>Failed</span>
                                            @endif
                                        </td>
                                        <td><a class='btn btn-success'>Verify</td>
                                    </tr>



                                    @else
                                    <tr class='alert alert-success'>
                                        <td>{{ $tranx->user->name }}<br>
                                            <a href='https://wa.me/234{{ substr($tranx->user->phone,1) }}'>{{
                                                $tranx->user->phone }}</a>
                                        </td>
                                        <td>{{ $tranx->title }}</td>
                                        <td>₦{{ number_format($tranx->amount,2) }}</td>
                                        <td>{{ $tranx->description }}</td>
                                        <td>₦{{ number_format($tranx->admin_before) }} / ₦{{
                                            number_format($tranx->admin_after) }}</td>
                                        <td>
                                            @if($tranx->status == 1)
                                            <span class='btn-sm btn btn-success'>Success</span>
                                            @else
                                            <span class='btn-sm btn btn-danger'>Failed</span>
                                            @endif
                                        </td>
                                        <td><a class='btn btn-success'>Verify</td>
                                    </tr>
                                    @endif


                                    @endforeach



                                </table>
                            </div>
                     
                        <!--end: Datatable-->
                    </form>
                </div>


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

      


            $('#searchTable').on('keyup', function() {
              oTable.search(this.value).draw();
            });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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