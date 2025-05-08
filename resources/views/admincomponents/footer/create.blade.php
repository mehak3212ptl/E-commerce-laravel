@extends('adminlayout.adminmaster')


@section('title', 'Add Footer ' . ucfirst(str_replace('_', ' ', $type)))

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@if($type == 'about_info' || $type == 'contact')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endif
@endsection

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Add Footer {{ ucfirst(str_replace('_', ' ', $type)) }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Add {{ ucfirst(str_replace('_', ' ', $type)) }}</h6>
                <a href="{{ url('admin/footer') }}" class="btn btn-secondary btn-sm">
    <i class="fas fa-arrow-left"></i> Back to List
</a>
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('admin/footer/store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="type" value="{{ $type }}">

                @if($type == 'about_info')
                    <!-- About Info Form -->
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Content <span class="text-danger">*</span></label>
                        <textarea class="form-control summernote" id="content" name="content" rows="5">{{ old('content') }}</textarea>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
              
                @elseif($type == 'quick_link')
                    <!-- Quick Link Form -->
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="url">URL <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}" required>
                        <small class="form-text text-muted">Use relative URLs for internal links (e.g., /about, /contact)</small>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                @elseif($type == 'contact')
                    <!-- Contact Form -->
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', 'Contact') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Contact Information <span class="text-danger">*</span></label>
                        <textarea class="form-control summernote" id="content" name="content" rows="5">{{ old('content', '<p><strong>Address:</strong> 123 Street, City, Country</p>
<p><strong>Email:</strong> example@example.com</p>
<p><strong>Phone:</strong> +1 234 567 8900</p>') }}</textarea>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                @elseif($type == 'gallery')
                    <!-- Gallery Form -->
                    <div class="form-group">
                        <label for="image">Image <span class="text-danger">*</span></label>
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                        <small class="form-text text-muted">Recommended size: 300x200 pixels, Maximum size: 2MB</small>
                    </div>
                    <div class="form-group">
                        <label for="alt_text">Alt Text</label>
                        <input type="text" class="form-control" id="alt_text" name="alt_text" value="{{ old('alt_text', 'Gallery Image') }}">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                @endif

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ url('admin/footer') }}" class="btn btn-secondary">Cancel</a>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@if($type == 'about_info' || $type == 'contact')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
@endif

</script>
@endsection