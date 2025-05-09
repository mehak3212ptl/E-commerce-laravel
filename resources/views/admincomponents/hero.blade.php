@extends('adminlayout.adminmaster')
@section('content')



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css">

<!-- DataTables Buttons Extension CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.dataTables.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<!-- DataTables core -->
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>

<!-- DataTables Buttons Extension -->
<script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.print.min.js"></script>

<!-- JSZip for Excel export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- pdfmake for PDF export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.8.4/axios.min.js" integrity="sha512-2A1+/TAny5loNGk3RBbk11FwoKXYOMfAK6R7r4CpQH7Luz4pezqEGcfphoNzB7SM4dixUoJsKkBsB6kg+dNE2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Document</title>
</head>
<body>
<div class="main mx-5">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">

            <h2 class="mb-4">Banner Image</h2>

            <!-- Add Product Button -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addheroModal">
                    <i class="fas fa-plus me-1"></i> Add Image
                </button>
                <div id="message" class="flex-grow-1 text-end"></div>
            </div>

            <!-- Table Wrapper -->
            <div style="overflow-x: auto;">
                <table class="table table-hover align-middle mb-0 table-striped display nowrap w-100" id="Herotable" style="min-width: 1000px;">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="heroTable" class="bg-white">
                        @forelse($heros as $index => $hero)
                        <tr id="hero_{{ $hero->id }}">
                            <td>{{ $hero->id }}</td>
                            <td>{{ $hero->title }}</td>
                            <td>{{ $hero->description }}</td>
                            <td>
                                @if($hero->url)
                                <img src="Upload/Banner/{{ basename($hero->url) }}" 
                                     style="width: 100px; height: 60px; object-fit: cover; border-radius: 0.5rem; cursor: pointer;"
                                     class="product-img shadow-sm"
                                     alt="Image">
                                @else
                                <span class="text-muted fst-italic">No Image</span>
                                @endif
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggleStatus" type="checkbox" role="switch"
                                           data-id="{{ $hero->id }}"
                                           {{ $hero->status ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm editheroBtn mb-1"
                                        data-id="{{ $hero->id }}"
                                        data-bs-toggle="modal" data-bs-target="#editheroModal">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </button><br>
                                <button class="btn btn-danger btn-sm deleteheroBtn"
                                        data-id="{{ $hero->id }}">
                                    <i class="fas fa-trash-alt me-1"></i>Delete
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No products found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div> <!-- overflow-x wrapper -->
        </div>
    </div>
</div>
</div>





    <!-- Add Product Modal -->
    <div class="modal fade" id="addheroModal" tabindex="-1" aria-labelledby="addheroModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="heroForm" enctype="multipart/form-data" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addheroModalLabel">Add New Banner image </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="form-group mb-3">
                        <label>Title:</label>
                        <textarea name="title" class="form-control" required></textarea>
                        <span class="text-danger error-text description_error"></span>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label>Description:</label>
                        <textarea name="description" class="form-control" required></textarea>
                        <span class="text-danger error-text description_error"></span>
                    </div>
                    <!-- <div class="form-group mb-3">
                    <label >Choose a :</lastatusbel>
w
                        <select name="status" class="form-control" required>
                        <option value="1">Active </option>
                        <option value="0">Inactive</option>
                       
                        </select>
                        </div>  -->
                    <div class="form-group mb-3">
                        <label>Image:</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required />
                        <span class="text-danger error-text image_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Image </button>
                </div>
            </form>
        </div>
    </div>

    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editheroModal" tabindex="-1" aria-labelledby="editheroModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="editheroForm" enctype="multipart/form-data" class="modal-content">
                @csrf
                <input type="hidden" name="hero_id" id="editheroId">
                <div class="modal-header">
                    <h5 class="modal-title" id="editheroModalLabel">Edit Image </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="form-group mb-3">
                        <label>Title:</label>
                        <textarea name="title" id="editheroTitle" class="form-control"
                            required></textarea>
                        <span class="text-danger error-text description_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label>Description:</label>
                        <textarea name="description" id="editheroDescription" class="form-control"
                            required></textarea>
                        <span class="text-danger error-text description_error"></span>
                    </div>
                    <!-- <div class="form-group mb-3">
                    <label >Choose a status:</label>

                        <select id="editstatus" name="status" class="form-control" required>
                        <option value="1">Electronics</option>
                        <option value="0">Cosmetics</option>
                       
                        </select>
                        </div> -->
                    <div class="form-group mb-3">
                        <label>Image:</label>

                        <!-- Image preview -->
                        <div id="image-preview" class="mb-2">
                            <img id="edit-preview-image" src="" alt="Current Image"
                                style="max-width: 200px; height: auto; display: none;" />
                        </div>

                        <!-- File input -->
                        <input type="file" name="image" class="form-control" accept="image/*" />
                        <span class="text-danger error-text image_error"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update content</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Bootstrap Image Preview Modal -->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewLabel" aria-hidden="true" style="z-index: 1055 !important;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white" id="imagePreviewLabel">Image Preview</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="previewImage" src="" alt="Preview" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap & jQuery -->
    
    <script>
        new DataTable('#Herotable', {
    layout: {
        topStart: {
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'] }
}
});

           

        // Show image in modal
        $(document).on('click', '.product-img', function() {
             const imageUrl = $(this).attr('src');
             $('#previewImage').attr('src', imageUrl);
             $('#imagePreviewModal').modal('show');
        });



        // Add Product AJAX
        $('#heroForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            // Clear old errors
            $('.error-text').text('');
    
            $.ajax({
                url: '/herosaveitem',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    $('#message').html(`<div class="alert alert-success">${response.success}</div>`);
                    $('#heroForm')[0].reset();
                    $('#addheroModal').modal('hide');
        $('#addheroModal').on('hidden.bs.modal', function () {
            $('body').removeClass('modal-open');
            $('body').css('overflow', 'auto');
            $('body').css('padding-right', '');
            $('.modal-backdrop').remove();
        });
                    let newRow = `<tr id="hero_${response.hero.id}">
                        <td>${response.hero.id}</td>
                        <td>${response.hero.title}</td>
                        <td>${response.hero.description}</td>                      
                        <td><img src="${response.hero.image}" class="product-img" alt="Image" style="width: 100px; height: 60px; object-fit: cover; border-radius: 0.5rem; cursor: pointer;"></td>
                        <td>${response.hero.status}</td>
                        <td><button class="btn btn-warning btn-sm editheroBtn" data-id="${response.hero.id}">Edit</button>
                        <button class="btn btn-danger btn-sm deleteproductBtn" data-id="${response.hero.id}">Delete</button></td>
                    </tr>`;
                    // $('#productTable').append(newRow);
                    $('#heroTable').prepend(newRow);
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, messages) {
                            $(`.error-text.${field}_error`).text(messages[0]);
                        });
                    } else {
                        $('#message').html(`<div class="alert alert-danger">Something went wrong.</div>`);
                    }
                }
            });
        });
    
        // Edit Product AJAX - Load Product Data into Modal
        $(document).on('click', '.editheroBtn', function() {
            let heroId = $(this).data('id');
            
            $.ajax({
                url: `${heroId}/edit`,
                type: 'GET',
                success: function(response) {
                    $('#editheroId').val(response.hero.id);
                    $('#editheroTitle').val(response.hero.title);
                    $('#editheroDescription').val(response.hero.description);
                    $('#editstatus').val(response.hero.status);
                    // Set the image preview
                    if (response.hero.image) {
                        $('#edit-preview-image').attr('src', response.hero.image).show();
                    } else {
                        $('#edit-preview-image').hide();
                    }
            
                    $('#editheroModal').modal('show');
                }
            });
        });
    
        // Update Product AJAX
        $('#editheroForm').submit(function(e) {
            e.preventDefault();
            let heroId = $('#editheroId').val();
            let formData = new FormData(this);
    
            $.ajax({
                url: `${heroId}/heroupdate`,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    $('#message').html(`<div class="alert alert-success">${response.success}</div>`);
                    $('#editheroForm')[0].reset();
                    $('#editheroModal').modal('hide');
                    $(`#hero_${response.hero.id} td:nth-child(3)`).text(response.hero.title);
                    $(`#hero_${response.hero.id} td:nth-child(4)`).text(response.hero.description);
                    $(`#hero_${response.hero.id} td:nth-child(5)`).text(response.hero.status);
                    $(`#hero_${response.hero.id} td:nth-child(6) img`).attr('src', response.hero.image);
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, messages) {
                            $(`.error-text.${field}_error`).text(messages[0]);
                        });
                    } else {
                        $('#message').html(`<div class="alert alert-danger">Something went wrong.</div>`);
                    }
                }
            });
        });


// toggle 
$(document).on('change', '.toggleStatus', function () {
    const heroId = $(this).data('id');
    const newStatus = $(this).is(':checked') ? 1 : 0;

    axios.post(`/toggle-status/${heroId}`, {
        status: newStatus
    }, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        Swal.fire('Success', response.data.message, 'success');

        // Reset all toggle buttons except the clicked one
        $('.toggleStatus').not(this).prop('checked', false);
    })
    .catch(error => {
        console.error(error);
        Swal.fire('Error', 'Could not update status.', 'error');
    });
});

    
        // Delete Product AJAX with Event Delegation
        $(document).on('click', '.deleteheroBtn', function(e) {
            e.preventDefault();
    
            const heroId = $(this).data('id');
            
            Swal.fire({
                title: 'Are you sure?',
                text: 'This will delete the product permanently!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then(result => {
                if (result.isConfirmed) {
                    axios.delete(`/delete/${heroId}`, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => {
                        Swal.fire('Deleted!', response.data.success, 'success');
                        $(`#hero_${heroId}`).remove();
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire('Error!', 'There was a problem deleting the product.', 'error');
                    });
                }
            });
        });
    </script>


</body>
</html>
@endsection