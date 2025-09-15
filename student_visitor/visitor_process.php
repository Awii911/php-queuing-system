<?php
session_start();
$conn = new mysqli("localhost", "root", "", "plsp_queuing_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$last_name      = $_POST['last_name'];
$first_name     = $_POST['first_name'];
$middle_initial = $_POST['middle_initial'];
$email          = $_POST['email'];
$number         = $_POST['number'];

try {
    // Insert into visitors
    $sql = "INSERT INTO visitors (last_name, first_name, middle_initial, email, number) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $last_name, $first_name, $middle_initial, $email, $number);
    $stmt->execute();

    $visitor_db_id = $stmt->insert_id;
    $_SESSION['user_type'] = "visitor";
    $_SESSION['user_id']   = $visitor_db_id;
    $stmt->close();

    // Insert into queue_table with visitor_id
    $sql_q = "INSERT INTO queue_table (visitor_id, office, status) VALUES (?, NULL, 'waiting')";
    $stmt_q = $conn->prepare($sql_q);
    $stmt_q->bind_param("i", $visitor_db_id);
    $stmt_q->execute();
    $_SESSION['queue_id'] = $stmt_q->insert_id;
    $stmt_q->close();

    $conn->close();

    header("Location: offices.php");
    exit();

} catch (mysqli_sql_exception $e) {
    if ($conn->errno === 1062) {
        header("Location: visitor.php?error=Email already exists!&last_name=$last_name&first_name=$first_name&middle_initial=$middle_initial&email=$email&number=$number");
        exit();
    } else {
        throw $e;
    }
}
