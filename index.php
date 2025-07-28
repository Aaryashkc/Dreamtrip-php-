<?php
require_once 'includes/auth.php';

$page_title = 'Welcome';
include 'includes/header.php';
?>

<style>
/* Enhanced animations and effects */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@keyframes blob {
    0%, 100% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes pulse-glow {
    0%, 100% {
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.4);
    }
    50% {
        box-shadow: 0 0 30px rgba(59, 130, 246, 0.6), 0 0 40px rgba(59, 130, 246, 0.3);
    }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out;
}

.animate-slide-left {
    animation: slideInLeft 0.8s ease-out;
}

.animate-slide-right {
    animation: slideInRight 0.8s ease-out;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

.animation-delay-300 {
    animation-delay: 0.3s;
}

.animation-delay-600 {
    animation-delay: 0.6s;
}

/* Glass morphism effect */
.glass {
    backdrop-filter: blur(16px) saturate(180%);
    background-color: rgba(255, 255, 255, 0.75);
    border: 1px solid rgba(209, 213, 219, 0.3);
}

/* Enhanced button styles */
.btn-primary-enhanced {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.btn-primary-enhanced::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-primary-enhanced:hover::before {
    left: 100%;
}

.btn-primary-enhanced:hover {
    transform: translateY(-2px);
    animation: pulse-glow 2s infinite;
}

/* Feature card enhancements */
.feature-card {
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, transparent 0%, rgba(59, 130, 246, 0.02) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.feature-card:hover::before {
    opacity: 1;
}

.feature-card:hover {
    transform: translateY(-8px) scale(1.02);
}

/* Enhanced hero image */
.hero-image-container {
    position: relative;
    overflow: hidden;
}

.hero-image-container::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(16, 185, 129, 0.1) 100%);
    mix-blend-mode: overlay;
    z-index: 15;
}

/* Floating elements */
.floating-element {
    position: absolute;
    animation: float 4s ease-in-out infinite;
}

.floating-element:nth-child(2) {
    animation-delay: 1s;
    animation-duration: 5s;
}

.floating-element:nth-child(3) {
    animation-delay: 2s;
    animation-duration: 6s;
}

/* Stats counter animation */
.stats-number {
    font-variant-numeric: tabular-nums;
    transition: all 0.3s ease;
}

/* Improved gradients */
.gradient-primary {
    background: linear-gradient(135deg, #3b82f6 0%, #1e40af 25%, #1d4ed8 50%, #1e3a8a 100%);
}

.gradient-secondary {
    background: linear-gradient(135deg, #10b981 0%, #059669 25%, #047857 50%, #065f46 100%);
}

.gradient-accent {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 25%, #b45309 50%, #92400e 100%);
}

/* Enhanced trust indicators */
.trust-indicator {
    transition: all 0.3s ease;
}

.trust-indicator:hover {
    transform: scale(1.05);
}

/* Responsive improvements */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
        line-height: 1.2;
    }
    
    .hero-subtitle {
        font-size: 1.125rem;
    }
}
</style>

<section class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen flex items-center">
        <!-- Enhanced animated background elements -->
        <div class="absolute inset-0 overflow-hidden opacity-30">
            <div class="absolute top-1/4 left-1/4 w-48 h-48 md:w-96 md:h-96 bg-gradient-to-r from-amber-200 to-blue-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
            <div class="absolute top-1/3 right-1/4 w-40 h-40 md:w-80 md:h-80 bg-gradient-to-l from-blue-300 to-purple-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
            <div class="absolute bottom-1/4 left-1/2 w-36 h-36 md:w-72 md:h-72 bg-gradient-to-t from-purple-200 to-amber-200 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
            
            <!-- Additional floating elements -->
            <div class="floating-element top-10 right-10 md:top-20 md:right-20 w-3 h-3 md:w-4 md:h-4 bg-blue-400 rounded-full opacity-30"></div>
            <div class="floating-element top-20 left-10 md:top-40 md:left-20 w-4 h-4 md:w-6 md:h-6 bg-amber-400 rounded-full opacity-30"></div>
            <div class="floating-element bottom-16 right-16 md:bottom-32 md:right-32 w-2 h-2 md:w-3 md:h-3 bg-purple-400 rounded-full opacity-30"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16 lg:py-24">
            <div class="text-center">
                <!-- Enhanced animated badge -->
                <div class="inline-flex items-center px-4 py-2 md:px-6 md:py-3 rounded-full text-xs md:text-sm font-semibold glass mb-6 md:mb-8 animate-float border shadow-lg">
                    <span class="relative flex h-2 w-2 md:h-3 md:w-3 mr-2 md:mr-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-500 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 md:h-3 md:w-3 bg-blue-500 shadow-sm"></span>
                    </span>
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-600 font-bold">
                        Explore the world, one destination at a time
                    </span>
                </div>

                <!-- Enhanced main heading -->
                <div class="animate-fade-in-up">
                    <h1 class="text-3xl md:text-5xl lg:text-7xl font-black text-gray-900 mb-4 md:mb-6 leading-tight tracking-tight">
                        Your <span class="relative">
                            <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 via-purple-600 to-accent">Dream Trip</span>
                            <div class="absolute -inset-1 bg-gradient-to-r from-blue-400/20 via-purple-400/20 to-amber-400/20 blur-lg -z-10"></div>
                        </span><br>
                        <span class="relative">
                            Awaits 
                            <span class="inline-block animate-float animation-delay-300">✈️</span>
                        </span>
                    </h1>
                </div>
                
                <!-- Enhanced subheading -->
                <div class="animate-fade-in-up animation-delay-300">
                    <p class="text-base md:text-xl lg:text-2xl text-gray-600 mb-8 md:mb-12 max-w-4xl mx-auto leading-relaxed font-medium px-4">
                        Plan, track, and relive your travel adventures with our comprehensive travel companion. 
                        Whether it's a <span class="text-purple-600 font-semibold">weekend getaway</span> or a 
                        <span class="text-blue-600 font-semibold">global expedition</span>, we help you organize 
                        your dream destinations in one beautiful, intuitive platform.
                    </p>
                </div>

              <?php if (!isLoggedIn()): ?>
                    <div class="flex flex-col sm:flex-row gap-4 md:gap-6 justify-center items-center mb-8 md:mb-16 animate-fade-in-up animation-delay-600 px-4">
                        <a href="register.php" class="btn-primary-enhanced w-full sm:w-auto px-6 md:px-10 py-3 md:py-5 text-base md:text-lg lg:text-xl font-bold shadow-2xl rounded-xl md:rounded-2xl text-white border-0 transform transition-all duration-300 hover:-translate-y-1">
                            <i class="fas fa-rocket mr-2 md:mr-3"></i> Get Started for Free
                         <span class="ml-1 md:ml-2">→</span>
                        </a>
                         <a href="login.php" class="glass border-2 border-blue-400/30 hover:border-blue-400/60 text-blue-600 hover:bg-blue-50 w-full sm:w-auto px-6 md:px-10 py-3 md:py-5 text-base md:text-lg lg:text-xl font-bold transition-all duration-300 rounded-xl md:rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <i class="fas fa-sign-in-alt mr-2 md:mr-3"></i> Sign In
                        </a>
                    </div>
              <?php else: ?>
                            <a href="dashboard.php" class="btn btn-primary-enhanced bg-white text-white hover:bg-gray-100 px-12 py-6 text-xl font-bold shadow-2xl rounded-2xl border-0 transform transition-all duration-300 hover:-translate-y-2 hover:scale-105 inline-block mb-20 animate-fade-in-up animation-delay-600">
                                <i class="fas fa-tachometer-alt mr-3"></i> Go to Dashboard
                                <span class="ml-2">→</span>
                            </a>
               <?php endif; ?>
                
                <!-- Enhanced CTA Buttons -->
     

                <!-- Enhanced trust indicators -->
                <div class="flex flex-col md:flex-row flex-wrap justify-center items-center gap-4 md:gap-8 text-gray-600 trust-indicators px-4">
                    <div class="trust-indicator flex items-center glass px-4 md:px-6 py-3 md:py-4 rounded-xl md:rounded-2xl shadow-lg w-full md:w-auto">
                        <div class="flex -space-x-2 md:-space-x-3 mr-3 md:mr-4">
                            <img class="h-8 w-8 md:h-10 md:w-10 rounded-full border-2 md:border-3 border-white shadow-md" src="https://randomuser.me/api/portraits/women/44.jpg" alt="User">
                            <img class="h-8 w-8 md:h-10 md:w-10 rounded-full border-2 md:border-3 border-white shadow-md" src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">
                            <img class="h-8 w-8 md:h-10 md:w-10 rounded-full border-2 md:border-3 border-white shadow-md" src="https://randomuser.me/api/portraits/women/68.jpg" alt="User">
                            <div class="h-8 w-8 md:h-10 md:w-10 rounded-full border-2 md:border-3 border-white bg-blue-500 text-white flex items-center justify-center text-xs md:text-sm font-bold shadow-md">+</div>
                        </div>
                        <div class="text-left">
                            <div class="text-lg md:text-xl font-bold text-gray-900">12,500+</div>
                            <div class="text-xs md:text-sm text-gray-600">Happy Travelers</div>
                        </div>
                    </div>
                    
                    <div class="trust-indicator flex items-center glass px-4 md:px-6 py-3 md:py-4 rounded-xl md:rounded-2xl shadow-lg w-full md:w-auto">
                        <div class="flex items-center mr-3">
                            <div class="flex items-center">
                                <svg class="h-4 w-4 md:h-5 md:w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg class="h-4 w-4 md:h-5 md:w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg class="h-4 w-4 md:h-5 md:w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg class="h-4 w-4 md:h-5 md:w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg class="h-4 w-4 md:h-5 md:w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-left">
                            <div class="flex items-baseline">
                                <span class="text-lg md:text-xl font-bold text-gray-900">4.9</span>
                                <span class="text-gray-400 ml-1 text-sm">/5.0</span>
                            </div>
                            <div class="text-xs md:text-sm text-gray-600">from 750+ reviews</div>
                        </div>
                    </div>
                    
                    <div class="trust-indicator flex items-center glass px-4 md:px-6 py-3 md:py-4 rounded-xl md:rounded-2xl shadow-lg w-full md:w-auto">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="text-left">
                            <div class="text-lg md:text-xl font-bold text-gray-900">180+</div>
                            <div class="text-xs md:text-sm text-gray-600">Countries Covered</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced hero illustration - Moved outside main container for better mobile handling -->
    </section>
    
    <!-- Separate section for hero image to prevent layout conflicts -->
    <section class="px-4 sm:px-6 lg:px-8 pb-8 md:pb-16 bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <div class="max-w-7xl mx-auto">
            <div class="hero-image-container relative rounded-2xl md:rounded-3xl shadow-2xl overflow-hidden transform transition-transform duration-500 hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent z-20"></div>
                <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                     alt="Travel destinations" 
                     class="w-full h-auto object-cover transition-transform duration-700 hover:scale-110"
                     style="aspect-ratio: 16/9; min-height: 200px; max-height: 600px;">
                <div class="absolute bottom-4 left-4 md:bottom-12 md:left-12 z-30 text-white max-w-xs md:max-w-lg">
                    <div class="glass text-gray-900 p-4 md:p-8 rounded-xl md:rounded-2xl backdrop-blur-md">
                        <h3 class="text-lg md:text-3xl font-bold mb-2 md:mb-4 leading-tight">Discover Your Next Adventure</h3>
                        <p class="opacity-90 text-sm md:text-lg leading-relaxed mb-2 md:mb-4">From tropical beaches to mountain peaks, find your perfect getaway with our curated destination guides.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Enhanced Features Section -->
<section class="py-32 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-primary via-transparent to-secondary"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <div class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-full text-sm font-semibold mb-6">
                ✨ Features
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                Plan Your <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary">Perfect Trip</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                Everything you need to organize your travel dreams and turn them into unforgettable memories. 
                Powerful tools designed for modern travelers.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-10 max-w-6xl mx-auto">
            <!-- Enhanced Feature 1 -->
            <div class="feature-card group bg-white p-10 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100">
                <div class="relative mb-8">
                    <div class="w-20 h-20 gradient-primary rounded-2xl flex items-center justify-center mb-6 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                    </div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-accent/20 rounded-full animate-ping"></div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-primary transition-colors duration-300">Plan Your Journey</h3>
                <p class="text-gray-600 mb-6 text-lg leading-relaxed">Create and organize your travel wishlist with detailed notes, categories, and priorities for each destination. Smart suggestions help you discover hidden gems.</p>
            </div>
            
            <!-- Enhanced Feature 2 -->
            <div class="feature-card group bg-white p-10 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100">
                <div class="relative mb-8">
                    <div class="w-20 h-20 gradient-secondary rounded-2xl flex items-center justify-center mb-6 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-primary/20 rounded-full animate-ping animation-delay-300"></div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-secondary transition-colors duration-300">Track Progress</h3>
                <p class="text-gray-600 mb-6 text-lg leading-relaxed">Monitor your travel goals, track visited destinations, and celebrate your achievements with our interactive progress dashboard. Visual analytics make planning fun.</p>
            </div>
            
            <!-- Enhanced Feature 3 -->
            <div class="feature-card group bg-white p-10 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100">
                <div class="relative mb-8">
                    <div class="w-20 h-20 gradient-accent rounded-2xl flex items-center justify-center mb-6 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-secondary/20 rounded-full animate-ping animation-delay-600"></div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-accent transition-colors duration-300"> Powerful Search</h3>
                <p class="text-gray-600 mb-6 text-lg leading-relaxed">Easily find destinations with powerful search and filtering options by country, type, or status.</p>
            </div>
        </div>

        <!-- Additional features showcase -->
        <div class="mt-20 text-center">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto">
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Secure & Private</h4>
                    <p class="text-sm text-gray-600">Your travel data is encrypted and secure</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-secondary/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Global Coverage</h4>
                    <p class="text-sm text-gray-600">Destinations from every continent</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-accent/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Mobile Ready</h4>
                    <p class="text-sm text-gray-600">Access your plans anywhere, anytime</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Community Driven</h4>
                    <p class="text-sm text-gray-600">Share experiences with fellow travelers</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Statistics Section -->
<section class="py-20 bg-gradient-to-r from-primary to-accent relative overflow-hidden">
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-12">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Join Thousands of Happy Travelers</h2>
            <p class="text-xl text-white/90 max-w-3xl mx-auto">Our platform has helped travelers from around the world plan and execute their dream trips.</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto">
            <div class="text-center group">
                <div class="stats-number text-4xl md:text-5xl font-black text-white mb-2 group-hover:scale-110 transition-transform duration-300">12.5K+</div>
                <div class="text-white/80 font-semibold text-lg">Active Users</div>
            </div>
            <div class="text-center group">
                <div class="stats-number text-4xl md:text-5xl font-black text-white mb-2 group-hover:scale-110 transition-transform duration-300">180+</div>
                <div class="text-white/80 font-semibold text-lg">Countries</div>
            </div>
            <div class="text-center group">
                <div class="stats-number text-4xl md:text-5xl font-black text-white mb-2 group-hover:scale-110 transition-transform duration-300">45K+</div>
                <div class="text-white/80 font-semibold text-lg">Trips Planned</div>
            </div>
            <div class="text-center group">
                <div class="stats-number text-4xl md:text-5xl font-black text-white mb-2 group-hover:scale-110 transition-transform duration-300">98%</div>
                <div class="text-white/80 font-semibold text-lg">Satisfaction Rate</div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Testimonials Section -->
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-secondary/10 text-secondary rounded-full text-sm font-semibold mb-6">
                💬 What Our Users Say
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Loved by Travelers Worldwide</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Don't just take our word for it - hear from real travelers who've transformed their trip planning experience.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="flex text-yellow-400 mr-3">
                        <?php for($i = 0; $i < 5; $i++): ?>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <span class="text-sm text-gray-500">Verified Review</span>
                </div>
                <p class="text-gray-600 mb-6 text-lg leading-relaxed">"This platform completely changed how I plan my travels. The interface is beautiful and the organization features are exactly what I needed!"</p>
                <div class="flex items-center">
                    <img class="h-12 w-12 rounded-full border-2 border-gray-200" src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah">
                    <div class="ml-4">
                        <div class="font-semibold text-gray-900">Sarah Johnson</div>
                        <div class="text-sm text-gray-500">Digital Nomad</div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="flex text-yellow-400 mr-3">
                        <?php for($i = 0; $i < 5; $i++): ?>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <span class="text-sm text-gray-500">Verified Review</span>
                </div>
                <p class="text-gray-600 mb-6 text-lg leading-relaxed">"Finally, a tool that understands how travelers think! The progress tracking keeps me motivated to explore new places."</p>
                <div class="flex items-center">
                    <img class="h-12 w-12 rounded-full border-2 border-gray-200" src="https://randomuser.me/api/portraits/men/46.jpg" alt="Mark">
                    <div class="ml-4">
                        <div class="font-semibold text-gray-900">Mark Chen</div>
                        <div class="text-sm text-gray-500">Adventure Enthusiast</div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="flex text-yellow-400 mr-3">
                        <?php for($i = 0; $i < 5; $i++): ?>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <span class="text-sm text-gray-500">Verified Review</span>
                </div>
                <p class="text-gray-600 mb-6 text-lg leading-relaxed">"As a travel blogger, this platform helps me stay organized and discover new destinations my audience loves. Highly recommended!"</p>
                <div class="flex items-center">
                    <img class="h-12 w-12 rounded-full border-2 border-gray-200" src="https://randomuser.me/api/portraits/women/24.jpg" alt="Emma">
                    <div class="ml-4">
                        <div class="font-semibold text-gray-900">Emma Rodriguez</div>
                        <div class="text-sm text-gray-500">Travel Blogger</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA Section -->
<section class="py-24 bg-gradient-to-br from-primary via-primary to-accent relative overflow-hidden">
    <!-- Background elements -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-white/10 rounded-full filter blur-3xl animate-blob"></div>
        <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-accent/20 rounded-full filter blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
            Ready to Start Your
            <span class="block bg-clip-text text-transparent bg-gradient-to-r from-yellow-200 to-orange-200">Adventure?</span>
        </h2>
        <p class="text-xl md:text-2xl text-white/90 mb-10 max-w-3xl mx-auto leading-relaxed">
            Join thousands of travelers who have already discovered the joy of organized trip planning. Your next adventure is just a click away.
        </p>
        
        <?php if (!isLoggedIn()): ?>
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <a href="register.php" class="btn btn-primary-enhanced bg-white text-white hover:bg-gray-100 px-12 py-6 text-xl font-bold shadow-2xl rounded-2xl border-0 transform transition-all duration-300 hover:-translate-y-2 hover:scale-105">
                    <i class="fas fa-rocket mr-3"></i> Start Planning Today

                </a>
            </div>
            
            <div class="mt-10 text-white/80 text-lg">
                <span class="mr-6">✓ Free forever</span>
                <span class="mr-6">✓ No credit card required</span>
                <span>✓ Setup in under 2 minutes</span>
            </div>
        <?php else: ?>
            <a href="dashboard.php" class="btn btn-primary-enhanced bg-white text-white hover:bg-gray-100 px-12 py-6 text-xl font-bold shadow-2xl rounded-2xl border-0 transform transition-all duration-300 hover:-translate-y-2 hover:scale-105 inline-block">
                <i class="fas fa-tachometer-alt mr-3"></i> Continue Planning
                <span class="ml-2">→</span>
            </a>
        <?php endif; ?>
    </div>
</section>

<script>
// Add some JavaScript for enhanced interactions
document.addEventListener('DOMContentLoaded', function() {
    // Animate stats numbers on scroll
    const statsNumbers = document.querySelectorAll('.stats-number');
    
    const animateNumbers = (entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const finalNumber = target.textContent;
                const duration = 2000;
                const increment = Math.ceil(parseInt(finalNumber.replace(/\D/g, '')) / (duration / 16));
                let current = 0;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= parseInt(finalNumber.replace(/\D/g, ''))) {
                        target.textContent = finalNumber;
                        clearInterval(timer);
                    } else {
                        target.textContent = current.toLocaleString() + (finalNumber.includes('+') ? '+' : '') + (finalNumber.includes('%') ? '%' : '') + (finalNumber.includes('K') ? 'K' : '');
                    }
                }, 16);
                
                observer.unobserve(target);
            }
        });
    };
    
    const observer = new IntersectionObserver(animateNumbers);
    statsNumbers.forEach(stat => observer.observe(stat));
    
    // Enhanced hover effects for feature cards
    const featureCards = document.querySelectorAll('.feature-card');
    featureCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-12px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>

<?php 
include 'includes/footer.php';
?>