@extends('manager.master')

@section('header')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    #editor-container {
        display: flex;
        flex-direction: column;
        height: 100vh;
    }

    #editor {
        flex: 1;
    }
</style>
@endsection

@section('content')




<div class="flex-row-fluid ml-lg-8">
    <!--begin::Card-->
    <div class="card card-custom">
        <!--begin::Header-->
        <form class="form" method='post' action='{{ route("updateblog") }}' enctype="multipart/form-data">@csrf
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">Edit Blog</h3>
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <p><strong>Opps Something went wrong</strong></p>
                        <ul>
                            @foreach ($errors->all() as $error)    
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                
            </div>
            <!--end::Header-->
            <!--begin::Form-->

            <div class="card-body">
               
                <!--begin::Form Group-->
                <div class="form-group row mb-4">
                    <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                           
                            <div class="">
                                <input type='hidden' value='{{ $blog->id }}' name='id'/>
                                <input value='{{ $blog->title }}' required name='title' placeholder="Enter Client Name" class="form-control form-control-lg form-control-solid"
                                    type="text" />
                            </div>
                        </div>
                    </div>
                </div>
                <!--begin::Form Group-->
                <div class="form-group row mb-4">
                    <label class="col-xl-3 col-lg-3 col-form-label">Description</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                           
                            {{-- <textarea name='description' type="text"
                                class="form-control form-control-lg form-control-solid"
                                placeholder="Enter Client Description" >{{ $blog->description }}</textarea> --}}

                                <input id='description' value='{{ $blog->description }}' name='description' type="hidden"
                                />
  
                              <div id="editor-container">
                                  <div id="editor">{!! $blog->description !!}</div>
                                  
                              </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-xl-3 col-lg-3 col-form-label">Category</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                           
                            <input value='{{ $blog->category}}' required type="text" name='category' class="form-control form-control-lg form-control-solid"
                                placeholder="Enter Client Type" />
                        </div>

                    </div>
                </div>
                <!--begin::Form Group-->
                <div class="form-group row mb-4">
                    <label class="col-xl-3 col-lg-3 col-form-label">Display Image</label>
                    <div class="col-lg-9 col-xl-6">
                        <img src='http://vtubiz.com/public/blog_display_image/{{ $blog->image }}' height='150px' width='150px' />
                  
                        <input type='file' class='form-control' name='image'  accept="image/*" />
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="col-xl-3 col-lg-3 col-form-label"></label>
                    <div class="col-lg-9 col-xl-6">
                        <button type="submit" class="btn btn-primary mr-2">Update Blog</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>

                <!--begin::Form Group-->

                <!--begin::Form Group-->
                {{-- <div class="form-group row mb-4 align-items-center">
                    <label class="col-xl-3 col-lg-3 col-form-label">Communication</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="checkbox-inline">
                            <label class="checkbox">
                                <input required type="checkbox" checked="checked" />
                                <span></span>Email</label>
                            <label class="checkbox">
                                <input required type="checkbox" checked="checked" />
                                <span></span>SMS</label>
                            <label class="checkbox">
                                <input required type="checkbox" />
                                <span></span>Phone</label>
                        </div>
                    </div>
                </div> --}}
                <!--begin::Form Group-->
                <div class="separator separator-dashed my-5"></div>
                
            </div>
        </form>
        <!--end::Form-->
    </div>
    <!--end::Card-->
</div>
@endsection

@section('script')

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    $(document).ready(function() {
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

  $("#editor").on('input', function() {
    var content = quill.root.innerHTML;
    $("#description").val(content)
    console.log(content);
  })
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