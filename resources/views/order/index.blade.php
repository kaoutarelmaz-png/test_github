@extends('layouts.app')
@section('title', 'Liste des Commandes')
@section('content')
<style>
    .orders-container {
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
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f2f5;
    }

    .page-title {
        color: #2c3e50;
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
    }

    .page-actions {
        display: flex;
        gap: 15px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, #0066cc, #004d99);
        color: white;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #004d99, #003366);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
    }

    .btn-success {
        background: linear-gradient(135deg, #28a745, #218838);
        color: white;
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #218838, #1e7e34);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    }

    .orders-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .orders-table th {
        background: #004d99;
        color: white;
        padding: 5px;
        text-align: center;
        font-weight: 600;
        font-size: 14px;
    }

    .orders-table td {
        padding: 5px;
        text-align: center;
        border-bottom: 1px solid #f0f2f5;
    }

    .orders-table tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .orders-table tr:hover {
        background-color: #e3f2fd;
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
        color: #28a745;
        font-size: 1.1rem;
    }

    .date {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
        align-items: center;
    }

    .btn-action {
        padding: 8px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-view {
        background: #17a2b8;
        color: white;
    }

    .btn-view:hover {
        background: #138496;
        transform: translateY(-1px);
    }

    .btn-validate {
        background: #28a745;
        color: white;
    }

    .btn-validate:hover {
        background: #218838;
        transform: translateY(-1px);
    }

    .btn-cancel {
        background: #dc3545;
        color: white;
    }

    .btn-cancel:hover {
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
        color: #0066cc;
        border: 1px solid #dee2e6;
    }

    .custom-pagination a:hover {
        background: #0066cc;
        color: white;
        border-color: #0066cc;
        transform: translateY(-1px);
    }

    .custom-pagination .current {
        background: linear-gradient(135deg, #0066cc, #004d99);
        color: white;
        border: 1px solid #0066cc;
    }

    .custom-pagination .disabled {
        background: #f8f9fa;
        color: #6c757d;
        border: 1px solid #dee2e6;
        cursor: not-allowed;
    }

    .navigation-links {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 25px;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .back-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
        color: white;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 15px;
        color: #dee2e6;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .page-actions {
            width: 100%;
            justify-content: space-between;
        }

        .orders-table {
            display: block;
            overflow-x: auto;
        }

        .action-buttons {
            flex-direction: column;
            gap: 5px;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }

        .navigation-links {
            flex-direction: column;
            align-items: center;
        }

        .back-link {
            width: 200px;
            justify-content: center;
        }
    }
</style>

<div class="orders-container">
    <div class="page-header">
        <h1 class="page-title">Orders List</h1>
        <div class="page-actions">
            <a href="{{ route('showValidatedOrders') }}" class="btn btn-success">
                <i class="fas fa-check-circle"></i>
                Validated Orders
            </a>
            <a href="{{ route('HistoriqueOrder.index') }}" class="btn btn-primary">
                <i class="fas fa-file-alt"></i>
                Order History
            </a>
        </div>
    </div>

    @if($orders->count() > 0)
    <div class="table-responsive">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Total Amount</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td class="customer-info">
                        <div class="customer-name">{{ $order->prenom }} {{ $order->nom }}</div>
                    </td>
                    <td class="customer-contact">
                        <div>{{ $order->email }}</div>
                        <div>{{ $order->phone }}</div>
                    </td>
                    <td>
                        <div>{{ Str::limit($order->adresse, 30) }}</div>
                    </td>
                    <td>
                        <span class="amount">${{ number_format($order->totalgenerale, 2) }}</span>
                    </td>
                    <td>
                        <span class="date">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('order.show', $order->id) }}" class="btn-action btn-view" title="View Details">
                                <i class="fas fa-eye"></i>
                                View
                            </a>
                            <form action="{{ route('validateOrder', $order->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="btn-action btn-validate" title="Validate Order" onclick="return confirm('Are you sure you want to validate this order?')">
                                    <i class="fas fa-check"></i>
                                    Validate
                                </button>
                            </form>
                            <form action="{{ route('order.destroy', $order->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn-action btn-cancel" title="Cancel Order" onclick="return confirm('Are you sure you want to cancel this order?')">
                                    <i class="fas fa-times"></i>
                                    Cancel
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        <div class="custom-pagination">
            @if ($orders->onFirstPage())
                <span class="disabled"><i class="fas fa-chevron-left"></i> Previous</span>
            @else
                <a href="{{ $orders->previousPageUrl() }}"><i class="fas fa-chevron-left"></i> Previous</a>
            @endif

            @for ($i = 1; $i <= $orders->lastPage(); $i++)
                @if ($i == $orders->currentPage())
                    <span class="current">{{ $i }}</span>
                @else
                    <a href="{{ $orders->url($i) }}">{{ $i }}</a>
                @endif
            @endfor

            @if ($orders->hasMorePages())
                <a href="{{ $orders->nextPageUrl() }}">Next <i class="fas fa-chevron-right"></i></a>
            @else
                <span class="disabled">Next <i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
    </div>
    @else
    <div class="empty-state">
        <i class="fas fa-inbox"></i>
        <h3>No Pending Orders</h3>
        <p>All orders have been processed or no orders have been placed yet.</p>
    </div>
    @endif
</div>


<script>
    // Animation pour les lignes du tableau
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.orders-table tbody tr');
        
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateX(-20px)';
            
            setTimeout(() => {
                row.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateX(0)';
            }, index * 100);
        });
    });

    // Confirmation pour les actions sensibles
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('form[method="POST"]');
        
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const isDelete = this.querySelector('input[name="_method"][value="DELETE"]');
                if (isDelete) {
                    if (!confirm('Êtes-vous sûr de vouloir annuler cette commande ? Cette action est irréversible.')) {
                        e.preventDefault();
                    }
                }
            });
        });
    });
</script>
@endsection