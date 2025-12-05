<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
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
            gap: 95px;
            /* margin: 0; */
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

        .cart-icon {
            font-size: 20px;
            color: #333;
            transition: color 0.3s ease;
        }

        .cart-icon:hover {
            color: #007bff;
        }

        .product-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 15px;
            width: 250px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-card .product-info {
            padding: 15px;
        }

        .product-card .product-info h4 {
            font-size: 18px;
            color: #333;
            font-weight: 600;
            margin: 10px 0;
        }

        .product-card .product-info p {
            font-size: 14px;
            color: #777;
        }

        .product-card .product-info .price {
            font-size: 16px;
            font-weight: 600;
            color: #007bff;
            margin-top: 10px;
        }

        .product-card .add-to-cart {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 0 0 8px 8px;
        }

        .product-card .add-to-cart:hover {
            background-color:rgb(235, 9, 9);
        }

        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
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
      background-color: rgba(245, 245, 1006, 5);
      color: white;
      transition: left 0.3s ease;
      z-index: 1000;
      padding-top: 60px; /* لتفادي الشريط العلوي */
    }
    .sidebar.active {
      left: 0;
    }
    .sidebar a {
      color: black;
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
    </style>
</head>
<body>
      <!-- القائمة الجانبية -->
  <div class="sidebar" id="sidebar">
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
    <!-----------------navbar---------------------->
  <div class="navbar">
      <div id="menu">
    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
  </div>
    <ul>
        <li></li>
            <li><a href="/">Home</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="{{ route('home.create') }}">About</a></li>
            <li><a href="{{ route('comments.create') }}">Contact Us</a></li>
            <li><a href="{{ route('login.index') }}">Login</a></li>
            <li><img src="{{ Storage::url('imager/yk.png') }}" alt="Logo"></li>
            <li><input type="text" class="rechercher" placeholder="🔎 Search"></li>
            <li>🛒</li>
        </ul>
    </div>

    <h1>Page Shop</h1>

    <div class="product-grid">
        @foreach ($shops as $shop)
            <div class="product-card">
                <img src="{{ Storage::url('imager/'.$shop->imager) }}" alt="{{ $shop->title }}">
                <div class="product-info">
                    <h4>{{ $shop->title }}</h4>
                    <p>{{ $shop->content }}</p>
                    <div class="price">${{ $shop->price }}</div>
                    <a href="{{ route('shop.show',$shop->id) }}"><button class="add-to-cart">More</button></a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="footer">
    <div class="footer-container">
        <div class="footer-section slogan">
            <span>Yaka: Moroccan Tradition, Modern Innovation!</span>
            <p>&copy; 2025 Yaka_Shopping. All Rights Reserved. Last updated: March 2025.</p>
        </div>

        <div class="footer-section contact-info" id="tt">
            <p><strong>Contact Us:</strong></p>
            <p>Phone: +123 456 789</p>
            <p>Email: Yaka_Shopping@gmail.com</p>
        </div>

        <div class="footer-section quick-links"  id="tt">
            <p><strong>Quick Links:</strong></p>
            <ul>
                <li><a href="privacy.html">Privacy Policy</a></li>
                <li><a href="terms.html">Terms of Service</a></li>
                <li><a href="faq.html">FAQ</a></li>
            </ul>
        </div>

        <div class="footer-section social-links"  id="tt">
            <p><strong>Follow Us:</strong></p>
            <a href="https://facebook.com/mediflora">Facebook</a><br>
            <a href="https://twitter.com/mediflora">Twitter</a><br>
            <a href="https://instagram.com/mediflora">Instagram</a>
        </div>
    </div>
</div>
  <script>
    function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('active');
    }
  </script>
</body>
</html>
