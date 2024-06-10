<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

$id = $_GET['id'];
$stmt = $db->prepare("DELETE FROM links WHERE id = :id");
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    header("Location: admin.php");
} else {
    echo "Error: Tidak bisa menghapus data.";
}
?>
