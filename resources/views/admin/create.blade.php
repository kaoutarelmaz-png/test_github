@extends('layouts.app')
@section('title', 'Tableau de Bord')
@section('content')
<div class="dashboard-container">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="dashboard-title">Dashboard</h2>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row" style="margin-top: -35px;">
        <div class="col-md-3 col-sm-9 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ $ordersCount }}</h3>
                    <p class="stat-label">Orders</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ $clients }}</h3>
                    <p class="stat-label">Clients</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ $products }}</h3>
                    <p class="stat-label">Products</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ $revenue}} KDH</h3>
                    <p class="stat-label">Revenue</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Tables -->
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="dashboard-card">
                <div class="card-header">
                    <h4>Recent Sales</h4>
                    <a href="{{ route('order.index') }}" class="btn-view-all">View All</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Client</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSales as $sale)
                                <tr>
                                    <td>{{ $sale->id }}</td>
                                    <td>{{ $sale->nom }} {{ $sale->prenom }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sale->created_at)->format('d/m/Y H:i') }}</td>
                                    <td>{{ $sale->totalgenerale }} DH</td>                                
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="dashboard-card">
                <div class="card-header">
                    <h4>Popular Products</h4>
                </div>
                <div class="card-body">
                    <div class="popular-products">
                        @foreach($productCount as $title => $data)
                            <div class="product-item">
                                <div class="product-image">
                                    <img src="{{ asset('/storage/imager/' . $data['image']) }}" alt="{{ $title }}">
                                </div>
                                <div class="product-info">
                                    <h5>{{ $title }}</h5>
                                    <p>{{ $data['size'] }}  {{ $data['price'] }}DH</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    .dashboard-container {
        padding: 20px 0;
    }
    
    .dashboard-title {
        color: #023e8a;
        font-weight: 700;
        margin-top: -25px;
    }
    
    .stat-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        transition: transform 0.3s ease;
        height: 60px;
        margin-top: 10px;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .stat-icon {
        width: 30px;
        height: 60px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1.5rem;
        color: white;
    }
    
    .stat-card:nth-child(1) .stat-icon {
        background: linear-gradient(135deg, #4361ee, #3a0ca3);
        height: 35px;
    }
    
    .stat-card:nth-child(2) .stat-icon {
        background: linear-gradient(135deg, #f72585, #b5179e);
    }
    
    .stat-card:nth-child(3) .stat-icon {
        background: linear-gradient(135deg, #4cc9f0, #4895ef);
    }
    
    .stat-card:nth-child(4) .stat-icon {
        background: linear-gradient(135deg, #f48c06, #e85d04);
    }
    
    .stat-value {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: #023e8a;
    }
    
    .stat-label {
        color: #6c757d;
        margin-bottom: 0;
        font-size: 0.7rem;
    }
    
    .dashboard-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        height: 100%;
    }
    
    .card-header {
        padding: 15px 20px;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .card-header h4 {
        margin: 0;
        color: #023e8a;
        font-weight: 600;
    }
    
    .btn-view-all {
        color: #4361ee;
        text-decoration: none;
        font-weight: 500;
    }
    
    .btn-view-all:hover {
        text-decoration: underline;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
        color: #495057;
        font-size: 0.9rem;
    }
    
    .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .status-delivered {
        background-color: #d4edda;
        color: #155724;
    }
    
    .status-shipped {
        background-color: #cce7ff;
        color: #004085;
    }
    
    .status-processing {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .status-cancelled {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    .popular-products {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .product-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f1f1f1;
    }
    
    .product-item:last-child {
        border-bottom: none;
    }
    
    .product-image {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        overflow: hidden;
        margin-right: 15px;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .product-info h5 {
        margin: 0 0 5px 0;
        font-size: 0.95rem;
        font-weight: 600;
    }
    
    .product-info p {
        margin: 0;
        font-size: 0.8rem;
        color: #6c757d;
    }
</style>
@endsection

@section('scripts')
<script>
    // Scripts spécifiques à la page dashboard
    console.log('Dashboard chargé');
    
    // Animation pour les cartes de statistiques
    document.addEventListener('DOMContentLoaded', function() {
        const statCards = document.querySelectorAll('.stat-card');
        
        statCards.forEach((card, index) => {
            // Animation d'apparition en cascade
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
@endsection