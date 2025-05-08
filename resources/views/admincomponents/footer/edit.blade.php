@extends('adminlayout.adminmaster')


@section('title', 'Edit Footer ' . ucfirst(str_replace('_', ' ', $type)))

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@if($type == 'about_info' || $type == 'contact')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endif
@endsection

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Footer {{ ucfirst(str_replace('_', ' ', $type)) }}</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Footer Content</h6>
            <a href="{{ url('admin/footer') }}" class="btn btn-sm btn-primary">
    <i class="fas fa-arrow-left"></i> Back to Footer Management
</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ url('admin/footer/update/' . $type) }}" method="POST" enctype="multipart/form-data">                @csrf
                @method('PUT')
                
                @if($type == 'about_info')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $data->title ?? '') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="content">About Content</label>
                        <textarea class="form-control summernote @error('content') is-invalid @enderror" id="content" name="content">{{ old('content', $data->content ?? '') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('logo') is-invalid @enderror" id="logo" name="logo">
                                <label class="custom-file-label" for="logo">Choose file</label>
                            </div>
                        </div>
                        @error('logo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        
                        @if(!empty($data->logo))
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $data->logo) }}" alt="Current Logo" class="img-thumbnail" style="max-height: 100px;">
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" id="remove_logo" name="remove_logo" value="1">
                                    <label class="form-check-label" for="remove_logo">Remove existing logo</label>
                                </div>
                            </div>
                        @endif
                    </div>
                @elseif($type == 'contact')
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control summernote @error('address') is-invalid @enderror" id="address" name="address">{{ old('address', $data->address ?? '') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $data->email ?? '') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $data->phone ?? '') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="working_hours">Working Hours</label>
                        <input type="text" class="form-control @error('working_hours') is-invalid @enderror" id="working_hours" name="working_hours" value="{{ old('working_hours', $data->working_hours ?? '') }}">
                        @error('working_hours')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
             
                @elseif($type == 'quick_links')
                    <div class="alert alert-info">
                        Add up to 6 quick links that will appear in the footer.
                    </div>
                    
                    @for($i = 0; $i < 6; $i++)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="link_title_{{ $i }}">Link {{ $i+1 }} Title</label>
                                    <input type="text" class="form-control @error('links.'.$i.'.title') is-invalid @enderror" 
                                        id="link_title_{{ $i }}" name="links[{{ $i }}][title]" 
                                        value="{{ old('links.'.$i.'.title', isset($data->links[$i]) ? $data->links[$i]['title'] : '') }}">
                                    @error('links.'.$i.'.title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="link_url_{{ $i }}">Link {{ $i+1 }} URL</label>
                                    <input type="text" class="form-control @error('links.'.$i.'.url') is-invalid @enderror" 
                                        id="link_url_{{ $i }}" name="links[{{ $i }}][url]" 
                                        value="{{ old('links.'.$i.'.url', isset($data->links[$i]) ? $data->links[$i]['url'] : '') }}">
                                    @error('links.'.$i.'.url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endfor
                @elseif($type == 'newsletter')
                    <div class="form-group">
                        <label for="newsletter_title">Newsletter Title</label>
                        <input type="text" class="form-control @error('newsletter_title') is-invalid @enderror" id="newsletter_title" name="newsletter_title" value="{{ old('newsletter_title', $data->title ?? '') }}">
                        @error('newsletter_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="newsletter_description">Newsletter Description</label>
                        <textarea class="form-control @error('newsletter_description') is-invalid @enderror" id="newsletter_description" name="newsletter_description" rows="3">{{ old('newsletter_description', $data->description ?? '') }}</textarea>
                        @error('newsletter_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="button_text">Button Text</label>
                        <input type="text" class="form-control @error('button_text') is-invalid @enderror" id="button_text" name="button_text" value="{{ old('button_text', $data->button_text ?? 'Subscribe') }}">
                        @error('button_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @elseif($type == 'copyright')
                    <div class="form-group">
                        <label for="copyright_text">Copyright Text</label>
                        <textarea class="form-control @error('copyright_text') is-invalid @enderror" id="copyright_text" name="copyright_text" rows="2">{{ old('copyright_text', $data->text ?? '') }}</textarea>
                        <small class="form-text text-muted">Use [year] to display the current year dynamically.</small>
                        @error('copyright_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
                
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="1" {{ old('status', $data->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $data->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@if($type == 'about_info' || $type == 'contact')
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        
        // Update file input label when a file is selected
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@endif
@endsection