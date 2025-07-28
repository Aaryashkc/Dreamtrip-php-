<?php
require_once 'includes/auth.php';
require_once 'classes/User.php';

if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        $error = 'Invalid request';
    } else {
        $username = sanitizeInput($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $error = 'All fields are required';
        } else {
            $user = new User();
            $result = $user->login($username, $password);
            
            if ($result['success']) {
                header('Location: dashboard.php');
                exit();
            } else {
                $error = $result['message'];
            }
        }
    }
}

$page_title = 'Login';
include 'includes/header.php';
?>

<style>
    .login-bg {
        background: linear-gradient(135deg, #4869ce 0%, #5900ff 100%);
        min-height: 100vh;
        position: relative;
        overflow: hidden;
    }
    
    .login-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.08) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(16, 185, 185, 0.1) 0%, transparent 50%);
    }
    
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
    }
    
    .input-group {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .input-field {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        border: 2px solid rgba(72, 105, 206, 0.1);
        border-radius: 12px;
        background: rgba(249, 250, 251, 0.8);
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
        font-size: 0.95rem;
    }
    
    .input-field:focus {
        outline: none;
        border-color: #4869ce;
        background: white;
        box-shadow: 0 0 0 3px rgba(72, 105, 206, 0.1);
        transform: translateY(-1px);
    }
    
    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #4869ce;
        z-index: 10;
    }
    
    .login-btn {
        background: linear-gradient(135deg, #4869ce 0%, #5900ff 100%);
        border: none;
        padding: 1rem 2rem;
        border-radius: 12px;
        color: white;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        width: 100%;
        font-size: 1rem;
    }
    
    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(72, 105, 206, 0.3);
    }
    
    .login-btn:active {
        transform: translateY(0);
    }
    
    .login-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }
    
    .login-btn:hover::before {
        left: 100%;
    }
    
    .error-alert {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        border: 1px solid #f87171;
        color: #dc2626;
        padding: 1rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        font-family: 'Poppins', sans-serif;
        animation: slideUp 0.5s ease-out;
    }
    
    .floating-shapes {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 1;
    }
    
    .shape {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }
    
    .shape:nth-child(1) {
        width: 80px;
        height: 80px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }
    
    .shape:nth-child(2) {
        width: 120px;
        height: 120px;
        top: 70%;
        right: 15%;
        animation-delay: 2s;
    }
    
    .shape:nth-child(3) {
        width: 60px;
        height: 60px;
        bottom: 20%;
        left: 20%;
        animation-delay: 4s;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
    
    @keyframes slideUp {
        0% { transform: translateY(20px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }
    
    .brand-logo {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #4869ce 0%, #5900ff 100%);
        border-radius: 20px;
        margin: 0 auto 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 25px rgba(72, 105, 206, 0.3);
        position: relative;
        overflow: hidden;
    }
    
    .brand-logo::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.2) 50%, transparent 70%);
        transform: rotate(45deg);
        animation: shine 3s infinite;
    }
    
    @keyframes shine {
        0% { transform: rotate(45deg) translate(-100%, -100%); }
        50% { transform: rotate(45deg) translate(100%, 100%); }
        100% { transform: rotate(45deg) translate(-100%, -100%); }
    }
</style>

<div class="login-bg">
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-md w-full">
            <div class="glass-card rounded-3xl p-8 animate-slide-up">
                <!-- Brand Logo -->
                <div class="brand-logo">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="white" stroke-width="2" stroke-linejoin="round"/>
                        <path d="M2 17L12 22L22 17" stroke="white" stroke-width="2" stroke-linejoin="round"/>
                        <path d="M2 12L12 17L22 12" stroke="white" stroke-width="2" stroke-linejoin="round"/>
                    </svg>
                </div>
                
                <!-- Header -->
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2" style="font-family: 'Poppins', sans-serif;">
                        Welcome Back
                    </h2>
                    <p class="text-gray-600" style="font-family: 'Poppins', sans-serif;">
                        Sign in to continue to your account
                    </p>
                </div>
                
                <!-- Form -->
                <form method="POST" class="space-y-6">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                    
                    <?php if ($error): ?>
                        <div class="error-alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Username Field -->
                    <div class="input-group">
                        <div class="input-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <input 
                            id="username" 
                            name="username" 
                            type="text" 
                            required 
                            class="input-field"
                            placeholder="Username or Email"
                            value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                        >
                    </div>
                    
                    <!-- Password Field -->
                    <div class="input-group">
                        <div class="input-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                                <circle cx="12" cy="16" r="1" stroke="currentColor" stroke-width="2"/>
                                <path d="M7 11V7C7 5.67392 7.52678 4.40215 8.46447 3.46447C9.40215 2.52678 10.6739 2 12 2C13.3261 2 14.5979 2.52678 15.5355 3.46447C16.4732 4.40215 17 5.67392 17 7V11" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            required 
                            class="input-field"
                            placeholder="Password"
                        >
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="login-btn">
                        <span>Sign In</span>
                    </button>
                </form>
                
                <!-- Footer -->
                <div class="mt-8 text-center">
                    <p class="text-gray-600" style="font-family: 'Poppins', sans-serif;">
                        Don't have an account? 
                        <a href="register.php" class="font-semibold text-transparent bg-clip-text" style="background-image: linear-gradient(135deg, #4869ce 0%, #5900ff 100%); text-decoration: none;">
                            Create Account
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>