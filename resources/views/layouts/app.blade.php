<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionStore - @yield('title', 'Boutique de vêtements')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .sidebar {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            min-height: calc(100vh - 120px);
            padding: 20px;
            border-right: 1px solid #dee2e6;
        }
        .main-content {
            padding: 20px;
            min-height: calc(100vh - 120px);
            background-color: #f8f9fa;
        }
        .action-btn {
            padding: 12px;
            text-align: center;
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 70px;
            width: 90%;
            font-size: 1rem;
            color: white;
            background: linear-gradient(135deg, #023e8a, #0077b6);
            border: none;
            margin: 0 auto 10px;
        }
        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            color: white;
        }
        .action-btn i {
            font-size: 1.2rem;
        }
        .sidebar-title {
            text-align: center;
            margin-bottom: 10px;
            color: #023e8a;
            font-weight: bold;
            border-bottom: 2px solid #023e8a;
            padding-bottom: 5px;
            margin-top: -20px;
        }
        .buttons-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0px;
        }
        
        /* Styles pour le bouton Fermer */
        .btn-danger.action-btn {
            background: linear-gradient(135deg, #dc3545, #c82333);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .buttons-grid {
                grid-template-columns: 1fr;
            }
            .action-btn {
                width: 90%;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-tshirt me-2"></i>FashionStore
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-home me-1"></i>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user me-1"></i>My Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-shopping-cart me-1"></i> Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-heart me-1"></i> Favorites</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
                    </li>
                </ul> 
           </div>
        </div>
    </nav> -->

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar avec boutons (30%) -->
            <div class="col-md-3 col-lg-3 sidebar">
                <h3 class="sidebar-title">Menu Boutique</h3>
                <div class="buttons-grid">
                    <a href="{{ route('admin.create') }}" class="btn action-btn">
                        <i class="fas fa-home"></i> Home
                    </a>
                    <a href="{{ route('order.index') }}" class="btn action-btn">
                        <i class="fas fa-shopping-bag"></i> Order
                    </a>
                    <a href="{{ route('AffcherTableShop') }}" class="btn action-btn">
                        <i class="fas fa-store"></i> Shop
                    </a>
                    <a href="{{ route('AffcherTableMen')}}" class="btn action-btn">
                        <i class="fas fa-male"></i> Men
                    </a>
                    <a href="{{ route('AffcherTableWoman')}}" class="btn action-btn">
                        <i class="fas fa-female"></i> Woman
                    </a>
                    <!-- <a href="#" class="btn action-btn">
                        <i class="fas fa-credit-card"></i> Paiements
                    </a> -->
                    <a href="{{ route('comments.index') }}" class="btn action-btn">
                        <i class="fas fa-comments"></i> Comments
                    </a>
                    <a href="{{route('inventaire.index')}}" class="btn action-btn">
                        <i class="fas fa-boxes"></i> Inventaire
                    </a>
                    <!-- <a href="#" class="btn action-btn">
                        <i class="fas fa-shipping-fast"></i> Livraison
                    </a> -->
                    <a href="{{ route('comperuser.index') }}" class="btn action-btn">
                        <i class="fas fa-star"></i>Clients
                    </a>
                    <a href="{{ route('statistiques.index') }}" class="btn action-btn">
                        <i class="fas fa-chart-bar"></i> Statistiques
                    </a>
                    <a href="{{route('market-stats')}}" class="btn action-btn">
                        <i class="fas fa-bullhorn"></i> Marketing
                    </a>
                    <!-- <a href="#" class="btn action-btn">
                        <i class="fas fa-cogs"></i> Paramètres
                    </a>
                    <a href="#" class="btn action-btn">
                        <i class="fas fa-question-circle"></i> Aide
                    </a> -->
                    <a href="{{ route('AddAdmin') }}" class="btn action-btn">
                        <i class="fas fa-user-shield"></i> Administartion
                    </a>
                    <a href="{{ route('admin.index') }}" class="btn btn-danger action-btn">
                        <i class="fas fa-times"></i> Fermer
                    </a>
                </div>
            </div>

            <!-- Contenu principal (70%) -->
            <div class="col-md-9 col-lg-9 main-content">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>