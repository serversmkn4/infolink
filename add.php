<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url = $_POST['url'];
    $status = $_POST['status'];
    $notes = $_POST['notes'];

    $stmt = $db->prepare("INSERT INTO links (url, status, notes) VALUES (:url, :status, :notes)");
    $stmt->bindParam(':url', $url);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':notes', $notes);

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error: Tidak bisa menambahkan data.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Link</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Tambah Link</h1>
    <form method="post" action="">
        <label for="url">URL:</label><br>
        <input type="text" id="url" name="url" required><br><br>
        <label for="status">Status:</label><br>
        <input type="text" id="status" name="status" required><br><br>
        <label for="notes">Catatan:</label><br>
        <textarea id="notes" name="notes"></textarea><br><br>
        <input type="submit" value="Tambah">
    </form>
    <a href="admin.php">Kembali</a>
</body>
</html>
