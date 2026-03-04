@extends('manager.master')

@section('header')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .page-header h1 { font-family: 'Fraunces', serif; font-size: 2.2rem; color: var(--primary-dark); margin-bottom: 8px; }
    .config-card { background: white; border-radius: var(--radius-lg); padding: 35px; box-shadow: var(--shadow-card); border: none; }
    .form-label { font-weight: 700; color: var(--primary-dark); margin-bottom: 10px; font-size: 0.9rem; }
    .form-control-custom { 
        width: 100%; padding: 14px 18px; border-radius: var(--radius-md); 
        border: 1px solid rgba(0,0,0,0.08); background: #F9F9F9; transition: all 0.2s; 
    }
    .form-control-custom:focus { outline: none; border-color: var(--primary-dark); background: white; box-shadow: 0 0 0 4px rgba(15, 53, 72, 0.05); }
    
    #editor-container { border-radius: var(--radius-md); border: 1px solid rgba(0,0,0,0.08); overflow: hidden; margin-top: 10px; }
    #editor { height: 400px; font-family: 'Inter', sans-serif; font-size: 1rem; }
    .ql-toolbar { border: none !important; background: #F8F9FA; border-bottom: 1px solid rgba(0,0,0,0.08) !important; }
    .ql-container { border: none !important; }
</style>
@endsection

@section('content')
<div class="page-header mb-5">
    <h1>Create New Article</h1>
    <p class="text-muted">Draft a new post for your platform's blog and news section.</p>
</div>

<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="config-card">
            @if($errors->any())
                <div class="alert alert-danger rounded-4 p-4 mb-4 border-0">
                    <h6 class="fw-bold mb-2">Please correct the following:</h6>
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="form" method="post" action="{{ route('saveblog') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <label class="form-label">Article Title</label>
                            <input required name="title" class="form-control-custom" type="text" placeholder="e.g. 5 Ways to Save on Data in 2024">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Content</label>
                            <input id="description" name="description" type="hidden">
                            <div id="editor-container">
                                <div id="editor"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-4">
                            <label class="form-label">Category</label>
                            <input required type="text" name="category" class="form-control-custom" placeholder="e.g. Tips & Tricks">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Featured Image</label>
                            <div class="bg-light p-4 rounded-4 text-center border-dashed">
                                <i class="fa-solid fa-cloud-arrow-up fs-2 text-muted mb-3"></i>
                                <input required type="file" class="form-control form-control-sm" name="image" accept="image/*">
                                <p class="small text-muted mt-2 mb-0">Recommended size: 1200x800px</p>
                            </div>
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold mb-3">Publish Article</button>
                            <button type="reset" class="btn btn-light w-100 rounded-pill py-3 fw-bold">Reset Form</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    $(document).ready(function() {
        const quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Start writing your amazing story...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'image'],
                    ['clean']
                ]
            }
        });

        // Update hidden input on change
        quill.on('text-change', function() {
            $('#description').val(quill.root.innerHTML);
        });

        @if(session('message'))
            Swal.fire({ icon: 'success', title: 'Success!', text: '{{ session("message") }}', confirmButtonColor: '#0F3548' });
        @endif
    });
</script>
@endsection