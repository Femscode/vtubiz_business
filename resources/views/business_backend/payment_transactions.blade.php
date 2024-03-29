@extends('business_backend.master')
@section('header')
@endsection
@section('content')


<div class="container-fluid">


    <div class="row">

            <!--begin::Card-->
            <div class="card mb-xl-10">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h2 class="fw-bolder">Payment Transactions
                        </h2>
                    </div>

                </div>
                <div class="card-body">
                    <form method='post' action='{{ route("save_admin_data") }}'>@csrf

                        <div style='overflow-x:auto;max-width: 100%'>
                            <table style='width:100%' class="datatable table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Reference</th>

                                        <th scope="col">Title </th>
                                        <th scope="col">Amount </th>
                                        <th scope="col">Details</th>
                                        <th scope="col">Before/After</th>
                                        <th scope="col">Status</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>

                                @foreach($transactions as $key => $tranx)
                                <tr>
                                    <td>{{ $tranx->user->name ?? 'No name'}}<br>
                                        <a href='https://wa.me/234{{ substr($tranx->user->phone ?? 'no phone',1) }}'>{{
                                            $tranx->user->phone ?? "No phone"}}</a>
                                    </td>
                                    <td>{{ $tranx->reference }}</td>
                                    <td>{{ $tranx->title }}</td>
                                    <td>₦{{ number_format($tranx->amount,2) }}</td>
                                    <td>{{ $tranx->description }}</td>
                                    <td>₦{{ number_format($tranx->before) }} / ₦{{ number_format($tranx->after) }}</td>
                                    <td>
                                        @if($tranx->status == 1)
                                        <span class='btn-sm btn btn-success'>Success</span>
                                        @elseif($tranx->status == 2)
                                        <span class='btn-sm btn btn-warning'>Pending</span>
                                        @else
                                        <span class='btn-sm btn btn-danger'>Failed</span>
                                        @endif
                                    </td>
                                    <td><a href='verify_payment/{{ $tranx->reference }}' class='btn btn-success'>Verify</td>
                                </tr>


                                @endforeach

                                </tbody>

                            </table>
                        </div>
                        <!--end: Datatable-->


                    </form>


                </div>
                <!--end::Card-->
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