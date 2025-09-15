<?php
session_start();

// Get POST data safely
$user_type        = $_SESSION['user_type'] ?? 'visitor'; // student or visitor
$user_id          = $_SESSION['user_id'] ?? null;
$office           = $_POST['office'] ?? '';
$window_no        = $_POST['window_number'] ?? null;
$transaction_type = $_POST['transaction_type'] ?? '';
$others           = $_POST['others'] ?? '';

// If "Others" has value, override transaction_type
if (!empty(trim($others))) {
    $transaction_type = $others;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "plsp_queuing_system");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Get user info
if ($user_type === "student") {
    $sql_user = $conn->prepare("SELECT * FROM students WHERE id=?");
} else {
    $sql_user = $conn->prepare("SELECT * FROM visitors WHERE id=?");
}
$sql_user->bind_param("i", $user_id);
$sql_user->execute();
$result_user = $sql_user->get_result();
$user = $result_user->fetch_assoc();
$sql_user->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaction Receipt</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-[#2db82d] flex items-center justify-center min-h-screen p-4">

<div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6 flex flex-col">

    <!-- Back Button (inside white box, upper-left) -->
    <a href="offices.php" 
       class="flex items-center space-x-2 text-[#2db82d] font-semibold hover:text-green-700 transition self-start mb-4">
        <i class="fas fa-arrow-left"></i>
        <span>Back</span>
    </a>

    <!-- Logo -->
    <div class="flex justify-center mb-6">
        <img src="https://plsp.edu.ph/wp-content/uploads/2022/03/PLSP-Logo-1.png"
             alt="PLSP Logo" class="w-24">
    </div>

    <h2 class="text-2xl font-bold text-center mb-6">Transaction Receipt</h2>

    <!-- Info Container -->
    <div class="space-y-3">

        <!-- Row Template -->
        <?php function infoRow($label, $value) { ?>
            <div class="flex justify-between border-b border-gray-200 py-1">
                <span class="font-semibold text-gray-700"><?= htmlspecialchars($label) ?></span>
                <span class="text-gray-800"><?= htmlspecialchars($value) ?></span>
            </div>
        <?php } ?>

        <?php infoRow("User Type", ucwords($user_type)); ?>

        <?php if ($user_type === "student"): ?>
            <?php infoRow("Student ID", $user['student_id']); ?>
            <?php infoRow("Name", ucwords($user['last_name'])); ?>
            <?php infoRow("Email", strtolower($user['email'])); ?>
            <?php infoRow("Number", $user['number']); ?>
        <?php else: ?>
            <?php infoRow("Name", ucwords($user['last_name'].' '.$user['first_name'].' '.$user['middle_initial'])); ?>
            <?php infoRow("Email", strtolower($user['email'])); ?>
            <?php infoRow("Number", $user['number']); ?>
        <?php endif; ?>

        <?php infoRow("Office", ucwords($office)); ?>

        <?php if (!empty($window_no)): ?>
            <?php infoRow("Window No", $window_no); ?>
        <?php endif; ?>

        <?php infoRow("Transaction Type", ucwords($transaction_type)); ?>

    </div>

    <!-- Finish Button -->
    <div class="mt-6 flex justify-center">
        <a href="index.php" class="bg-[#2db82d] hover:bg-green-600 text-white px-6 py-2 rounded-lg font-semibold transition">
            Finish
        </a>
    </div>
</div>

</body>
</html>
