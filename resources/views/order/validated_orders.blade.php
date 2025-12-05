@extends('layouts.app')
@section('title', 'Commandes Validées')
@section('content')
<style>
    .validated-orders-container {
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
        margin-bottom: 10px;
        padding-bottom: 20px;
    }

    .page-title {
        color: #023e8a;
        font-size: 1.8rem; 
        font-weight: 700;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
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

    .stat-card:hover {
        transform: translateY(-2px); /* تأثير أخف */
    }

    .stat-number {
        font-size: 1rem; 
        font-weight: 700;
        color: #023e8a;
        margin-bottom: 4px;
        line-height: 1.2;
    }

    .stat-label {
        color: #6c757d;
        font-size: 0.8rem; 
        font-weight: 500;
        line-height: 1.2;
    }
    .orders-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .orders-table th {
        background:  #004d99;
        color: white;
        padding: 10px;
        text-align: center;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .orders-table td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid #f0f2f5;
    }

    .orders-table tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .orders-table tr:hover {
        background-color: #e8eef5ff;
        transition: background-color 0.2s ease;
    }

    .customer-info {
        text-align: left;
    }

    .customer-name {
        font-weight: 600;
        color: #2c3e50;
    }

    .customer-contact {
        font-size: 0.85rem;
        color: #6c757d;
    }

    .amount {
        font-weight: 700;
        color: #004d99;
        font-size: 1rem;
    }

    .date {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        background: #e8f5e8;
        color: #2e7d32;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .btn-view {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        background: #004d99;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-view:hover {
        background: #026bd3ff;
        transform: translateY(-1px);
        color: white;
    }

    .navigation-links {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 30px;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(135deg, #0066cc, #004d99);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .back-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
        color: white;
    }

    .back-link-secondary {
        background: linear-gradient(135deg, #6c757d, #495057);
    }

    .back-link-secondary:hover {
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
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
        color: #004d99;
        border: 1px solid #dee2e6;
    }

    .custom-pagination a:hover {
        background: #004d99;
        color: white;
        border-color: #004d99;
        transform: translateY(-1px);
    }

    .custom-pagination .current {
        background: linear-gradient(135deg, #004d99, #004d99);
        color: white;
        border: 1px solid #004d99;
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
        color: #004d99;
        opacity: 0.5;
    }

    .empty-state h3 {
        color: #495057;
        margin-bottom: 10px;
    }

    .export-section {
        display: flex;
        justify-content: flex-end;
        gap: 5px;
        margin-bottom: 20px;
    }

    .btn-export {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 5px;
        background: white;
        color: #023e8a;
        text-decoration: none;
        border: 2px solid #023e8a;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-export:hover {
        background: #004d99;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    }

    @media (max-width: 768px) {
        .validated-orders-container {
            padding: 20px;
        }

        .page-title {
            font-size: 1.8rem;
            flex-direction: column;
            gap: 10px;
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

        .orders-table {
            display: block;
            overflow-x: auto;
        }

        .export-section {
            justify-content: center;
            flex-wrap: wrap;
        }

        .navigation-links {
            flex-direction: column;
            align-items: center;
        }

        .back-link {
            width: 250px;
            justify-content: center;
        }

        .custom-pagination {
            flex-wrap: wrap;
            justify-content: center;
        }

        .action-buttons {
            flex-direction: column;
            gap: 5px;
        }

        .btn-view {
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

<div class="validated-orders-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-check-circle"></i>
            Validated Orders List
        </h1>
        <!-- Export Section -->
        <!-- <div class="export-section">
            <a href="#" class="btn-export">
                <i class="fas fa-file-excel"></i>
                Export Excel
            </a>
            <a href="#" class="btn-export">
                <i class="fas fa-file-pdf"></i>
                Export PDF
            </a>
            <a href="#" class="btn-export">
                <i class="fas fa-print"></i>
                Print
            </a>
        </div> -->
    </div>

    <!-- Statistics Overview -->
    <div class="stats-overview">
        <div class="stat-item">
            <div class="stat-number">{{ $validatedOrders->total() }}</div>
            <div class="stat-label">Validated Orders</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ number_format($validatedOrders->avg('totalgenerale') ?? 0, 2) }} DH</div>
            <div class="stat-label">Average per Order</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ number_format($validatedOrders->sum('totalgenerale'), 2) }} DH</div>
            <div class="stat-label">Total Revenue</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $validatedOrders->unique('email')->count() }}</div>
            <div class="stat-label">Satisfied Customers</div>
        </div>
    </div>

    @if($validatedOrders->count() > 0)
    <!-- Orders Table -->
    <div class="table-responsive">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($validatedOrders as $order)
                <tr>
                    <td class="customer-info">
                        <div class="customer-name">{{ $order->prenom }} {{ $order->nom }}</div>
                    </td>
                    <td class="customer-contact">
                        <div>{{ $order->email }}</div>
                        <div>{{ $order->phone }}</div>
                    </td>
                    <td>
                        <div>{{ Str::limit($order->adresse, 25) }}</div>
                    </td>
                    <td>
                        <span class="amount">{{ number_format($order->totalgenerale, 2) }} DH</span>
                    </td>
                    <td>
                        <span class="status-badge">
                            <i class="fas fa-check"></i>
                            Validated
                        </span>
                    </td>
                    <td>
                        <span class="date">{{ date('d/m/Y H:i', strtotime($order->created_at)) }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-container">
        <div class="custom-pagination">
            @if ($validatedOrders->onFirstPage())
                <span class="disabled"><i class="fas fa-chevron-left"></i> Previous</span>
            @else
                <a href="{{ $validatedOrders->previousPageUrl() }}"><i class="fas fa-chevron-left"></i> Previous</a>
            @endif

            @for ($i = 1; $i <= $validatedOrders->lastPage(); $i++)
                @if ($i == $validatedOrders->currentPage())
                    <span class="current">{{ $i }}</span>
                @else
                    <a href="{{ $validatedOrders->url($i) }}">{{ $i }}</a>
                @endif
            @endfor

            @if ($validatedOrders->hasMorePages())
                <a href="{{ $validatedOrders->nextPageUrl() }}">Next <i class="fas fa-chevron-right"></i></a>
            @else
                <span class="disabled">Next <i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
    </div>
    @else
    <!-- Empty State -->
    <div class="empty-state">
        <i class="fas fa-clipboard-check"></i>
        <h3>No Validated Orders</h3>
        <p>Validated orders will appear here once they have been processed.</p>
        <p>Check the pending orders section to validate them.</p>
    </div>
    @endif
</div>


<script>
    // إضافة تأثيرات للجدول
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.orders-table tbody tr');
        
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                row.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // وظيفة التصدير (يمكن تطويرها لاحقاً)
        document.querySelectorAll('.btn-export').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                // يمكن إضافة منطق التصدير هنا
                alert('Fonction d\'exportation à implémenter');
            });
        });
    });

    // تحديث الإحصائيات في الوقت الفعلي
    function updateRealTimeStats() {
        // يمكن إضافة تحديث ديناميكي للإحصائيات هنا
        console.log('Mise à jour des statistiques');
    }
</script>
@endsection