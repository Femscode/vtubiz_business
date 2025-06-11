@extends('manager.master')

@section('header')
<style>
    .plan-status-table tbody tr:hover {
        background-color: #f5f8fa;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
    }

    .status-active {
        background-color: #e8f5e9;
        color: #2e7d32;
    }

    .status-inactive {
        background-color: #ffebee;
        color: #c62828;
    }

    .btn-group {
        display: flex;
        gap: 8px;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s ease;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
</style>
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
                            <h3 class="card-label">Data Plan Status
                            </h3>
                            <a href="/reset_data_price/all" class="btn btn-primary">Reset All</a>
                        </div>

                    </div>
                    <div class="card-body">
                    <table class="datatable table table-striped plan-status-table">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Network</th>
                                    <th scope="col">Plan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>MTN</td>
                                    <td>SME</td>
                                    <td>
                                        <span class="status-badge {{ $mtn_sme->status == 1 ? 'status-active' : 'status-inactive' }}">
                                            {{ $mtn_sme->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($mtn_sme->status == 0)
                                            <a href="/plan_status/1/sme" class='btn btn-sm btn-success action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-check-circle"></i> Enable
                                            </a>
                                            @else
                                            <a href="/plan_status/1/sme" class='btn btn-sm btn-danger action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-times-circle"></i> Disable
                                            </a>
                                            @endif
                                            <a href="/reset_data_price/mtn_sme" class='btn btn-sm btn-warning action-btn' onclick='return confirm("Reset prices for this plan?")'>
                                                <i class="fas fa-sync"></i> Reset Price
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>MTN</td>
                                    <td>AWOOF</td>
                                    <td>
                                        <span class="status-badge {{ $mtn_awoof->status == 1 ? 'status-active' : 'status-inactive' }}">
                                            {{ $mtn_awoof->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($mtn_awoof->status == 0)
                                            <a href="/plan_status/1/awoof" class='btn btn-sm btn-success action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-check-circle"></i> Enable
                                            </a>
                                            @else
                                            <a href="/plan_status/1/awoof" class='btn btn-sm btn-danger action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-times-circle"></i> Disable
                                            </a>
                                            @endif
                                            <a href="/reset_data_price/mtn_awoof" class='btn btn-sm btn-warning action-btn' onclick='return confirm("Reset prices for this plan?")'>
                                                <i class="fas fa-sync"></i> Reset Price
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>MTN</td>
                                    <td>CG</td>
                                    <td>
                                        <span class="status-badge {{ $mtn_cg->status == 1 ? 'status-active' : 'status-inactive' }}">
                                            {{ $mtn_cg->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($mtn_cg->status == 0)
                                            <a href="/plan_status/1/cg" class='btn btn-sm btn-success action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-check-circle"></i> Enable
                                            </a>
                                            @else
                                            <a href="/plan_status/1/cg" class='btn btn-sm btn-danger action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-times-circle"></i> Disable
                                            </a>
                                            @endif
                                            <a href="/reset_data_price/mtn_cg" class='btn btn-sm btn-warning action-btn' onclick='return confirm("Reset prices for this plan?")'>
                                                <i class="fas fa-sync"></i> Reset Price
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>MTN</td>
                                    <td>cg_lite</td>
                                    <td>
                                        <span class="status-badge {{ $mtn_cg_lite->status == 1 ? 'status-active' : 'status-inactive' }}">
                                            {{ $mtn_cg_lite->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($mtn_cg_lite->status == 0)
                                            <a href="/plan_status/1/cg_lite" class='btn btn-sm btn-success action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-check-circle"></i> Enable
                                            </a>
                                            @else
                                            <a href="/plan_status/1/cg_lite" class='btn btn-sm btn-danger action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-times-circle"></i> Disable
                                            </a>
                                            @endif
                                            <a href="/reset_data_price/mtn_cg_lite" class='btn btn-sm btn-warning action-btn' onclick='return confirm("Reset prices for this plan?")'>
                                                <i class="fas fa-sync"></i> Reset Price
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>MTN</td>
                                    <td>direct</td>
                                    <td>
                                        <span class="status-badge {{ $mtn_gifting->status == 1 ? 'status-active' : 'status-inactive' }}">
                                            {{ $mtn_gifting->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($mtn_gifting->status == 0)
                                            <a href="/plan_status/1/direct" class='btn btn-sm btn-success action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-check-circle"></i> Enable
                                            </a>
                                            @else
                                            <a href="/plan_status/1/direct" class='btn btn-sm btn-danger action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-times-circle"></i> Disable
                                            </a>
                                            @endif
                                            <a href="/reset_data_price/mtn_gifting" class='btn btn-sm btn-warning action-btn' onclick='return confirm("Reset prices for this plan?")'>
                                                <i class="fas fa-sync"></i> Reset Price
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>GLO</td>
                                    <td>cg</td>
                                    <td>
                                        <span class="status-badge {{ $glo_cg->status == 1 ? 'status-active' : 'status-inactive' }}">
                                            {{ $glo_cg->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($glo_cg->status == 0)
                                            <a href="/plan_status/2/cg" class='btn btn-sm btn-success action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-check-circle"></i> Enable
                                            </a>
                                            @else
                                            <a href="/plan_status/2/cg" class='btn btn-sm btn-danger action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-times-circle"></i> Disable
                                            </a>
                                            @endif
                                            <a href="/reset_data_price/glo_cg" class='btn btn-sm btn-warning action-btn' onclick='return confirm("Reset prices for this plan?")'>
                                                <i class="fas fa-sync"></i> Reset Price
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>GLO</td>
                                    <td>direct</td>
                                    <td>
                                        <span class="status-badge {{ $glo_gifting->status == 1 ? 'status-active' : 'status-inactive' }}">
                                            {{ $glo_gifting->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($glo_gifting->status == 0)
                                            <a href="/plan_status/2/direct" class='btn btn-sm btn-success action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-check-circle"></i> Enable
                                            </a>
                                            @else
                                            <a href="/plan_status/2/direct" class='btn btn-sm btn-danger action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-times-circle"></i> Disable
                                            </a>
                                            @endif
                                            <a href="/reset_data_price/glo_gifting" class='btn btn-sm btn-warning action-btn' onclick='return confirm("Reset prices for this plan?")'>
                                                <i class="fas fa-sync"></i> Reset Price
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>GLO</td>
                                    <td>Awoof</td>
                                    <td>
                                        <span class="status-badge {{ $glo_awoof->status == 1 ? 'status-active' : 'status-inactive' }}">
                                            {{ $glo_awoof->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($glo_awoof->status == 0)
                                            <a href="/plan_status/2/awoof" class='btn btn-sm btn-success action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-check-circle"></i> Enable
                                            </a>
                                            @else
                                            <a href="/plan_status/2/awoof" class='btn btn-sm btn-danger action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-times-circle"></i> Disable
                                            </a>
                                            @endif
                                            <a href="/reset_data_price/glo_awoof" class='btn btn-sm btn-warning action-btn' onclick='return confirm("Reset prices for this plan?")'>
                                                <i class="fas fa-sync"></i> Reset Price
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>AIRTEL</td>
                                    <td>cg</td>
                                    <td>
                                        <span class="status-badge {{ $airtel_cg->status == 1 ? 'status-active' : 'status-inactive' }}">
                                            {{ $airtel_cg->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($airtel_cg->status == 0)
                                            <a href="/plan_status/3/cg" class='btn btn-sm btn-success action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-check-circle"></i> Enable
                                            </a>
                                            @else
                                            <a href="/plan_status/3/cg" class='btn btn-sm btn-danger action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-times-circle"></i> Disable
                                            </a>
                                            @endif
                                            <a href="/reset_data_price/airtel_cg" class='btn btn-sm btn-warning action-btn' onclick='return confirm("Reset prices for this plan?")'>
                                                <i class="fas fa-sync"></i> Reset Price
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>AIRTEL</td>
                                    <td>AWOOF</td>
                                    <td>
                                        <span class="status-badge {{ $airtel_awoof->status == 1 ? 'status-active' : 'status-inactive' }}">
                                            {{ $airtel_awoof->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($airtel_awoof->status == 0)
                                            <a href="/plan_status/3/awoof" class='btn btn-sm btn-success action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-check-circle"></i> Enable
                                            </a>
                                            @else
                                            <a href="/plan_status/3/awoof" class='btn btn-sm btn-danger action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-times-circle"></i> Disable
                                            </a>
                                            @endif
                                            <a href="/reset_data_price/airtel_awoof" class='btn btn-sm btn-warning action-btn' onclick='return confirm("Reset prices for this plan?")'>
                                                <i class="fas fa-sync"></i> Reset Price
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>AIRTEL</td>
                                    <td>direct</td>
                                    <td>
                                        <span class="status-badge {{ $airtel_gifting->status == 1 ? 'status-active' : 'status-inactive' }}">
                                            {{ $airtel_gifting->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($airtel_gifting->status == 0)
                                            <a href="/plan_status/3/direct" class='btn btn-sm btn-success action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-check-circle"></i> Enable
                                            </a>
                                            @else
                                            <a href="/plan_status/3/direct" class='btn btn-sm btn-danger action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-times-circle"></i> Disable
                                            </a>
                                            @endif
                                            <a href="/reset_data_price/airtel_gifting" class='btn btn-sm btn-warning action-btn' onclick='return confirm("Reset prices for this plan?")'>
                                                <i class="fas fa-sync"></i> Reset Price
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>9MOBILE</td>
                                    <td>SME</td>
                                    <td>
                                        <span class="status-badge {{ $nmobile_sme->status == 1 ? 'status-active' : 'status-inactive' }}">
                                            {{ $nmobile_sme->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($nmobile_sme->status == 0)
                                            <a href="/plan_status/4/sme" class='btn btn-sm btn-success action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-check-circle"></i> Enable
                                            </a>
                                            @else
                                            <a href="/plan_status/4/sme" class='btn btn-sm btn-danger action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-times-circle"></i> Disable
                                            </a>
                                            @endif
                                            <a href="/reset_data_price/9mobile_sme" class='btn btn-sm btn-warning action-btn' onclick='return confirm("Reset prices for this plan?")'>
                                                <i class="fas fa-sync"></i> Reset Price
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>9MOBILE</td>
                                    <td>direct</td>
                                    <td>
                                        <span class="status-badge {{ $nmobile_gifting->status == 1 ? 'status-active' : 'status-inactive' }}">
                                            {{ $nmobile_gifting->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($nmobile_gifting->status == 0)
                                            <a href="/plan_status/4/direct" class='btn btn-sm btn-success action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-check-circle"></i> Enable
                                            </a>
                                            @else
                                            <a href="/plan_status/4/direct" class='btn btn-sm btn-danger action-btn' onclick='return confirm("Change the status of this plan?")'>
                                                <i class="fas fa-times-circle"></i> Disable
                                            </a>
                                            @endif
                                            <a href="/reset_data_price/9mobile_gifting" class='btn btn-sm btn-warning action-btn' onclick='return confirm("Reset prices for this plan?")'>
                                                <i class="fas fa-sync"></i> Reset Price
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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

        @if (session('message'))
        Swal.fire('Success!',"{{ session('message') }}",'success');
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

    $('body').on('click', '.update_data', function() {

                    id = $(this).data('id');
                  
                    var fd = new FormData;
            fd.append('plan_id', id);
          
            fd.append('actual_price', $("#actual_price_"+id).val());
            fd.append('data_price', $("#data_price_"+id).val());
            fd.append('account_price', $("#account_price_"+id).val());
            fd.append('plan_name', $("#plan_name_"+id).val());
            console.log(fd)
            $.ajax({
                type: 'POST',
                url: "{{route('update_data')}}",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: function($data) {
                    console.log('the data', $data)
                    Swal.close()
                    Toast.fire({
                          icon: 'success',
                          title: 'Data price updated successfully!'
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