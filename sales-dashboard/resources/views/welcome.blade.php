<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Dashboard - Modern Business Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="h-full bg-gradient-to-br from-blue-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    <!-- Navigation -->
    <nav class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg p-2 mr-3">
                        <i class="fas fa-chart-line text-white text-xl"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-900 dark:text-white">Sales Dashboard</span>
                </div>
                <div class="flex items-center space-x-4">
                    <button id="darkModeToggle" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                        <i class="fas fa-moon dark:hidden"></i>
                        <i class="fas fa-sun hidden dark:block"></i>
                    </button>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-medium rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Sign In
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                    Modern
                    <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Sales Management
                    </span>
                    Platform
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400 mb-8 max-w-3xl mx-auto">
                    Streamline your business operations with our comprehensive sales dashboard. 
                    Manage customers, inventory, sales, and analytics all in one place.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-lg font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-rocket mr-2"></i>
                        Get Started
                    </a>
                    <a href="#features" class="inline-flex items-center px-8 py-4 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-lg font-semibold rounded-lg border-2 border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                        <i class="fas fa-play mr-2"></i>
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-24 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Powerful Features for Your Business
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400">
                    Everything you need to manage your sales operations effectively
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Customer Management -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-gray-700 dark:to-gray-800 rounded-xl p-8 border border-gray-200 dark:border-gray-600 hover:shadow-xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg p-3 w-fit mb-6">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Customer Management</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Manage customer relationships, track interactions, and maintain detailed customer profiles with our comprehensive CRM system.
                    </p>
                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Customer profiles & history</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Contact management</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Sales tracking</li>
                    </ul>
                </div>

                <!-- Inventory Management -->
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-gray-700 dark:to-gray-800 rounded-xl p-8 border border-gray-200 dark:border-gray-600 hover:shadow-xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-lg p-3 w-fit mb-6">
                        <i class="fas fa-boxes text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Inventory Control</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Keep track of your inventory levels, set reorder points, and manage stock alerts to prevent stockouts.
                    </p>
                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Real-time stock tracking</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Low stock alerts</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Product management</li>
                    </ul>
                </div>

                <!-- Sales Analytics -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 dark:from-gray-700 dark:to-gray-800 rounded-xl p-8 border border-gray-200 dark:border-gray-600 hover:shadow-xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg p-3 w-fit mb-6">
                        <i class="fas fa-chart-bar text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Sales Analytics</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Get insights into your sales performance with detailed reports, charts, and analytics dashboard.
                    </p>
                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Sales reports</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Performance metrics</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Trend analysis</li>
                    </ul>
                </div>

                <!-- Multi-Role Access -->
                <div class="bg-gradient-to-br from-orange-50 to-red-50 dark:from-gray-700 dark:to-gray-800 rounded-xl p-8 border border-gray-200 dark:border-gray-600 hover:shadow-xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-orange-600 to-red-600 rounded-lg p-3 w-fit mb-6">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Role-Based Access</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Secure access control with different permission levels for admin, CRM, advertiser, and warehouse roles.
                    </p>
                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Admin full access</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>CRM customer focus</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Warehouse inventory</li>
                    </ul>
                </div>

                <!-- Budget Management -->
                <div class="bg-gradient-to-br from-teal-50 to-cyan-50 dark:from-gray-700 dark:to-gray-800 rounded-xl p-8 border border-gray-200 dark:border-gray-600 hover:shadow-xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-teal-600 to-cyan-600 rounded-lg p-3 w-fit mb-6">
                        <i class="fas fa-coins text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Budget Tracking</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Monitor advertising budgets, track spending, and manage campaign performance for advertisers.
                    </p>
                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Budget allocation</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Spending tracking</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Campaign management</li>
                    </ul>
                </div>

                <!-- Real-time Updates -->
                <div class="bg-gradient-to-br from-yellow-50 to-amber-50 dark:from-gray-700 dark:to-gray-800 rounded-xl p-8 border border-gray-200 dark:border-gray-600 hover:shadow-xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-yellow-600 to-amber-600 rounded-lg p-3 w-fit mb-6">
                        <i class="fas fa-bolt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Real-time Updates</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Get instant notifications and real-time updates on sales, inventory, and important business metrics.
                    </p>
                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Live notifications</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Instant updates</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Alert system</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                Ready to Transform Your Business?
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Join thousands of businesses that have streamlined their operations with our sales dashboard.
            </p>
            <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-4 bg-white text-blue-600 text-lg font-semibold rounded-lg hover:bg-gray-50 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <i class="fas fa-rocket mr-2"></i>
                Start Your Free Trial
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg p-2 mr-3">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                        <span class="text-xl font-bold">Sales Dashboard</span>
                    </div>
                    <p class="text-gray-400">
                        Modern business management platform for sales, inventory, and customer relationship management.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Features</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Customer Management</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Inventory Control</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Sales Analytics</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Budget Tracking</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Support</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Documentation</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Status</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Company</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">About</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Privacy</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 Sales Dashboard. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Dark mode toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        const html = document.documentElement;
        
        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'true' || 
            (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
        }
        
        darkModeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            localStorage.setItem('darkMode', html.classList.contains('dark'));
        });
    </script>
</body>
</html>
