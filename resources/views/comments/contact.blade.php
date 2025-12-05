<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Contact Us · Bootstrap v5.3</title>

    <!-- إضافة ملف CSS المحلي -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">

    <style>
       body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            color: #333;
        }
        .navbar {
          background-color:rgb(3, 38, 73) !important;
           

        }
        .navbar-brand, .nav-link {
            color: white !important;
            font-weight: bold;
        }

        .nav-link:hover {
            color: #d4edda !important;
        }
      .contact-section {
        padding: 60px 0;
      }

      .contact-form {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 30px;
        background-color: #f8f9fa;
      }

      .contact-info {
        margin-top: 50px;
      }

      .contact-info h4 {
        margin-bottom: 20px;
      }

      .contact-info p {
        font-size: 1rem;
        color: #6c757d;
      }

      .map-container {
        margin-top: 50px;
        height: 400px;
        border-radius: 10px;
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
        .imgul{
            width: 5%;
            height: auto;
            border-radius: 20px;
        }
    </style>
  </head>

  <body>
    <!-- Navigation Menu -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <img src="{{ Storage::url('imager/yk.png') }}" class="imgul">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('shop.index') }}">Shop</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login.index') }}">login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#contact">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Contact Section -->
      <!-- Display Success Message -->
  @if(session('success'))
          <div class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>
        @endif
    <div id="contact" class="contact-section">
      <div class="container">
        <h2 class="text-center mb-4">Contact Us</h2>
        <p class="lead text-center">We'd love to hear from you. Please reach out with any questions or feedback.</p>

        <!-- Contact Form -->
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="contact-form">
              <h4>Get in Touch</h4>
              <form action="{{ route('comments.index') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label">Your Name</label>
                  <input type="text" class="form-control" name='name' id="name" placeholder="Enter your name" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Your Email</label>
                  <input type="email" class="form-control" name='email' id="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                  <label for="message" class="form-label">Your Message</label>
                  <textarea class="form-control" name='messager' id="message" rows="4" placeholder="Your message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
              </form>
            </div>
          </div>
        </div>

        <!-- Contact Info -->
        <div class="contact-info text-center">
          <h4>Contact Information</h4>
          <p><strong>Address:</strong> 1234 Street Name, City, Country</p>
          <p><strong>Phone:</strong> +123 456 7890</p>
          <p><strong>Email:</strong> Yaka_Shopping@gmail.com</p>
        </div>

        <!-- Map -->
        <div class="map-container">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2949.705760689831!2d-2.9235261!3d35.1464623!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd77a7cf5946705b%3A0xd47446650be9d0fc!2sOFPPT%20ISTA%20Nador!5e0!3m2!1sen!2sin!4v1655088661353!5m2!1sen!2sin" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>

    <!-- Footer -->
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

    <!-- إضافة ملف JS المحلي -->
  </body>
</html>
