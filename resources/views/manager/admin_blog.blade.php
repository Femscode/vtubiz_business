@extends('manager.master')

@section('header')
@endsection

@section('content')
<div class="row mt-4">

    <!-- Left side columns -->
    <div class="col-lg-12">
        <div class="row">

         


            <!-- Recent Sales -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">

              

                    <div class="card-body">
                        <h5 class="card-title">All Blogs</h5>
                        <a class='btn btn-success' href='/create_blog'>Create Blog</a>

                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>

                                    <th scope="col">Image</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blogs as $blog)
                                <tr>

                                    <td>
                                        <img src='http://vtubiz.com/public/blog_display_image/{{ $blog->image }}' height='100px' width='100px' />
                                    </td>
                                    <td><b>{{ $blog->title }} (@if($blog->status == 1)<a class=' text-success'>Active</a>@else<a class='text-secondary'>Not active</a> @endif)</b><br>{!! Str::limit($blog->description,200) !!}<br><a href='/viewmore/{{ $blog->uid }}'>View more</a></td>
                                    <td>
                                        <a href='/editblog/{{ $blog->id }}' class="btn btn-primary">Edit</a>
                                        <a onclick='return confirm("Are you sure you want to change the status of this blog?")' href='/changeblogstatus/{{ $blog->id }}' class="btn btn-warning">Change Status</a>
                                        <a onclick='return confirm("Are you sure you want to delete this blog?")' href='/deleteblog/{{ $blog->id }}' class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End Recent Sales -->

        </div>
    </div><!-- End Left side columns -->

 

</div>
@endsection

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

        @if (session('message'))
        Swal.fire('Success!',"{{ session('message') }}",'success');
    @endif
        
    })

</script>
@endsection