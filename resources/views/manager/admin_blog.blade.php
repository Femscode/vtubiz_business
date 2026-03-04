@extends('manager.master')

@section('header')
<style>
    .page-header h1 { font-family: 'Fraunces', serif; font-size: 2.2rem; color: var(--primary-dark); margin-bottom: 8px; }
    .blog-card { background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-card); border: none; overflow: hidden; }
    .blog-img { width: 80px; height: 80px; border-radius: var(--radius-md); object-fit: cover; }
    .status-badge { padding: 5px 12px; border-radius: var(--radius-pill); font-size: 0.75rem; font-weight: 700; }
    .status-active { background: rgba(40, 167, 69, 0.1); color: #28a745; }
    .status-inactive { background: rgba(108, 117, 125, 0.1); color: #6c757d; }
    
    .search-container { position: relative; }
    .search-icon { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #adb5bd; }
    .search-input { padding-left: 45px !important; }
    
    .table thead th { background: #F8F9FA; color: var(--primary-dark); font-weight: 700; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px; border: none; padding: 15px 20px; }
    .table tbody td { padding: 20px; vertical-align: middle; border-bottom: 1px solid rgba(0,0,0,0.05); }
</style>
@endsection

@section('content')
<div class="page-header mb-5 d-flex justify-content-between align-items-end">
    <div>
        <h1>Blog Management</h1>
        <p class="text-muted">Create, edit, and manage platform articles and news.</p>
    </div>
    <a href="{{ route('create_blog') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold">
        <i class="fa-solid fa-plus me-2"></i> Create New Blog
    </a>
</div>

<div class="blog-card">
    <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="serif mb-0" style="color: var(--primary-dark)">All Articles</h5>
        <div class="search-container w-25">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" id="searchTable" class="form-control-custom search-input" placeholder="Search blogs...">
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover mb-0 datatable">
            <thead>
                <tr>
                    <th>Article</th>
                    <th>Status</th>
                    <th>Engagement</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <img src="http://vtubiz.com/public/blog_display_image/{{ $blog->image }}" class="blog-img" alt="">
                            <div>
                                <h6 class="mb-1 fw-bold text-dark">{{ $blog->title }}</h6>
                                <p class="small text-muted mb-0">{!! Str::limit(strip_tags($blog->description), 80) !!}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($blog->status == 1)
                            <span class="status-badge status-active">Active</span>
                        @else
                            <span class="status-badge status-inactive">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="/viewmore/{{ $blog->uid }}" class="btn btn-sm btn-light rounded-pill px-3">
                            <i class="fa-solid fa-eye me-1"></i> Preview
                        </a>
                    </td>
                    <td class="text-end">
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm rounded-circle" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                <li><a class="dropdown-item py-2" href="/editblog/{{ $blog->id }}"><i class="fa-solid fa-pen-to-square me-2 text-primary"></i> Edit</a></li>
                                <li><a class="dropdown-item py-2" onclick="return confirm('Change status?')" href="/changeblogstatus/{{ $blog->id }}"><i class="fa-solid fa-rotate me-2 text-warning"></i> Toggle Status</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item py-2 text-danger" onclick="return confirm('Delete this blog?')" href="/deleteblog/{{ $blog->id }}"><i class="fa-solid fa-trash me-2"></i> Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        const oTable = $('.datatable').DataTable({
            dom: 'lrtip',
            ordering: false,
            pageLength: 10,
            language: {
                paginate: {
                    previous: "<i class='fa-solid fa-chevron-left'></i>",
                    next: "<i class='fa-solid fa-chevron-right'></i>"
                }
            }
        });

        $('#searchTable').on('keyup', function() {
            oTable.search(this.value).draw();
        });

        @if(session('message'))
            Swal.fire({ icon: 'success', title: 'Success!', text: '{{ session("message") }}', confirmButtonColor: '#0F3548' });
        @endif
    });
</script>
@endsection