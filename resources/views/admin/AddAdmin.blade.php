@extends('layouts.app')
@section('title', 'Admin Management')
@section('content')
<style>
    .admin-management-container {
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
        color: #023e8a;
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .btn-add {
        background: linear-gradient(135deg, #023e8a, #0077b6);
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
        box-shadow: 0 4px 15px rgba(44, 62, 80, 0.3);
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(44, 62, 80, 0.4);
        color: white;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .admin-table th {
        background: #023e8a;
        color: white;
        padding: 10px;
        text-align: center;
        font-weight: 600;
        font-size: 0.9rem;
        border: none;
    }

    .admin-table td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid #f0f2f5;
        vertical-align: middle;
    }

    .admin-table tr:nth-child(even) {
        background-color: #fafafa;
    }

    .admin-table tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.2s ease;
    }

    .admin-id {
        font-family: 'Courier New', monospace;
        font-weight: 600;
        color: #2c3e50;
        background: #ecf0f1;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
    }

    .admin-email {
        font-weight: 600;
        color: #3498db;
        text-align: left;
    }

    .admin-password {
        font-family: 'Courier New', monospace;
        color: #7f8c8d;
        background: #f8f9fa;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.8rem;
        letter-spacing: 1px;
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
        padding: 8px 16px;
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

    .btn-edit-disabled {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 8px 16px;
        background: #bdc3c7;
        color: #7f8c8d;
        text-decoration: none;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 500;
        cursor: not-allowed;
        border: none;
    }

    .btn-delete {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 8px 16px;
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

    .btn-delete:disabled {
        background: #bdc3c7;
        color: #7f8c8d;
        cursor: not-allowed;
        transform: none;
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
        color: #2c3e50;
        border: 1px solid #dee2e6;
    }

    .custom-pagination a:hover {
        background: #2c3e50;
        color: white;
        border-color: #2c3e50;
        transform: translateY(-1px);
    }

    .custom-pagination .active {
        background: linear-gradient(135deg, #2c3e50, #34495e);
        color: white;
        border: 1px solid #2c3e50;
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
        color: #bdc3c7;
        opacity: 0.5;
    }

    .empty-state h3 {
        color: #495057;
        margin-bottom: 10px;
    }

    .stats-overview {
        display: grid;
        grid-template-columns: repeat(4, 1fr); 
        gap: 15px; 
        margin-top: -15px;
        margin-bottom: 15px;
    }

    .stat-item {
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

    .seeder-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #e8f6f3;
        color: #1abc9c;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 600;
        margin-left: 8px;
    }

    @media (max-width: 768px) {
        .admin-management-container {
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

        .stats-overview {
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .stat-item {
            min-width: 140px;
            flex: 0 0 calc(50% - 10px);
        }

        .admin-table {
            display: block;
            overflow-x: auto;
        }

        .action-buttons {
            flex-direction: column;
            gap: 5px;
        }

        .btn-edit, .btn-delete, .btn-edit-disabled {
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

<div class="admin-management-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-users-cog"></i>
            Admin Management
        </h1>
        <a href="{{ route('AjouterAutreAdmin') }}" class="btn-add">
            <i class="fas fa-plus-circle"></i>
        </a>
    </div>

    <!-- Stats Overview -->
    <div class="stats-overview">
        <div class="stat-item">
            <div class="stat-number">{{ $admins->total() }}</div>
            <div class="stat-label">Total Admins</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $admins->where('from_seeder', true)->count() }}</div>
            <div class="stat-label">System Admins</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $admins->where('from_seeder', false)->count() }}</div>
            <div class="stat-label">Custom Admins</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $admins->count() }}</div>
            <div class="stat-label">Active Admins</div>
        </div>
    </div>

    @if($admins->count() > 0)
    <!-- Admin Table -->
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                <tr>
                    <td>
                        <span class="admin-id">#{{ $admin->id }}</span>
                    </td>
                    <td class="admin-email">
                        {{ $admin->email }}
                        @if($admin->from_seeder)
                            <span class="seeder-badge" title="System Admin">
                                <i class="fas fa-shield-alt"></i>
                                System
                            </span>
                        @endif
                    </td>
                    <td>
                        <span class="admin-password">••••••••</span>
                    </td>
                    <td>
                        @if($admin->from_seeder)
                            <span style="color: #1abc9c; font-weight: 600;">System</span>
                        @else
                            <span style="color: #3498db; font-weight: 600;">Custom</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            @if($admin->from_seeder)
                                <span class="btn-edit-disabled" title="System Admin - Edit Not Allowed">
                                    <i class="fas fa-edit"></i>
                                </span>
                            @else
                                <a class="btn-edit" href="{{ route('admin.edit', $admin->id) }}" title="Edit Admin">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif
                            
                            <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('DELETE')
                                <button class="btn-delete" 
                                    @if($admin->from_seeder) disabled @endif
                                    onclick="return confirm('Are you sure you want to delete this admin?')"
                                    title="@if($admin->from_seeder) System Admin - Delete Not Allowed @else Delete Admin @endif">
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
            @if ($admins->onFirstPage())
                <span class="disabled"><i class="fas fa-chevron-left"></i> Previous</span>
            @else
                <a href="{{ $admins->previousPageUrl() }}"><i class="fas fa-chevron-left"></i> Previous</a>
            @endif

            @for ($i = 1; $i <= $admins->lastPage(); $i++)
                @if ($i == $admins->currentPage())
                    <span class="active">{{ $i }}</span>
                @else
                    <a href="{{ $admins->url($i) }}">{{ $i }}</a>
                @endif
            @endfor

            @if ($admins->hasMorePages())
                <a href="{{ $admins->nextPageUrl() }}">Next <i class="fas fa-chevron-right"></i></a>
            @else
                <span class="disabled">Next <i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
    </div>
    @else
    <!-- Empty State -->
    <div class="empty-state">
        <i class="fas fa-users-cog"></i>
        <h3>No Admins Found</h3>
        <p>Start by adding your first admin.</p>
        <a href="{{ route('AjouterAutreAdmin') }}" class="btn-add" style="width: 170px; padding: 0px; margin-left: 360px;">
            <i class="fas fa-plus-circle" style="font-size: 20px;color:white; margin-top: 30px;"></i>
            Add First Admin
        </a>
    </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // تأثيرات دخول الصفوف
        const rows = document.querySelectorAll('.admin-table tbody tr');
        
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
        const deleteForms = document.querySelectorAll('form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (this.querySelector('.btn-delete:not(:disabled)')) {
                    if (!confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ? Cette action est irréversible.')) {
                        e.preventDefault();
                    }
                }
            });
        });

        // إضافة تأثير للأزرار
        const buttons = document.querySelectorAll('.btn-edit, .btn-delete:not(:disabled)');
        buttons.forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endsection