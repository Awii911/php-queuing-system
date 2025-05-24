<?php
session_start();
$_SESSION['role'] = 'student/visitor';
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PLSP Entry</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-[#2db82d] min-h-screen flex items-center justify-center px-4 py-8">

  <!-- White Rounded Card -->
  <div class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-sm h-[90vh] flex flex-col items-center relative">

    <!--  Back Button  -->
    <a href="../index.html" class="absolute left-4 top-4 flex items-center space-x-2 text-[#2db82d] font-semibold hover:text-green-700 transition">
      <i class="fas fa-arrow-left"></i>
      <span>Back</span>
    </a>

    <!-- Logo -->
    <img src="https://plsp.edu.ph/wp-content/uploads/2022/03/PLSP-Logo-1.png" alt="PLSP Logo" class="w-24 mt-12 mb-6">

    <!-- Select User Type -->
    <p class="text-xl font-semibold text-center mb-6 py-6 px-4 text-[#2db82d]">
      Select User Type
    </p>

    <!-- Buttons -->
    <div class="flex flex-col items-center space-y-6 w-full">
      <a href="student.php" class="bg-[#2db82d] text-white py-4 text-center rounded-md font-semibold text-lg hover:bg-green-600 transition w-full max-w-xs">
        Students
      </a>
      <a href="visitor.php" class="bg-[#2db82d] text-white py-4 text-center rounded-md font-semibold text-lg hover:bg-green-600 transition w-full max-w-xs">
        Visitors
      </a>
    </div>

  </div>

</body>
</html>
