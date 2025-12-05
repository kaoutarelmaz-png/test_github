<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yaka Shopping - Professional Design</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reset */
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }

        /* Typography */
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: #f9f9f9; 
            color: #333;
            line-height: 1.6;
        }

        /* Top Bar */
        #top-bar {
            position: fixed;
            top: 0;
            width: 100%;
            height: 50px;
            background:black;
            color:white;
            display: flex;
            justify-content: space-around;
            align-items: center;
            font-weight: bold;
            z-index: 1000;
            font-size: 15px;
        }
        #top-bar i { margin-right: 8px; }

        /* Truck Animation */
        @keyframes truckMove {
            0% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            100% { transform: translateX(-5px); }
        }
        .truck { display: inline-block; animation: truckMove 2s linear infinite; }

        /* Sidebar Toggle Icon */
        #sidebarToggle {
            position: fixed;
            top: 10px;
            left: 10px;
            font-size: 28px;
            color: #fff;
            cursor: pointer;
            z-index: 1100;
            transition: transform 0.3s;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 50px;
            left: -280px;
            width: 280px;
            height: calc(100% - 50px);
            background: #fff;
            color: #333;
            padding-top: 20px;
            box-shadow: 2px 0 15px rgba(0,0,0,0.1);
            transition: left 0.3s ease;
            z-index: 1050;
            border-right: 1px solid #e0e0e0;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            color: #555;
            padding: 15px 25px;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s;
            border-bottom: 1px solid #f0f0f0;
        }
        .sidebar a:hover {
            background: #f5f5f5;
            padding-left: 35px;
            color: #333;
        }
        .sidebar a i { margin-right: 10px; width: 20px; text-align: center; color: #777; }
        .sidebar h3 {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
            color: #444;
            font-weight: 600;
        }

        /* Navbar */
        .navbar {
            margin-top: 50px;
            background-color: #314e5810;
            display: flex;
            align-items: center;
            padding: 15px;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .logo-container {
            display: flex;
            align-items: center;
        }
        .logo {
            width: 50px;
            height: 50px;
            background: #777;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 20px;
            margin-right: 15px;
        }
        .logo-text { font-size: 24px; font-weight: 700; color: #444; }
        .navbar ul {
            display: flex;
            list-style: none;
            flex-wrap: wrap;
        }
        .navbar ul li { margin: 0 5px; font-weight: 500; }
        .navbar ul li a {
            color: #333131ff;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 4px;
            transition: all 0.3s;
            font-size: 15px;
            font-weight: bold;
        }
        .navbar ul li a:hover { color: #09b0dfff; }

        /* Content */
        .content {
            margin-top: 50px;
            transition: margin-left 0.3s ease;
        }

        .sidebar-open .content { margin-left: 280px; }
        @media (max-width: 768px) { .sidebar-open .content { margin-left: 0; } }

        .container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            padding: 40px;
            margin-top: 30px;
            min-height: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 2px dashed #e0e0e0;
        }
        .container h2 { color: #777; font-weight: 500; margin-bottom: 15px; text-align: center; }
        .container p { color: #999; text-align: center; max-width: 500px; }

        /* Footer */
        footer {
            background:black;
            padding: 40px 20px;
            margin-top: 50px;
            border-top: 1px solid #e0e0e0;
            text-align: center;
            color: #666;
        }
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            text-align: left;
        }
        .footer-section h3 { color:#fff; margin-bottom: 20px; font-weight: bold; }
        .footer-section p, .footer-section a { color:white; margin-bottom: 10px; display: block; text-decoration: none; transition: color 0.3s; }
        .footer-section a:hover { color: #444; }

        footer .copyright {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            color: white;
            font-size: 14px;
            line-height: 1.5;
        }
        .footer-section.social-logo { text-align: center; }
        .footer-section .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 15px;
        }
        .footer-section .social-icons a img {
            transition: transform 0.3s, opacity 0.3s;
        }
        .footer-section .social-icons a img:hover {
            transform: scale(1.2);
            opacity: 0.8;
        }
        .footer-section .site-logo img {
            display: block;
            margin: 0 auto;
            margin-top: 5px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar { flex-direction: column; align-items: flex-start; }
            .navbar ul { flex-direction: column; width: 100%; margin-top: 15px; display: none; }
            .navbar.active ul { display: flex; }
            .navbar ul li { margin: 5px 0; width: 100%; }
            .navbar ul li a { display: block; text-align: left; }
            #top-bar { font-size: 13px; }
            .sidebar { width: 220px; }
                #sidebarToggle {
                top: 38px; /* النزول قليلاً */
                font-size: 26px; /* تصغير قليل للأيقونة إذا أحببت */
                color:#fff;
                background-color: #444;
            }
                .logo-container {
        display: none; /* إخفاء الشعار على الشاشات الصغيرة */
    }
        }
        @media (max-width: 480px) {
            .footer-content { grid-template-columns: 1fr; text-align: center; }
            .logo-text { font-size: 20px; }
            .sidebar { width: 200px}
        }

        /* Images responsive */
        img, .logo, .container { max-width: 100%; height: auto; }

    </style>
</head>
<body>

    <!-- Top Bar -->
    <div id="top-bar">
        <div><i class="fas fa-truck truck"></i> Free Shipping</div>
        <div><i class="fas fa-shield-alt"></i> Warranty</div>
        <div><i class="fas fa-phone"></i> Contact: 07704888221</div>
    </div>

    <!-- Sidebar Toggle -->
    <div id="sidebarToggle"><i class="fas fa-bars"></i></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h3>Yaka Shopping</h3>
        <a href="#"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
        <a href="{{route('men.index')}}"><i class="fa fa-male"></i> Men's Products</a>
        <a href="{{route('women.index')}}"><i class="fa fa-female"></i> Women's Products</a>
        <a href="{{route('shop.index')}}"><i class="fa fa-box"></i> Products</a>
        <a href="#"><i class="fa fa-percentage"></i> Offers</a>
        <a href="{{route('user.create')}}"><i class="fa fa-user"></i> My Account</a>
        <a href="#"><i class="fa fa-cog"></i> Settings</a>
    </div>

    <!-- Navbar -->
    <div class="navbar">
        <div class="logo-container">
            <div class="logo">YS</div>
            <div class="logo-text">Yaka Shopping</div>
        </div>
        <ul>
            <li><a href="/" class="active">Home</a></li>
            <li><a href="{{ route('home.create') }}">About</a></li>
            <li><a href="{{ route('comments.create') }}">Contact Us</a></li>
            <li><a href="{{ route('user.create') }}">Login</a></li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Store</h3>
                <p>Yaka Shopping is your favorite store for buying the latest fashion and clothing trends. We provide high quality products at affordable prices for everyone.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <a href="/">Home</a>
                <a href="{{ route('home.create') }}">About</a>
                <a href="{{route('shop.index')}}">Shop</a>
                <a href="{{ route('comments.create') }}">Contact Us</a>
            </div>
            <div class="footer-section">
                <h3>Contact Information</h3>
                <p><i class="fas fa-map-marker-alt"></i> Baghdad, Iraq</p>
                <p><i class="fas fa-phone"></i> 07704888221</p>
                <p><i class="fas fa-envelope"></i> info@yaka-shopping.com</p>
            </div>
            <div class="footer-section social-logo">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="#" target="_blank"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook" width="30"></a>
                    <a href="#" target="_blank"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram" width="30"></a>
                    <a href="#" target="_blank"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter" width="30"></a>
                    <a href="#" target="_blank"><img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="LinkedIn" width="30"></a>
                    <a href="#" target="_blank"><img src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png" alt="YouTube" width="30"></a>
                </div>
                <div class="payment-icons" style="display: flex; gap: 10px; justify-content: center;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg" alt="Visa" width="50">
                    <img src="https://cdn-icons-png.flaticon.com/512/179/179457.png" alt="MasterCard" width="50">
                    <img src="https://cdn-icons-png.flaticon.com/512/179/179446.png" alt="PayPal" width="50">
                    <img src="https://cdn-icons-png.flaticon.com/512/888/888870.png" alt="Apple Pay" width="50">
                </div>
            </div>
        </div>
        <div class="copyright">
            &copy; 2023 Yaka Shopping. All rights reserved.
        </div>
    </footer>

    <script>
        const toggleBtn = document.getElementById("sidebarToggle");
        const sidebar = document.getElementById("sidebar");

        toggleBtn.addEventListener("click", () => {
            sidebar.style.left = (sidebar.style.left === "0px") ? "-280px" : "0px";
            document.body.classList.toggle("sidebar-open");
            document.querySelector(".navbar").classList.toggle("active");
        });

        // Close sidebar when clicking outside
        document.addEventListener("click", (e) => {
            if(!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                sidebar.style.left = "-280px";
                document.body.classList.remove("sidebar-open");
                document.querySelector(".navbar").classList.remove("active");
            }
        });
    </script>

</body>
</html>
