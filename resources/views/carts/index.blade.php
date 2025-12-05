<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f4f8;
            margin: 0;
            /* padding: 20px; */
            color: #333;
        }

        .cart-container {
            max-width: 1000px;
            margin: 14px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 16px;
            text-align: center;
        }

        th {
            background-color: #0056b3;
            color: white;
            font-size: 15px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        td img {
            width: 70px;
            border-radius: 10px;
        }

        .total-price {
            font-weight: bold;
            color: #0069d9;
        }

        .btn {
            padding: 8px 14px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }

        .btn-modifier {
            background-color: #ffc107;
            color: #212529;
            text-decoration: none;
        }

        .btn-modifier:hover {
            background-color: #e0a800;
        }

        .btn-supprimer {
            background-color: #e74c3c;
            color: white;
        }

        .btn-supprimer:hover {
            background-color: #c0392b;
        }

        .checkout-btn {
            width: 100%;
            background: #28a745;
            color: white;
            font-size: 18px;
            padding: 14px;
            border: none;
            border-radius: 8px;
            margin-top: 30px;
            cursor: pointer;
            transition: 0.3s;
        }

        .checkout-btn:hover {
            background: #218838;
        }

        .payment-section {
            margin-top: 35px;
            background-color: #0056b3;
            padding: 30px;
            border-radius: 10px;
        }

        .payment-section label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: white;
        }

        .payment-section input,
        .payment-section select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        h1 {
            margin-top: 40px;
            font-size: 24px;
            color: #444;
        }

                .navbar {
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
        }

        .navbar ul {
            list-style-type: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap:100px;
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            display: flex;
            align-items: center;
        }

        .navbar ul li a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .navbar ul li a:hover {
            color: #007bff;
        }

        .navbar ul li img {
            width: 70px;
            height: auto;
        }
    .rechercher {
                border-radius: 50px;
                width: 200px;
                height: 30px;
                font-size: 14px;
                text-align: left;
                padding: 5px 15px;
                border: 1px solid #ddd;
                outline: none;
                transition: border-color 0.3s ease;
            }

                .rechercher::placeholder {
                    color: #999;
                    font-size: 14px;
                }

                .rechercher:focus {
                    border-color: #007bff;
                }
                @media (max-width: 768px) {
                    table, thead, tbody, th, td, tr {
                        display: block;
                    }

                    thead tr {
                        display: none;
                    }

                    td {
                        position: relative;
                        padding-left: 50%;
                        margin-bottom: 10px;
                    }

                    td:before {
                        content: attr(data-label);
                        position: absolute;
                        left: 15px;
                        font-weight: bold;
                    }

                    .checkout-btn {
                        font-size: 16px;
                        padding: 12px;
                    }
                }

                @media (max-width: 1024px) {
            .navbar ul {
                gap: 40px;
                flex-wrap: wrap;
                justify-content: center;
            }
            .sidebar {
                width: 100%;
                left: -100%;
            }
            .sidebar.active {
                left: 0;
            }
            .sidebar.active ~ #menu {
                left: 100%;
                width: 0;
            }
            .sidebar.active ~ #menu ~ .content {
                margin-left: 0;
            }
        }

        /* للأجهزة الصغيرة جدًا (أقل من 480px) */
        @media (max-width: 480px) {
            .navbar ul {
                gap: 10px;
            }
            .card img {
                width: 100px;
                height: 100px;
            }
            .product-details h1 {
                font-size: 24px;
            }
            .product-details .price {
                font-size: 20px;
            }
            .buy-button,
            .btnAnnuler {
                font-size: 16px;
                padding: 10px 20px;
            }}
        /* Responsive */
            @media (max-width: 768px) {
        .navbar ul {
            flex-direction: row; /* اجبرها تبقى أفقية */
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

            .footer-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .rechercher {
                width: 100%;
                max-width: 300px;
            }
            #tt{
                margin-left: 50px;
            }
            #menu{
                margin-left: -10px;
            }
            }
                    /* القائمة الجانبية */
            .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: -280px; /* مخفية في البداية */
            /* background-color: rgba(245, 245, 1006, 5); */
            background-color: #0f6dd1ff;
            color: white;
            transition: left 0.3s ease;
            z-index: 1000;
            padding-top: 60px; /* لتفادي الشريط العلوي */
            }
            .sidebar.active {
            left: 0;
            }
            .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
            font-weight: bold;
            }
            .sidebar a:hover {
            background: #495057;
            }

            /* الشريط العلوي */
            #menu {
            height: 50px;
            display: flex;
            align-items: center;
            padding-left: 10px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1002;
            transition: left 0.3s ease, width 0.3s ease;
            }
            /* تحريك الشريط العلوي عند ظهور القائمة */
            .sidebar.active ~ #menu {
            left: 280px;
            width: calc(100% - 280px);
            }

            /* زر القائمة */
            .menu-toggle {
            font-size: 24px;
            cursor: pointer;
            background: none;
            border: none;
            color: black;
            font-weight: bold;
            }

            /* المحتوى */
            .content {
            padding: 80px 20px 20px 20px;
            transition: margin-left 0.3s ease;
            margin-left: 0;
            }
            /* تحريك المحتوى عند ظهور القائمة */
            .sidebar.active ~ #menu ~ .content {
            margin-left: 280px;
            }

            #img {
            width: 20%;
            border-radius: 80%;
            }
            h1{
                font-weight: bold;
            }
            #ve{
                width: 15%;
                border-radius: 50%;
            }
            #post {
            position: absolute;
            bottom: 20px;
            left: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            }
            #logout-icon {
        margin-left: 8px;
        color: white;
        text-decoration: none;
        font-size: 20px;
        cursor: pointer;
        background: none;
        }
        .sidebar h4{
            background: #030254ff;
            font-size: 25px;
            text-align: center;
        }
        #btn_menu{
            margin-top: -20px;
        }

            /*---------------------------------------------------------------------------- */

                .footer {
            background-color:rgb(3, 38, 73);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .footer-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 50px;
            max-width: 1200px;
            margin: auto;
        }

        .footer-section {
            flex: 1 1 220px;
            min-width: 220px;
        }

        .footer-section span {
            font-size: 25px;
            font-weight: bold;
            color: red;
        }

        .footer-section p,
        .footer-section a {
            font-size: 14px;
            color: white;
            text-decoration: none;
        }

        .footer-section a:hover {
            text-decoration: underline;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-section ul li {
            margin: 5px 0;
        }
        .form-group {
            display: flex;
            gap: 50px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .form-group > div {
            flex: 1 1 45%;
            min-width: 200px;
        }

        @media (max-width: 768px) {
            .form-group > div {
                flex: 1 1 100%;
            }
        }

    </style>
</head>
<body>
                  <!-- القائمة الجانبية -->
  <div class="sidebar" id="sidebar">
     <div id="btn_menu"><button class="menu-toggle" onclick="toggleSidebar()" style="color:red;padding:2%">☰</button></div>
    <h4 class="text-center" style="font-weight: bold;">
      Hello, Yaka_Shopping
    </h4>
    <a href="#"><i class="fa fa-tachometer-alt"></i> Dashboard</a><br/>
    <a href="#"><i class="fa fa-box"></i> Men</a><br/>
    <a href="#"><i class="fa fa-shopping-cart"></i> Woman</a><br/>
    <a href="#"><i class="fa fa-cog"></i> Paramètres</a>

    <div class="email-display text-center" style="margin-top: 10px; color: #ddd;">
</div>
  </div>
<div class="navbar">
         <ul>
            <li>    
                <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
            </li>
            <li><a href="/">Home</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="{{ route('home.create') }}">About</a></li>
            <li><a href="{{ route('comments.create') }}">Contact Us</a></li>
            <li><a href="{{ route('login.index') }}">Login</a></li>
            <li><img src="{{ Storage::url('imager/yk.png') }}" alt="Logo"></li>

        </ul>
    </div>
<div class="cart-container">
    <h2>🛍️ Panier d'Achat</h2>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">Close</button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul style="text-align: left;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">Close</button>
    </div>
@endif

    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Titre</th>
                <th>Content</th>
                <th>Size</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Total</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts as $cart)
                <tr>
                    <td>
                        <img src="{{ Storage::url('imager/'.$cart->imager) }}" alt="Product Image">
                    </td>
                    <td>{{ $cart->title }}</td>
                    <td>{{ $cart->content }}</td>
                    <td>{{ $cart->size }}</td>
                    <td>${{ number_format($cart->price, 2) }}</td>
                    <td>{{ $cart->quantite }}</td>
                    <td class="total-price">${{ number_format($cart->Total, 2) }}</td>
                    <td>
                        <a href="{{ route('carte.edit',$cart->id) }}" class="btn btn-modifier">✏️ Modifier</a>
                    </td>
                    <td>
                        <form action="{{ route('carte.destroy', $cart->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-supprimer">🗑️ Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <h1>💰 Montant Total: {{ number_format($Totalgeneral, 2) }} $</h1>

    <!-- Formulaire de commande séparé -->
    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        <!-- Champs cachés pour les données du panier -->
        @foreach ($carts as $cart)
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <input type="hidden" name="products[{{ $cart->id }}][imager]" value="{{ $cart->imager }}">
            <input type="hidden" name="products[{{ $cart->id }}][title]" value="{{ $cart->title }}">
            <input type="hidden" name="products[{{ $cart->id }}][content]" value="{{ $cart->content }}">
            <input type="hidden" name="products[{{ $cart->id }}][size]" value="{{ $cart->size}}">
            <input type="hidden" name="products[{{ $cart->id }}][price]" value="{{ $cart->price }}">
            <input type="hidden" name="products[{{ $cart->id }}][quantite]" value="{{ $cart->quantite }}">
            <input type="hidden" name="products[{{ $cart->id }}][total]" value="{{ $cart->Total }}">
        @endforeach
        <input type="hidden" name="totalgenerale" value="{{ $Totalgeneral }}">

 <!-- Informations client -->
<div class="payment-section">
    <div class="form-group">
        <div>
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" placeholder="Votre nom" required>
        </div>
        <div>
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" placeholder="Votre prénom" required>
        </div>
    </div>
    <div class="form-group">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Votre email" required>
        </div>
        <div>
            <label for="adresse">Adresse:</label>
            <input type="text" id="adresse" name="adresse" placeholder="Votre adresse" required>
        </div>
    </div>
    <div class="form-group">
        <div>
            <label for="phone">Téléphone:</label>
            <input type="text" id="phone" name="phone" placeholder="Votre phone" required>
        </div>
        <div>
             <label for="paymentMethod">Méthode de paiement:</label>
            <select id="paymentMethod" onchange="handlePaymentChange()" name="payment_method">
                <option value="delivery">🚚 Livraison</option>
                <!-- <option value="cash">💳 Paiement en espèces</option> -->
            </select>
        </div>
    </div>
</div>
<!-- 
Méthode de paiement
<div class="payment-section">
    <div class="form-group">
        <div id="bankInfo" style="display: none;">
            <label for="bankAccount">Numéro de compte bancaire:</label>
            <input type="text" id="bankAccount" name="bank_account" placeholder="Ex: 1234 5678 9012 3456">
        </div>
    </div>
</div> -->

<button type="submit" class="checkout-btn">🛒 Passer la commande</button>

    
</div>
    <!--------------------------------Footer------------------------------------------------->
    <div class="footer">
    <div class="footer-container">
        <div class="footer-section slogan">
            <span>Yaka: Moroccan Tradition, Modern Innovation!</span>
            <p>&copy; 2025 Yaka_Shopping. All Rights Reserved. Last updated: March 2025.</p>
        </div>

        <div class="footer-section contact-info">
            <p><strong>Contact Us:</strong></p>
            <p>Phone: +123 456 789</p>
            <p>Email: Yaka_Shopping@gmail.com</p>
        </div>

        <div class="footer-section quick-links">
            <p><strong>Quick Links:</strong></p>
            <ul>
                <li><a href="privacy.html">Privacy Policy</a></li>
                <li><a href="terms.html">Terms of Service</a></li>
                <li><a href="faq.html">FAQ</a></li>
            </ul>
        </div>

        <div class="footer-section social-links">
            <p><strong>Follow Us:</strong></p>
            <a href="https://facebook.com/mediflora">Facebook</a><br>
            <a href="https://twitter.com/mediflora">Twitter</a><br>
            <a href="https://instagram.com/mediflora">Instagram</a>
        </div>
    </div>
<script>
    function handlePaymentChange() {
        const method = document.getElementById('paymentMethod').value;
        const bankDiv = document.getElementById('bankInfo');
        bankDiv.style.display = (method === 'cash') ? 'block' : 'none';
    }
</script>
<script src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
  <script>
    function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('active');
    }
  </script>
</body>
</html>