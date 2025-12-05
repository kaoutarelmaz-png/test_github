<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <style>
        /* Resetting margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }

        .product-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }

        .product-image {
            flex: 1;
            max-width: 600px;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .product-details {
            flex: 1;
            padding-left: 30px;
            text-align: center;
        }

        .product-details h1 {
            font-size: 32px;
            color: #333;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .product-details p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .product-details .price {
            font-size: 24px;
            color: #007bff;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .buy-button {
            background-color: #007bff;
            color: white;
            font-size: 18px;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .buy-button:hover {
            background-color:rgb(202, 183, 8);
        }
        .btnAnnuler{
            background-color:rgb(255, 0, 0);
            color: white;
            font-size: 18px;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }
        /* Media Query for responsiveness */
        @media (max-width: 768px) {
            .product-container {
                flex-direction: column;
                align-items: center;
                padding: 20px;
            }

            .product-image {
                max-width: 100%;
                margin-bottom: 20px;
            }

            .product-details {
                padding-left: 0;
                text-align: center;
            }
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

        .cart-icon {
            font-size: 20px;
            color: #333;
            transition: color 0.3s ease;
        }

        .cart-icon:hover {
            color: #007bff;
        }
        quantity-box {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 15px 0;
        }

        .quantity-box input {
            width: 60px;
            text-align: center;
            font-size: 16px;
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 5px;
        }

        .quantity-box button {
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 18px;
            padding: 5px 12px;
            cursor: pointer;
            border-radius: 6px;
            transition: 0.3s;
        }

        .quantity-box button:hover {
            background-color: #0056b3;
        }
        .cart-icon {
    position: relative;
    font-size: 24px;
    color: #333;
    transition: color 0.3s ease;
}

.cart-icon:hover {
    color: #007bff;
}

.cart-count {
    position: absolute;
    top: -8px; /* رفع الرقم إلى أعلى */
    right: -8px; /* تحريك الرقم إلى اليمين */
    background-color: red; /* لون الخلفية */
    color: white; /* لون الرقم */
    border-radius: 50%; /* جعل الرقم دائري */
    width: 20px; /* عرض الرقم */
    height: 20px; /* ارتفاع الرقم */
    font-size: 12px; /* حجم الخط */
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}
.container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 40px;
    justify-content: center;
}

.card {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 200px;
    text-align: center;
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.card h1 {
    font-size: 20px;
    color: #333;
    margin-bottom: 10px;
}

.card p {
    font-size: 14px;
    color: #555;
    margin-bottom: 10px;
}

.card .price {
    font-size: 18px;
    color: #007bff;
    font-weight: bold;
    margin-bottom: 10px;
}
.card img{
    width: 150px;
    height: 150px;
}

/* 1. أجهزة التابلت: من 768px إلى 1024px */
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

  .product-container {
    flex-direction: column;
    align-items: center;
  }

  .product-details {
    padding-left: 0;
  }

  .product-image {
    max-width: 100%;
    margin-bottom: 20px;
  }
}
/* 3. الشاشات الصغيرة جداً: أقل من 480px */
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
  }

  .rechercher {
    width: 100%;
  }

  .sidebar h4 {
    font-size: 20px;
  }

  #ve {
    width: 30%;
  }

  #img {
    width: 40%;
  }
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
#btn_menu{
    margin-top: -30px;
}
    </style>
</head>
<body>
              <!-- القائمة الجانبية -->
  <div class="sidebar" id="sidebar">
     <div id="btn_menu"><button class="menu-toggle" onclick="toggleSidebar()" style="color:red;padding:10%">☰</button></div>
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
            <li><input type="text" class="rechercher" placeholder="🔎 Search"></li>
            <li> <a href="{{ route('carte.index') }}" class="cart-icon">
        🛒
        @if(isset($counts) && $counts > 0)
            <span class="cart-count">{{ $counts }}</span>
        @endif
    </a></li>
        </ul>
    </div><br/><br/><br/>
    <form action="{{ route('carte.index') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="product-container">
            <!-- Image on the left -->
            <div>
                <img src="{{ Storage::url('imager/').$womans->imager }}" width="250px" alt="Product Image" class="product-image">
            </div>
            <!-- Product details on the right -->
            <div class="product-details">
                <input type="hidden" name="IDwomen" value="{{ $womans->id }}">        
                <h1>{{ $womans->title }}</h1>
                <p>{{ $womans->content }}</p>
                <div class="price">${{ $womans->price }}</div>
                <div class="size">{{ $womans->size }}</div>
                <div class="quantity-box">
                    <button type="button" onclick="decreaseQuantity()">-</button>
                    <input type="number" name="quantite" id="quantite" value="1" min="1">
                    <button type="button" onclick="increaseQuantity()">+</button>
                </div>
                <br/>
                
                <button type='submit' class="buy-button">Add to Cart</button>
                <a href="{{ route('women.index') }}"  class="btnAnnuler">Annuler</a>
                </div>
        </div>
                <div class="container">
    @foreach($menssse as $mensssesse)
        <a href="{{ route('women.show', $mensssesse->id) }}" style="text-decoration: none;">
            <div class="card">
                 <img src="{{ Storage::url('imager/').$mensssesse->imager }}" alt="Product Image" class="product-image">
                <h1>{{ $mensssesse->title }}</h1>
                <p>{{ $mensssesse->content }}</p>
                <div class="price">${{ $mensssesse->price }}</div>
                <div class="price">{{ $mensssesse->size }}</div>
            </div>
        </a>
    @endforeach
</div>
    </form>
    <script>
    function decreaseQuantity() {
        let input = document.getElementById('quantite');
        if (input.value > 1) {
            input.value--;
        }
    }

    function increaseQuantity() {
        let input = document.getElementById('quantite');
        input.value++;
    }
</script>
  <script>
    function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('active');
    }
  </script>
</body>
</html>
