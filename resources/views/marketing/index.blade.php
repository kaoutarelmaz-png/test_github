@extends('layouts.app')
@section('title', 'Dashboard Mondial – Statistiques des Vêtements')
@section('content')
<div class="container-fluid ">

    <!-- Header with gradient and stats -->
    <div class="dashboard-header mb-2">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="mb-3">
                    <h1 class="fw-bold text-gradient-primary mb-2">🌍 Global Clothing Dashboard</h1>
                    <p class="text-muted mb-0">Comprehensive overview of worldwide clothing sales and inventory</p>
                </div>
                <div class="d-flex align-items-center flex-wrap gap-3">
                    <div class="d-flex align-items-center">
                        <div class="stat-badge bg-primary-subtle text-primary rounded-circle p-2 me-2">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Total Products</small>
                            <span class="fw-bold fs-5">{{ $menCount + $womenCount + $mixCount }}</span>
                        </div>
                    </div>
                    <div class="vertical-divider"></div>
                    <div class="d-flex align-items-center">
                        <div class="stat-badge bg-success-subtle text-success rounded-circle p-2 me-2">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Active Categories</small>
                            <span class="fw-bold fs-5">3</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <!-- Men's Clothing Card -->
        <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card stats-card border-0 shadow-sm hover-lift">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-uppercase text-muted small fw-semibold mb-1">Men's Clothing</h6>
                            <h2 class="fw-bold text-primary mb-0">{{ $menCount }}</h2>
                        </div>
                        <div class="icon-wrapper bg-primary-subtle rounded-3 p-3">
                            <i class="fas fa-male text-primary fs-4"></i>
                        </div>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-primary" style="width: {{ $menCount > 0 ? ($menCount/($menCount+$womenCount+$mixCount))*100 : 0 }}%"></div>
                    </div>
                    <p class="text-muted small mb-0 mt-2">{{ number_format(($menCount > 0 ? ($menCount/($menCount+$womenCount+$mixCount))*100 : 0), 1) }}% of total inventory</p>
                </div>
            </div>
        </div>

        <!-- Women's Clothing Card -->
        <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card stats-card border-0 shadow-sm hover-lift">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-uppercase text-muted small fw-semibold mb-1">Women's Clothing</h6>
                            <h2 class="fw-bold text-danger mb-0">{{ $womenCount }}</h2>
                        </div>
                        <div class="icon-wrapper bg-danger-subtle rounded-3 p-3">
                            <i class="fas fa-female text-danger fs-4"></i>
                        </div>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-danger" style="width: {{ $womenCount > 0 ? ($womenCount/($menCount+$womenCount+$mixCount))*100 : 0 }}%"></div>
                    </div>
                    <p class="text-muted small mb-0 mt-2">{{ number_format(($womenCount > 0 ? ($womenCount/($menCount+$womenCount+$mixCount))*100 : 0), 1) }}% of total inventory</p>
                </div>
            </div>
        </div>

        <!-- Unisex Card -->
        <div class="col-xl-4 col-lg-4 col-md-4">
            <div class="card stats-card border-0 shadow-sm hover-lift">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-uppercase text-muted small fw-semibold mb-1">Unisex Collection</h6>
                            <h2 class="fw-bold text-success mb-0">{{ $mixCount }}</h2>
                        </div>
                        <div class="icon-wrapper bg-success-subtle rounded-3 p-3">
                            <i class="fas fa-people-arrows text-success fs-4"></i>
                        </div>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: {{ $mixCount > 0 ? ($mixCount/($menCount+$womenCount+$mixCount))*100 : 0 }}%"></div>
                    </div>
                    <p class="text-muted small mb-0 mt-2">{{ number_format(($mixCount > 0 ? ($mixCount/($menCount+$womenCount+$mixCount))*100 : 0), 1) }}% of total inventory</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-4 mb-4">
        <!-- Bar Chart -->
        <div class="col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fw-semibold">
                            <i class="fas fa-chart-bar text-primary me-2"></i>Global Distribution
                        </h5>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <canvas id="barChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fw-semibold">
                            <i class="fas fa-chart-pie text-danger me-2"></i>Category Percentage
                        </h5>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <canvas id="pieChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Line Chart -->
        <div class="col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fw-semibold">
                            <i class="fas fa-chart-line text-success me-2"></i>Sales Trend
                        </h5>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <canvas id="lineChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Donut Chart -->
        <div class="col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fw-semibold">
                            <i class="fas fa-chart-circle text-warning me-2"></i>Inventory Overview
                        </h5>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <canvas id="donutChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

