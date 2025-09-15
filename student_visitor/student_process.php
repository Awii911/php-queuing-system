<?php
session_start();
$conn = new mysqli("sql312.infinityfree.com","if0_38998585","Finch2323","if0_38998585_queue_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$last_name  = $_POST['last_name'];
$student_id = $_POST['Student_ID'];
$email      = $_POST['email'];
$number     = $_POST['number'];

try {
    // Insert into students table
    $sql = "INSERT INTO students (last_name, student_id, email, number) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $last_name, $student_id, $email, $number);
    $stmt->execute();

    $student_db_id = $stmt->insert_id; // new student.id
    $_SESSION['user_type'] = "student";
    $_SESSION['user_id']   = $student_db_id;
    $stmt->close();

    // Insert into queue_table right away
    $sql_q = "INSERT INTO queue_table (student_id, office, status) VALUES (?, NULL, 'waiting')";
    $stmt_q = $conn->prepare($sql_q);
    $stmt_q->bind_param("i", $student_db_id);
    $stmt_q->execute();
    $_SESSION['queue_id'] = $stmt_q->insert_id;
    $stmt_q->close();

    $conn->close();

    header("Location: offices.php");
    exit();

} catch (mysqli_sql_exception $e) {
    // Handle duplicate email or student_id error
    if ($conn->errno === 1062) {
        header("Location: student.php?error=Email or Student ID already exists!&last_name=$last_name&Student_ID=$student_id&email=$email&number=$number");
        exit();
    } else {
        throw $e;
    }
}
