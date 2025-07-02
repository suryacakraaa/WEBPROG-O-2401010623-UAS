<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_id = $_POST['class_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $experience_level = $_POST['experience_level'];
    $message = $_POST['message'];

    $stmt = $pdo->prepare("INSERT INTO participants (class_id, full_name, email, phone, experience_level, message) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$class_id, $full_name, $email, $phone, $experience_level, $message]);

    header("Location: list_peserta.php");
    exit();
}
?>
