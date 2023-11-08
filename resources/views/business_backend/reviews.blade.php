@extends('newdashboard.master')
@section('header')
@endsection
@section('content')


<div class='col-md-12'>

        <div class="row g-5 g-xl-10 mb-xl-10 mt-2 p-2">
            <!--begin::Col-->
            <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
                <!--begin::Chart widget 3-->
                <div class="card card-flush overflow-hidden h-md-100">
                    <!--begin::Header-->
                    <div class="card-header py-5">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder text-dark">{{ $user->name }}</span>
                        </h3>
                     
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
                        <!--begin::Statistics-->
                        <div class="px-9 mb-5">
                            <!--begin::Statistics-->
                            <div class="mb-2 p-4">
                                <h4 class="fs-6 fw-bold text-gray-400">Total Reviews</h4>
                                <h4
                                    class="fs-2hx fw-bolder text-gray-800 me-2 lh-1 ls-n2">{{number_format(count($reviews))
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


        <div class="row gy-5 g-xl-10 p-2">
            <!--begin::Col-->
          
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-12 mb-5 mb-xl-10">
                <!--begin::Table Widget 4-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Card header-->
                    <div class="card-header pt-7">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder text-gray-800">All Reviews</span>
                            
                        </h3>
                        <!--end::Title-->
                        <!--begin::Actions-->
                    
                        <!--end::Actions-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-2">
                        <!--begin::Table-->
                        <div id="kt_table_widget_4_table_wrapper"
                            class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive">
                                <table id='datatable'
                                    class="table align-middle table-row-dashed fs-6 gy-3 dataTable no-footer"
                                    >
                                    <!--begin::Table head-->
                                    <thead>
                                        <!--begin::Table row-->
                                        <tr
                                            class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                           
                                            <th class="min-w-100px sorting_disabled"
                                                rowspan="1" colspan="1" style="width: 500px;">Review</th>
                                           
                                            <th class=" min-w-50px sorting_disabled"
                                                rowspan="1" colspan="1" style="width: 50px;">Action
                                            </th>
                                           
                                           
                                        </tr>
                                        <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bolder text-gray-600">





                                        @foreach($reviews as $key=> $review)

                                        <tr>
                                           
                                           
                                            <td class="">{{ $review->complaint }}<br>
                                                <span
                                                class="badge py-3 px-4 fs-7 badge-light-danger">{{ Date('d-m-Y',strtotime($review->created_at)) }}</span>
                                            </td>
                                            <td>
                                                @if($review->phone == null)
                                                <a onclick='return Swal.fire("This user does not include his/her phone number while making the review")' class='btn btn-secondary btn-sm'>Message</a>
                                                @else
                                                <a href='https://wa.me/234{{ substr($review->phone,1) }}?text=Hi,%20from%20{{ $user->name }},we%20received%20your%20complain%20in%20regards...' class='btn btn-success btn-sm'>Message</a>
                                                @endif
                                            </td>
                                        
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                {{ $reviews->links('pagination::bootstrap-4') }}
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
  
<!-- end row -->
</div>
@section('script')
@endsection
@endsection