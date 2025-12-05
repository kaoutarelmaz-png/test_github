@extends('layouts.app')
@section('title', 'Create Admin')
@section('content')

<div class="admin-container">
    <form action="storeAddAdmin" method="POST" class="admin-form compact-form">
        @csrf

        <div class="form-header">
            <div class="form-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1>New Admin</h1>
        </div>

        <div class="form-body">
            <div class="form-row">
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i> Email
                    </label>
                    <div class="input-group">
                        <input type="email" id="email" name="email" class="form-input" required 
                               placeholder="admin@example.com">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" class="form-input" required 
                               placeholder="••••••••">
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="confirm_password" class="form-label">
                    <i class="fas fa-redo"></i> Confirm Password
                </label>
                <div class="input-group">
                    <input type="password" id="confirm_password" name="confirm_password" class="form-input" required 
                           placeholder="••••••••">
                </div>
            </div>

            <div class="form-actions">
                <div class="action-buttons">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-user-shield"></i>
                        Create Admin
                    </button>
                    
                    <a href="AddAdmin" class="btn-cancel">
                        <i class="fas fa-times"></i>
                        Cancel
                    </a>
                </div>
            </div>
        </div>

    </form>
</div>

<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        margin: 0;
        display: flex;
        flex-direction: column;
    }

    .admin-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 80vh;
        padding: 0px;
    }

    .compact-form {
        width: 100%;
        max-width: 650px;
        min-height: auto;
        background: rgba(255, 255, 255, 0.98);
        border-radius: 20px;
        box-shadow: 
            0 20px 50px rgba(0, 0, 0, 0.2),
            0 10px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .compact-form:hover {
        transform: scale(1.01);
    }

    .form-header {
        background: #023e8a ;
        padding: 0px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .form-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 50%);
    }

    .form-icon {
        font-size: 42px;
        color: white;
        margin-bottom: 15px;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    .form-header h1 {
        color: white;
        font-size: 28px;
        font-weight: 700;
        margin: 0;
        letter-spacing: 1px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .form-body {
        padding: 35px 40px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        margin-bottom: 25px;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }

    .form-group {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        margin-bottom: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #2d3748;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-label i {
        margin-right: 8px;
        color: #667eea;
    }

    .input-group {
        position: relative;
    }

    .form-input {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: #f8fafc;
        color: #2d3748;
        box-sizing: border-box;
    }

    .form-input:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .form-input::placeholder {
        color: #a0aec0;
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #a0aec0;
        cursor: pointer;
        font-size: 16px;
        padding: 5px;
        transition: color 0.3s ease;
    }

    .password-toggle:hover {
        color: #667eea;
    }

    .form-actions {
        margin-top: 35px;
        padding-top: 25px;
        border-top: 1px solid #e2e8f0;
    }

    .action-buttons {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 576px) {
        .action-buttons {
            grid-template-columns: 1fr;
        }
    }

    .btn-submit {
        width: 100%;
        padding: 18px 25px;
        background: #023e8a;
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-submit:active {
        transform: translateY(-1px);
    }

    .btn-cancel {
        width: 100%;
        padding: 18px 25px;
        background: #f1f5f9;
        color: #64748b;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        text-align: center;
    }

    .btn-cancel:hover {
        background: #e2e8f0;
        border-color: #cbd5e0;
        color: #475569;
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .btn-cancel:active {
        transform: translateY(-1px);
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .compact-form {
        animation: fadeInUp 0.5s ease-out;
    }

    .form-row {
        animation: fadeInUp 0.6s ease-out 0.1s both;
    }

    .form-actions {
        animation: fadeInUp 0.6s ease-out 0.2s both;
    }
</style>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.querySelector('.password-toggle i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.className = 'fas fa-eye-slash';
        } else {
            passwordInput.type = 'password';
            toggleIcon.className = 'fas fa-eye';
        }
    }

    // Password confirmation validation
    document.getElementById('confirm_password').addEventListener('input', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = e.target.value;
        
        if (confirmPassword && password !== confirmPassword) {
            this.style.borderColor = '#ef4444';
            this.style.boxShadow = '0 0 0 4px rgba(239, 68, 68, 0.1)';
        } else {
            this.style.borderColor = password && confirmPassword && password === confirmPassword ? '#10b981' : '#e2e8f0';
            this.style.boxShadow = password && confirmPassword && password === confirmPassword ? '0 0 0 4px rgba(16, 185, 129, 0.1)' : 'none';
        }
    });

    // Email validation
    document.getElementById('email').addEventListener('blur', function(e) {
        const email = e.target.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email && !emailRegex.test(email)) {
            this.style.borderColor = '#ef4444';
            this.style.boxShadow = '0 0 0 4px rgba(239, 68, 68, 0.1)';
        } else if (email) {
            this.style.borderColor = '#10b981';
            this.style.boxShadow = '0 0 0 4px rgba(16, 185, 129, 0.1)';
        }
    });
</script>

@endsection