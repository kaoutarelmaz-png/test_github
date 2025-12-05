<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #000428, #004e92);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
        }

        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 60px;
            border-radius: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(15px);
        }

        h1 {
            font-size: 48px;
            margin-bottom: 30px;
        }

        .images {
            display: flex;
            justify-content: center;
            gap: 40px;
        }

        .images img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid white;
            transition: transform 0.3s ease-in-out;
        }

        .images img:hover {
            transform: scale(1.15);
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 30px;
        }

        button {
            background: #ff416c;
            background: linear-gradient(to right, #ff4b2b, #ff416c);
            color: white;
            border: none;
            padding: 20px 50px;
            font-size: 22px;
            border-radius: 40px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 5px 15px rgba(255, 65, 108, 0.4);
        }

        button:hover {
            background: #ff4b2b;
            transform: translateY(-5px);
            box-shadow: 0 7px 20px rgba(255, 65, 108, 0.6);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Login Page</h1>
        <div class="images">
            <img src="{{ Storage::url('imager/user.png') }}" alt="User">
            <img src="{{ Storage::url('imager/admin.png') }}" alt="Admin">
        </div>
        <div class="buttons">
            <a href="{{ route('user.create') }}"><button>User</button></a>
            <a href="{{ route('admin.index') }}"><button>Admin</button></a>
        </div>
    </div>
</body>
</html>