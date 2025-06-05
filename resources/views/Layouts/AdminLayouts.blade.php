<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Default description')">
    <title>@yield('title', 'My App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body class="min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div>
                <span class="text-xl font-semibold">Admin Panel</span>
            </div>
            <div class="relative">
                <div class="flex items-center cursor-pointer" id="profileDropdown">
                    <img src="{{ asset('images/default-profile.png') }}" alt="Profile" class="h-8 w-8 rounded-full">
                    <span class="ml-2">Admin</span>
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden" id="profileMenu">
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flex container for sidebar and main content -->
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside class="bg-gray-900 text-white w-64 min-h-screen">
            <nav class="py-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m-8-4l8 4m8 0l-8 4m8-4v10a1 1 0 01-1 1h-6a1 1 0 01-1-1v-6"></path>
                            </svg>
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Orders
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.settings') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Settings
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const profileDropdown = document.getElementById('profileDropdown');
                const profileMenu = document.getElementById('profileMenu');
                
                profileDropdown.addEventListener('click', function() {
                    profileMenu.classList.toggle('hidden');
                });
                
                document.addEventListener('click', function(e) {
                    if (!profileDropdown.contains(e.target) && !profileMenu.contains(e.target)) {
                        profileMenu.classList.add('hidden');
                    }
                });
            });
        </script>
    <main class="">
        @yield(section: 'main')
    </main>
</body>
</html>
