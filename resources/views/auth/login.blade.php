<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Absensi Lab RM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        medical: {
                            500: '#3b82f6', // Blue main
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-blue-50 flex items-center justify-center min-h-screen bg-cover bg-center" style="background-color: #eff6ff;">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border-t-8 border-medical-500">
        <div class="text-center mb-8">
            <div class="inline-block p-2 rounded-full mb-2">
                <img src="{{ asset('header.png') }}" class="h-20 w-auto object-contain" alt="SAHABAT Logo">
            </div>
            <h2 class="text-3xl font-black text-blue-700 tracking-widest uppercase mb-1">SAHABAT</h2>
            <p class="text-gray-500 font-medium tracking-wide">Sistem Absensi</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg  focus:ring-medical-500 focus:border-medical-500 outline-none transition">
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg  focus:ring-medical-500 focus:border-medical-500 outline-none transition">
            </div>

            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-medical-600 hover:bg-medical-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-medical-500 transition-colors">
                Sign In
            </button>
        </form>
    </div>
</body>
</html>
