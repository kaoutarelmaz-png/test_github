@extends('layouts.app')
@section('title','Inventaire')
@section('content')
<style>
    .inventory-container {
        background: #fff;
        padding: 5px;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        margin: -20px;
    }

    .page-header {
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f0f2f5;
    }


    .page-title {
        color: #2c3e50;
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-title i {
        color: #0d6efd;
        font-size: 2rem;
    }


    .alert-custom {
        border-radius: 10px;
        border: none;
        padding: 15px 20px;
        margin-bottom: 25px;
        font-weight: 500;
    }

    .alert-success {
        background: #e8f5e8;
        color: #2e7d32;
        border-left: 4px solid #4caf50;
    }

    .alert-danger {
        background: #ffebee;
        color: #c62828;
        border-left: 4px solid #f44336;
    }

    .search-section {
        background: #f8f9fa;
        padding: 5px;
        border-radius: 12px;
        margin-top: -50px;
        border: 1px solid #e9ecef;
    }

    .search-form {
        display: flex;
        gap: 15px;
        align-items: flex-end;
        flex-wrap: wrap;
    }

    .form-group {
        flex: 1;
        min-width: 250px;
    }

    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        display: block;
    }

    .form-control-custom {
        width: 100%;
        padding: 5px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: white;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #023e8a, #01285bff);
        color: white;
        padding: 10px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
    }

    .product-result {
        background: linear-gradient(135deg, #e3f2fd, #f3e5f5);
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        border-left: 4px solid #023e8a;
    }

    .product-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 15px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-size: 0.8rem;
        color: #6c757d;
        font-weight: 500;
        margin-bottom: 4px;
    }

    .info-value {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.95rem;
    }

    .add-form {
        display: flex;
        gap: 15px;
        align-items: flex-end;
        flex-wrap: wrap;
    }

    .quantity-input {
        min-width: 120px;
    }

    .btn-success-custom {
        background: linear-gradient(135deg, #023e8a, #01285bff);
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-success-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
    }

    .total-price-section {
        background: linear-gradient(135deg, #0077b6, #023e8a);
        padding: 5px;
        border-radius: 12px;
        margin-top: 10px;
        margin-bottom: 10px;
        text-align: center;
        border: 2px solid #023e8a;
    }

    .total-price {
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
        margin: 0;
    }

    .total-label {
        font-size: 1rem;
        color: #636e72;
        color: white;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .inventory-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .inventory-table th {
        background: #023e8a;
        color: white;
        padding: 10px;
        text-align: center;
        font-weight: 600;
        font-size: 0.9rem;
        border: none;
    }

    .inventory-table td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid #f0f2f5;
        vertical-align: middle;
    }

    .inventory-table tr:nth-child(even) {
        background-color: #fafafa;
    }

    .inventory-table tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.2s ease;
    }

    .code-cell {
        font-family: 'Courier New', monospace;
        font-weight: 600;
        color: #3498db;
        background: #e3f2fd;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 0.85rem;
    }

    .title-cell {
        font-weight: 600;
        color: #2c3e50;
        text-align: left;
    }

    .price-cell {
        font-weight: 700;
        color: #27ae60;
        font-size: 1rem;
    }

    .size-cell {
        background: #e3f2fd;
        color: #1976d2;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .stock-cell {
        font-weight: 600;
        color: #2c3e50;
    }

    .quantity-cell {
        background: #fff3e0;
        color: #ef6c00;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.9rem;
    }

    .date-cell {
        color: #6c757d;
        font-size: 0.85rem;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .btn-edit {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 8px 12px;
        background: #f39c12;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-edit:hover {
        background: #e67e22;
        transform: translateY(-1px);
        color: white;
    }

    .btn-delete {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 8px 12px;
        background: #e74c3c;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
    }

    .btn-delete:hover {
        background: #c0392b;
        transform: translateY(-1px);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        color: #bdc3c7;
        opacity: 0.5;
    }

    .empty-state h3 {
        color: #495057;
        margin-bottom: 10px;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    .custom-pagination {
        display: flex;
        gap: 5px;
        align-items: center;
    }

    .custom-pagination a,
    .custom-pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
        min-width: 44px;
        transition: all 0.2s ease;
    }

    .custom-pagination a {
        background: white;
        color: #3498db;
        border: 1px solid #dee2e6;
    }

    .custom-pagination a:hover {
        background: #3498db;
        color: white;
        border-color: #3498db;
        transform: translateY(-1px);
    }

    .custom-pagination .active {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
        border: 1px solid #3498db;
    }

    .custom-pagination .disabled {
        background: #f8f9fa;
        color: #6c757d;
        border: 1px solid #dee2e6;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        .inventory-container {
            padding: 20px;
        }

        .page-title {
            font-size: 1.8rem;
            flex-direction: column;
            gap: 10px;
        }

        .search-form,
        .add-form {
            flex-direction: column;
            align-items: stretch;
        }

        .form-group {
            min-width: auto;
        }

        .product-info {
            grid-template-columns: 1fr;
        }

        .inventory-table {
            display: block;
            overflow-x: auto;
        }

        .action-buttons {
            flex-direction: column;
            gap: 5px;
        }

        .btn-edit, .btn-delete {
            justify-content: center;
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .total-price {
            font-size: 1.5rem;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="inventory-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-clipboard-list"></i>
            Inventory Management
        </h1>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-custom alert-success">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-custom alert-danger">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Search Section -->
    <div class="search-section">
        <form action="{{ route('search_inventaire') }}" method="get" class="search-form">
            <div class="form-group">
                <label class="form-label">Search by Article Code</label>
                <input type="number" name="code_search_article" placeholder="Enter article code"
                       class="form-control-custom" required>
            </div>
            <button type="submit" class="btn-primary-custom">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <!-- Search Result -->
    @if(isset($product))
        <div class="product-result">
            <div class="product-info">
                <div class="info-item">
                    <span class="info-label">Product</span>
                    <span class="info-value">{{ $product->title }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Code</span>
                    <span class="info-value">{{ $product->code_article_mens ?? $product->code_article_womans ?? $product->code_article_shops }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Price</span>
                    <span class="info-value">{{ $product->price }} DH</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Size</span>
                    <span class="info-value">{{ $product->size }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Current Stock</span>
                    <span class="info-value">{{ $product->stock }}</span>
                </div>
            </div>

            <form action="{{ route('inventaire.store') }}" method="post" class="add-form">
                @csrf
                <input type="hidden" name="code_article" value="{{ $product->code_article_mens ?? $product->code_article_womans ?? $product->code_article_shops }}">
                <input type="hidden" name="title" value="{{ $product->title }}">
                <input type="hidden" name="price" value="{{ $product->price }}">
                <input type="hidden" name="size" value="{{ $product->size }}">
                <input type="hidden" name="stock" value="{{ $product->stock }}">

                <div class="form-group quantity-input">
                    <label class="form-label">Quantity to Add</label>
                    <input type="number" name="quantite" min="1" class="form-control-custom" 
                           placeholder="Quantity" required>
                </div>

                <button type="submit" class="btn-success-custom">
                    <i class="fas fa-plus-circle"></i>
                    Add to Inventory
                </button>
            </form>
        </div>
    @endif

    <!-- Total Price -->
    @php
        $totalPrix = $inventaires->sum(function($item) {
            return $item->price * $item->quantite;
        });
    @endphp
    
    @if($inventaires->count() > 0)
        <div class="total-price-section">
            <div class="total-label">Total Inventory Value</div>
            <div class="total-price">{{ number_format($totalPrix, 2) }} DH</div>
        </div>
    @endif

    <!-- Inventory Table -->
    <h3 class="mb-3" style="color: #023e8a; font-weight: 600;">
        <i class="fas fa-table me-2"></i>Inventory Table
    </h3>

    @if($inventaires->count() > 0)
        <div class="table-responsive">
            <table class="inventory-table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Size</th>
                        <th>Stock</th>
                        <th>Quantity</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventaires as $item)
                        <tr>
                            <td>
                                <span class="code-cell">{{ $item->code_article }}</span>
                            </td>
                            <td class="title-cell">{{ $item->title }}</td>
                            <td>
                                <span class="price-cell">{{ number_format($item->price, 2) }} DH</span>
                            </td>
                            <td>
                                <span class="size-cell">{{ $item->size }}</span>
                            </td>
                            <td>
                                <span class="stock-cell">{{ $item->stock }}</span>
                            </td>
                            <td>
                                <span class="quantity-cell">{{ $item->quantite }}</span>
                            </td>
                            <td class="date-cell">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            <td class="date-cell">{{ $item->updated_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('inventaire.edit', $item->id) }}" 
                                       class="btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('inventaire.destroy', $item->id) }}" method="POST" 
                                          class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" 
                                                title="Delete"
                                                onclick="return confirm('Do you really want to delete this item from inventory?');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            <div class="custom-pagination">
                @if ($inventaires->onFirstPage())
                    <span class="disabled"><i class="fas fa-chevron-left"></i> Previous</span>
                @else
                    <a href="{{ $inventaires->previousPageUrl() }}"><i class="fas fa-chevron-left"></i> Previous</a>
                @endif

                @for ($i = 1; $i <= $inventaires->lastPage(); $i++)
                    @if ($i == $inventaires->currentPage())
                        <span class="active">{{ $i }}</span>
                    @else
                        <a href="{{ $inventaires->url($i) }}">{{ $i }}</a>
                    @endif
                @endfor

                @if ($inventaires->hasMorePages())
                    <a href="{{ $inventaires->nextPageUrl() }}">Next <i class="fas fa-chevron-right"></i></a>
                @else
                    <span class="disabled">Next <i class="fas fa-chevron-right"></i></span>
                @endif
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <i class="fas fa-clipboard-list"></i>
            <h3>No items in inventory</h3>
            <p>Use the search to add products to the inventory.</p>
        </div>
    @endif
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // تأثيرات دخول الصفوف
        const rows = document.querySelectorAll('.inventory-table tbody tr');
        
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                row.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // تحسين تأكيد الحذف
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Êtes-vous sûr de vouloir supprimer cet article de l\\'inventaire ? Cette action est irréversible.')) {
                    e.preventDefault();
                }
            });
        });

        // إضافة تأثير للبحث
        const searchInput = document.querySelector('input[name="code_search_article"]');
        if (searchInput) {
            searchInput.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
                this.parentElement.style.transition = 'transform 0.3s ease';
            });
            
            searchInput.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        }
    });
</script>
@endsection