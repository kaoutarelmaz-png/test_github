<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Yaka Shopping</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 60px 20px;
            text-align: center;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #007bff;
        }

        p {
            font-size: 18px;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .about-image {
            width: 100%;
            max-width: 1500px;
            margin: 40px auto;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .highlight {
            font-weight: 600;
            color: #007bff;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            p {
                font-size: 16px;
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
            gap: 20px;
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

        .img {
            background-color: rgb(231, 232, 233);
            width: 97.5%;
            height: auto;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .imgul {
            list-style-type: none;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .imgul li img {
            max-width: 100%;
            height: auto;
            border-radius: 20px;
        }

        .imgul li div {
            text-align: center;
        }

        .imgul li div label {
            font-size: 2.5rem;
            font-weight: 600;
            color: #333;
        }

        .imgul li div button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            border-radius: 50px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .imgul li div button:hover {
            background-color: #0056b3;
        }

        .imgul li div button:active {
            background-color: #004080;
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
    .footer-container {
        flex-direction: column;
        align-items: flex-start;
    }

    .footer-section {
        width: 100%;
    }
}


        /* Responsive Design */
        @media (max-width: 1200px) {
            .imgul {
                gap: 15px;
            }

            .imgul li div label {
                font-size: 2rem;
            }

            .footer {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 768px) {
            .navbar ul {
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }

            .rechercher {
                width: 150px;
            }

            .imgul {
                flex-direction: column;
                gap: 20px;
            }

            .imgul li img {
                width: 80%;
            }

            .imgul li div label {
                font-size: 1.8rem;
            }

            .footer {
                font-size: 1rem;
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            .navbar ul li a {
                font-size: 14px;
            }

            .rechercher {
                width: 120px;
                font-size: 12px;
            }

            .imgul li div label {
                font-size: 1.5rem;
            }

            .imgul li div button {
                padding: 8px 16px;
                font-size: 14px;
            }

            .footer {
                font-size: 0.9rem;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
<div class="navbar">
        <ul>
            <li style="font-weight:bold"><a href="/">Home</a></li>
            <li><a href="{{ route('home.create') }}">About</a></li>
            <li><a href="{{ route('shop.index') }}">Shop</a></li>
            <li><a href="{{ route('comments.create') }}">Contact Us</a></li>
            <li><a href="{{ route('login.index') }}">Login</a></li>
            <li><img src="{{ Storage::url(path: 'imager/yk.png') }}" alt="Logo"></li>
            <li><input type="text" class="rechercher" placeholder="🔎 Search"  disabled></li>
            <li><a href="{{ route('shop.index') }}" class="cart-icon">🛒</a></li>
        </ul>
    </div>
    <div class="container">
        <h1>About Yaka Shopping</h1>
        <p>
            Welcome to <span class="highlight">Yaka Shopping</span>, the ultimate destination where 
            <strong>Moroccan tradition</strong> meets <strong>modern fashion</strong>.
        </p>
        <p>
            Founded with a passion for style and cultural identity, we offer a curated selection of 
            men’s and women’s clothing that blends elegance with authenticity.
        </p>
        <img src="{{ Storage::url('imager/site.png') }}" alt="About Us" class="about-image">
        <p>
            Our mission is simple: provide quality, trust, and fashion that connects you to your roots. 
            With secure shopping and reliable delivery, we serve clients across Morocco and abroad.
        </p>
        <p>
            Thank you for trusting <span class="highlight">Yaka</span>. Your journey with us just started!
        </p>
    </div>
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
</body>
</html>
