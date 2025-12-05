<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
        }

        /* Sidebar يبقى ممتدًا من الأعلى للأسفل */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #343a40;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            font-size: 16px;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background: #495057;
        }

        .sidebar i {
            margin-right: 10px;
        }

        /* لجعل المحتوى يتحرك قليلاً لليمين */
        .content {
            margin-left: 45%;
            /* text-align: center; */
            padding: 20px;
        }

        /* تحريك شريط التنقل نحو اليمين */
        .navbar {
            position: fixed;
            top: 0;
            left: 270px;
            right: 0;
            display: flex;
            justify-content: center;
            background: white;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar ul {
            list-style-type: none;
            display: flex;
            align-items: center;
            gap: 50px;
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

        /* تصميم النموذج */
        .container {
            width: 100%;
            margin: 100px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .img-preview {
            width: 100%;
            max-height: 250px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center">Edit Panel</h4>
        <a href="#dashboard"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
        <a href="#products"><i class="fa fa-box"></i> Products</a>
        <a href="#orders"><i class="fa fa-shopping-cart"></i> Orders</a>
        <a href="{{ route('men.create') }}"><i class="fa fa-users"></i> Create Men</a>
        <a href="#users"><i class="fa fa-users"></i> Create Women</a>
        <a href="#settings"><i class="fa fa-cog"></i> Settings</a>
        <a href="{{ route('admin.create') }}" class="text-danger"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Navbar -->
    <div class="navbar">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="{{ route('login.index') }}">Login</a></li>
            <li><img src="{{ Storage::url('imager/yk.png') }}" alt="Logo"></li>
            <li><input type="text" class="rechercher" placeholder="🔎 Search" disabled></li>
            <li><label  class="cart-icon" disabled>🛒</label></li>
        </ul>
    </div>

    <!-- Form Container -->
    <div class="content">
        <div class="container">
            <h2 class="text-center mb-4">Edit Product</h2>
            <form action="{{ route('carte.update', $edits->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group text-center">
                    <label>
                    <img src="{{ Storage::url('imager/'.$edits->imager) }}" class="img-preview">
                    </label>
                </div>

                <div class="form-group">
                    <label class="fw-bold">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $edits->title }}" disabled>
                </div>

                <div class="form-group">
                    <label class="fw-bold">Content</label>
                    <textarea name="content" class="form-control" rows="3" disabled>{{ $edits->content }}</textarea>
                </div>

                <div class="form-group">
                    <label class="fw-bold">Price</label>
                    <input type="number" name="price" class="form-control" value="{{ $edits->price }}" disabled>
                </div>
                <div class="form-group">
                    <label class="fw-bold">Quantite</label>
                    <input type="number" name="stock" class="form-control" value="{{ $edits->quantite }}" required min="1">
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-3">Save Changes</button>
            </form>
        </div>
    </div>

</body>
</html>
