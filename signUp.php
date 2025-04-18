<?php
session_start();
include('db_connect.php'); 

$msg = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_re_password = $_POST['user_re_password'];

    if (!empty($user_name) && !empty($user_email) && !empty($user_password)) {
        if ($user_password === $user_re_password) {
            $query = "INSERT INTO user (user, email, password) VALUES ('$user_name', '$user_email', '$user_password')";
            if (mysqli_query($conn, $query)) {
                header("Location: login.php");
                exit();
            } else {
                $msg = "Registration failed. Try again.";
            }
        } else {
            $msg = "Passwords do not match!";
        }
    } else {
        $msg = "All fields are required!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gaana Paglu | Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.85)), 
                        url('https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=1470') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }
        .music-note { animation: float 3s ease-in-out infinite; }
        .music-note:nth-child(2) { animation-delay: 0.5s; top: 20%; left: 25%; }
        .music-note:nth-child(3) { animation-delay: 1s; top: 60%; left: 75%; }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-20px); } }
        .input-field:focus { box-shadow: 0 0 0 2px #5adae0; }
        .signup-btn { transition: 0.3s ease; background: linear-gradient(to right, #111727, #1a2a4a); }
        .signup-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); }
        .password-strength { height: 4px; transition: all 0.3s; }
    </style>
</head>
<body class="text-gray-200">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <i class="bi bi-music-note-beamed text-4xl text-[#5adae0] absolute top-10 left-10 music-note"></i>
        <i class="bi bi-vinyl-fill text-3xl text-[#5adae0] absolute music-note"></i>
        <i class="bi bi-music-note-list text-4xl text-[#5adae0] absolute music-note"></i>
    </div>

    <div class="container mx-auto flex items-center justify-center min-h-screen px-4">
        <div class="flex flex-col md:flex-row w-full max-w-6xl bg-[#0b1320] rounded-xl overflow-hidden shadow-2xl">
            <!-- Left Side - Form -->
            <div class="w-full md:w-2/5 bg-white p-8 md:p-12 flex flex-col justify-center">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-[#111727]">Gaana Paglu</h1>
                    <p class="text-gray-500 mt-1">Join our musical community</p>
                </div>

                <?php if($msg): ?>
                    <div class="mb-4 text-sm text-red-600 text-center font-medium"><?= $msg ?></div>
                <?php endif; ?>

                <form method="POST" class="space-y-5">
                    <div>
                        <label for="user_name" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <div class="relative">
                            <i class="bi bi-person absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"></i>
                            <input name="user_name" type="text" required class="input-field pl-10 w-full px-4 py-2 rounded-md border border-gray-300 text-gray-700" placeholder="Enter your username">
                        </div>
                    </div>

                    <div>
                        <label for="user_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <div class="relative">
                            <i class="bi bi-envelope absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"></i>
                            <input name="user_email" type="email" required class="input-field pl-10 w-full px-4 py-2 rounded-md border border-gray-300 text-gray-700" placeholder="Enter your email">
                        </div>
                    </div>

                    <div>
                        <label for="user_password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <i class="bi bi-lock absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"></i>
                            <input name="user_password" id="password" type="password" required class="input-field pl-10 w-full px-4 py-2 rounded-md border border-gray-300 text-gray-700" placeholder="Create a password">
                        </div>
                        <div class="flex mt-1 space-x-1">
                            <div class="password-strength w-1/4 bg-gray-200 rounded-full"></div>
                            <div class="password-strength w-1/4 bg-gray-200 rounded-full"></div>
                            <div class="password-strength w-1/4 bg-gray-200 rounded-full"></div>
                            <div class="password-strength w-1/4 bg-gray-200 rounded-full"></div>
                        </div>
                    </div>

                    <div>
                        <label for="user_re_password" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <div class="relative">
                            <i class="bi bi-lock absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"></i>
                            <input name="user_re_password" type="password" required class="input-field pl-10 w-full px-4 py-2 rounded-md border border-gray-300 text-gray-700" placeholder="Confirm your password">
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" required class="h-4 w-4 text-[#5adae0] border-gray-300 rounded">
                        <label class="ml-2 block text-sm text-gray-700">I agree to the <a href="#" class="text-[#5adae0] hover:underline">Terms</a> & <a href="#" class="text-[#5adae0] hover:underline">Privacy Policy</a></label>
                    </div>

                    <button type="submit" class="signup-btn w-full py-3 px-4 rounded-md text-sm font-medium text-white focus:ring-2 focus:ring-[#5adae0]">Create Account</button>

                    <div class="text-center text-sm text-gray-600 mt-4">
                        <p>Already have an account? <a href="login.php" class="font-medium text-[#5adae0] hover:text-[#111727]">Log in</a></p>
                    </div>
                </form>
            </div>

            <!-- Right Side - Image -->
            <div class="hidden md:block md:w-3/5 relative">
                <img src="https://images.unsplash.com/photo-1501612780327-45045538702b?q=80&w=1470" alt="Music" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0b1320] to-transparent opacity-80"></div>
                <div class="absolute bottom-0 left-0 p-8 text-white">
                    <h2 class="text-4xl font-bold mb-2">Start Your Journey</h2>
                    <p class="text-lg opacity-90">Access millions of songs and connect with music lovers worldwide.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const strengthBars = document.querySelectorAll('.password-strength');
        passwordInput.addEventListener('input', function () {
            const strength = Math.min(4, Math.floor(this.value.length / 3));
            strengthBars.forEach((bar, index) => {
                bar.classList.toggle('bg-[#5adae0]', index < strength);
                bar.classList.toggle('bg-gray-200', index >= strength);
            });
        });
    </script>
</body>
</html>
