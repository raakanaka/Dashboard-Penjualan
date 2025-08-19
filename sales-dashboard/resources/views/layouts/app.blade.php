<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sales Management System')</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
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
                            950: '#172554',
                        }
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full bg-gray-50 dark:bg-gray-900 font-inter transition-colors duration-300">
    <div class="flex h-full">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar fixed inset-y-0 left-0 z-50 w-64 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 bg-gradient-to-b from-blue-600 to-blue-800 dark:from-blue-800 dark:to-blue-900 shadow-xl">
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-16 px-6 bg-white/10 backdrop-blur-sm border-b border-white/20">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 text-white font-semibold text-lg">
                    <i class="fas fa-chart-line text-2xl"></i>
                    <span>SalesPro</span>
                </a>
                <button id="sidebarClose" class="lg:hidden text-white hover:text-gray-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <!-- Sidebar Navigation -->
            <div class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <!-- Dashboard -->
                @if(auth()->user()->hasPermission('dashboard'))
                <a href="{{ route('dashboard') }}" 
                   class="nav-link flex items-center px-4 py-3 text-white rounded-lg transition-all duration-300 hover:bg-white/10 {{ request()->routeIs('dashboard') ? 'bg-white/20 shadow-lg' : '' }}">
                    <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                    <span>Dashboard</span>
                </a>
                @endif
                
                <!-- Products -->
                @if(auth()->user()->hasPermission('inventory'))
                <a href="{{ route('products.index') }}" 
                   class="nav-link flex items-center px-4 py-3 text-white rounded-lg transition-all duration-300 hover:bg-white/10 {{ request()->routeIs('products.*') ? 'bg-white/20 shadow-lg' : '' }}">
                    <i class="fas fa-box w-5 h-5 mr-3"></i>
                    <span>Products</span>
                </a>
                @endif
                
                <!-- Sales -->
                @if(auth()->user()->hasPermission('sales'))
                <a href="{{ route('sales.index') }}" 
                   class="nav-link flex items-center px-4 py-3 text-white rounded-lg transition-all duration-300 hover:bg-white/10 {{ request()->routeIs('sales.*') ? 'bg-white/20 shadow-lg' : '' }}">
                    <i class="fas fa-shopping-cart w-5 h-5 mr-3"></i>
                    <span>Sales</span>
                </a>
                @endif
                
                <!-- Purchases -->
                @if(auth()->user()->hasPermission('purchases'))
                <a href="{{ route('purchases.index') }}" 
                   class="nav-link flex items-center px-4 py-3 text-white rounded-lg transition-all duration-300 hover:bg-white/10 {{ request()->routeIs('purchases.*') ? 'bg-white/20 shadow-lg' : '' }}">
                    <i class="fas fa-truck w-5 h-5 mr-3"></i>
                    <span>Purchases</span>
                </a>
                @endif
                
                <!-- Customers -->
                @if(auth()->user()->hasPermission('customers'))
                <a href="{{ route('customers.index') }}" 
                   class="nav-link flex items-center px-4 py-3 text-white rounded-lg transition-all duration-300 hover:bg-white/10 {{ request()->routeIs('customers.*') ? 'bg-white/20 shadow-lg' : '' }}">
                    <i class="fas fa-users w-5 h-5 mr-3"></i>
                    <span>Customers</span>
                </a>
                @endif

                <!-- Advanced CRM -->
                @if(auth()->user()->hasPermission('customers'))
                <a href="{{ route('crm.dashboard') }}" 
                   class="nav-link flex items-center px-4 py-3 text-white rounded-lg transition-all duration-300 hover:bg-white/10 {{ request()->routeIs('crm.*') ? 'bg-white/20 shadow-lg' : '' }}">
                    <i class="fas fa-chart-pie w-5 h-5 mr-3"></i>
                    <span>Advanced CRM</span>
                </a>
                @endif
                
                <!-- Suppliers -->
                @if(auth()->user()->hasPermission('suppliers'))
                <a href="{{ route('suppliers.index') }}" 
                   class="nav-link flex items-center px-4 py-3 text-white rounded-lg transition-all duration-300 hover:bg-white/10 {{ request()->routeIs('suppliers.*') ? 'bg-white/20 shadow-lg' : '' }}">
                    <i class="fas fa-building w-5 h-5 mr-3"></i>
                    <span>Suppliers</span>
                </a>
                @endif
                
                <!-- Inventory -->
                @if(auth()->user()->hasPermission('inventory'))
                <a href="{{ route('inventory.index') }}" 
                   class="nav-link flex items-center px-4 py-3 text-white rounded-lg transition-all duration-300 hover:bg-white/10 {{ request()->routeIs('inventory.*') ? 'bg-white/20 shadow-lg' : '' }}">
                    <i class="fas fa-warehouse w-5 h-5 mr-3"></i>
                    <span>Inventory</span>
                </a>
                @endif
                
                <!-- Reports -->
                <div class="pt-4 border-t border-white/20">
                    <h3 class="px-4 text-xs font-semibold text-white/60 uppercase tracking-wider">Reports</h3>
                    <div class="mt-2 space-y-1">
                        <a href="{{ route('reports.sales') }}" 
                           class="nav-link flex items-center px-4 py-2 text-white/80 rounded-lg transition-all duration-300 hover:bg-white/10 {{ request()->routeIs('reports.sales') ? 'bg-white/20 shadow-lg' : '' }}">
                            <i class="fas fa-chart-bar w-4 h-4 mr-3"></i>
                            <span class="text-sm">Sales Report</span>
                        </a>
                        <a href="{{ route('reports.purchases') }}" 
                           class="nav-link flex items-center px-4 py-2 text-white/80 rounded-lg transition-all duration-300 hover:bg-white/10 {{ request()->routeIs('reports.purchases') ? 'bg-white/20 shadow-lg' : '' }}">
                            <i class="fas fa-chart-line w-4 h-4 mr-3"></i>
                            <span class="text-sm">Purchase Report</span>
                        </a>
                        <a href="{{ route('reports.inventory') }}" 
                           class="nav-link flex items-center px-4 py-2 text-white/80 rounded-lg transition-all duration-300 hover:bg-white/10 {{ request()->routeIs('reports.inventory') ? 'bg-white/20 shadow-lg' : '' }}">
                            <i class="fas fa-chart-pie w-4 h-4 mr-3"></i>
                            <span class="text-sm">Inventory Report</span>
                        </a>
                    </div>
                </div>

                <!-- Advertisers Section -->
                @if(auth()->user()->hasPermission('advertisers'))
                <div class="mt-8">
                    <h3 class="px-4 text-xs font-semibold text-white/60 uppercase tracking-wider">Advertising</h3>
                    <div class="mt-2 space-y-1">
                        <a href="{{ route('advertisers.index') }}"
                           class="nav-link flex items-center px-4 py-2 text-white/80 rounded-lg transition-all duration-300 hover:bg-white/10 {{ request()->routeIs('advertisers.*') ? 'bg-white/20 shadow-lg' : '' }}">
                            <i class="fas fa-bullhorn w-4 h-4 mr-3"></i>
                            <span class="text-sm">Advertisers</span>
                        </a>
                    </div>
                </div>
                @endif

                <!-- Budgets Section -->
                @if(auth()->user()->hasPermission('budgets'))
                <div class="mt-8">
                    <h3 class="px-4 text-xs font-semibold text-white/60 uppercase tracking-wider">Budget Management</h3>
                    <div class="mt-2 space-y-1">
                        <a href="{{ route('budgets.index') }}"
                           class="nav-link flex items-center px-4 py-2 text-white/80 rounded-lg transition-all duration-300 hover:bg-white/10 {{ request()->routeIs('budgets.*') ? 'bg-white/20 shadow-lg' : '' }}">
                            <i class="fas fa-coins w-4 h-4 mr-3"></i>
                            <span class="text-sm">Budgets</span>
                        </a>
                    </div>
                </div>
                @endif

                <!-- Admin Section -->
                @if(auth()->user()->isAdmin())
                <div class="mt-8">
                    <h3 class="px-4 text-xs font-semibold text-white/60 uppercase tracking-wider">Administration</h3>
                    <div class="mt-2 space-y-1">
                        <a href="{{ route('users.index') }}"
                           class="nav-link flex items-center px-4 py-2 text-white/80 rounded-lg transition-all duration-300 hover:bg-white/10 {{ request()->routeIs('users.*') ? 'bg-white/20 shadow-lg' : '' }}">
                            <i class="fas fa-users-cog w-4 h-4 mr-3"></i>
                            <span class="text-sm">Users</span>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-0">
            <!-- Top Navigation -->
            <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button id="sidebarToggle" class="lg:hidden text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 mr-4">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-xl font-semibold text-gray-900 dark:text-white">@yield('title', 'Dashboard')</h1>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Dark Mode Toggle -->
                        <button id="darkModeToggle" class="relative p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors duration-200">
                            <i class="fas fa-sun text-yellow-500 dark:hidden text-lg"></i>
                            <i class="fas fa-moon text-blue-300 hidden dark:block text-lg"></i>
                        </button>
                        
                        <!-- Notifications -->
                        <button class="relative p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors duration-200">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400"></span>
                        </button>
                        
                        <!-- User Menu -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors duration-200">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-sm">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <span class="hidden md:block font-medium">{{ auth()->user()->name }}</span>
                                <span class="hidden md:block text-xs text-gray-500 dark:text-gray-400">({{ auth()->user()->role->display_name ?? 'No Role' }})</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1 z-50">
                                <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
                                    <p class="text-xs text-blue-600 dark:text-blue-400">{{ auth()->user()->role->display_name ?? 'No Role' }}</p>
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 dark:bg-gray-900">
                <div class="container mx-auto px-6 py-8">
                    @if(session('success'))
                        <div class="mb-6 bg-green-100 dark:bg-green-900/50 border border-green-400 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 bg-red-100 dark:bg-red-900/50 border border-red-400 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Overlay for mobile sidebar -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>

    <!-- JavaScript -->
    <script>
        // Dark Mode Toggle
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
            
            // Add visual feedback
            darkModeToggle.classList.add('scale-110');
            setTimeout(() => {
                darkModeToggle.classList.remove('scale-110');
            }, 150);
        });
        
        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarClose = document.getElementById('sidebarClose');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        
        function openSidebar() {
            sidebar.classList.add('translate-x-0');
            sidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
        }
        
        function closeSidebar() {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        }
        
        sidebarToggle.addEventListener('click', openSidebar);
        sidebarClose.addEventListener('click', closeSidebar);
        sidebarOverlay.addEventListener('click', closeSidebar);
        
        // Auto-hide alerts
        const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            }, 5000);
        });
    </script>
</body>
</html>
