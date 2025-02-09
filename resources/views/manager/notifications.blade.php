@extends('manager.master')
@section('header')
@endsection
@section('content')


<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Container-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">


        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Manage Notifications</h4>
                </div>





            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-4">
                <div class="card overflow-hidden">
                    <div class="bg-secondary bg-soft">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-primary p-3">
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <h5 style="color:#640f11">Notification Type</h5>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">


                            <div class="col-sm-12">
                                <div class="pt-4 m-4">

                                    <div class="row">
                                        <select class='form-control form-select' id='type' name='type'>
                                            <option>--Select Notification Type</option>
                                            @foreach($notifications as $not)
                                            <option data-title='{{ $not->title }}' data-description='{{ $not->description }}' value='{{ $not->id }}'>{{ $not->type }}</option>

                                            @endforeach
                                        </select>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

            <div class="col-xl-8">

                <!-- end row -->

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Notification</h4>
                        <div id='show_notify' style='display:none'>
                            <form method='post' action='{{ route("update_notification") }}' enctype='multipart/form-data'>@csrf

                                <div class="mb-3">
                                    <label for="heading" class="form-label">Title</label>
                                    <input type="text" id='title' class="form-control" name="title" value="" placeholder="Input notification title">
                                    <input type='hidden' id='notf_id' name='notf_id' />
                                </div>
                                <div class="mb-3">
                                    <label for="heading" class="form-label">Description <span class='text-danger'>(Optional)</span></label>
                                    <textarea class="form-control" name="description" id='description' placeholder="Input notification description"></textarea>
                                </div>




                                <div class='text-right'>
                                    <button type="submit" name='submit_type' value='save' class="btn btn-primary w-md ">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <div style='font-size:17px; font-weight:300; border-top:10px solid #856404;border:1px dashed black' class='alert alert-dark'>
                    <h3>Lucky Tuesday Giveaway Guides</h3>
                    <ul>
                        <li>Create the giveaway <a href='https://vtubiz.com/my-giveaway'>here</a></li>
                        <li>Go to notification and select the homepage notification</li>
                        <li>Copy the giveaway notification format below and paste in the description field.</li>
                        <li>Replace the new givaway with the existing one inside the a tag.</li>
                    </ul>
                </div>

                <div style='font-size:17px; font-weight:300; border-top:10px solid #856404; border:1px dashed black' class='alert alert-dark'>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="m-0">Giveaway Template</h4>
                        <button class="btn btn-sm btn-primary" onclick="copyTemplate()">
                            <i class="fas fa-copy"></i> Copy HTML
                        </button>
                    </div>
                    <pre style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 0;"><code id="template-content" style="color: #333; white-space: pre-wrap;">&lt;h2&gt;Lucky Tuesday Giveaway!&lt;/h2&gt;
&lt;p&gt;Get Lucky Today, Get 1GB of data for N10 on all networks. &lt;a href=&quot;https://vtubiz.com/Lucky-Tuesday-Giveaway-jBpXw&quot;&gt;Click here to participate.&lt;/a&gt;&lt;/p&gt;</code></pre>
                </div>



            </div>



        </div>


    </div>
    <!-- end row -->


    <!-- end row -->
</div>
</div>
@section('script')
<script>
    $(document).ready(function() {
        $("#type").on('change', function() {
            $("#show_notify").show()
            $("#title").val($("#type").find(':selected').data('title'))
            $("#description").val($("#type").find(':selected').data('description'))
            $("#notf_id").val($("#type").find(':selected').val())
        })
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

        @if(session('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session("success") }}'
        })

        @endif
    })
</script>

<script>
    function copyTemplate() {
        const content = document.getElementById('template-content').innerText;
        navigator.clipboard.writeText(content).then(() => {
            // Show toast notification
            Toast.fire({
                icon: 'success',
                title: 'Template copied to clipboard!'
            });
        }).catch(err => {
            console.error('Failed to copy: ', err);
        });
    }
</script>

@endsection

@endsection