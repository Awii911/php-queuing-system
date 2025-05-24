<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");  
    exit();
}

// Get role and determine dashboard category
$role = strtolower($_SESSION['role'] ?? '');
$defaultCategory = ($role === 'registrar dashboard') ? 'Registrar Dashboard' :
                   (($role === 'finance dashboard') ? 'Finance Dashboard' : 'Registrar Dashboard');

$category = isset($_GET['category']) ? $_GET['category'] : $defaultCategory;

$categoryTitles = [
    'inbox' => 'Inbox',
    'ongoing' => 'Ongoing Tasks',
    'previous' => 'Previous Operation',
    'route' => 'Route to Offices',
    'Registrar Dashboard' => 'Registrar Dashboard',
    'Finance Dashboard' => 'Finance Dashboard'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $categoryTitles[$category] ?? 'Dashboard'; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <style>
    #mainContent.shifted {
      margin-left: 16rem;
      transition: margin-left 0.3s ease;
    }
    #mainContent.fullscreen {
      margin-left: 0;
      transition: margin-left 0.3s ease;
    }
  </style>
</head>
<body class="bg-[#A5D6A7] min-h-screen overflow-hidden relative">

<!-- Sidebar -->
<div id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out z-50">
  <div class="bg-[#2db82d] text-white p-4 flex items-center gap-2 justify-between">
    <div class="flex items-center gap-2">
      <img src="https://plsp.edu.ph/wp-content/uploads/2022/03/PLSP-Logo-1.png" class="w-12 h-12" alt="PLSP Logo" />
      <span class="text-xl font-bold"><?php echo $_SESSION['username']; ?></span>
    </div>
    <button onclick="toggleSidebar()" class="text-white text-xl focus:outline-none">
      <i class="fas fa-arrow-left"></i>
    </button>
  </div>

  <nav class="flex flex-col px-4 gap-4 text-lg font-medium text-black mt-4">
    <a href="?category=inbox" class="flex items-center gap-3 <?php echo ($category === 'inbox') ? 'text-[#2db82d]' : ''; ?>"><i class="far fa-envelope"></i> Inbox</a>
    <a href="?category=ongoing" class="flex items-center gap-3 <?php echo ($category === 'ongoing') ? 'text-[#2db82d]' : ''; ?>"><i class="fas fa-history"></i> Ongoing</a>
    <a href="?category=previous" class="flex items-center gap-3 <?php echo ($category === 'previous') ? 'text-[#2db82d]' : ''; ?>"><i class="fas fa-scroll"></i> Previous Operation</a>
    <a href="?category=route" class="flex items-center gap-3 <?php echo ($category === 'route') ? 'text-[#2db82d]' : ''; ?>"><i class="fas fa-running"></i> Route to Offices</a>

    <div class="flex gap-2 mt-6">
      <a href="Logout.php" class="bg-[#2db82d] text-white px-4 py-2 rounded-full flex-1 text-center">Sign out</a>
    </div>
  </nav>
</div>

<!-- Main Content -->
<div id="mainContent" class="fullscreen">
  <div class="flex items-center justify-between border-b p-4 bg-white shadow-md">
    <div class="flex items-center">
      <button onclick="toggleSidebar()" aria-label="Menu" class="text-black text-3xl font-extrabold mr-6">
        <i class="fas fa-bars"></i>
      </button>
      <h1 class="text-3xl font-extrabold text-black">
        <?php echo $categoryTitles[$category] ?? ucfirst($category); ?>
      </h1>
    </div>
  </div>

  <?php if ($category === 'Registrar Dashboard' || $category === 'Finance Dashboard'): ?>
    <div class="bg-[#A5D6A7] h-[calc(100vh-64px)] flex justify-center items-center">
      <div class="flex justify-evenly items-center w-full max-w-7xl flex-wrap gap-y-10 px-4">
        <a href="?category=inbox" class="flex flex-col items-center gap-2 w-1/5 min-w-[120px]">
          <div class="bg-[#2db82d] rounded-xl p-8 flex items-center justify-center w-28 h-28">
            <i class="far fa-envelope text-black text-6xl"></i>
          </div>
          <span class="text-black text-lg font-semibold text-center">Inbox</span>
        </a>

        <a href="?category=ongoing" class="flex flex-col items-center gap-2 w-1/5 min-w-[120px]">
          <div class="bg-[#2db82d] rounded-xl p-8 flex items-center justify-center w-28 h-28">
            <i class="fas fa-history text-black text-6xl"></i>
          </div>
          <span class="text-black text-lg font-semibold text-center">Ongoing</span>
        </a>

        <a href="?category=previous" class="flex flex-col items-center gap-2 w-1/5 min-w-[120px] text-center">
          <div class="bg-[#2db82d] rounded-xl p-8 flex items-center justify-center w-28 h-28">
            <i class="fas fa-scroll text-black text-6xl"></i>
          </div>
          <span class="text-black text-lg font-semibold leading-tight">Previous<br />Operation</span>
        </a>

        <a href="?category=route" class="flex flex-col items-center gap-2 w-1/5 min-w-[120px] text-center">
          <div class="bg-[#2db82d] rounded-xl p-8 flex items-center justify-center w-28 h-28">
            <i class="fas fa-running text-black text-6xl"></i>
          </div>
          <span class="text-black text-lg font-semibold leading-tight">Route to<br />Offices</span>
        </a>
      </div>
    </div>
  <?php else: ?>
    <div class="p-6">
      <div class="bg-white p-6 rounded-lg shadow-md">
        <?php if ($category === 'inbox'): ?>
          <h2 class="text-xl font-semibold mb-4">Inbox Messages</h2>
          <p>This is where you view incoming messages.</p>

        <?php elseif ($category === 'ongoing'): ?>
          <h2 class="text-xl font-semibold mb-4">Ongoing Tasks</h2>
          <p>Documents currently being processed.</p>

        <?php elseif ($category === 'previous'): ?>
          <h2 class="text-xl font-semibold mb-4">Previous Operations</h2>
          <p>History of completed tasks.</p>

        <?php elseif ($category === 'route'): ?>
          <h2 class="text-xl font-semibold mb-4">Route to Offices</h2>
          <p>Departmental document routing info.</p>

        <?php else: ?>
          <p>Invalid category.</p>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
</div>

<!-- Sidebar toggle script -->
<script>
  const sidebar = document.getElementById('sidebar');
  const mainContent = document.getElementById('mainContent');

  function toggleSidebar() {
    const isOpen = !sidebar.classList.contains('-translate-x-full');
    sidebar.classList.toggle('-translate-x-full');
    sidebar.classList.toggle('translate-x-0');

    if (isOpen) {
      mainContent.classList.remove('shifted');
      mainContent.classList.add('fullscreen');
    } else {
      mainContent.classList.remove('fullscreen');
      mainContent.classList.add('shifted');
    }
  }
</script>

</body>
</html>
