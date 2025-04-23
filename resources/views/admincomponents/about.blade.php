@extends('adminlayout.adminmaster')
@section('content')
<div style="margin-left:200px">
<!DOCTYPE html>
<html>
<head>
    <title>Post Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jodit@3.24.5/build/jodit.min.css">
</head>
<body>
<div class="main">
<div class="container mt-5">
<h1 class="mb-4">Banner Image</h1>

{{-- Show Success Message --}}
@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

{{-- Add / Edit Form --}}
@if(isset($edit) && $edit === true)
    <h3>Edit Post</h3>
    <form method="POST" action="/about/{{ $post->id }}/update" enctype="multipart/form-data">
@else
    <h3>Add New Post</h3>
    <form method="POST" action="/about" enctype="multipart/form-data">
@endif

    @csrf
    <input type="text" name="title" placeholder="Title" value="{{ old('title', $post->title ?? '') }}"><br><br>

    <textarea name="description" id="editor">{{ old('description', $post->description ?? '') }}</textarea><br><br>

    <input type="file" name="image"><br>
    @if(isset($post) && $post->image)
        <img src="{{ asset('storage/' . $post->image) }}" width="100"><br>
    @endif

    <button class="btn btn-success" type="submit">{{ isset($edit) && $edit ? 'Update' : 'Save' }}</button>
    <br>
</form>
</div>
<br>
<!-- Button to toggle the visibility of the table -->
<button onclick="toggleTable()" class="btn btn-primary mb-3">Show Table</button>

<!-- Table wrapper that is hidden initially -->
<div id="postsTable" style="display: none;">
    <div style="overflow-x: auto;">
        <table class="table table-hover align-middle mb-0 table-striped display nowrap w-100" id="Herotable" style="min-width: 1000px;">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="heroTable" class="bg-white">
                @foreach ($posts as $index => $item)
                    <tr id="post_{{ $item->id }}">
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{!! $item->description !!}</td> {{-- Allow HTML formatting from Jodit --}}
                        <td>
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" style="width: 100px; height: 60px; object-fit: cover; border-radius: 0.5rem;" alt="Post Image">
                            @else
                                <span class="text-muted fst-italic">No Image</span>
                            @endif
                        </td>
                        <td>
                            <!-- Action Buttons: Edit and Delete -->
                            <a href="/about/{{ $item->id }}/edit" class="btn btn-warning btn-sm mb-1">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <br>
                            <a href="/about/{{ $item->id }}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Delete this post?')">
                                <i class="fas fa-trash-alt me-1"></i>Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/jodit@3.24.5/build/jodit.min.js"></script>
<script>
    const editor = new Jodit('#editor');
    function toggleTable() {
        const table = document.getElementById('postsTable');
        if (table.style.display === "none") {
            table.style.display = "block";
        } else {
            table.style.display = "none";
        }
    }

</script>

</body>
</html>


@endsection