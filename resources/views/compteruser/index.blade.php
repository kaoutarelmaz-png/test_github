@extends('layouts.app')
@section('title', 'YakaShopping-List_Users')
@section('content')
<style>
    .users-container {
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
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-title i {
        color: #023e8a;
        font-size: 2rem;
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

    .users-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .users-table thead {
        background: #023e8a;
    }

    .users-table th {
        color: white;
        padding: 10px;
        text-align: center;
        font-weight: 600;
        font-size: 0.9rem;
        border: none;
    }

    .users-table td {
        padding: 5px;
        text-align: center;
        border-bottom: 1px solid #f0f2f5;
        vertical-align: middle;
    }

    .users-table tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.2s ease;
    }

    .user-id {
        font-family: 'Courier New', monospace;
        font-weight: 600;
        color: #2c3e50;
        background: #f8f9fa;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
    }

    .user-name {
        font-weight: 600;
        color: #2c3e50;
    }

    .user-email {
        color: #6c757d;
        font-size: 0.9rem;
        word-break: break-all;
    }

    .password-mask {
        font-family: 'Courier New', monospace;
        background: #f8f9fa;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.8rem;
        color: #6c757d;
        letter-spacing: 1px;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .btn-delete {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 1.1rem;
    }

    .btn-delete:hover {
        background: #c82333;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
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
        color: #023e8a;
        border: 1px solid #dee2e6;
    }

    .custom-pagination a:hover {
        background: #023e8a;
        color: white;
        border-color: #023e8a;
        transform: translateY(-1px);
    }

    .custom-pagination .current {
        background: linear-gradient(135deg, #023e8a, #0a58ca);
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

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
        margin: 0 auto;
    }

    @media (max-width: 1200px) {
        .stats-cards {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
    }

    @media (max-width: 768px) {
        .users-container {
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

        .users-table {
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

        .users-table th,
        .users-table td {
            padding: 12px 8px;
            font-size: 0.85rem;
        }
    }
</style>

<div class="users-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-users"></i>
            Users Management
        </h1>
    </div>

    <!-- Stats Cards -->
    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-number">{{ $listusers->total() }}</div>
            <div class="stat-label">Total Users</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $listusers->unique('email')->count() }}</div>
            <div class="stat-label">Unique Emails</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $listusers->count() }}</div>
            <div class="stat-label">Active Users</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">-</div>
            <div class="stat-label">New (7d)</div>
        </div>
    </div>

    <!-- Search & Sort Bar -->
    <div class="search-filter-bar">
        <div class="search-box">
            <input type="text" placeholder="Search for a user..." id="searchInput">
            <i class="fas fa-search"></i>
        </div>
        <select class="filter-select" id="sortFilter">
            <option value="newest">Newest</option>
            <option value="oldest">Oldest</option>
            <option value="name">By Name</option>
        </select>
    </div>

    @if($listusers->count() > 0)
    <!-- Users Table -->
    <div class="table-responsive">
        <table class="users-table">
            <thead>
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>User</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th style="width: 80px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listusers as $listuser)
                <tr class="user-row">
                    <td>
                        <span class="user-id">#{{ $listuser->id }}</span>
                    </td>
                    <td>
                        <div class="user-avatar">
                            {{ substr($listuser->firstName, 0, 1) }}{{ substr($listuser->lastName, 0, 1) }}
                        </div>
                    </td>
                    <td>
                        <div class="user-name">{{ $listuser->firstName }} {{ $listuser->lastName }}</div>
                    </td>
                    <td>
                        <div class="user-email">{{ $listuser->email }}</div>
                    </td>
                    <td>
                        <span class="password-mask">{{ $listuser->password }}</span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <form action="{{ route('comperuser.destroy', $listuser) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" 
                                        onclick="return confirm('Are you sure you want to delete this user?')"
                                        title="Delete User">
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
            @if ($listusers->onFirstPage())
                <span class="disabled"><i class="fas fa-chevron-left"></i> Previous</span>
            @else
                <a href="{{ $listusers->previousPageUrl() }}"><i class="fas fa-chevron-left"></i> Previous</a>
            @endif

            @for ($i = 1; $i <= $listusers->lastPage(); $i++)
                @if ($i == $listusers->currentPage())
                    <span class="current">{{ $i }}</span>
                @else
                    <a href="{{ $listusers->url($i) }}">{{ $i }}</a>
                @endif
            @endfor

            @if ($listusers->hasMorePages())
                <a href="{{ $listusers->nextPageUrl() }}">Next <i class="fas fa-chevron-right"></i></a>
            @else
                <span class="disabled">Next <i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
    </div>
    @else
    <!-- Empty State -->
    <div class="empty-state">
        <i class="fas fa-users-slash"></i>
        <h3>No Users</h3>
        <p>No users have registered yet.</p>
        <p>Users will appear here once they register.</p>
    </div>
    @endif
</div>


<script>
    // تأثيرات دخول الصفوف
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.users-table tbody tr');
        
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateX(-20px)';
            
            setTimeout(() => {
                row.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateX(0)';
            }, index * 100);
        });

        // وظيفة البحث
        const searchInput = document.getElementById('searchInput');
        const userRows = document.querySelectorAll('.user-row');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            userRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // تأكيد الحذف
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.')) {
                    e.preventDefault();
                }
            });
        });

        // تصفية حسب الخيار
        const sortFilter = document.getElementById('sortFilter');
        sortFilter.addEventListener('change', function() {
            // يمكن إضافة منطق الفرز هنا إذا كان مطلوباً
            console.log('Tri sélectionné:', this.value);
        });
    });
</script>
@endsection