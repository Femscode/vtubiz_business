@extends('dashboard.master1')
@section('header')
@endsection

<!--begin::Content wrapper-->
@section('content')
<div class="d-flex flex-column flex-column-fluid">


    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <!--begin::Row-->
        <div class="row g-5 g-xl-8">
            <!--begin::Col-->
            <div class="col-xl-4">

                <!--begin::Misc Widget 1-->
                <div class="row mb-5 mb-xl-8 g-5 g-xl-8">

                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Card-->
                        <div class="card card-stretch custom-box shadow-lg">
                            <!--begin::Link-->
                            <a href="/transfer" style='border-top:5px solid #640f11;'
                                class="btn btn-flex btn-text-gray-800 btn-icon-gray-400 btn-active-color-primary bg-body flex-column justfiy-content-start align-items-start text-start w-100 p-10">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Shopping/Credit-card.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <rect fill="#000000" opacity="0.3" x="2" y="5" width="20" height="14"
                                                rx="2" />
                                            <rect fill="#000000" x="2" y="8" width="20" height="3" />
                                            <rect fill="#000000" opacity="0.3" x="16" y="14" width="4" height="2"
                                                rx="1" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-4 fw-normal">
                                    Make Transfer </span>
                            </a>
                            <!--end::Link-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Card-->
                        <div class="card card-stretch custom-box shadow-lg">
                            <!--begin::Link-->
                            <a href="/transactions"  style='border-left:5px solid #ebab21 ';
                                class="btn btn-flex btn-text-gray-800 btn-icon-gray-400 btn-active-color-primary bg-body flex-column justfiy-content-start align-items-start text-start w-100 p-10">
                                <!--begin::Svg Icon | path: icons/duotune/technology/teh008.svg-->
                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Communication/Clipboard-list.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                        <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                        <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                        <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                        <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                        <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                        <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
                                <!--end::Svg Icon-->
                                <span class="fs-4 fw-normal">
                                    My Transactions </span>
                            </a>
                            <!--end::Link-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <div class="col-6">
                        <!--begin::Card-->
                        <div class="card card-stretch custom-box shadow-lg">
                            <!--begin::Link-->
                            <a href="/data"  style='border-left:5px solid #FF4500 ';
                                class="btn btn-flex btn-text-gray-800 btn-icon-gray-400 btn-active-color-primary bg-body flex-column justfiy-content-start align-items-start text-start w-100 p-10">
                                <!--begin::Svg Icon | path: icons/duotune/technology/teh008.svg-->
                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Devices/LTE2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M16.4508979,17.4029496 L15.1784978,15.8599014 C16.324501,14.9149052 17,13.5137472 17,12 C17,10.4912085 16.3289582,9.09418404 15.1893841,8.14910121 L16.466112,6.60963188 C18.0590936,7.93073905 19,9.88958759 19,12 C19,14.1173586 18.0528606,16.0819686 16.4508979,17.4029496 Z M19.0211112,20.4681628 L17.7438102,18.929169 C19.7927036,17.2286725 21,14.7140097 21,12 C21,9.28974232 19.7960666,6.77820732 17.7520315,5.07766256 L19.031149,3.54017812 C21.5271817,5.61676443 23,8.68922234 23,12 C23,15.3153667 21.523074,18.3916375 19.0211112,20.4681628 Z M7.54910207,17.4029496 C5.94713944,16.0819686 5,14.1173586 5,12 C5,9.88958759 5.94090645,7.93073905 7.53388797,6.60963188 L8.81061588,8.14910121 C7.67104182,9.09418404 7,10.4912085 7,12 C7,13.5137472 7.67549895,14.9149052 8.82150222,15.8599014 L7.54910207,17.4029496 Z M4.9788888,20.4681628 C2.47692603,18.3916375 1,15.3153667 1,12 C1,8.68922234 2.47281829,5.61676443 4.96885102,3.54017812 L6.24796852,5.07766256 C4.20393339,6.77820732 3,9.28974232 3,12 C3,14.7140097 4.20729644,17.2286725 6.25618985,18.929169 L4.9788888,20.4681628 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M11,14.2919782 C10.1170476,13.9061998 9.5,13.0251595 9.5,12 C9.5,10.6192881 10.6192881,9.5 12,9.5 C13.3807119,9.5 14.5,10.6192881 14.5,12 C14.5,13.0251595 13.8829524,13.9061998 13,14.2919782 L13,20 C13,20.5522847 12.5522847,21 12,21 C11.4477153,21 11,20.5522847 11,20 L11,14.2919782 Z" fill="#000000"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
                                <!--end::Svg Icon-->
                                <span class="fs-4 fw-normal">
                                    Buy Data </span>
                            </a>
                            <!--end::Link-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <div class="col-6">
                        <!--begin::Card-->
                        <div class="card card-stretch custom-box shadow-lg">
                            <!--begin::Link-->
                            <a href="/airtime"  style='border-bottom:5px solid brown'
                                class="btn btn-flex btn-text-gray-800 btn-icon-gray-400 btn-active-color-primary bg-body flex-column justfiy-content-start align-items-start text-start w-100 p-10">
                                <!--begin::Svg Icon | path: icons/duotune/technology/teh008.svg-->
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Communication/Active-call.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M13.0799676,14.7839934 L15.2839934,12.5799676 C15.8927139,11.9712471 16.0436229,11.0413042 15.6586342,10.2713269 L15.5337539,10.0215663 C15.1487653,9.25158901 15.2996742,8.3216461 15.9083948,7.71292558 L18.6411989,4.98012149 C18.836461,4.78485934 19.1530435,4.78485934 19.3483056,4.98012149 C19.3863063,5.01812215 19.4179321,5.06200062 19.4419658,5.11006808 L20.5459415,7.31801948 C21.3904962,9.0071287 21.0594452,11.0471565 19.7240871,12.3825146 L13.7252616,18.3813401 C12.2717221,19.8348796 10.1217008,20.3424308 8.17157288,19.6923882 L5.75709327,18.8875616 C5.49512161,18.8002377 5.35354162,18.5170777 5.4408655,18.2551061 C5.46541191,18.1814669 5.50676633,18.114554 5.56165376,18.0596666 L8.21292558,15.4083948 C8.8216461,14.7996742 9.75158901,14.6487653 10.5215663,15.0337539 L10.7713269,15.1586342 C11.5413042,15.5436229 12.4712471,15.3927139 13.0799676,14.7839934 Z"
                                                fill="#000000" />
                                            <path
                                                d="M14.1480759,6.00715131 L13.9566988,7.99797396 C12.4781389,7.8558405 11.0097207,8.36895892 9.93933983,9.43933983 C8.8724631,10.5062166 8.35911588,11.9685602 8.49664195,13.4426352 L6.50528978,13.6284215 C6.31304559,11.5678496 7.03283934,9.51741319 8.52512627,8.02512627 C10.0223249,6.52792766 12.0812426,5.80846733 14.1480759,6.00715131 Z M14.4980938,2.02230302 L14.313049,4.01372424 C11.6618299,3.76737046 9.03000738,4.69181803 7.1109127,6.6109127 C5.19447112,8.52735429 4.26985715,11.1545872 4.51274152,13.802405 L2.52110319,13.985098 C2.22450978,10.7517681 3.35562581,7.53777247 5.69669914,5.19669914 C8.04101739,2.85238089 11.2606138,1.72147333 14.4980938,2.02230302 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-4 fw-normal">
                                    Buy Airtime </span>
                            </a>
                            <!--end::Link-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <div class="col-6">
                        <!--begin::Card-->
                        <div class="card card-stretch custom-box shadow-lg">
                            <!--begin::Link-->
                            <a href="/cable"  style='border-bottom:5px solid #8A2BE2 '
                                class="btn btn-flex btn-text-gray-800 btn-icon-gray-400 btn-active-color-primary bg-body flex-column justfiy-content-start align-items-start text-start w-100 p-10">
                                <!--begin::Svg Icon | path: icons/duotune/technology/teh008.svg-->
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Devices/TV2.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M3,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,17 C22,17.5522847 21.5522847,18 21,18 L3,18 C2.44771525,18 2,17.5522847 2,17 L2,6 C2,5.44771525 2.44771525,5 3,5 Z M9.632,10.066 L11.032,10.066 L11.032,9.044 L7.035,9.044 L7.035,10.066 L8.435,10.066 L8.435,14 L9.632,14 L9.632,10.066 Z M14.935,14 L16.846,9.044 L15.523,9.044 L14.382,12.558 L14.354,12.558 L13.206,9.044 L11.862,9.044 L13.738,14 L14.935,14 Z"
                                                fill="#000000" />
                                            <rect fill="#000000" opacity="0.3" x="3" y="19" width="18" height="1"
                                                rx="0.5" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-4 fw-normal">
                                    Tv Subscription </span>
                            </a>
                            <!--end::Link-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <div class="col-6">
                        <!--begin::Card-->
                        <div class="card card-stretch custom-box shadow-lg">
                            <!--begin::Link-->
                            <a href="/electricity"  style='border-top:5px solid #00BFFF'
                                class="btn btn-flex btn-text-gray-800 btn-icon-gray-400 btn-active-color-primary bg-body flex-column justfiy-content-start align-items-start text-start w-100 p-10">
                                <!--begin::Svg Icon | path: icons/duotune/technology/teh008.svg-->
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Electric/Highvoltage.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M2.76702366,20 C2.59202225,20 2.4200849,19.9540749 2.2683913,19.8668136 C1.78966338,19.5914265 1.62482304,18.9800956 1.90021009,18.5013676 L11.1332403,2.45083309 C11.221302,2.29774818 11.3483346,2.17071522 11.5014193,2.08265312 C11.9801465,1.80726488 12.5914779,1.97210369 12.8668662,2.45083092 L22.0999499,18.5013655 C22.187212,18.6530596 22.2331375,18.8249977 22.2331375,19 C22.2331375,19.5522847 21.7854223,20 21.2331375,20 L2.76702366,20 Z M11,18 L15,12 L12.9444444,12 L12.9444444,8 L9,14 L11,14 L11,18 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-4 fw-normal">
                                    Pay Light Bills </span>
                            </a>
                            <!--end::Link-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                  
                    {{-- <div class="col-6">
                        <!--begin::Card-->
                        <div class="card card-stretch custom-box shadow-lg">
                            <!--begin::Link-->
                            <a href="/analysis"  style='border-left:5px solid purple'
                                class="btn btn-flex btn-text-gray-800 btn-icon-gray-400 btn-active-color-primary bg-body flex-column justfiy-content-start align-items-start text-start w-100 p-10">
                                <!--begin::Svg Icon | path: icons/duotune/technology/teh004.svg-->
                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Media/Equalizer.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"/>
                                        <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"/>
                                        <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"/>
                                        <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
                                <!--end::Svg Icon-->
                                <span class="fs-4 fw-normal">
                                    My Order Analysis </span>
                            </a>
                            <!--end::Link-->
                        </div>
                        <!--end::Card-->
                    </div> --}}
              
                    <!--end::Col-->
                    <div class="col-6">
                        <!--begin::Card-->
                        <div class="card card-stretch custom-box shadow-lg">
                            <!--begin::Link-->
                            <a href="/examination"  style='border-top:5px solid #2E8B57'
                                class="btn btn-flex btn-text-gray-800 btn-icon-gray-400 btn-active-color-primary bg-body flex-column justfiy-content-start align-items-start text-start w-100 p-10">
                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs025.svg-->
                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Layout/Layout-horizontal.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <rect fill="#000000" opacity="0.3" x="4" y="5" width="16" height="6" rx="1.5"/>
                                        <rect fill="#000000" x="4" y="13" width="16" height="6" rx="1.5"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
                                <!--end::Svg Icon-->
                                <span class="fs-4 fw-normal">
                                    Exam Result Checker </span>
                            </a>
                            <!--end::Link-->
                        </div>
                        <!--end::Card-->
                    </div>

                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Card-->
                        <div class="card custom-box shadow-lg">
                            <!--begin::Link-->
                            <a href="/bulksms"  style='border-bottom:5px solid #CC99FF  '
                                class="btn btn-flex btn-text-gray-800 btn-icon-gray-400 btn-active-color-primary bg-body flex-column justfiy-content-start align-items-start text-start w-100 p-10">
                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs025.svg-->
                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Shopping/ATM.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <rect fill="#000000" opacity="0.3" x="2" y="4" width="20" height="5" rx="1"/>
                                        <path d="M5,7 L8,7 L8,21 L7,21 C5.8954305,21 5,20.1045695 5,19 L5,7 Z M19,7 L19,19 C19,20.1045695 18.1045695,21 17,21 L11,21 L11,7 L19,7 Z" fill="#000000"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
                                <!--end::Svg Icon-->
                                <span class="fs-4 fw-normal">
                                    Bulk SMS </span>
                               
                            </a>
                            <!--end::Link-->
                        </div>
                        <!--end::Card-->
                    </div>
              
                    {{-- <div class="col-6">
                        <!--begin::Card-->
                        <div class="card card-stretch custom-box shadow-lg">
                            <!--begin::Link-->
                            <a href="/transactions"  style='border-left:5px solid #FF4081     '
                                class="btn btn-flex btn-text-gray-800 btn-icon-gray-400 btn-active-color-primary bg-body flex-column justfiy-content-start align-items-start text-start w-100 p-10">
                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs025.svg-->
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Communication/Clipboard-list.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                                fill="#000000" />
                                            <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2"
                                                rx="1" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2"
                                                rx="1" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2"
                                                rx="1" />
                                            <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2"
                                                rx="1" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2"
                                                rx="1" />
                                            <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2"
                                                rx="1" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-4 fw-normal">
                                    My Transactions </span>
                            </a>
                            <!--end::Link-->
                        </div>
                        <!--end::Card-->
                    </div> --}}
                    <!--end::Col-->

                </div>


            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-8 ps-xl-12">



                <!--begin::Engage widget 1-->
                @if($user->user_type == 'customer')
                <div class="card card-custom bgi-no-repeat gutter-b"
                    style="height: 200px; background-color: #663259; background-position: calc(100% + 0.5rem) 100%; background-size: 100% auto; background-image: url(https://preview.keenthemes.com/metronic/theme/html/demo2/dist/assets/media/svg/patterns/taieri.svg)">
                    <!--begin::Body-->
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <h4 class="text-white line-height-lg mb-5">
                                Upgrade to a business account and get yourself a free VTU website!
                             
                            </h4>
                            <a onclick='return confirmUpgrade()'  href="/upgrade/{{ $user->id }}" class="btn btn-success font-weight-bold px-6 py-3">
                               Upgrade </a>
                            {{-- <a href="/airtime" class="btn btn-info font-weight-bold px-6 py-3">Buy
                                Airtime</a> --}}
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                @endif
                <div class="card card-custom bgi-no-repeat bgi-size-cover gutter-b card-stretch"
                    style="height:200px; margin-top:20px; background-image: url(../theme/html/demo2/dist/assets/media/stock-600x600/img-16.jpg)">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column align-items-start justify-content-start">
                        <div class="p-1 flex-grow-1">
                            <h3 class="text-white font-weight-bolder line-height-lg mb-5">
                                Kindly follow our 
                                <br>social media pages 
                            </h3>
                            <a href='{{ $company->facebook }}' class='btn btn-sm btn-primary'>Facebook</a>
                            <a href='{{ $company->twitter }}' class='btn btn-sm btn-info'>Twitter</a>
                            <a href='{{ $company->instagram }}' class='btn btn-sm btn-warning'>Instagram</a>
                            {{-- <a href='btn btn-sm'>Facebook</a> --}}
                          
                               
                        </div>

                        <span class="svg-icon svg-icon-lg svg-icon-warning">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                    <rect fill="#000000" opacity="0.3"
                                        transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                        x="11" y="5" width="2" height="14" rx="1"></rect>
                                    <path
                                        d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)">
                                    </path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span></a>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Engage widget 1-->
                <!--begin::Row-->

                <!--end::Row-->


                <!--begin::Tables Widget 5-->

                <!--end::Tables Widget 5-->
                <!--begin::Row-->

            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Content-->
</div>
@endsection
<!--end::Content wrapper-->



@section('script')
<script>
     function confirmUpgrade() {
    Swal.fire({
      title: 'You are about to upgrade your account to a business account?',
    //   text: 'This action cannot be undone!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, upgrade!'
    }).then((result) => {
      if (result.isConfirmed) {
        // User clicked "Yes, upgrade!" button, navigate to the upgrade page
        window.location.href = "/upgrade/{{ $user->id }}";
      }
    });

    // Prevent the default anchor tag behavior (navigation) until confirmation
    return false;
  }
    </script>
@endsection