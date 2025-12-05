@extends('layouts.app')

@section('title', 'Create New Product')

@section('content')

<div class="container py-4" style="margin-top: -30px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card  " style="border: 0.5px solid gray">
                <div class="card-header  text-black py-3" style="background-color: #004d99;">
                    <h2 class="text-center text-white mb-0 h5" >
                        <i class="fas fa-plus-circle me-2"></i>Create New Product Women
                    </h2>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('women.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                        @csrf
                        
                        <!-- Image Upload -->
                          <div class="row g-3">
                            <div class="col-md-6">
                                <label for="title" class="form-label fw-semibold">Code Product</label>
                                <input type="number" id="title" name="code_article_womans" class="form-control" 
                                       placeholder="Enter product code" required maxlength="255" style="border: 0.5px solid black;">
                                @error('code_article_womans')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                            <label for="image" class="form-label fw-semibold">Product Image</label>
                            <input type="file" id="image" name="imager" class="form-control" required style="border: 0.5px solid black;"
                                   accept="image/*" onchange="previewImage(event)">
                            <div class="image-preview mt-2" id="imagePreview" style="border: 0.5px solid black;">
                                <i class="fas fa-image"></i>
                                <span >Image Preview</span>
                            </div>
                        </div>

                        </div>

                        <!-- Title & Price -->
                        <div class="row g-3 mb-2">
                            <div class="col-md-6">
                                <label for="title" class="form-label fw-semibold">Product Title</label>
                                <input type="text" id="title" name="title" class="form-control" 
                                       placeholder="Enter product title" required maxlength="255" style="border: 0.5px solid black;">
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label fw-semibold">Price ($)</label>
                                <input type="number" id="price" name="price" class="form-control" style="border: 0.5px solid black;" 
                                       placeholder="0.00" step="0.01" min="0" required>
                            </div>
                        </div>

                        <!-- Size & Stock & Content -->
                        <div class="row g-3">
                            <div class="col-md-6">
                            <label for="content" class="form-label fw-semibold">Content</label>
                            <textarea id="content" name="content" class="form-control" rows="3" 
                                      placeholder="Enter product content" required maxlength="1000"  style="border: 0.5px solid black;height:48px"></textarea>
                             </div>

                            <div class="col-md-3">
                                <label for="size" class="form-label fw-semibold">Size</label>
                                <select id="size" name="size" class="form-select" required  style="border: 0.5px solid black;">
                                    <option value="" disabled selected>Select size</option>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="stock" class="form-label fw-semibold">Stock Quantity</label>
                                <input type="number" id="stock" name="stock" class="form-control"  style="border: 0.5px solid black;"
                                       min="0" placeholder="0" required>
                            </div>
                        </div>
                        <!-- Buttons -->
                        <div class="row mt-2">
                            <div class="col-6">
                                <a href="{{ route('AffcherTableWoman') }}" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn w-100 fw-bold shadow-sm" style="background-color: #004d99; color: white;"> 
                                    <i class="fas fa-save me-2"></i>Create Product
                                </button>
                            </div>
                        </div>

                        </div>

                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
}

.card-header {
    border-radius: 10px 10px 0 0 !important;
}

.form-control, .form-select {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 10px 12px;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
}

.image-preview {
    width: 120px;
    height: 120px;
    margin: 0 auto;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    overflow: hidden;
    background: #f8f9fa;
}

.image-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: none;
}

.image-preview i {
    font-size: 2rem;
    margin-bottom: 8px;
}

.image-preview span {
    font-size: 0.8rem;
    text-align: center;
}

.btn {
    border-radius: 8px;
    font-weight: 600;
}

@media (max-width: 768px) {
    .container {
        padding: 1rem;
    }
    
    .card-body {
        padding: 1.5rem !important;
    }
}
</style>

<script>
function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            preview.querySelector('img').style.display = 'block';
        }
        
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = '<i class="fas fa-image"></i><span>Image Preview</span>';
    }
}

// Form validation
document.getElementById('productForm').addEventListener('submit', function(e) {
    const price = document.getElementById('price').value;
    const stock = document.getElementById('stock').value;
    
    if (parseFloat(price) <= 0) {
        e.preventDefault();
        alert('Please enter a valid price greater than 0');
        return false;
    }
    
    if (parseInt(stock) < 0) {
        e.preventDefault();
        alert('Stock quantity cannot be negative');
        return false;
    }
});
</script>
@endsection 