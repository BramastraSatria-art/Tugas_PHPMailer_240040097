<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$pesan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama    = $_POST['nama'];
    $email   = $_POST['email'];
    $telepon = $_POST['telepon'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'bramastrasatriaprojek@gmail.com';
        $mail->Password   = 'uclt opwp xzuq iimw'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('bramastrasatriaprojek@gmail.com', 'Panitia');
        $mail->addAddress($email, $nama);

        $mail->isHTML(true);
        $mail->Subject = 'Konfirmasi Pendaftaran';
        $mail->Body    = "
            <h2>Halo, $nama!</h2>
            <p>Pendaftaran Anda telah berhasil diterima.</p>
            <ul>
                <li>Nama: $nama</li>
                <li>Email: $email</li>
                <li>No. Telepon: $telepon</li>
            </ul>
            <p>Terima kasih!</p>
        ";

        $mail->send();
        $pesan = "Pendaftaran berhasil! Email konfirmasi telah dikirim ke $email";

    } catch (Exception $e) {
        $pesan = "Gagal mengirim email: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>
</head>
<body>
    <h2>Formulir Pendaftaran</h2>

    <?php if ($pesan): ?>
        <?php echo $pesan; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>No. Telepon:</label><br>
        <input type="text" name="telepon" required><br><br>

        <button type="submit">Daftar</button>
    </form>
</body>
</html>