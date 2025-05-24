<?php 
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $accounts = [
        "Window 1" => ["password" => "login", "role" => "Registrar"],
        "Window 2" => ["password" => "PLSP Registrar 2025-2026", "role" => "Registrar Dashboard"],
        "Window 3" => ["password" => "PLSP Registrar 2025-2026", "role" => "Registrar Dashboard"],
        "Window 4" => ["password" => "PLSP Registrar 2025-2026", "role" => "Registrar Dashboard"],
        "Window 5" => ["password" => "PLSP Registrar 2025-2026", "role" => "Registrar Dashboard"],
        "Window 6" => ["password" => "PLSP Registrar 2025-2026", "role" => "Registrar Dashboard"],
        "Finance" => ["password" => "finance123", "role" => "Finance Dashboard"]
    ];

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($accounts[$username]) && $accounts[$username]['password'] === $password) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $accounts[$username]['role'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-white flex flex-col items-center justify-center min-h-screen relative m-0 p-0">

    <div class="w-full max-w-full">
        <!-- Green Header with Back Button -->
        <div class="bg-[#2db82d] relative flex justify-center py-8">
            <a href="../index.html" class="absolute left-4 top-4 flex items-center space-x-2 text-white font-semibold hover:text-gray-200 transition">
    <i class="fas fa-arrow-left"></i>
    <span>Back</span>
</a>

            </a>
            <img src="https://plsp.edu.ph/wp-content/uploads/2022/03/PLSP-Logo-1.png" alt="PLSP LOGO" class="w-32 h-32 object-contain">
        </div>

        <h2 class="text-2xl font-bold my-4 text-center text-green-600">Admin Login</h2>

        <form action="index.php" method="POST" autocomplete="off" class="px-8 py-6 flex flex-col items-center space-y-4 w-full max-w-md mx-auto">
            <?php if ($error): ?>
                <div class="text-red-500 font-semibold mb-4"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="w-full">
                <label class="sr-only" for="admin_user">Username</label>
                <div class="flex items-center border border-black rounded-full px-4 py-2 space-x-3 text-[#2db82d]">
                    <i class="fas fa-user text-lg"></i>
                    <input type="text" name="username" id="admin_user" placeholder="Username" required autocomplete="off" class="bg-transparent outline-none w-full text-black placeholder:text-[#2db82d]">
                </div>
            </div>

            <div class="w-full relative">
                <label class="sr-only" for="reg_pass">Password</label>
                <div class="flex items-center border border-black rounded-full px-4 py-2 space-x-3 text-[#2db82d]">
                    <i class="fas fa-lock text-lg"></i>
                    <input type="password" name="password" id="reg_pass" placeholder="Password" required autocomplete="new-password" class="bg-transparent outline-none w-full text-black placeholder:text-[#2db82d]">
                    <button type="button" id="togglePassword" class="text-[#2db82d] focus:outline-none">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-40 py-2 rounded-full font-semibold text-black bg-gradient-to-r from-[#2db82d] to-[#a6d96a]">
                Log in
            </button>
        </form>
    </div>

    <script>
        // Password visibility toggle
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('reg_pass');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
