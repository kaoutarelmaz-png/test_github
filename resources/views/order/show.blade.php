@extends('layouts.app')

@section('title', 'Détails de la commande #'.$order->id)

@section('content')
<style>
    /* التصميم العادي للصفحة */
    .invoice-container {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-bottom: 30px;
    }

    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 20px;
        border-bottom: 2px solid #f0f2f5;
        margin-bottom: 30px;
    }

    .company-logo {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 24px;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }

    .company-info {
        text-align: right;
    }

    .company-name {
        font-size: 2rem;
        font-weight: 700;
        color: #0d6efd;
        margin: 0;
    }

    .company-tagline {
        color: #6c757d;
        font-size: 1rem;
        margin: 0;
    }

    .customer-info-card {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        border-left: 4px solid #0d6efd;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-weight: 600;
        color: #495057;
        font-size: 0.9rem;
        margin-bottom: 5px;
    }

    .info-value {
        color: #2c3e50;
        font-size: 1rem;
        font-weight: 500;
    }

    .total-amount {
        background: linear-gradient(135deg, #198754, #157347);
        color: white;
        padding: 15px 25px;
        border-radius: 10px;
        text-align: center;
        margin: 20px 0;
    }

    .total-label {
        font-size: 1rem;
        margin-bottom: 5px;
        opacity: 0.9;
    }

    .total-value {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
    }

    .products-section {
        margin: 30px 0;
    }

    .section-title {
        color: #2c3e50;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f2f5;
    }

    .products-table {
        width: 100%;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .products-table thead {
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
    }

    .products-table th {
        color: white;
        padding: 16px;
        text-align: center;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .products-table td {
        padding: 14px;
        text-align: center;
        border-bottom: 1px solid #f0f2f5;
    }

    .products-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .product-image {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        object-fit: cover;
        border: 2px solid #e9ecef;
    }

    .product-title {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .product-description {
        color: #6c757d;
        font-size: 0.85rem;
        line-height: 1.3;
    }

    .price-amount {
        font-weight: 600;
        color: #198754;
    }

    .quantity-badge {
        background: #0d6efd;
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 2px solid #f0f2f5;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
        color: white;
    }

    .btn-success {
        background: linear-gradient(135deg, #198754, #157347);
        color: white;
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #157347, #146c43);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
    }

    .thank-you-message {
        text-align: center;
        padding: 30px;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 12px;
        margin-top: 30px;
        display: none;
    }

    .thank-you-text {
        font-size: 1.2rem;
        font-weight: 600;
        color: #0d6efd;
        margin: 0;
    }

    /* تصميم الطباعة */
    @media print {
        @page {
            size: A4;
            margin: 15mm;
        }

        body * {
            visibility: hidden;
        }

        .invoice-container, .invoice-container * {
            visibility: visible;
        }

        .invoice-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            background: #fff;
            padding: 0;
            margin: 0;
            box-shadow: none;
        }

        .no-print {
            display: none !important;
        }

        .invoice-header {
            border-bottom: 3px solid #0d6efd;
            margin-bottom: 25px;
            padding-bottom: 15px;
        }

        .company-logo {
            width: 70px;
            height: 70px;
            font-size: 20px;
        }

        .company-name {
            font-size: 1.8rem;
        }

        .customer-info-card {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-left: 4px solid #0d6efd;
        }

        .total-amount {
            background: #198754 !important;
            -webkit-print-color-adjust: exact;
        }

        .products-table {
            box-shadow: none;
            border: 1px solid #dee2e6;
        }

        .products-table thead {
            background: #0d6efd !important;
            -webkit-print-color-adjust: exact;
        }

        .thank-you-message {
            display: block !important;
            background: #f8f9fa !important;
            -webkit-print-color-adjust: exact;
            border: 1px solid #dee2e6;
        }

        .action-buttons {
            display: none;
        }

        /* تحسين الفواصل للطباعة */
        .page-break {
            page-break-before: always;
        }
    }

    /* تصميم متجاوب */
    @media (max-width: 768px) {
        .invoice-header {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .company-info {
            text-align: center;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .products-table {
            display: block;
            overflow-x: auto;
        }

        .action-buttons {
            flex-direction: column;
            align-items: stretch;
        }

        .btn {
            justify-content: center;
        }
    }
</style>

<div class="invoice-container" id="invoice">
    <!-- رأس الفاتورة -->
    <div class="invoice-header">
        <div class="company-logo">YS</div>
        <div class="company-info">
            <h1 class="company-name">Yaka Shopping</h1>
            <p class="company-tagline">Votre boutique de confiance</p>
        </div>
    </div>

    <!-- معلومات العميل -->
    <div class="customer-info-card">
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Nom complet</span>
                <span class="info-value">{{ $order->prenom }} {{ $order->nom }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Email</span>
                <span class="info-value">{{ $order->email }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Téléphone</span>
                <span class="info-value">{{ $order->phone }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Adresse</span>
                <span class="info-value">{{ $order->adresse }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Méthode de paiement</span>
                <span class="info-value">{{ ucfirst($order->payment_method) }}</span>
            </div>
            @if($order->payment_method === 'cash')
            <div class="info-item">
                <span class="info-label">Numéro de compte bancaire</span>
                <span class="info-value">{{ $order->bank_account }}</span>
            </div>
            @endif
        </div>
    </div>

    <!-- المبلغ الإجمالي -->
    <div class="total-amount">
        <div class="total-label">Total général de la commande</div>
        <div class="total-value">{{ number_format($order->totalgenerale, 2) }} DH</div>
    </div>

    <!-- جدول المنتجات -->
    <div class="products-section">
        <h3 class="section-title">Produits achetés</h3>
        <table class="products-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Produit</th>
                    <th>Taille</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        @if(isset($product['imager']))
                        <img src="{{ asset('storage/imager/' . $product['imager']) }}" 
                             alt="Image produit" 
                             class="product-image">
                        @else
                        <div style="width:60px; height:60px; background:#f8f9fa; border-radius:8px; display:flex; align-items:center; justify-content:center; color:#6c757d;">
                            <i class="fas fa-image"></i>
                        </div>
                        @endif
                    </td>
                    <td>
                        <div class="product-title">{{ $product['title'] ?? 'N/A' }}</div>
                        <div class="product-description">{{ Str::limit($product['content'] ?? 'N/A', 50) }}</div>
                    </td>
                    <td>
                        <span class="quantity-badge">{{ $product['size'] ?? 'N/A' }}</span>
                    </td>
                    <td>
                        <span class="price-amount">{{ number_format($product['price'] ?? 0, 2) }} DH</span>
                    </td>
                    <td>
                        <span class="quantity-badge">{{ $product['quantite'] ?? 0 }}</span>
                    </td>
                    <td>
                        <span class="price-amount">{{ number_format($product['total'] ?? 0, 2) }} DH</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- رسالة الشكر (تظهر فقط عند الطباعة) -->
    <div class="thank-you-message">
        <p class="thank-you-text">
            شكراً جزيلاً على مشترياتكم، نتمنى لكم يوماً سعيداً! 🙏
        </p>
        <p style="color: #6c757d; margin-top: 10px;">
            Pour toute question, contactez-nous au {{ $order->phone }}
        </p>
    </div>

    <!-- أزرار العمل -->
    <div class="action-buttons no-print">
        <a href="{{ route('order.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Retour aux commandes
        </a>
        <button class="btn btn-success" onclick="printInvoice()">
            <i class="fas fa-print"></i>
            Imprimer la facture
        </button>
    </div>
</div>

<script>
function printInvoice() {
    // إظهار رسالة الشكر قبل الطباعة
    document.querySelector('.thank-you-message').style.display = 'block';
    
    // الانتظار قليلاً ثم الطباعة
    setTimeout(() => {
        window.print();
        
        // إخفاء رسالة الشكر بعد الطباعة
        setTimeout(() => {
            document.querySelector('.thank-you-message').style.display = 'none';
        }, 500);
    }, 100);
}

// تحميل الصور قبل الطباعة لضمان ظهورها
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.onload = function() {
            console.log('Image loaded:', img.src);
        };
    });
});
</script>
@endsection