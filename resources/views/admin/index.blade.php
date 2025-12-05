<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Professionnel</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #000428, #004e92);
            margin: 0;
        }
        .login-container {
            display: flex;
            width: 850px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);
            border-radius: 20px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .image-container {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
        }
        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .form-container {
            width: 50%;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
        }
        .form-container h2 {
            margin-bottom: 20px;
            font-size: 26px;
            font-weight: 600;
            text-align: center;
        }
        .input-group {
            margin-bottom: 20px;
            position: relative;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 400;
        }
        .input-group input {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            font-size: 16px;
        }
        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg,rgb(7, 49, 2),rgb(22, 168, 3));
            border: none;
            color: white;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn:hover {
            background: linear-gradient(135deg,rgb(1, 7, 44),rgb(6, 10, 238));
        }
        .return{
            width: 100%;
            padding: 12px 42.5%;
            background: linear-gradient(135deg,rgb(255, 65, 65), #FF4B2B);
            border: none;
            color: white;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
        }
        .return:hover {
            background: linear-gradient(135deg,rgb(1, 7, 44),rgb(6, 10, 238));
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="image-container">
            <img src="{{ Storage::url('imager/admin.png') }}" alt="Image de connexion">
        </div>
        <div class="form-container">
            <h2>Login Admin</h2>
            <form action="{{ route('admin.store') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="Entrez votre email" >
                </div>
                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <input type="text" id="password" name="password" placeholder="Entrez votre mot de passe" >
                </div>
                <button type="submit" class="btn">Se connecter</button><br/><br/>
                <a href="/" class="return">logout</a>
            </form>
        </div>
    </div>
    
</body>
</html>