<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up</title>
  <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
  <style>
    body {
      background: linear-gradient(to right, #000428, #004e92);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .signup-form {
      background: white;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
      max-width: 500px;
      width: 100%;
    }

    .signup-form h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    .hint-text {
      text-align: center;
      margin-bottom: 20px;
      color: #777;
    }

    .form-control {
      border-radius: 10px;
    }

    .btn-success {
      border-radius: 10px;
      font-size: 18px;
      background-color: #2575fc;
      border: none;
    }

    .btn-success:hover {
      background-color: #1a5edb;
    }

    .text-center a {
      color: #2575fc;
    }

  </style>
</head>
<body>
  <div class="signup-form">
    <div>
    @if(session('erreur'))
          <div class="alert alert-danger" role="alert">
            {{ session('erreur') }}
          </div>
        @endif
    </div>
    <form action="{{ route('comperuser.store') }}" method="post">
      @csrf
      <h2>Register</h2>
      <p class="hint-text">Create your account. It's free and only takes a minute.</p>
      <div class="form-group mb-3">
        <div class="row g-2">
          <div class="col">
            <input type="text" class="form-control" name="firstName" placeholder="First Name" required>
          </div>
          <div class="col">
            <input type="text" class="form-control" name="lastName" placeholder="Last Name" required>
          </div>
        </div>
      </div>
      <div class="form-group mb-3">
        <input type="email" class="form-control" name="email" placeholder="Email" required>
      </div>
      <div class="form-group mb-3">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
      </div>
      <div class="form-group mb-3">
        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
      </div>
      <div class="form-group d-grid mb-3">
        <button type="submit" class="btn btn-success btn-lg">Register Now</button>
      </div>
    </form>
    <div class="text-center">Already have an account? <a href="{{ route('user.create') }}">Sign in</a></div>
  </div>

</body>
</html>
