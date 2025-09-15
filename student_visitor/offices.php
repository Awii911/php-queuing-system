<?php
session_start();
$conn = new mysqli("localhost", "root", "", "plsp_queuing_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['office'])) {
    $_SESSION['office'] = $_POST['office'];
    $office = $_POST['office'];

    // Get the current user queue record
    $user_id   = $_SESSION['user_id'];
    $user_type = $_SESSION['user_type']; // "student" or "visitor"

    if ($user_type === "student") {
        $sql = "UPDATE queue_table SET office = ? WHERE student_id = ?";
    } else {
        $sql = "UPDATE queue_table SET office = ? WHERE visitor_id = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $office, $user_id);
    $stmt->execute();
    $stmt->close();

    // Redirect based on office
    if ($office === "Registrar") {
        header("Location: Windows.php");
    } else {
        header("Location: F-Transaction.php");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PLSP Offices</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-[#2db82d] min-h-screen flex items-center justify-center px-4 py-8">

  <!-- White Rounded Card -->
  <div class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-sm h-[90vh] flex flex-col items-center relative">

    <!-- Back Button -->
    <a href="index.php" class="flex items-center space-x-2 text-[#2db82d] font-semibold hover:text-green-700 transition absolute top-4 left-4">
      <i class="fas fa-arrow-left"></i>
      <span>Back</span>
    </a>

    <!-- Logo -->
    <img src="https://plsp.edu.ph/wp-content/uploads/2022/03/PLSP-Logo-1.png"
         alt="PLSP Logo"
         class="w-24 mt-10 mb-24">

    <!-- Office Selection Form -->
    <form action="offices.php" method="POST" class="flex flex-col items-center space-y-6 w-full">
      <button type="submit" name="office" value="Registrar"
              class="bg-[#2db82d] text-white py-4 text-center rounded-md font-semibold text-lg hover:bg-green-600 transition w-full max-w-xs">
        Registrar
      </button>
      <button type="submit" name="office" value="Finance"
              class="bg-[#2db82d] text-white py-4 text-center rounded-md font-semibold text-lg hover:bg-green-600 transition w-full max-w-xs">
        Finance
      </button>
    </form>

  </div>

</body>
</html>
