<?php
session_start();
include('db_connect.php'); 
$msg = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];

    $query = "SELECT * FROM user WHERE user = '$user_name' AND password = '$user_password' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        header("Location: index1.php");
        exit();
    } else {
        $msg = "Incorrect Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaana Paglu | Music Website Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.85)),
            url('https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=1470&auto=format&fit=crop') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }
        .music-note { animation: float 3s ease-in-out infinite; }
        .music-note:nth-child(2) { animation-delay: 0.5s; top: 20%; left: 25%; }
        .music-note:nth-child(3) { animation-delay: 1s; top: 60%; left: 75%; }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-20px); } }
        .input-field:focus { box-shadow: 0 0 0 2px #5adae0; }
        .login-btn {
            transition: all 0.3s ease;
            background: linear-gradient(to right, #111727, #1a2a4a);
        }
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="text-gray-200">
    <!-- Floating Music Notes -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <i class="bi bi-music-note-beamed text-4xl text-[#5adae0] absolute top-10 left-10 music-note"></i>
        <i class="bi bi-vinyl-fill text-3xl text-[#5adae0] absolute music-note"></i>
        <i class="bi bi-music-note-list text-4xl text-[#5adae0] absolute music-note"></i>
    </div>

    <div class="container mx-auto flex items-center justify-center min-h-screen px-4">
        <div class="flex flex-col md:flex-row w-full max-w-6xl bg-[#0b1320] rounded-xl overflow-hidden shadow-2xl">
            <!-- Left Side - Login Form -->
            <div class="w-full md:w-2/5 bg-white p-8 md:p-12 flex flex-col justify-center">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-[#111727]">Gaana Paglu</h1>
                    <p class="text-gray-500 mt-1">Your gateway to musical bliss</p>
                </div>
                
                <?php if ($msg): ?>
                    <div class="text-red-500 text-sm text-center mb-4">
                        <?= $msg ?>
                    </div>
                <?php endif; ?>

                <form class="space-y-6" method="POST">
                    <div>
                        <label for="user_name" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-person text-gray-400"></i>
                            </div>
                            <input type="text" name="user_name" id="user_name"
                                   class="input-field pl-10 w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#5adae0] text-gray-700"
                                   placeholder="Enter your username" required>
                        </div>
                    </div>

                    <div>
                        <label for="user_password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-lock text-gray-400"></i>
                            </div>
                            <input type="password" name="user_password" id="user_password"
                                   class="input-field pl-10 w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#5adae0] text-gray-700"
                                   placeholder="Enter your password" required>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-[#5adae0] focus:ring-[#5adae0] border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                        </div>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-[#5adae0] hover:text-[#111727]">Forgot password?</a>
                        </div>
                    </div>

                    <button type="submit"
                            class="login-btn w-full py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5adae0]">
                        Sign in
                    </button>

                    <div class="text-center text-sm text-gray-600 mt-6">
                        <p>Don't have an account? <a href="signUp.php" class="font-medium text-[#5adae0] hover:text-[#111727]">Sign up</a></p>
                    </div>
                </form>
            </div>

            <!-- Right Side - Image -->
            <div class="hidden md:block md:w-3/5 relative">
                <img src="https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?q=80&w=1469&auto=format&fit=crop"
                     alt="Music concert"
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0b1320] to-transparent opacity-80"></div>
                <div class="absolute bottom-0 p-8 text-white">
                    <h2 class="text-4xl font-bold mb-2">Feel The Music</h2>
                    <p class="text-lg opacity-90">Stream millions of songs, anywhere, anytime.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
