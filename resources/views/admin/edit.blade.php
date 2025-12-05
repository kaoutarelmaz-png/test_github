@extends('layouts.app')

@section('title', 'Update Admin')

@section('content')    
<div class="simple-edit-container">
    <div class="simple-edit-form">
        <h2>
            <i class="fas fa-user-edit"></i>
            Edit Admin
        </h2>
        
        <p class="current-email">Editing: <strong>{{ $edits->email }}</strong></p>

        <form action="{{ route('admin.update', $edits->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-field">
                <label for="email">
                    <i class="fas fa-envelope"></i> Email
                </label>
                <input type="email" id="email" name="email" 
                       value="{{ $edits->email }}" 
                       required
                       class="form-control">
            </div>

            <div class="form-field">
                <label for="password">
                    <i class="fas fa-lock"></i> New Password (Optional)
                </label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" 
                           placeholder="Leave empty to keep current"
                           class="form-control">
                    <button type="button" class="show-password" onclick="togglePassword()">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <small class="password-note">
                    Only fill if you want to change the password
                </small>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Save Changes
                </button>
                
                <a href="{{ route('AddAdmin') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    .simple-edit-container {
        padding: 40px 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        background: #f8f9fa;
    }

    .simple-edit-form {
        width: 100%;
        max-width: 450px;
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        border: 1px solid #eaeaea;
    }

    .simple-edit-form h2 {
        color: #2c3e50;
        margin-bottom: 10px;
        font-size: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .simple-edit-form h2 i {
        color: #023e8a;
    }

    .current-email {
        color: #7f8c8d;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
        font-size: 14px;
    }

    .form-field {
        margin-bottom: 25px;
    }

    .form-field label {
        display: block;
        margin-bottom: 8px;
        color: #2c3e50;
        font-weight: 500;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-field label i {
        color: #023e8a;
        font-size: 14px;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.3s;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #023e8a;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    }

    .password-wrapper {
        position: relative;
    }

    .show-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #95a5a6;
        cursor: pointer;
        padding: 5px;
        font-size: 14px;
    }

    .show-password:hover {
        color: #023e8a;
    }

    .password-note {
        color: #7f8c8d;
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }

    .form-buttons {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }

    .btn-save, .btn-back {
        flex: 1;
        padding: 12px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s;
    }

    .btn-save {
        background: #023e8a;
        color: white;
    }

    .btn-save:hover {
        background: #2980b9;
        transform: translateY(-1px);
    }

    .btn-back {
        background: #ecf0f1;
        color: #7f8c8d;
    }

    .btn-back:hover {
        background: #bdc3c7;
        color: #2c3e50;
        transform: translateY(-1px);
    }

    /* Responsive */
    @media (max-width: 480px) {
        .simple-edit-form {
            padding: 20px;
        }
        
        .form-buttons {
            flex-direction: column;
        }
        
        .btn-save, .btn-back {
            width: 100%;
        }
    }
</style>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const icon = document.querySelector('.show-password i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            passwordInput.type = 'password';
            icon.className = 'fas fa-eye';
        }
    }
</script>

@endsection