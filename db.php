<?php
try {
    $db = new PDO('sqlite:links.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Buat tabel jika belum ada
    $db->exec("CREATE TABLE IF NOT EXISTS links (
        id INTEGER PRIMARY KEY,
        url TEXT NOT NULL,
        status TEXT NOT NULL,
        notes TEXT
    )");
    
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY,
        username TEXT NOT NULL,
        password TEXT NOT NULL
    )");
    
    // Tambahkan pengguna admin default jika belum ada
    $stmt = $db->prepare("INSERT OR IGNORE INTO users (username, password) VALUES (:username, :password)");
    $stmt->execute([
        ':username' => 'admin',
        ':password' => password_hash('adminpassword', PASSWORD_DEFAULT) // Ganti dengan password yang lebih aman
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
