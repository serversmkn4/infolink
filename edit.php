<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

$id = $_GET['id'];
$query = $db->prepare("SELECT * FROM links WHERE id = :id");
$query->bindParam(':id', $id);
$query->execute();
$link = $query->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url = $_POST['url'];
    $status = $_POST['status'];
    $notes = $_POST['notes'];

    $stmt = $db->prepare("UPDATE links SET url = :url, status = :status, notes = :notes WHERE id = :id");
    $stmt->bindParam(':url', $url);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':notes', $notes);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: admin.php");
    } else {
        echo "Error: Tidak bisa mengupdate data.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Link</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Edit Link</h1>
    <form method="post" action="">
        <label for="url">URL:</label><br>
        <input type="text" id="url" name="url" value="<?php echo htmlspecialchars($link['url']); ?>" required><br><br>
        <label for="status">Status:</label><br>
        <input type="text" id="status" name="status" value="<?php echo htmlspecialchars($link['status']); ?>" required><br><br>
        <label for="notes">Catatan:</label><br>
        <textarea id="notes" name="notes"><?php echo htmlspecialchars($link['notes']); ?></textarea><br><br>
        <input type="submit" value="Update">
    </form>
    <a href="admin.php">Kembali</a>
</body>
</html>
