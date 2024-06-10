<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menangkap data dari form
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Validasi data form
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Lengkapi form dan coba lagi.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Konfigurasi Server SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'serxx4@gmail.com'; // Ganti dengan alamat email Gmail Anda
        $mail->Password = 'qissooth-dari-gmail-app'; // Ganti dengan sandi aplikasi atau sandi email Gmail Anda
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Pengaturan Email
        $mail->setFrom('servcdsd@gmail.com', 'aplikasi info'); // Ganti dengan alamat email dan nama pengirim
        $mail->addAddress('servedfsd@gmail.com', 'admin'); // Ganti dengan alamat email penerima yang sama

        $mail->isHTML(true);
        $mail->Subject = 'Pesan Baru dari Form Kontak';
        $mail->Body    = "<p>Nama: $name</p><p>Email: $email</p><p>Pesan: $message</p>";

        $mail->send();
        echo 'Email telah berhasil dikirim.';
        // Redirect ke halaman utama (home)
        echo '<script>
        setTimeout(function() {
        window.location.href = "index.php"; // Redirect setelah 3 detik
        }, 3000); // Delay selama 3 detik (3000 milidetik)
        </script>';


} catch (Exception $e) {
echo 'Email tidak dapat dikirim. Mailer Error: ', $mail->ErrorInfo;
}
} else {
http_response_code(403);
echo "Ada masalah dengan pengiriman pesan, coba lagi.";
}
?>


