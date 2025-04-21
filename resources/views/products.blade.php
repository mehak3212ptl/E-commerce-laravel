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
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <div class="main">
<div class="container mt-5">
    <h2 class="mb-4">Product List</h2>

    <!-- Add Product Button -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="fas fa-plus me-1"></i> Add Product
        </button>
        <div id="message" class="flex-grow-1 text-end"></div>
    </div>

    <div class="table-responsive shadow rounded-4 overflow-hidden">
    <table class="table table-hover align-middle mb-0 table-striped display nowrap" id="bannerTable">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Category</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody id="productTable" class="bg-white">
            @forelse($products as $index => $product)
            <tr id="product_{{ $product->id }}">
                <td>{{ $product->id}}</td>
                <td class="fw-semibold">{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                
                <td>
                    @if($product->image)
                    <img src="{{ asset($product->image) }}"
                         style="width: 100px; height: 60px; object-fit: cover; border-radius: 0.5rem; cursor: pointer;"
                         class="product-img shadow-sm"
                         alt="Image">
                    @else
                    <span class="text-muted fst-italic">No Image</span>
                    @endif
                </td>
                <td>{{ $product->category->categoryname }}</td>
                <td>
                    <button class="btn btn-warning btn-sm editProductBtn mb-1"
                        data-id="{{ $product->id }}"
                        data-bs-toggle="modal" data-bs-target="#editProductModal">
                        <i class="fas fa-edit me-1"></i>Edit
                    </button>
                    <br>
                    <button class="btn btn-danger btn-sm deleteProductBtn"
                        data-id="{{ $product->id }}">
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
</div>
 
</div>
</div>


    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="productForm" enctype="multipart/form-data" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" required />
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label>Description:</label>
                        <textarea name="description" class="form-control" required></textarea>
                        <span class="text-danger error-text description_error"></span>
                    </div>
                    <div class="form-group mb-3">
                    <label >Choose a category:</label>

                        <select name="category" class="form-control" required>
                        <option value="1">Electronics</option>
                        <option value="2">Cosmetics</option>
                        <option value="6">Grocery</option>
                        <option value="5">Stationery</option>
                        <option value="7">Toys</option>
                        </select>
                        </div> 
                    <div class="form-group mb-3">
                        <label>Image:</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required />
                        <span class="text-danger error-text image_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Product</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="editProductForm" enctype="multipart/form-data" class="modal-content">
                <input type="hidden" name="product_id" id="editProductId">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Name:</label>
                        <input type="text" name="name" id="editProductName" class="form-control" required />
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label>Description:</label>
                        <textarea name="description" id="editProductDescription" class="form-control"
                            required></textarea>
                        <span class="text-danger error-text description_error"></span>
                    </div>
                    <div class="form-group mb-3">
                    <label >Choose a category:</label>

                        <select id="editcategory" name="category" class="form-control" required>
                        <option value="1">Electronics</option>
                        <option value="2">Cosmetics</option>
                        <option value="6">Grocery</option>
                        <option value="5">Stationery</option>
                        <option value="7">Toys</option>
                       
                        </select>
                        </div>
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
                    <button type="submit" class="btn btn-success">Update Product</button>
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
// datatabels 
new DataTable('#bannerTable', {
    layout: {
        topStart: {
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
   }
}
});

            // $('#addProductModal').modal('hide'); // Close modal

            // // Remove backdrop and cleanup body class
            // $('.modal-backdrop').remove();
            // $('body').removeClass('modal-open');
            // $('body').css('padding-right', '');

        // Show image in modal
        $(document).on('click', '.product-img', function() {
             const imageUrl = $(this).attr('src');
             $('#previewImage').attr('src', imageUrl);
             $('#imagePreviewModal').modal('show');
        });



        // Add Product AJAX
        $('#productForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            // Clear old errors
            $('.error-text').text('');
    
            $.ajax({
                url: "{{ route('product.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    $('#message').html(`<div class="alert alert-success">${response.success}</div>`);
                    $('#productForm')[0].reset();
                    $('#addProductModal').modal('hide');
                    let newRow = `<tr id="product_${response.product.id}">
                        <td>${response.product.index}</td>
                        <td>${response.product.name}</td>
                        <td>${response.product.description}</td>
                        <td>${response.product.category}</td>
                        <td><img src="${response.product.image}" class="product-img" alt="Image"></td>
                        <td><button class="btn btn-warning btn-sm editProductBtn" data-id="${response.product.id}">Edit</button>
                        <button class="btn btn-danger btn-sm deleteProductBtn" data-id="${response.product.id}">Delete</button></td>
                    </tr>`;
                    // $('#productTable').append(newRow);
                    $('#productTable').prepend(newRow);
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
        $(document).on('click', '.editProductBtn', function() {
            let productId = $(this).data('id');
            
            $.ajax({
                url: `/products/${productId}/edit`,
                type: 'GET',
                success: function(response) {
                    $('#editProductId').val(response.product.id);
                    $('#editProductName').val(response.product.name);
                    $('#editProductDescription').val(response.product.description);
                    $('#editcategory').val(response.product.category_id);
                    // Set the image preview
                    if (response.product.image) {
                        $('#edit-preview-image').attr('src', response.product.image).show();
                    } else {
                        $('#edit-preview-image').hide();
                    }
            
                    $('#editProductModal').modal('show');
                }
            });
        });
    
        // Update Product AJAX
        $('#editProductForm').submit(function(e) {
            e.preventDefault();
            let productId = $('#editProductId').val();
            let formData = new FormData(this);
    
            $.ajax({
                url: `/products/${productId}/update`,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    $('#message').html(`<div class="alert alert-success">${response.success}</div>`);
                    $('#editProductForm')[0].reset();
                    $('#editProductModal').modal('hide');
                    $(`#product_${response.product.id} td:nth-child(2)`).text(response.product.name);
                    $(`#product_${response.product.id} td:nth-child(3)`).text(response.product.description);
                    $(`#product_${response.product.id} td:nth-child(3)`).text(response.product.category_id);
                    $(`#product_${response.product.id} td:nth-child(4) img`).attr('src', response.product.image);
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
    
        // Delete Product AJAX with Event Delegation
        $(document).on('click', '.deleteProductBtn', function(e) {
            e.preventDefault();
    
            const productId = $(this).data('id');
            
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
                    axios.delete(`/products/delete/${productId}`, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => {
                        Swal.fire('Deleted!', response.data.success, 'success');
                        $(`#product_${productId}`).remove();
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