<?php
session_start();
include 'db.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    $new_password = htmlspecialchars($_POST['new_password']);
    
    // Hash password baru
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
    // Update password admin
    $stmt = $db->prepare("UPDATE users SET password = :password WHERE username = 'admin'");
    $stmt->bindParam(':password', $hashed_password);
    $stmt->execute();
    
    $passwordChanged = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Admin Password</title>
</head>
<body>
    <h1>Change Admin Password</h1>
    <?php if (isset($passwordChanged)): ?>
        <p style="color: green;">Password successfully changed!</p>
    <?php endif; ?>
    <form method="post" action="">
        <input type="hidden" name="change_password" value="1">
        <label for="new_password">New Password:</label><br>
        <input type="password" id="new_password" name="new_password" required><br><br>
        <input type="submit" value="Change Password">
    </form>
</body>
</html>
