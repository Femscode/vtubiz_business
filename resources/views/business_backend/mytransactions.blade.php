@extends('business_backend.master')
@section('header')
@endsection
@section('content')


<div class="container-fluid">




    <div class="row">

        <div class="card mb-xl-10">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h2 class="fw-bolder">Pending Transactions
                    </h2>
                </div>

            </div>
            <div class="card-body">
                <form method='post' action='{{ route("save_admin_data") }}'>@csrf



                    <div style='overflow-x:auto;max-width: 100%'>
                        <table style='width:100%' class="datatable table table-striped">
                            <thead>
                                <tr>
                                  
                                    <th scope="col">Details</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Date & Time</th>
                                  
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $key => $tranx)

                                <tr>

                                    <td>{{ $tranx->details }}</td>
                                    <td>₦{{ number_format($tranx->amount) }}</td>
                                    <td>{{ Date('d-m-Y | h:i',strtotime($tranx->created_at))}} | {{ Date("h:i", strtotime($tranx->created_at)) }}</td>
                                   
                                    <td>
                                        <a href='admin_delete_duplicate/confirm/{{ $tranx->id }}' onclick="return confirm('Confirm the success of this transaction?')" class='btn btn-success btn-sm'>Confirm Tranx</a>
                                        <a href='https://wa.me/2349058744473'  class='btn btn-info btn-sm'>Complain Tranx</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
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