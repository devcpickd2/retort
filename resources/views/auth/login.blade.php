<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-RETORT Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: linear-gradient(rgba(180, 30, 30, 0.6), rgba(180, 30, 30, 0.6)), url('images/rtt.png');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="flex justify-center items-center h-screen">

    <div class="relative z-10 text-center text-white space-y-8">
        <h1 class="text-6xl font-extrabold tracking-widest uppercase">RETORT</h1>

        <div class="w-[420px] p-10 bg-[rgba(180,30,30,0.6)] backdrop-blur-sm border border-white border-opacity-30 rounded-2xl shadow-[0_10px_25px_rgba(0,0,0,0.25)] flex flex-col items-center space-y-5">

            <!-- Notifikasi Error -->
            @if($errors->has('login_error'))
                <div class="w-full bg-red-700 text-white text-sm py-2 px-4 rounded-lg text-left">
                    <i class="fas fa-exclamation-circle mr-2"></i> {{ $errors->first('login_error') }}
                </div>
            @endif

            <form method="POST" action="{{ url('/login') }}" class="w-full space-y-5">
                @csrf
                <!-- Username -->
                <div class="relative">
                    <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-white text-lg"></i>
                    <input type="text" name="username" placeholder="Username"
                           value="{{ old('username') }}"
                           class="w-full pl-12 pr-4 py-3 bg-white bg-opacity-30 text-white placeholder-white placeholder-opacity-70 rounded-lg focus:outline-none focus:bg-opacity-40 transition-colors duration-300">
                </div>

                <!-- Password -->
                <div class="relative">
                    <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-white text-lg"></i>
                    <input type="password" name="password" placeholder="Password"
                           class="w-full pl-12 pr-4 py-3 bg-white bg-opacity-30 text-white placeholder-white placeholder-opacity-70 rounded-lg focus:outline-none focus:bg-opacity-40 transition-colors duration-300">
                </div>

                <!-- Tombol Login -->
                <button type="submit" class="w-full py-3 mt-4 font-semibold text-white bg-red-800 rounded-lg hover:bg-red-900 transition-colors duration-300">
                    LOGIN
                </button>
            </form>
        </div>
    </div>
</body>
</html>
