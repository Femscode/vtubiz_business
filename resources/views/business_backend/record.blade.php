@extends('newdashboard.master')
@section('header')
@endsection
@section('content')


<div class="col-md-12">

    <div class="container-xxl" id="kt_content_container">
        <!--begin::Products-->


        <div class="row g-5 g-xl-10 mb-xl-10 mt-2">
            <!--begin::Col-->
            <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0 ">
                <!--begin::Chart widget 3-->
                <div class="card card-flush overflow-hidden h-md-100 ">
                    <!--begin::Header-->

                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class=" card-body d-flex justify-content-between flex-column pb-1 px-0">
                        <!--begin::Statistics-->
                        <div class="px-9 mb-5 ">
                            <!--begin::Statistics-->
                            <div class="mb-2 p-4">
                                <h4 class="fs-6 fw-bold text-gray-400">Total Sales</h4>
                                <h4 class="fs-2hx fw-bolder text-gray-800 me-2 lh-1 ls-n2">NGN
                                    {{number_format($total_sales,2)
                                    }}</h4>
                            </div>
                            <!--end::Statistics-->
                            <!--begin::Description-->
                            <!--end::Description-->
                        </div>
                      </div>
                    <!--end::Card body-->
                </div>
                <!--end::Chart widget 3-->
            </div>
            <!--end::Col-->
        </div>


        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->

            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-12 mb-5 mb-xl-10">
                <!--begin::Table Widget 4-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Card header-->
                  
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body p-4">
                        <h4>Store Record</h4>
                        <!--begin::Table-->
                        <div id="kt_table_widget_4_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive">
                                <table id='datatable' class="table align-middle table-row-dashed fs-6 gy-3 dataTable no-footer">
                                    <!--begin::Table head-->
                                    <thead>
                                        <!--begin::Table row-->
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1"
                                                style="width: 100px;">Product ID</th>
                                            <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1"
                                                style="width: 100px;">Name</th>
                                            <th class="text-end min-w-125px sorting_disabled" rowspan="1" colspan="1"
                                                style="width: 125px;">Count</th>
                                            <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1"
                                                style="width: 100px;">Unit Price
                                            </th>
                                            <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1"
                                                style="width: 100px;">Sales</th>

                                        </tr>
                                        <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bolder text-gray-600">





                                        @foreach($foods as $key=> $food)

                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-800 text-hover-primary">#PRD-{{ ++$key
                                                    }}</a>
                                            </td>
                                            <td class="text-end">{{ $food[0]['name'] }}</td>
                                            <td class="text-end">
                                                {{ $food[1]}}
                                            </td>
                                            <td class="text-end">{{ number_format($food[0]['price'],2) }}</td>

                                            <td class="text-end">
                                                <span class="text-dark">{{
                                                    number_format($food[0]['price'] * $food[1],2) }}</span>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                            </div>
                            <div class="row">
                                <div
                                    class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                                </div>
                                <div
                                    class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                </div>
                            </div>
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Table Widget 4-->
            </div>

            <!--<div class="col-xl-4 mb-xl-10">-->
            <!--begin::Engage widget 1-->
            <!--    <div class="card h-md-100">-->
            <!--begin::Body-->
            <!--        <div class="card-body d-flex flex-column flex-center">-->
            <!--begin::Heading-->
            <!--            <div class="mb-2">-->
            <!--begin::Title-->
            <!--                <h1 class="fw-bold text-gray-800 text-center lh-lg">Have you tried the-->
            <!--                    <br>-->
            <!--                    <span class="fw-boldest">Premium Plan ?</span>-->
            <!--                </h1>-->
            <!--end::Title-->
            <!--begin::Illustration-->
            <!--                <div class="flex-grow-1 bgi-no-repeat bgi-size-contain bgi-position-x-center card-rounded-bottom h-200px mh-200px my-5 my-lg-12"-->
            <!--                    style="background-image:url('/metronic8/demo4/assets/media/svg/illustrations/easy/2.svg')">-->
            <!--                </div>-->
            <!--end::Illustration-->
            <!--            </div>-->
            <!--end::Heading-->
            <!--begin::Links-->
            <!--            <div class="text-center mb-1">-->
            <!--begin::Link-->
            <!--                <a class="btn btn-sm btn-primary me-2"-->
            <!--                    href="#">Subscribe</a>-->
            <!--end::Link-->
            <!--begin::Link-->

            <!--            </div>-->
            <!--end::Links-->
            <!--        </div>-->
            <!--end::Body-->
            <!--    </div>-->
            <!--end::Engage widget 1-->
            <!--</div>-->
            <!--end::Col-->
        </div>
        <!--end::Products-->
    </div>

</div>
<!-- end row -->



<!-- end row -->
</div>
@section('script')

@endsection
@endsection