<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?>DreamTrip</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Using a specific version of Font Awesome without integrity check to prevent issues -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Production-ready Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <!-- Alternative approach: Use a specific version of Tailwind CSS -->
    <!-- <script src="https://cdn.tailwindcss.com/3.4.1"></script> -->

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4869ceff',
                        secondary: '#10b9b9ff',
                        accent: '#5900ffff',
                        dark: '#1F2937',
                        light: '#F9FAFB',
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft': '0 4px 20px 0 rgba(0, 0, 0, 0.05)',
                        'card': '0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.03)',
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                    },
                }
            },
            plugins: [
                function({ addUtilities }) {
                    const newUtilities = {
                        '.text-shadow': {
                            'text-shadow': '0 2px 4px rgba(0,0,0,0.1)',
                        },
                        '.text-shadow-md': {
                            'text-shadow': '0 4px 8px rgba(0,0,0,0.12), 0 2px 4px rgba(0,0,0,0.08)',
                        },
                        '.text-shadow-lg': {
                            'text-shadow': '0 15px 30px rgba(0,0,0,0.11), 0 5px 15px rgba(0,0,0,0.08)',
                        },
                        '.text-shadow-none': {
                            'text-shadow': 'none',
                        },
                    }
                    addUtilities(newUtilities)
                }
            ]
        }
    </script>
    <style>
        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .btn {
            @apply px-6 py-3 rounded-lg font-medium transition-all duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary;
        }
        .btn-primary {
            @apply bg-primary text-white hover:bg-opacity-90 focus:ring-primary/50;
        }
        .btn-outline {
            @apply border-2 border-primary text-primary hover:bg-primary hover:text-white;
        }
    </style>
</head>
<body class="bg-light min-h-screen font-sans text-dark flex flex-col">
    <nav class="bg-white shadow-md sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center">
                    <a href="index.php" class="flex items-center space-x-2 group">
                        <svg class="h-8 w-8 text-primary transform transition-transform duration-300 group-hover:rotate-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-2xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">DreamTrip</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-6">
                    <?php if (isLoggedIn()): ?>
                        <a href="dashboard.php" class="text-gray-600 hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                            Dashboard
                        </a>
                        <a href="add_destination.php" class="text-gray-600 hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                            Add Destination
                        </a>
                        <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </a>
                    <?php else: ?>
                        <a href="login.php" class="text-gray-600 hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                            <i class="fas fa-sign-in-alt mr-1"></i> Login
                        </a>
                        <a href="register.php" class="bg-gradient-to-r from-primary to-accent text-white px-6 py-2 rounded-lg text-sm font-medium hover:opacity-90 transition-opacity duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            <i class="fas fa-user-plus mr-1"></i> Register
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-primary hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary transition-colors duration-200">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-white shadow-lg rounded-b-lg overflow-hidden transition-all duration-300 ease-in-out">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <?php if (isLoggedIn()): ?>
                    <a href="dashboard.php" class="flex items-center text-gray-700 hover:bg-gray-50 hover:text-primary block px-4 py-3 rounded-md text-base font-medium transition-colors duration-200">
                        Dashboard
                    </a>
                    <a href="add_destination.php" class="flex items-center text-gray-700 hover:bg-gray-50 hover:text-primary block px-4 py-3 rounded-md text-base font-medium transition-colors duration-200">
                        Add Destination
                    </a>
                    <a href="logout.php" class="flex items-center bg-red-500 text-white hover:bg-red-600 block px-4 py-3 rounded-md text-base font-medium transition-colors duration-200">
                        <i class="fas fa-sign-out-alt w-5 mr-2 text-center"></i> Logout
                    </a>
                <?php else: ?>
                    <a href="login.php" class="flex items-center text-gray-700 hover:bg-gray-50 hover:text-primary block px-4 py-3 rounded-md text-base font-medium transition-colors duration-200">
                        <i class="fas fa-sign-in-alt w-5 mr-2 text-center"></i> Login
                    </a>
                    <a href="register.php" class="flex items-center bg-gradient-to-r from-primary to-accent text-white hover:opacity-90 block px-4 py-3 rounded-md text-base font-medium transition-opacity duration-200">
                        <i class="fas fa-user-plus w-5 mr-2 text-center"></i> Register
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main id="main-content" class="flex-grow">
    <input type="hidden" id="csrf-token-for-js" value="<?php echo generateCSRFToken(); ?>">

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            var menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
