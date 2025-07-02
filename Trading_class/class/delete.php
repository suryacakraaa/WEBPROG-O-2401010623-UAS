<?php
include '../config.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM classes WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: list.php");
exit();