<!-- Product Table with Search -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0 fw-semibold">
                <i class="fas fa-boxes text-info me-2"></i>Product List
            </h5>
            <div class="d-flex gap-2">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <span class="input-group-text bg-light border-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" 
                           id="productSearch" 
                           class="form-control border-0 bg-light" 
                           placeholder="Search products..."
                           onkeyup="searchProducts()">
                </div>
                <button class="btn btn-sm btn-outline-primary" onclick="clearSearch()">
                    <i class="fas fa-times me-1"></i> Clear
                </button>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="productsTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4 py-3 fw-semibold border-0" style="width: 70px;">Image</th>
                        <th class="py-3 fw-semibold border-0">Product Name</th>
                        <th class="py-3 fw-semibold border-0">Category</th>
                        <th class="py-3 fw-semibold border-0">Price</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach($mix as $item)
                    <tr class="border-top product-row" 
                        data-name="{{ strtolower($item['title']) }}"
                        data-category="{{ strtolower($item['category']) }}"
                        data-price="{{ $item['price'] }}">
                        <td class="ps-4 py-3">
                            <div class="product-img-wrapper rounded-3 overflow-hidden" style="width: 60px; height: 60px;">
                                <img src="{{ $item['image'] }}" 
                                     alt="{{ $item['title'] }}"
                                     class="img-fluid h-100 w-100 object-fit-cover">
                            </div>
                        </td>
                        <td class="py-3">
                            <div>
                                <h6 class="mb-0 fw-semibold product-name">{{ $item['title'] }}</h6>
                                <small class="text-muted">SKU: {{ $item['id'] ?? 'N/A' }}</small>
                            </div>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-{{ $item['category'] == 'men\'s clothing' ? 'primary' : 'danger' }}-subtle text-{{ $item['category'] == 'men\'s clothing' ? 'primary' : 'danger' }} product-category">
                                {{ ucfirst(str_replace("'s clothing", "", $item['category'])) }}
                            </span>
                        </td>
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <span class="fw-bold fs-5 text-dark product-price">${{ number_format($item['price'], 2) }}</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<div class="card-footer bg-transparent border-0 py-3">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="text-muted small">
                Showing {{ (($currentPage - 1) * $perPage) + 1 }}-{{ min($currentPage * $perPage, $totalProducts) }} of {{ $totalProducts }}
            </div>
        </div>
        
        <nav>
            <ul class="pagination pagination-sm mb-0">
                @if($currentPage > 1)
                    <li class="page-item">
                        <a class="page-link" href="?page={{ $currentPage - 1 }}">
                            <i class="fas fa-chevron-left me-1"></i> Prev
                        </a>
                    </li>
                @endif
                
                <li class="page-item disabled">
                    <span class="page-link">{{ $currentPage }}/{{ $totalPages }}</span>
                </li>
                
                @if($currentPage < $totalPages)
                    <li class="page-item">
                        <a class="page-link" href="?page={{ $currentPage + 1 }}">
                            Next <i class="fas fa-chevron-right ms-1"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
</div>

</div>

@endsection

