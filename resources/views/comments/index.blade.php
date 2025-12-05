@extends('layouts.app')
@section('title', 'Comments')
@section('content')
<style>
    .comments-container {
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
        color: #6c757d;
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
        color: #6c757d;
        margin-bottom: 4px;
        line-height: 1.2;
    }

    .stat-label {
        color: #6c757d;
        font-size: 0.8rem;
        font-weight: 500;
        line-height: 1.2;
    }

    .comments-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .comments-table thead {
        background: linear-gradient(135deg, #2c3e50, #34495e);
    }

    .comments-table th {
        color: white;
        padding: 10px;
        text-align: left;
        font-weight: 600;
        font-size: 0.9rem;
        border: none;
    }

    .comments-table td {
        padding: 5px;
        text-align: left;
        border-bottom: 1px solid #f0f2f5;
        vertical-align: top;
    }

    .comments-table tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.2s ease;
    }

    .commenter-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .commenter-name {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.95rem;
    }

    .commenter-email {
        color: #6c757d;
        font-size: 0.85rem;
        word-break: break-all;
    }

    .comment-message {
        color: #495057;
        line-height: 1.5;
        font-size: 0.9rem;
        max-width: 300px;
    }

    .comment-date {
        color: #6c757d;
        font-size: 0.85rem;
        white-space: nowrap;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .btn-delete {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: transparent;
        color: #dc3545;
        border: 1px solid #dc3545;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .btn-delete:hover {
        background: #dc3545;
        color: white;
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
        color: #6c757d;
        border: 1px solid #dee2e6;
    }

    .custom-pagination a:hover {
        background: #6c757d;
        color: white;
        border-color: #6c757d;
        transform: translateY(-1px);
    }

    .custom-pagination .current {
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
        border: 1px solid #6c757d;
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
        border-color: #6c757d;
        box-shadow: 0 0 0 3px rgba(108, 117, 125, 0.1);
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

    .message-preview {
        max-height: 80px;
        overflow: hidden;
        position: relative;
    }

    .message-preview.expanded {
        max-height: none;
    }

    .read-more-btn {
        background: none;
        border: none;
        color: #6c757d;
        font-size: 0.8rem;
        cursor: pointer;
        padding: 2px 0;
        margin-top: 4px;
        text-decoration: underline;
    }

    .read-more-btn:hover {
        color: #495057;
    }

    @media (max-width: 1200px) {
        .stats-cards {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
    }

    @media (max-width: 768px) {
        .comments-container {
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

        .comments-table {
            display: block;
            overflow-x: auto;
        }

        .comments-table th,
        .comments-table td {
            white-space: nowrap;
        }

        .comment-message {
            max-width: 200px;
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

        .comments-table th,
        .comments-table td {
            padding: 12px 8px;
            font-size: 0.85rem;
        }
    }
</style>

<div class="comments-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-comments"></i>
            Comments Management
        </h1>
    </div>

    <!-- Stats Cards -->
    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-number">{{ $comments->total() }}</div>
            <div class="stat-label">Total Comments</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $comments->unique('email')->count() }}</div>
            <div class="stat-label">Unique Commenters</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $comments->count() > 0 ? round($comments->avg(function($comment) { return strlen($comment->messager); })) : 0 }}</div>
            <div class="stat-label">Average Length</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $comments->groupBy('email')->count() }}</div>
            <div class="stat-label">Active Users</div>
        </div>
    </div>

    <!-- Search & Sort Bar -->
    <div class="search-filter-bar">
        <div class="search-box">
            <input type="text" placeholder="Search comments..." id="searchInput">
            <i class="fas fa-search"></i>
        </div>
        <select class="filter-select" id="sortFilter">
            <option value="newest">Newest</option>
            <option value="oldest">Oldest</option>
        </select>
    </div>

    @if($comments->count() > 0)
    <!-- Comments Table -->
    <div class="table-responsive">
        <table class="comments-table">
            <thead>
                <tr>
                    <th>Commenter</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                <tr class="comment-row">
                    <td>
                        <div class="commenter-info">
                            <div class="commenter-name">{{ $comment->name }}</div>
                            <div class="commenter-email">{{ $comment->email }}</div>
                        </div>
                    </td>
                    <td>
                        <div class="comment-message" id="message-{{ $comment->id }}">
                            {{ $comment->messager }}
                        </div>
                        @if(strlen($comment->messager) > 150)
                        <button class="read-more-btn" onclick="toggleMessage({{ $comment->id }})">
                            Read More
                        </button>
                        @endif
                    </td>
                    <td>
                        <div class="comment-date">{{ $comment->created_at->format('d/m/Y H:i') }}</div>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" 
                                        onclick="return confirm('Are you sure you want to delete this comment?')">
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
            @if ($comments->onFirstPage())
                <span class="disabled"><i class="fas fa-chevron-left"></i> Previous</span>
            @else
                <a href="{{ $comments->previousPageUrl() }}"><i class="fas fa-chevron-left"></i> Previous</a>
            @endif

            @for ($i = 1; $i <= $comments->lastPage(); $i++)
                @if ($i == $comments->currentPage())
                    <span class="current">{{ $i }}</span>
                @else
                    <a href="{{ $comments->url($i) }}">{{ $i }}</a>
                @endif
            @endfor

            @if ($comments->hasMorePages())
                <a href="{{ $comments->nextPageUrl() }}">Next <i class="fas fa-chevron-right"></i></a>
            @else
                <span class="disabled">Next <i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
    </div>
    @else
    <!-- Empty State -->
    <div class="empty-state">
        <i class="fas fa-comment-slash"></i>
        <h3>No Comments</h3>
        <p>No comments have been posted yet.</p>
        <p>User comments will appear here.</p>
    </div>
    @endif
</div>


<script>
    // تأثيرات دخول الصفوف
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.comments-table tbody tr');
        
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
        const commentRows = document.querySelectorAll('.comment-row');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            commentRows.forEach(row => {
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
                if (!confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ? Cette action est irréversible.')) {
                    e.preventDefault();
                }
            });
        });
    });

    // وظيفة عرض/إخفاء النص الكامل
    function toggleMessage(commentId) {
        const messageElement = document.getElementById(`message-${commentId}`);
        const button = messageElement.nextElementSibling;
        
        if (messageElement.classList.contains('expanded')) {
            messageElement.classList.remove('expanded');
            button.textContent = 'Lire plus';
        } else {
            messageElement.classList.add('expanded');
            button.textContent = 'Lire moins';
        }
    }

    // تصفية حسب التاريخ
    const sortFilter = document.getElementById('sortFilter');
    sortFilter.addEventListener('change', function() {
        // يمكن إضافة منطق الفرز هنا إذا كان مطلوباً
        console.log('Tri sélectionné:', this.value);
    });
</script>
@endsection