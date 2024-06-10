<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$query = $db->query("SELECT * FROM links");
$links = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Link</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Admin - Daftar Link dengan Status dan Catatan</h1>
    <a href="add.php">Tambah Link</a> |
    <a href="logout.php">Logout</a> | <a href="change_password.php">Change Password</a>
    <table>
        <thead>
            <tr>
                <th>Link</th>
                <th>Status</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($links) > 0): ?>
                <?php foreach ($links as $link): ?>
                    <tr>
                        <td><a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank"><?php echo htmlspecialchars($link['url']); ?></a></td>
                        <td><?php echo htmlspecialchars($link['status']); ?></td>
                        <td><?php echo htmlspecialchars($link['notes']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $link['id']; ?>">Edit</a> |
                            <a href="delete.php?id=<?php echo $link['id']; ?>" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Tidak ada data.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