@section('styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #023e8a 0%, #01306eff 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --danger-gradient: linear-gradient(135deg, #f093fb 0%, #f557d3ff 100%);
        --warning-gradient: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
    }

    .text-gradient-primary {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .dashboard-header {
        background: white;
        margin: -30px;
        padding: 1rem;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
    }

    .stats-card {
        transition: all 0.3s ease;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stats-card:hover::before {
        opacity: 1;
    }

    .stats-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.1) !important;
    }

    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .hover-lift:hover {
        transform: translateY(-4px);
    }

    .icon-wrapper {
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .stats-card:hover .icon-wrapper {
        transform: scale(1.1);
    }

    .vertical-divider {
        width: 1px;
        height: 40px;
        background-color: #dee2e6;
        margin: 0 1rem;
    }

    .product-img-wrapper {
        position: relative;
        border: 2px solid #f8f9fa;
        transition: all 0.3s ease;
    }

    .product-img-wrapper:hover {
        border-color: var(--bs-primary);
        transform: scale(1.05);
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: rgba(var(--bs-primary-rgb), 0.05) !important;
    }

    .card {
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card-header {
        background-color: rgba(255,255,255,0.95);
        backdrop-filter: blur(10px);
    }

    .progress {
        border-radius: 10px;
        background-color: #f8f9fa;
    }

    .progress-bar {
        border-radius: 10px;
    }

    .badge {
        padding: 0.5rem 1rem;
        font-weight: 500;
    }

    .object-fit-cover {
        object-fit: cover;
    }

    /* Custom scrollbar */
    .table-responsive::-webkit-scrollbar {
        height: 6px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #a1a1a1;
    }

    /* Animation for cards */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stats-card {
        animation: fadeInUp 0.5s ease forwards;
    }

    .stats-card:nth-child(2) {
        animation-delay: 0.1s;
    }

    .stats-card:nth-child(3) {
        animation-delay: 0.2s;
    }

    /* Styles for search functionality */
    #productSearch:focus {
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
        border-color: #86b7fe;
    }

    th button {
        background: none;
        border: none;
        font-weight: 600;
        color: inherit;
        cursor: pointer;
    }

    th button:hover {
        color: #0d6efd;
    }

    th button i {
        font-size: 0.8em;
        opacity: 0.7;
    }

    .product-row {
        transition: all 0.2s ease;
    }

    .product-row:hover {
        background-color: rgba(13, 110, 253, 0.05) !important;
        transform: translateX(2px);
    }

    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: white;
    }

    .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .dashboard-header {
            padding: 1.5rem;
        }
        
        .vertical-divider {
            display: none;
        }
        
        .icon-wrapper {
            width: 48px;
            height: 48px;
        }
        
        .card-header .d-flex {
            flex-direction: column;
            gap: 1rem;
        }
        
        .card-header .input-group {
            width: 100% !important;
        }
        
        .btn-group {
            flex-wrap: wrap;
        }
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const men = {{ $menCount }};
    const women = {{ $womenCount }};
    const mix = {{ $mixCount }};
    const total = men + women + mix;

    // Bar Chart with enhanced styling
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Men\'s', 'Women\'s', 'Unisex'],
            datasets: [{
                label: 'Products',
                data: [men, women, mix],
                backgroundColor: [
                    'rgba(13, 110, 253, 0.2)',
                    'rgba(220, 53, 69, 0.2)',
                    'rgba(25, 135, 84, 0.2)'
                ],
                borderColor: [
                    'rgb(13, 110, 253)',
                    'rgb(220, 53, 69)',
                    'rgb(25, 135, 84)'
                ],
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.parsed.y + ' products';
                            label += ' (' + ((context.parsed.y/total)*100).toFixed(1) + '%)';
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        padding: 10
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        padding: 10
                    }
                }
            }
        }
    });

    // Pie Chart with gradient
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['Men\'s', 'Women\'s', 'Unisex'],
            datasets: [{
                data: [men, women, mix],
                backgroundColor: [
                    '#0d6efd',
                    '#dc3545',
                    '#198754'
                ],
                borderWidth: 2,
                borderColor: '#fff',
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const percentage = ((context.parsed/total)*100).toFixed(1);
                            return `${context.label}: ${context.parsed} (${percentage}%)`;
                        }
                    }
                }
            },
            cutout: '0%'
        }
    });

    // Line Chart with trend
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Men\'s Trend',
                data: [men*0.7, men*0.8, men*0.9, men, men*1.1, men*1.2, men*1.3],
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13, 110, 253, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 3
            }, {
                label: 'Women\'s Trend',
                data: [women*0.6, women*0.7, women*0.8, women, women*1.1, women*1.3, women*1.5],
                borderColor: '#dc3545',
                backgroundColor: 'rgba(220, 53, 69, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Donut Chart
    const donutCtx = document.getElementById('donutChart').getContext('2d');
    new Chart(donutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Men\'s', 'Women\'s', 'Unisex'],
            datasets: [{
                data: [men, women, mix],
                backgroundColor: [
                    'rgba(13, 110, 253, 0.8)',
                    'rgba(220, 53, 69, 0.8)',
                    'rgba(25, 135, 84, 0.8)'
                ],
                borderColor: '#fff',
                borderWidth: 3,
                hoverOffset: 20
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            cutout: '70%'
        }
    });

    // Add animation to table rows
    document.addEventListener('DOMContentLoaded', function() {
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach((row, index) => {
            row.style.animationDelay = `${index * 0.05}s`;
            row.classList.add('fade-in');
        });
    });

    // Search functionality
    let searchTimeout;
    
    function searchProducts() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(performSearch, 300);
    }
    
    function performSearch() {
        const searchInput = document.getElementById('productSearch');
        const searchTerm = searchInput.value.toLowerCase().trim();
        const rows = document.querySelectorAll('.product-row');
        let visibleCount = 0;
        
        rows.forEach(row => {
            const productName = row.getAttribute('data-name');
            const productCategory = row.getAttribute('data-category');
            
            const matches = productName.includes(searchTerm) || 
                           productCategory.includes(searchTerm);
            
            if (matches || searchTerm === '') {
                row.style.display = '';
                visibleCount++;
                
                if (searchTerm !== '') {
                    highlightText(row, searchTerm);
                } else {
                    removeHighlight(row);
                }
            } else {
                row.style.display = 'none';
            }
        });
        
        updateResultCount(visibleCount);
    }
    
    function highlightText(row, searchTerm) {
        const nameElement = row.querySelector('.product-name');
        const categoryElement = row.querySelector('.product-category');
        
        const nameText = nameElement.textContent;
        const highlightedName = nameText.replace(
            new RegExp(searchTerm, 'gi'),
            match => `<span class="bg-warning text-dark px-1 rounded">${match}</span>`
        );
        nameElement.innerHTML = highlightedName;
        
        const categoryText = categoryElement.textContent;
        const highlightedCategory = categoryText.replace(
            new RegExp(searchTerm, 'gi'),
            match => `<span class="bg-warning text-dark px-1 rounded">${match}</span>`
        );
        categoryElement.innerHTML = highlightedCategory;
    }
    
    function removeHighlight(row) {
        const nameElement = row.querySelector('.product-name');
        const categoryElement = row.querySelector('.product-category');
        
        nameElement.innerHTML = nameElement.textContent;
        categoryElement.innerHTML = categoryElement.textContent;
    }
    
    function clearSearch() {
        document.getElementById('productSearch').value = '';
        performSearch();
    }
    
    function updateResultCount(count) {
        const total = {{ $menCount + $womenCount + $mixCount }};
        const resultElement = document.getElementById('resultCount');
        
        if (count === total) {
            resultElement.innerHTML = `Showing all ${total} products`;
        } else {
            resultElement.innerHTML = `Showing ${count} of ${total} products`;
            
            const searchTerm = document.getElementById('productSearch').value;
            if (searchTerm) {
                resultElement.innerHTML += ` <span class="badge bg-info">Filtered</span>`;
            }
        }
    }
    
    // Sorting functionality
    let currentSortColumn = null;
    let sortAscending = true;
    
    function sortTable(column) {
        const tbody = document.getElementById('tableBody');
        const rows = Array.from(tbody.querySelectorAll('.product-row'));
        
        if (currentSortColumn === column) {
            sortAscending = !sortAscending;
        } else {
            currentSortColumn = column;
            sortAscending = true;
        }
        
        updateSortIcons(column);
        
        rows.sort((a, b) => {
            let valueA, valueB;
            
            switch(column) {
                case 'name':
                    valueA = a.getAttribute('data-name');
                    valueB = b.getAttribute('data-name');
                    break;
                case 'category':
                    valueA = a.getAttribute('data-category');
                    valueB = b.getAttribute('data-category');
                    break;
                case 'price':
                    valueA = parseFloat(a.getAttribute('data-price'));
                    valueB = parseFloat(b.getAttribute('data-price'));
                    break;
                default:
                    return 0;
            }
            
            if (valueA < valueB) return sortAscending ? -1 : 1;
            if (valueA > valueB) return sortAscending ? 1 : -1;
            return 0;
        });
        
        rows.forEach(row => tbody.appendChild(row));
    }
    
    function updateSortIcons(column) {
        document.querySelectorAll('th button i').forEach(icon => {
            icon.className = 'fas fa-sort ms-1 text-muted';
        });
        
        const currentIcon = document.querySelector(`th button[onclick="sortTable('${column}')"] i`);
        if (currentIcon) {
            currentIcon.className = sortAscending ? 
                'fas fa-sort-up ms-1 text-primary' : 
                'fas fa-sort-down ms-1 text-primary';
        }
    }
    
    
    // Search on Enter key
    document.getElementById('productSearch').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });
</script>
@endsection