@extends('layouts.app')
@section('title','Product Women')
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
        justify-content: between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
    }

    .page-title {
        color: #023e8a;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .btn-add {
        background: linear-gradient(135deg, #023e8a, #1e549aff);
        color: white;
        padding: 12px 25px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        border: none;
        margin-left: 400px;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(2, 62, 138, 0.4);
        color: white;
    }

    .search-filter-bar {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
        margin-top: -10px;
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
        outline: none;
        border-color: #023e8a;
        background: white;
        box-shadow: 0 6px 20px rgba(2, 62, 138, 0.4);
    }

    .search-box i {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
    }

   .filter-select {
        padding: 5px;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        background: white;
        min-width: 150px;
        font-size: 0.9rem;
    }

    .filter-select:focus {
        outline: none;
        border-color: #023e8a;
        background: white;
        box-shadow: 0 6px 20px rgba(2, 62, 138, 0.4);
    }

    .filter-actions {
        display: flex;
        gap: 10px;
    }

    .btn-filter {
        padding: 12px 20px;
        background: #023e8a;
        color: white;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-filter:hover {
        background: #052d60ff;
        transform: translateY(-1px);
    }

    .btn-reset {
        padding: 12px 20px;
        background: #6c757d;
        color: white;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-reset:hover {
        background: #495057;
        transform: translateY(-1px);
    }

    .product-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .product-table th {
        background: #023e8a;
        color: white;
        padding: 10px;
        text-align: center;
        font-weight: 600;
        font-size: 0.9rem;
        border: none;
    }

    .product-table td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid #f0f2f5;
        vertical-align: middle;
    }

    .product-table tr:nth-child(even) {
        background-color: #fafafa;
    }

    .product-table tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.2s ease;
    }

    .product-row {
        transition: all 0.3s ease;
    }

    .product-code {
        font-family: 'Courier New', monospace;
        font-weight: 600;
        color: #023e8a;
        background: #fff5f7;
        padding: 4px 8px;
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
        color: #023e8a;
        font-size: 1rem;
    }

    .product-size {
        background: #e3f2fd;
        color: #1976d2;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .stock-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .stock-high {
        background: #e8f5e8;
        color: #2e7d32;
    }

    .stock-low {
        background: #fff3e0;
        color: #ef6c00;
    }

    .stock-critical {
        background: #ffebee;
        color: #c62828;
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
        background: #2196f3;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-edit:hover {
        background: #1976d2;
        transform: translateY(-1px);
        color: white;
    }

    .btn-delete {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 8px 12px;
        background: #f44336;
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
        background: #d32f2f;
        transform: translateY(-1px);
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 30px;
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
        color: #023e8a;
        border: 1px solid #dee2e6;
    }

    .custom-pagination a:hover {
        background: #023e8a;
        color: white;
        border-color: #023e8a;
        transform: translateY(-1px);
    }

    .custom-pagination .active {
        background: linear-gradient(135deg, #023e8a, #0c52adff);
        color: white;
        border: 1px solid #023e8a;
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
        color: #023e8a;
        opacity: 0.5;
    }

    .empty-state h3 {
        color: #495057;
        margin-bottom: 10px;
    }

    .stats-overview {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 10px;
        margin-top: -40px;
        flex-wrap: nowrap;
        overflow-x: auto;
        padding: 15px;

    }

    .stat-item {
        background: white;
        padding: -15px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-left: 4px solid #023e8a;
        min-width: 150px;
        flex: 1;
    }

    .stat-number {
        font-size: 1.2rem;
        font-weight: 700;
        color: #023e8a;
        margin-bottom: 5px;
    }

    .stat-label {
        color: #6c757d;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .no-results {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
        display: none;
    }

    .no-results i {
        font-size: 3rem;
        margin-bottom: 15px;
        color: #023e8a;
        opacity: 0.5;
    }

    @media (max-width: 768px) {
        .product-management-container {
            padding: 20px;
        }

        .page-header {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .page-title {
            font-size: 1.6rem;
        }

        .btn-add {
            margin-left: 0;
        }

        .search-filter-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box {
            min-width: auto;
        }

        .filter-select {
            width: 100%;
        }

        .stats-overview {
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .stat-item {
            min-width: 140px;
            flex: 0 0 calc(50% - 10px);
        }

        .product-table {
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
        .stat-item {
            flex: 0 0 100%;
            min-width: auto;
        }
        
        .stat-number {
            font-size: 1.3rem;
        }
        
        .stat-label {
            font-size: 0.75rem;
        }
    }
</style>

<div class="product-management-container">
    <!-- رأس الصفحة -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-tshirt"></i>
            Product Management - Women
        </h1>
        <a href="{{ route('women.create') }}" class="btn-add">
            <i class="fas fa-plus-circle"></i>
        </a>
    </div>

    <!-- نظرة عامة على الإحصائيات -->
    <div class="stats-overview">
        <div class="stat-item">
            <div class="stat-number" id="totalProducts">{{ $womans->total() }}</div>
            <div class="stat-label">Total Products</div>
        </div>
        <div class="stat-item">
            <div class="stat-number" id="avgPrice">{{ number_format($womans->avg('price') ?? 0, 2) }} DH</div>
            <div class="stat-label">Average Price</div>
        </div>
        <div class="stat-item">
            <div class="stat-number" id="totalStock">{{ $womans->sum('stock') }}</div>
            <div class="stat-label">Total Stock</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $womans->unique('size')->count() }}</div>
            <div class="stat-label">Available Sizes</div>
        </div>
    </div>

    <!-- شريط البحث والتصفية -->
    <div class="search-filter-bar">
        <div class="search-box">
            <input type="text" placeholder="Search by code, title, price..." id="searchInput">
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
        <!-- 
        <div class="filter-actions">
            <button class="btn-filter" id="applyFilters">
                <i class="fas fa-filter"></i> Apply
            </button>
            <button class="btn-reset" id="resetFilters">
                <i class="fas fa-redo"></i> Reset
            </button>
        </div> -->
    </div>

    <!-- رسالة عدم وجود نتائج -->
    <div class="no-results" id="noResults">
        <i class="fas fa-search"></i>
        <h3>No products found</h3>
        <p>Try adjusting your search or filter criteria</p>
    </div>

    @if($womans->count() > 0)
    <!-- جدول المنتجات -->
    <div class="table-responsive">
        <table class="product-table">
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
            <tbody id="productsTableBody">
                @foreach ($womans as $woman)
                    <tr class="product-row" 
                        data-code="{{ $woman->code_article_womans }}"
                        data-title="{{ strtolower($woman->title) }}"
                        data-price="{{ $woman->price }}"
                        data-size="{{ $woman->size }}"
                        data-stock="{{ $woman->stock }}">
                        <td>
                            <span class="product-code">{{ $woman->code_article_womans }}</span>
                        </td>
                        <td class="product-title">{{ Str::limit($woman->title, 30) }}</td>
                        <td>
                            <span class="product-price">{{ number_format($woman->price, 2) }} DH</span>
                        </td>
                        <td>
                            <span class="product-size">{{ $woman->size }}</span>
                        </td>
                        <td>
                            @php
                                $stockClass = 'stock-high';
                                if ($woman->stock <= 10 && $woman->stock > 5) {
                                    $stockClass = 'stock-low';
                                } elseif ($woman->stock <= 5) {
                                    $stockClass = 'stock-critical';
                                }
                            @endphp
                            <span class="stock-badge {{ $stockClass }}">
                                <i class="fas fa-box"></i>
                                {{ $woman->stock }} in stock
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a class="btn-edit" 
                                   href="{{ route('women.edit', $woman->id) }}"
                                   title="Edit Product">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('women.destroy', $woman->id) }}" method="POST" 
                                      class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" 
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
            @if ($womans->onFirstPage())
                <span class="disabled"><i class="fas fa-chevron-left"></i> Previous</span>
            @else
                <a href="{{ $womans->previousPageUrl() }}"><i class="fas fa-chevron-left"></i> Previous</a>
            @endif

            @for ($i = 1; $i <= $womans->lastPage(); $i++)
                @if ($i == $womans->currentPage())
                    <span class="active">{{ $i }}</span>
                @else
                    <a href="{{ $womans->url($i) }}">{{ $i }}</a>
                @endif
            @endfor

            @if ($womans->hasMorePages())
                <a href="{{ $womans->nextPageUrl() }}">Next <i class="fas fa-chevron-right"></i></a>
            @else
                <span class="disabled">Next <i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
    </div>
    @else
    <!-- حالة عدم وجود منتجات -->
    <div class="empty-state">
        <i class="fas fa-tshirt"></i>
        <h3>No Products Found</h3>
        <p>Start by adding your first women's product to the collection.</p>
        <a href="{{ route('women.create') }}" class="btn-add mt-3" style="padding: 5px; width: 200px;">
            <i class="fas fa-plus-circle" style="font-size: 20px; margin-bottom: 10px; color: white; "></i>
            Add First Product
        </a>
    </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const sizeFilter = document.getElementById('sizeFilter');
        const stockFilter = document.getElementById('stockFilter');
        const applyFilters = document.getElementById('applyFilters');
        const resetFilters = document.getElementById('resetFilters');
        const productRows = document.querySelectorAll('.product-row');
        const noResults = document.getElementById('noResults');
        const productsTableBody = document.getElementById('productsTableBody');
        
        // عناصر الإحصائيات
        const totalProducts = document.getElementById('totalProducts');
        const totalStock = document.getElementById('totalStock');
        const avgPrice = document.getElementById('avgPrice');
        const wellStocked = document.getElementById('wellStocked');

        // وظيفة تطبيق الفلاتر
        function applyAllFilters() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const selectedSize = sizeFilter.value;
            const selectedStock = stockFilter.value;
            
            let visibleCount = 0;
            let totalStockValue = 0;
            let totalPrice = 0;
            let wellStockedCount = 0;
            let visibleProducts = 0;

            productRows.forEach(row => {
                const code = row.getAttribute('data-code').toLowerCase();
                const title = row.getAttribute('data-title');
                const price = parseFloat(row.getAttribute('data-price'));
                const size = row.getAttribute('data-size');
                const stock = parseInt(row.getAttribute('data-stock'));
                
                // تطبيق البحث
                const matchesSearch = !searchTerm || 
                    code.includes(searchTerm) || 
                    title.includes(searchTerm) || 
                    price.toString().includes(searchTerm);
                
                // تطبيق فلتر الحجم
                const matchesSize = !selectedSize || size === selectedSize;
                
                // تطبيق فلتر المخزون
                let matchesStock = true;
                if (selectedStock === 'high') matchesStock = stock > 10;
                else if (selectedStock === 'medium') matchesStock = stock >= 5 && stock <= 10;
                else if (selectedStock === 'low') matchesStock = stock < 5;
                
                // إظهار أو إخفاء الصف
                if (matchesSearch && matchesSize && matchesStock) {
                    row.style.display = '';
                    visibleCount++;
                    totalStockValue += stock;
                    totalPrice += price;
                    if (stock > 10) wellStockedCount++;
                    visibleProducts++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            // تحديث الإحصائيات
            updateStatistics(visibleCount, totalStockValue, totalPrice, wellStockedCount, visibleProducts);
            
            // إظهار رسالة عدم وجود نتائج
            if (visibleCount === 0) {
                noResults.style.display = 'block';
                productsTableBody.style.display = 'none';
            } else {
                noResults.style.display = 'none';
                productsTableBody.style.display = '';
            }
        }

        // تحديث الإحصائيات
        function updateStatistics(visibleCount, totalStockValue, totalPrice, wellStockedCount, visibleProducts) {
            totalProducts.textContent = visibleCount;
            totalStock.textContent = totalStockValue;
            
            const averagePrice = visibleProducts > 0 ? (totalPrice / visibleProducts).toFixed(2) : '0.00';
            avgPrice.textContent = averagePrice + ' DH';
            
            wellStocked.textContent = wellStockedCount;
        }

        // البحث أثناء الكتابة
        searchInput.addEventListener('input', applyAllFilters);
        
        // تطبيق الفلاتر عند تغييرها
        sizeFilter.addEventListener('change', applyAllFilters);
        stockFilter.addEventListener('change', applyAllFilters);
        
        // تطبيق الفلاتر عند الضغط على الزر
        applyFilters.addEventListener('click', applyAllFilters);

        // إعادة تعيين الفلاتر
        resetFilters.addEventListener('click', function() {
            searchInput.value = '';
            sizeFilter.value = '';
            stockFilter.value = '';
            applyAllFilters();
        });

        // تأثيرات دخول الصفوف
        productRows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateX(-20px)';
            
            setTimeout(() => {
                row.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateX(0)';
            }, index * 100);
        });

        // تأكيد الحذف
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
                    e.preventDefault();
                }
            });
        });

        // تطبيق الفلاتر أول مرة
        applyAllFilters();
    });
</script>
@endsection