<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Windows Selection</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-[#2db82d] min-h-screen flex items-center justify-center px-4 py-8">

  <!-- White Rounded Card -->
  <div class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-sm relative min-h-[80vh] overflow-auto">

    <!-- Back Button (Left) -->
    <a href="process.php" class="flex items-center space-x-2 text-[#2db82d] font-semibold hover:text-green-700 transition absolute top-4 left-4">
      <i class="fas fa-arrow-left"></i>
      <span>Back</span>
    </a>

    <!-- Window Info Link (Right) -->
    <a href="Windows Info.php" class="flex items-center space-x-2 text-[#2db82d] font-semibold hover:text-green-700 transition absolute top-4 right-4">
      <span>Windows Info</span>
    </a>

    <!-- Logo -->
    <div class="flex justify-center mt-12 mb-6">
      <img src="https://plsp.edu.ph/wp-content/uploads/2022/03/PLSP-Logo-1.png" alt="PLSP Logo" class="w-24" />
    </div>

    <!-- Title -->
<p class="text-sm font-bold text-[#2db82d] text-center mb-6">
  Choose Window
</p>


    <!-- 6 Windows -->
    <div class="flex flex-col items-center space-y-4 w-full px-2 bg-white py-4 rounded-lg">
      <a href="Window 1.php" class="bg-[#2db82d] text-white py-3 text-center rounded-md font-semibold text-lg hover:bg-green-600 transition w-full max-w-xs">Window 1</a>
      <a href="Window 2.php" class="bg-[#2db82d] text-white py-3 text-center rounded-md font-semibold text-lg hover:bg-green-600 transition w-full max-w-xs">Window 2</a>
      <a href="Window 3.php" class="bg-[#2db82d] text-white py-3 text-center rounded-md font-semibold text-lg hover:bg-green-600 transition w-full max-w-xs">Window 3</a>
      <a href="Window 4.php" class="bg-[#2db82d] text-white py-3 text-center rounded-md font-semibold text-lg hover:bg-green-600 transition w-full max-w-xs">Window 4</a>
      <a href="Window 5.php" class="bg-[#2db82d] text-white py-3 text-center rounded-md font-semibold text-lg hover:bg-green-600 transition w-full max-w-xs">Window 5</a>
      <a href="Window 6.php" class="bg-[#2db82d] text-white py-3 text-center rounded-md font-semibold text-lg hover:bg-green-600 transition w-full max-w-xs">Window 6</a>
    </div>
    

  </div>

</body>
</html>
