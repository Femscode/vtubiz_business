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
            <div class="col-xl-12">

                <!--begin::Misc Widget 1-->

                <div style='font-size:17px; font-weight:300; border-top:10px solid #856404;border:1px dashed black' @if($user->total_spent < 10000) class='alert alert-warning' @else class='alert alert-dark' @endif>
                        <h4>Starter</h4>
                        <p>Requirement : Registration</p>
                        <ul>
                            <li>Free access to all data plans.</li>
                        </ul>
                </div>
                <div style='font-size:17px; font-weight:300; border-top:10px solid #856404;border:1px dashed black'
                    @if($user->total_spent >= 10000 && $user->total_spent < 50000)
                        class='alert alert-warning'
                        @else
                        class='alert alert-dark'
                        @endif>
                        <h4>Enthusiast</h4>
                        <p>Requirement : Perform transactions worth N10,000 and above</p>
                        <ul>
                            <li>Free access to all data plans</li>
                            <li>Schedule Purchase</li>
                            <li>Bulk Purchase</li>
                        </ul>
                </div>
                <div style='font-size:17px; font-weight:300; border-top:10px solid #856404;border:1px dashed black'
                    @if($user->total_spent >= 50000 && $user->total_spent < 200000)
                        class='alert alert-warning'
                        @else
                        class='alert alert-dark'
                        @endif>
                        <h4>Loyal</h4>
                        <p>Requirement : Perform transactions worth N50,000 and above</p>
                        <ul>
                            <li>Free access to all data plans</li>
                            <li>Schedule Purchase</li>
                            <li>Bulk Purchase</li>
                            <li>Ability to create giveaways</li>
                            <li>Free data worth 50MB weekly</li>
                        </ul>
                </div>

                <div style='font-size:17px; font-weight:300; border-top:10px solid #856404;border:1px dashed black'
                    @if($user->total_spent >= 200000 && $user->total_spent < 1000000)
                        class='alert alert-warning'
                        @else
                        class='alert alert-dark'
                        @endif>
                        <h4>Pro</h4>
                        <p>Requirement : Perform transactions worth N200,000 and above</p>
                        <ul>
                            <li>Free access to all data plans</li>
                            <li>Schedule Purchase</li>
                            <li>Bulk Purchase</li>
                            <li>Ability to create and partake in giveaways</li>
                            <li>Free data worth 100MB weekly</li>
                            <li>Get all products at a reseller price</li>
                        </ul>
                </div>
                <div style='font-size:17px; font-weight:300; border-top:10px solid #856404;border:1px dashed black'
                    @if($user->total_spent >= 1000000 && $user->total_spent < 5000000)
                        class='alert alert-warning'
                        @else
                        class='alert alert-dark'
                        @endif>
                        <h4>Elite</h4>
                        <p>Requirement : Perform transactions worth N500,000 and above</p>
                        <ul>
                            <li>Free access to all data plans</li>
                            <li>Schedule Purchase</li>
                            <li>Bulk Purchase</li>
                            <li>Ability to create and partake in giveaways</li>
                            <li>Free data worth 200MB weekly</li>
                            <li>Get all products at a reseller price</li>
                            <li>A free VTU Website</li>
                        </ul>
                </div>

                <div style='font-size:17px; font-weight:300; border-top:10px solid #d4af37;border:1px dashed black'
                    @if($user->total_spent >= 5000000)
                    class='alert alert-warning'
                    @else
                    class='alert alert-dark'
                    @endif>
                    <h4>Legend</h4>
                    <p>Requirement : Perform transactions worth N1,000,000 and above</p>
                    <ul>
                        <li>Free access to all data plans</li>
                        <li>Schedule Purchase</li>
                        <li>Bulk Purchase</li>
                        <li>Ability to create and partake in giveaways</li>
                        <li>Free data worth 500MB weekly</li>
                        <li>Get all products at a reseller price</li>
                        <li>A free VTU Website</li>
                        <li>Exclusive customer support</li>
                        <li>Priority access to new features and services</li>
                    </ul>
                </div>








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
            title: 'What does a business account entails?',
            html: `
        <ul>
            <li>A free website.</li>
            <li>Discount in all data plan prices.</li>
            <li>Customizing your own data prices..</li>
            <li>Email marketing.</li>
        </ul>
        <p style='color:red'>Please note: Upgrading to a business account incurs a charge of NGN3,500.</p>
    `,
            icon: 'info',
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