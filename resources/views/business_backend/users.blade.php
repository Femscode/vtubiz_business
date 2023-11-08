@extends('business_backend.master')
@section('header')
@endsection
@section('content')


<div class="container-fluid">



    <div class="row">

        <div class="col-lg-12">

            <div class="row mb-3">
                <div class="col-xl-4 col-sm-6">
                    <div class="mt-2">
                        <h5>Data Prices</h5>
                    </div>
                </div>

            </div>

            <!-- end row -->

        </div>
    </div>

    <div class="row">

        <!--begin::Content-->
        <div class="col-md-12">
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Data Prices
                        </h3>
                    </div>

                </div>
                <div class="card-body">

                    <div style='overflow-x:auto;max-width: 100%'>
                        <table style='width:100%' class="datatable table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>

                                    <th scope="col">Phone </th>
                                    <th scope="col">Balance</th>
                                    <th scope="col">Spent</th>
                                    <th scope="col">Actions</th>

                                </tr>
                            </thead>

                            @foreach($users as $key => $user)

                            <tr>


                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->phone }}
                                </td>
                                <td>
                                    NGN{{ number_format($user->balance,2) }}
                                </td>
                                <td>
                                    NGN{{ number_format($user->spent,2) }}
                                </td>
                                <td>
                                    <a class='btn btn-warning btn-sm'  href='/fund_wallet/{{ $user->uuid }}'>Fund Wallet</a>
                                    <a class='btn btn-info btn-sm' href='/transactions/{{ $user->uuid }}'>Transactions</a>
                                    @if($user->block == 0)
                                    <a href='/block_user/{{ $user->uuid }}' class='btn btn-danger btn-sm' onclick="
                                        event.preventDefault();
                                        Swal.fire({
                                            title: 'Are you sure?',
                                            text: 'You are about to block this user.',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Yes, block!'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = '/block_user/{{ $user->uuid }}';
                                            }
                                        });
                                    ">Block User</a>
                                    
                                    @else
                                    <a href='/block_user/{{ $user->uuid }}' class='btn btn-success btn-sm' onclick="
                                        event.preventDefault();
                                        Swal.fire({
                                            title: 'Are you sure?',
                                            text: 'You are about to unblock this user.',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Yes, unblock!'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = '/block_user/{{ $user->uuid }}';
                                            }
                                        });
                                    ">Unblock User</a>
                                    @endif
                                   
                                </td>




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