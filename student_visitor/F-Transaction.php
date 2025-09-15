<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finance Transaction</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-[#2db82d] flex items-center justify-center min-h-screen">

  <div class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-sm h-[90vh] flex flex-col items-center relative">

    <!-- Back Button -->
    <a href="offices.php" class="flex items-center space-x-2 text-[#2db82d] font-semibold hover:text-green-700 transition absolute top-4 left-4">
      <i class="fas fa-arrow-left"></i>
      <span>Back</span>
    </a>

    <!-- Logo -->
    <img src="https://plsp.edu.ph/wp-content/uploads/2022/03/PLSP-Logo-1.png"
         alt="PLSP Logo"
         class="w-24 mt-10 mb-8">

    <!-- Finance Label -->
    <div class="text-sm font-bold text-white bg-[#2db82d] px-4 py-1 rounded-full mb-6">
      Finance Transaction
    </div>

    <!-- Transaction Form -->
    <form action="receipt.php" method="POST" class="w-full flex flex-col gap-4 mb-6">

      <select name="transaction_type" required
              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
        <option disabled selected hidden>Select Transaction</option>
        <option value="Payment">Payment</option>
        <option value="Enrollment Fee">Enrollment Fee</option>
        <option value="Clearance">Clearance</option>
      </select>

      <input type="text" name="others" placeholder="Others / Please Specify"
             class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">

      <!-- Hidden office value -->
      <input type="hidden" name="office" value="Finance">

      <!-- Proceed Button -->
      <button type="submit"
              class="w-full bg-[#2db82d] hover:bg-green-600 text-white font-semibold py-2 rounded-lg transition">
        Proceed
      </button>
    </form>
  </div>

</body>
</html>
