@extends('layouts.app')
@section('title','Update Product')
@section('content')
<div class="container py-4" style="margin-top: -40px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="border: 0.5px solid gray">
                <div class="card-header text-black py-3" style="background-color: #004d99; border-radius: 10px 10px 0 0;">
                    <h2 class="text-center mb-0 h5 text-white">
                        <i class="fas fa-edit me-2"></i>Edit Product Shop
                    </h2>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('shop.update', $edits->id) }}" method="POST" enctype="multipart/form-data" id="productForm">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Code Product</label>
                                <input type="number" name="code_article_shops" class="form-control" 
                                       value="{{ $edits->code_article_shops }}" required maxlength="255" style="border: 0.5px solid black;">
                                @error('code_article_shops')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Product Image</label>
                                <input type="file" id="imageInput" name="imager" class="form-control" accept="image/*"
                                       onchange="previewImage(event)" style="border: 0.5px solid black;">
                                <div class="image-preview mt-2" id="imagePreview" style="border: 0.5px solid black;">
                                    <img src="{{ Storage::url('imager/' . $edits->imager) }}" alt="Preview" style="display: block; width:100%; height:100%; object-fit:cover;">
                                </div>
                            </div>
                        </div>

                        <div class="row g-3" style="margin-bottom: -20px;">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Product Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $edits->title }}" required maxlength="255" style="border: 0.5px solid black;">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Price ($)</label>
                                <input type="number" id="price" name="price" class="form-control" value="{{ $edits->price }}" style="border: 0.5px solid black;" step="0.01" min="0" required>
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Content</label>
                                <textarea name="content" class="form-control" rows="3" required maxlength="1000" style="border: 0.5px solid black;">{{ $edits->content }}</textarea>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Size</label>
                                <input type="text" name="size" class="form-control" value="{{ $edits->size }}" required style="border: 0.5px solid black;">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Stock Quantity</label>
                                <input type="number" id="stock" name="stock" class="form-control" value="{{ $edits->stock }}" style="border: 0.5px solid black;" min="0" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <a href="{{ route('AffcherTableShop') }}" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn w-100 fw-bold shadow-sm" style="background-color: #004d99; color: white;"> 
                                    <i class="fas fa-save me-2"></i>Save Changes
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
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
    }
    .btn {
        border-radius: 8px;
        font-weight: 600;
    }
    @media (max-width: 768px) {
        .container { padding: 1rem; }
        .card-body { padding: 1.5rem !important; }
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
            }
            reader.readAsDataURL(file);
        }
    }

    document.getElementById('productForm').addEventListener('submit', function(e) {
        const price = document.getElementById('price').value;
        const stock = document.getElementById('stock').value;
        if (parseFloat(price) <= 0) {
            e.preventDefault();
            alert('Please enter a valid price greater than 0');
        }
        if (parseInt(stock) < 0) {
            e.preventDefault();
            alert('Stock quantity cannot be negative');
        }
    });
</script>
@endsection
