<?php
session_start();

include 'db.php';

try {
    $query = $db->query("SELECT * FROM links");
    $links = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database query failed: " . $e->getMessage());
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Link</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Daftar Link smkn4barru</h1>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Link</th>
                    <th>Status</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>

                <!-- Isi tabel disini -->
                <?php if (count($links) > 0): ?>
                    <?php foreach ($links as $link): ?>
                        <tr>
                            <td><a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank"><?php echo htmlspecialchars($link['url']); ?></a></td>
                            <td><?php echo htmlspecialchars($link['status']); ?></td>
                            <td><?php echo htmlspecialchars($link['notes']); ?></td>
                        </tr>
                     <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                         <td colspan="3">Tidak ada data.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Kontak Admin</h2>
        <form id="contact-form" method="post" action="config.php">
            <label for="name">Nama:</label><br>
            <input type="text" id="name" name="name" required><br><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>
            <label for="message">Pesan:</label><br>
            <textarea id="message" name="message" required></textarea><br><br>
            <input type="submit" value="Kirim">
        </form>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 Daftar Link. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
