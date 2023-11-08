@extends('newdashboard.master')
@section('header')
@endsection
@section('content')


<div class="container-fluid">



    <div class="row">
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                   
                    <!--end::Search-->
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <!--begin::Flatpickr-->
                    <div class='d-flex'>
                    <div class="input-group w-250px">
                        
                        <h4>Today's Orders (<span id='total_order'>{{ count($orders) }}</span>)</h4>
                    </div>
                    </div>
                    <!--end::Flatpickr-->
                  
                    <!--begin::Add product-->
                    <!--<a href="../catalog/add-product.html" class="btn btn-primary">Add Order</a>-->
                    <!--end::Add product-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table id='datatable' class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_sales_table">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                           
                            <th class="">Order ID</th>
                            <th class="">Customer</th>
                            <th class="text-end ">Total</th>
                            <th class="text-end  sorting" aria-controls="kt_ecommerce_sales_table">Date Added</th>
                            <th class="text-end ">Location</th>
                            <th class="text-end ">Action</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600" id='t_body'>
                        <!--begin::Table row-->
                        @foreach($orders as $order)
                        <tr>
                          
                            <td data-kt-ecommerce-order-filter="order_id">
                                <a href="details.html" class="text-gray-800 text-hover-primary fw-bolder">CT-{{$order->order_id}}</a>
                            </td>
                            <td>
                               
                                   
                                      <p class="text-gray-800 text-hover-primary fs-5 fw-bolder">{{$order->name}}</p>
                                 
                            </td>
                          
                            <td class="text-end pe-0">
                                <span class="fw-bolder"># {{number_format($order->total_price,2)}}</span>
                            </td>
                            <td class="text-end" data-order="{{Date('d-m-Y', strtotime($order->created_at))}}">
                                <span class="fw-bolder">{{Date('d/m/Y', strtotime($order->created_at))}}</span>
                            </td>
                            <td class="text-end" data-order="{{Date('d/m/Y', strtotime($order->updated_at))}}">
                                <span class="fw-bolder">{{$order->location}}</span>
                            </td>
                            <td class="text-end">

                                <a href='orderdetails/{{$order->id}}' style='background:#ebab21' class='btn-sm btn btn-warning'>View</a>
                                @if($user->delivery_status == 1) 
                                
                                <a href='/track_order/{{$order->order_id}}' style='background:black' class='btn-sm btn btn-dark'>Process delivery</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>

    </div>
</div>
<!-- end row -->



<!-- end row -->
</div>
@section('script')

@endsection
@endsection