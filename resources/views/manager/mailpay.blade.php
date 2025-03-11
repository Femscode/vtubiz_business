@extends('manager.master')

@section('header')
@endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Container-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <!--begin::Profile Account Information-->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Mailpay Transactions ({{ number_format(count($mailpays)) }})</h4>
                        <table class="datatable table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Sender Details</th>
                                    <th scope="col">User Details</th>
                                   
                                    <th scope="col">Narration</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mailpays as $key => $tranx)

                                <tr>

                                    <td>{{ $tranx->sender_name  }}<br><span class='text-danger'>{{ $tranx->phone }}</span></td>
                                    <td>{{ $tranx->user->name ?? "Nil" }}<br><span class='text-danger'>{{ $tranx->user->email ?? "Nil" }}</span></td>
                                   
                                    <td>{{ $tranx->narration }}</td>
                                    <td>₦{{ number_format($tranx->amount) }}</td>
                                    <td>
                                        @if($tranx->status == 1)
                                            <span class="badge bg-success">Confirmed</span>
                                        @elseif($tranx->status == 2)
                                            <span class="badge bg-warning">Pending</span>
                                        @else
                                            <span class="badge bg-danger">Failed</span>
                                        @endif
                                    </td>
                                    <td>{{ $tranx->date }}</td>
                                   
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

            <!-- end col -->
        </div>
        <!--end::Profile Account Information-->
    </div>
    <!--end::Container-->
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
        
    })

</script>
@endsection