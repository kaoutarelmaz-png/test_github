@extends('layouts.app')
@section('title','Product Men')
@section('content')
<style>
     .products-management-container {
        background: #fff;
        padding: 5px;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        margin: -20px;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
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

    .add-product-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        margin-top: 5px;
    }

    .add-product-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(13, 110, 253, 0.4);
        color: white;
    }

    .add-product-btn i {
        font-size: 1.2rem;
    }

    .stats-cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr); 
        gap: 15px; 
        margin-top: -15px;
        margin-bottom: 15px;
    }

    .stat-card {
        background: white;
        padding: 15px;  
        border-radius: 10px; 
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); 
        border-left: 3px solid #023e8a; 
        transition: transform 0.2s ease;
        min-height: 50px; 
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 50px;
    }
    .stat-card:hover {
        transform: translateY(-2px);
    }

    .stat-number {
        font-size: 1.2rem; 
        font-weight: 700;
        color: #0d6efd;
        margin-bottom: 4px;
        line-height: 1.2;
    }

    .stat-label {
        color: #6c757d;
        font-size: 0.8rem; 
        font-weight: 500;
        line-height: 1.2;
    }

    .products-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .products-table thead {
        background: linear-gradient(135deg, #2c3e50, #34495e);
    }

    .products-table th {
        color: white;
        padding: 10px;
        text-align: center;
        font-weight: 600;
        font-size: 0.9rem;
        border: none;
    }

    .products-table td {
        padding: 5px;
        text-align: center;
        border-bottom: 1px solid #f0f2f5;
        vertical-align: middle;
    }
    .products-table tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.2s ease;
    }

    .product-code {
        font-family: 'Courier New', monospace;
        font-weight: 600;
        color: #2c3e50;
        background: #f8f9fa;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
    }

    .product-title {
        font-weight: 600;
        color: #2c3e50;
        text-align: left;
    }

    .product-price {
        font-weight: 700;
        color: #28a745;
        font-size: 1.1rem;
    }

    .product-price::after {
        content: " DH";
    }

    .product-size {
        display: inline-block;
        padding: 6px 12px;
        background: #e3f2fd;
        color: #1976d2;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .stock-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .stock-high {
        background: #d4edda;
        color: #155724;
    }

    .stock-medium {
        background: #fff3cd;
        color: #856404;
    }

    .stock-low {
        background: #f8d7da;
        color: #721c24;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
    }

    .btn-edit {
        background: #17a2b8;
        color: white;
    }

    .btn-edit:hover {
        background: #138496;
        transform: translateY(-1px);
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background: #c82333;
        transform: translateY(-1px);
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin: 30px 0 20px 0;
    }

    .custom-pagination {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .custom-pagination a,
    .custom-pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 16px;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
        min-width: 44px;
        transition: all 0.2s ease;
    }

    .custom-pagination a {
        background: white;
        color: #0d6efd;
        border: 1px solid #dee2e6;
    }

    .custom-pagination a:hover {
        background: #0d6efd;
        color: white;
        border-color: #0d6efd;
        transform: translateY(-1px);
    }

    .custom-pagination .current {
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        color: white;
        border: 1px solid #0d6efd;
    }

    .custom-pagination .disabled {
        background: #f8f9fa;
        color: #6c757d;
        border: 1px solid #dee2e6;
        cursor: not-allowed;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        color: #dee2e6;
    }

    .empty-state h3 {
        color: #495057;
        margin-bottom: 10px;
    }

    .search-filter-bar {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .search-box {
        flex: 1;
        min-width: 250px;
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 5px;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .search-box input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
        outline: none;
    }

    .search-box i {
            position: absolute;
            right: 15px;
            top: 45%;
            transform: translateY(-50%);
            color: #6c757d;
        }

    .filter-select {
        padding: 5px;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        background: white;
        min-width: 150px;
        font-size: 0.9rem;
    }

    @media (max-width: 1200px) {
        .stats-cards {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
    }

    @media (max-width: 768px) {
        .products-management-container {
            padding: 20px;
        }

        .page-header {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .stats-cards {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .stat-card {
            padding: 12px;
            min-height: 70px;
        }

        .stat-number {
            font-size: 1.2rem;
        }

        .stat-label {
            font-size: 0.75rem;
        }

        .products-table {
            display: block;
            overflow-x: auto;
        }

        .search-filter-bar {
            flex-direction: column;
        }

        .search-box {
            min-width: 100%;
        }

        .action-buttons {
            flex-direction: column;
            gap: 5px;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }

        .custom-pagination {
            flex-wrap: wrap;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .stat-card {
            padding: 10px;
            min-height: 65px;
        }

        .stat-number {
            font-size: 1.1rem;
        }

        .stat-label {
            font-size: 0.7rem;
        }
    }
</style>

<div class="products-management-container">
    <!-- رأس الصفحة -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-male"></i>
            Product Management Men
        </h1>
        <a href="{{ route('men.create') }}" class="add-product-btn">
            <i class="fas fa-plus-circle"></i>
        </a>
    </div>

    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-number">{{ $mens->total() }}</div>
            <div class="stat-label">Total Products</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ number_format($mens->avg('price') ?? 0, 2) }}</div>
            <div class="stat-label">Average Price</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $mens->sum('stock') }}</div>
            <div class="stat-label">Total Stock</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $mens->unique('size')->count() }}</div>
            <div class="stat-label">Available Sizes</div>
        </div>
    </div>

    <!-- شريط البحث والتصفية -->
    <div class="search-filter-bar">
        <div class="search-box">
            <input type="text" placeholder="Search products..." id="searchInput">
            <i class="fas fa-search"></i>
        </div>
        <select class="filter-select" id="sizeFilter">
            <option value="">All Sizes</option>
            <option value="S">Small (S)</option>
            <option value="M">Medium (M)</option>
            <option value="L">Large (L)</option>
            <option value="XL">Extra Large (XL)</option>
        </select>
        <select class="filter-select" id="stockFilter">
            <option value="">All Stock</option>
            <option value="high">High Stock (>10)</option>
            <option value="medium">Medium Stock (5-10)</option>
            <option value="low">Low Stock (<5)</option>
        </select>
    </div>

    @if($mens->count() > 0)
    <!-- جدول المنتجات -->
    <div class="table-responsive">
        <table class="products-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Size</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mens as $men)
                <tr class="product-row">
                    <td>
                        <span class="product-code">
                            {{ $men->code_article_mens }}
                        </span>
                    </td>
                    <td>
                        <div class="product-title">{{ Str::limit($men->title, 30) }}</div>
                    </td>
                    <td>
                        <span class="product-price">{{ number_format($men->price, 2) }}</span>
                    </td>
                    <td>
                        <span class="product-size">{{ $men->size }}</span>
                    </td>
                    <td>
                        @php
                            $stockClass = 'stock-high';
                            if ($men->stock <= 5) {
                                $stockClass = 'stock-low';
                            } elseif ($men->stock <= 10) {
                                $stockClass = 'stock-medium';
                            }
                        @endphp
                        <span class="stock-badge {{ $stockClass }}">
                            {{ $men->stock }} in stock
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a class="btn-action btn-edit" 
                               href="{{ route('men.edit', $men->id) }}"
                               title="Edit Product">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('men.destroy', $men->id) }}" method="POST" 
                                  class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" 
                                        title="Delete Product"
                                        onclick="return confirm('Are you sure you want to delete this product?')">
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

    <!-- الترقيم -->
    <div class="pagination-container">
        <div class="custom-pagination">
            @if ($mens->onFirstPage())
                <span class="disabled"><i class="fas fa-chevron-left"></i> Previous</span>
            @else
                <a href="{{ $mens->previousPageUrl() }}"><i class="fas fa-chevron-left"></i> Previous</a>
            @endif

            @for ($i = 1; $i <= $mens->lastPage(); $i++)
                @if ($i == $mens->currentPage())
                    <span class="current">{{ $i }}</span>
                @else
                    <a href="{{ $mens->url($i) }}">{{ $i }}</a>
                @endif
            @endfor

            @if ($mens->hasMorePages())
                <a href="{{ $mens->nextPageUrl() }}">Next <i class="fas fa-chevron-right"></i></a>
            @else
                <span class="disabled">Next <i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
    </div>
    @else
    <!-- حالة عدم وجود منتجات -->
    <div class="empty-state">
        <i class="fas fa-box-open"></i>
        <h3>No Products Found</h3>
        <p>Start by adding your first men's product.</p>
        <a href="{{ route('men.create') }}" class="add-product-btn" style="margin-top: 10px; padding: 10px;">
            <i class="fas fa-plus-circle" style="font-size: 20px; margin-bottom: 5px;"></i>
            Add Your First Product
        </a>
    </div>
    @endif
