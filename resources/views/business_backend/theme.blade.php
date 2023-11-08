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
                        <h5>Available Themes</h5>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-6">
                    <form class="mt-4 mt-sm-0 float-sm-end d-sm-flex align-items-center">
                        <div class="search-box me-2">
                            <div class="position-relative">
                                <input type="text" class="form-control border-0" placeholder="Search...">
                                <i class="bx bx-search-alt search-icon"></i>
                            </div>
                        </div>
                        <ul class="nav nav-pills product-view-nav justify-content-end mt-3 mt-sm-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="#"><i class="bx bx-grid-alt"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="bx bx-list-ul"></i></a>
                            </li>
                        </ul>
                        
                        
                    </form>
                </div>
            </div>
            <div class="row">
                @foreach($themes as $theme)
                <div class="col-xl-4 col-sm-6">
                    <div class="card" @if($user->selected_theme == $theme->id) style='background:#d4edda;border:2px dotted #155724' @endif>
                        <div class="card-body">
                            <div class="product-img position-relative">
                                <div class="avatar-sm product-ribbon">
                                    <span class="avatar-title rounded-circle  bg-primary">
                                        {{ $theme->rank }}
                                    </span>
                                </div>
                                <img src="assets/images/product/img-1.png" alt="" class="img-fluid mx-auto d-block">
                            </div>
                            <div class="mt-4 text-center">
                                <h5 class="mb-3 text-truncate"><a href="javascript: void(0);" class="text-dark">{{ $theme->name }} </a></h5>
                                
                                <div class="px-4 py-3 border-top">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item me-3">
                                            <a data-id='{{ $theme->id }}' class="select_theme btn btn-success">Select</a>
                                        </li>
                                        <li class="list-inline-item me-3">
                                            <a href='/theme_preview/{{ $theme->uuid }}' class="btn btn-primary">Preview</a>
                                        </li>
                                        <li class="list-inline-item me-3">
                                            <a href='/customize_theme/{{ $theme->uuid }}' class="btn btn-warning">Customize</a>
                                        </li>
                                        
                                        
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-12 m-0 text-center">
                  <a href='#' class='btn btn-primary'>Build Your Own Theme -></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->



<!-- end row -->
</div>
@section('script')
<script>
    $(document).ready(function() {
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
                $(".select_theme").on("click", function() {
      
                var id = $(this).data('id')
                console.log(id)
                            Swal.fire({
                        title: 'Use this as your default theme?',
                        // text: 'You won\'t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#155724',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Proceed!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // User confirmed, perform AJAX request
                            var fd = new FormData;
            fd.append('id', id);
                            $.ajax({
                type: 'POST',
                url: "{{ route('select_theme') }}",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: function($data) {
                    console.log('the data', $data)
                    Swal.close()
                    Toast.fire({
                        icon: 'success',
                        title: 'Theme selected'
                        }) 
                
                window.location.reload()

                },
                error: function(data) {
                    console.log(data)
                    Swal.close()
                    Swal.fire('Opps!', 'Unable to update theme, contact the administrator', 'error')
                }
            })
                        }
        });
                })

             


    })
</script>

@endsection
@endsection