@extends('adminlayout.adminmaster')


@section('title', 'Manage Footer')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">


<style>
    .card-header-tabs {
        margin-bottom: 0;
    }
    .sortable-handle {
        cursor: move;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manage Footer</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <ul class="nav nav-tabs card-header-tabs" id="footer-tabs" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" id="about-tab" data-toggle="tab" href="#about" role="tab">About Info</a>

                </li>
              
                <li class="nav-item">
                    <a class="nav-link" id="quick-links-tab" data-toggle="tab" href="#quick-links-sortable" role="tab">Quick Links</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab">Gallery</a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content" id="footer-content">
                <!-- About Info Tab -->
                <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5>About Info</h5>
                        @if($aboutSection)
                        <a href="{{ url('/admin/footer/edit/about_info') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                            </a>
                        @else
                        <a href="{{ url('/admin/footer/create/about_info') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Add
                            </a>
                        @endif
                    </div>

                    @if($aboutSection)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $aboutSection->title }}</td>
                                        <td>{{ Str::limit($aboutSection->content, 100) }}</td>
                                        <td>
                                            @if($aboutSection->is_active)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center">No about info added yet.</p>
                    @endif
                </div>

                

                <!-- Quick Links Tab -->
                <div class="tab-pane fade" id="quick-links" role="tabpanel" aria-labelledby="quick-links-tab">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5>Quick Links</h5>
                        <a href="{{ url('/admin/footer/create/quick_link') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> Add New
                        </a>
                    </div>

                    @if(count($quickLinks) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Title</th>
                                        <th>URL</th>
                                        <th>Status</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="quick-links-sortable">
                                    @foreach($quickLinks as $index => $link)
                                        <tr data-id="{{ $link->id }}">
                                            <td class="sortable-handle"><i class="fas fa-grip-vertical"></i></td>
                                            <td>{{ $link->title }}</td>
                                            <td><a href="{{ $link->url }}" target="_blank">{{ Str::limit($link->url, 30) }}</a></td>
                                            <td>
                                                @if($link->is_active)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                            <a href="{{ url('/admin/footer/edit/quick_link/' . $link->id) }}" class="btn btn-primary btn-sm">

                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ url('/admin/footer/delete/quick_link/' . $link->id) }}" method="POST" class="d-inline">

                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this link?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center">No quick links added yet.</p>
                    @endif
                </div>

                <!-- Contact Tab -->
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5>Contact Information</h5>
                        @if($contactSection)
                        <a href="{{ url('/admin/footer/edit/contact') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                            </a>
                        @else
                        <a href="{{ url('/admin/footer/create/contact') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Add
                            </a>
                        @endif
                    </div>

                    @if($contactSection)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $contactSection->title }}</td>
                                        <td>{{ Str::limit($contactSection->content, 100) }}</td>
                                        <td>
                                            @if($contactSection->is_active)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center">No contact information added yet.</p>
                    @endif
                </div>

                <!-- Gallery Tab -->
                <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5>Gallery Images</h5>
                        <a href="{{ url('/admin/footer/create/gallery') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Add New
                        </a>
                    </div>

                    @if(count($galleryImages) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Image</th>
                                        <th>Alt Text</th>
                                        <th>Status</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="gallery-sortable">
                                    @foreach($galleryImages as $index => $image)
                                        <tr data-id="{{ $image->id }}">
                                            <td class="sortable-handle"><i class="fas fa-grip-vertical"></i></td>
                                            <td>
                                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->alt_text }}" style="height: 50px;">
                                            </td>
                                            <td>{{ $image->alt_text }}</td>
                                            <td>
                                                @if($image->is_active)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                            <a href="{{ url('/admin/footer/edit/gallery/' . $image->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ url('/admin/footer/delete/gallery/' . $image->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this image?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center">No gallery images added yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
 $(document).ready(function() {
    // Initialize the correct tab based on the URL hash
    var hash = window.location.hash;
    if (hash) {
        $('#footer-tabs a[href="' + hash + '"]').tab('show');
    }

    // When a tab is clicked, update the URL hash
    $('#footer-tabs a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
        window.location.hash = this.hash; // Update the URL with the tab hash
    });

    // Make tables sortable
    $('#quick-links-sortable').sortable({
        handle: '.sortable-handle',
        update: function(event, ui) {
            updateOrder('quick_link', $(this));
        }
    });

    $('#gallery-sortable').sortable({
        handle: '.sortable-handle',
        update: function(event, ui) {
            updateOrder('gallery', $(this));
        }
    });

        // Function to update display order
        function updateOrder(type, element) {
            const items = [];
            element.find('tr').each(function() {
                items.push($(this).data('id'));
            });

            $.ajax({
                url: '{{ url("/admin/footer/update-order") }}',

                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    type: type,
                    items: items
                },
                success: function(response) {
                    if(response.success) {
                        // Show success message
                        const alert = $('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                            response.success +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '</div>');
                        $('#footer-content').before(alert);
                        
                        // Auto close alert after 2 seconds
                        setTimeout(function() {
                            alert.alert('close');
                        }, 2000);
                    }
                },
                error: function(xhr) {
                    console.error('Error updating order:', xhr.responseText);
                    alert('Failed to update order. Please try again.');
                }
            });
        }
    });
</script>
@endsection