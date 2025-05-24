<?php
session_start();
// Clear session data so no leftover info is shown
session_unset();
session_destroy();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Entry</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-[#2db82d] min-h-screen flex items-center justify-center px-4 py-8">

  <div class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-sm relative">
    
    <!-- Back Button -->
    <a href="index.php" class="flex items-center space-x-2 text-[#2db82d] font-semibold hover:text-green-700 transition absolute top-4 left-4">
      <i class="fas fa-arrow-left"></i>
      <span>Back</span>
    </a>

    <!-- Logo -->
    <div class="flex justify-center mt-12 mb-6">
      <img src="https://plsp.edu.ph/wp-content/uploads/2022/03/PLSP-Logo-1.png" alt="PLSP Logo" class="w-24" />
    </div>

    <!-- Form -->
    <form action="process.php" method="POST" class="space-y-5">
      <div>
        <label class="text-sm font-semibold text-gray-700 block mb-1">Last Name</label>
        <input type="text" name="last_name" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
      </div>
      <div>
        <label class="text-sm font-semibold text-gray-700 block mb-1">Student ID</label>
        <input type="text" name="Student_ID" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
      </div>
      <div>
        <label class="text-sm font-semibold text-gray-700 block mb-1">Email</label>
        <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
      </div>
      <div>
        <label class="text-sm font-semibold text-gray-700 block mb-1">Number</label>
        <input type="tel" name="number" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
      </div>
      
      <button type="submit" class="w-full bg-[#2db82d] text-white font-semibold py-2 rounded-lg hover:bg-green-600 transition">
        Proceed
      </button>
    </form>
  </div>

</body>
</html>
