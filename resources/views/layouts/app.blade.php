<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SAHABAT</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        medical: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6', // Accent Biru (Blue main)
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
<body class="bg-[#f8fafc] text-gray-800 font-sans antialiased flex h-screen overflow-hidden">

    @auth
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col h-full hidden md:flex">
        <div class="px-6 py-6 flex items-center justify-center space-x-3 border-b border-gray-100">
            <img src="{{ asset('header.png') }}" alt="Logo" class="h-10 w-auto object-contain">
            <span class="text-2xl font-black text-blue-700 tracking-widest uppercase">SAHABAT</span>
        </div>
        <nav class="flex-1 px-4 py-8 space-y-2 relative">
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-medical-50 text-medical-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-medical-600' }}">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span>Dashboard</span>
                </div>
            </a>
            <a href="{{ route('admin.users.index') }}" class="block px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.users.*') ? 'bg-medical-50 text-medical-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-medical-600' }}">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span>Asisten Lab</span>
                </div>
            </a>
            <a href="{{ route('admin.tasks.index') }}" class="block px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.tasks.*') ? 'bg-medical-50 text-medical-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-medical-600' }}">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    <span>Manajemen Tugas</span>
                </div>
            </a>
            <a href="{{ route('admin.lab_heads.index') }}" class="block px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.lab_heads.*') ? 'bg-medical-50 text-medical-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-medical-600' }}">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M9 11l3 3L22 4"></path></svg>
                    <span>Kepala Lab</span>
                </div>
            </a>
            @else
            <a href="{{ route('user.dashboard') }}" class="block px-4 py-3 rounded-lg transition {{ request()->routeIs('user.dashboard') ? 'bg-medical-50 text-medical-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-medical-600' }}">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    <span>Form Absensi</span>
                </div>
            </a>
            <a href="{{ route('user.tasks') }}" class="block px-4 py-3 rounded-lg transition {{ request()->routeIs('user.tasks') ? 'bg-medical-50 text-medical-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-medical-600' }}">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Tugas Saya</span>
                </div>
            </a>
            <a href="{{ route('user.profile.edit') }}" class="block px-4 py-3 rounded-lg transition {{ request()->routeIs('user.profile.*') ? 'bg-medical-50 text-medical-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-medical-600' }}">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span>Profil</span>
                </div>
            </a>
            @endif
        </nav>
        <div class="p-6 border-t border-gray-100 bg-gray-50/50">
            <div class="flex items-center space-x-3 mb-6">
                @if(auth()->user()->avatar)
                    <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="Avatar" class="h-10 w-10 rounded-full object-cover border border-gray-200 bg-white shadow-sm">
                @else
                    <div class="bg-medical-100 text-medical-700 border border-medical-200 shadow-sm rounded-full h-10 w-10 flex items-center justify-center font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                @endif
                <div>
                    <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-white border border-gray-300 shadow-sm hover:bg-gray-50 hover:text-red-600 text-gray-700 py-2.5 px-4 rounded-lg transition flex items-center justify-center space-x-2 font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </aside>
    @endauth

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-full bg-[#f8fafc] overflow-y-auto w-full">
        <!-- Header Mobile (only visible on mobile) -->
        @auth
        <header class="bg-white shadow-sm px-6 py-4 md:hidden flex justify-between items-center z-10 relative border-b border-gray-200">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('header.png') }}" alt="Logo" class="h-8 w-auto">
                <span class="text-xl font-black text-blue-700 tracking-widest uppercase">SAHABAT</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-red-500 font-medium">Logout</button>
            </form>
        </header>
        @endauth

        <div class="p-6 lg:p-8 flex-1">
            @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 shadow-sm mb-6 rounded-lg flex items-center" role="alert">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 shadow-sm mb-6 rounded-lg flex items-center" role="alert">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="block sm:inline font-medium">{{ session('error') }}</span>
            </div>
            @endif

            @yield('content')
        </div>
    </main>

    @yield('scripts')
</body>
</html>
