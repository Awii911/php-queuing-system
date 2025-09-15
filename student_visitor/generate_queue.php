<?php
session_start();

$user_type = $_SESSION['user_type'] ?? 'visitor';
$prefix = ($user_type === "student") ? "S-" : "V-";

// Database connection
$conn = new mysqli("sql312.infinityfree.com", "if0_38998585", "Finch2323", "if0_38998585_queue_db");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Check if table is empty
$result = $conn->query("SELECT COUNT(*) AS total FROM queue_no");
$row = $result->fetch_assoc();

if ($row['total'] == 0) {
    // Table empty: reset AUTO_INCREMENT to 1
    $conn->query("ALTER TABLE queue_no AUTO_INCREMENT = 1");
}

// Insert a new row with temporary placeholder
$insert = $conn->prepare("INSERT INTO queue_no (queue_no, user_type) VALUES (?, ?)");
$temp_queue = "TEMP";
$insert->bind_param("ss", $temp_queue, $user_type);
$insert->execute();

// Get the auto-increment ID
$id = $conn->insert_id;

// Generate actual queue number
$queue_no = $prefix . str_pad($id, 3, "0", STR_PAD_LEFT);

// Update the row with proper queue number
$update = $conn->prepare("UPDATE queue_no SET queue_no = ? WHERE id = ?");
$update->bind_param("si", $queue_no, $id);
$update->execute();

$insert->close();
$update->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Queue Number</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .queue-card {
            background-color: #fff;
            padding: 40px 60px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
            animation: fadeIn 1s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .queue-card h1 {
            font-size: 48px;
            color: #333;
            margin: 0 0 20px;
        }
        .queue-card .verified {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            color: #4CAF50;
        }
        .queue-card .verified img {
            width: 24px;
            height: 24px;
            margin-right: 8px;
        }
        .queue-card p {
            color: #666;
            font-size: 16px;
            margin-top: 10px;
        }
        .queue-card a.button-home {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #4CAF50;
            color: #fff;
            font-size: 16px;
            border-radius: 6px;
        }
        .queue-card a.button-home:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="queue-card">
        <h1><?php echo $queue_no; ?></h1>
        <div class="verified">
            <img src="https://img.icons8.com/color/48/000000/checked--v1.png" alt="Verified">
            Verified
        </div>
        <p>Your queue number has been generated successfully.</p>
        <a href="index.php" class="button-home">Home</a>
    </div>
</body>
</html>