</div>

<script>
    // تأثيرات دخول الصفوف
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.products-table tbody tr');
        
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateX(-20px)';
            
            setTimeout(() => {
                row.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateX(0)';
            }, index * 100);
        });

        // وظيفة البحث الأساسية
        const searchInput = document.getElementById('searchInput');
        const productRows = document.querySelectorAll('.product-row');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            productRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // تأكيد الحذف مع تحسين
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
                    e.preventDefault();
                }
            });
        });

        // تصفية حسب الحجم
        const sizeFilter = document.getElementById('sizeFilter');
        sizeFilter.addEventListener('change', function() {
            const selectedSize = this.value;
            productRows.forEach(row => {
                const size = row.querySelector('.product-size').textContent;
                if (!selectedSize || size === selectedSize) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // تصفية حسب المخزون
        const stockFilter = document.getElementById('stockFilter');
        stockFilter.addEventListener('change', function() {
            const selectedStock = this.value;
            productRows.forEach(row => {
                const stockBadge = row.querySelector('.stock-badge');
                const stockText = stockBadge.textContent;
                const stockValue = parseInt(stockText);
                
                let show = true;
                if (selectedStock === 'high' && stockValue <= 10) show = false;
                if (selectedStock === 'medium' && (stockValue > 10 || stockValue <= 5)) show = false;
                if (selectedStock === 'low' && stockValue > 5) show = false;
                
                row.style.display = show ? '' : 'none';
            });
        });
    });
</script>
@endsection