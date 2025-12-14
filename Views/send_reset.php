<?php
session_start();
include '../config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer-master/src/Exception.php';
require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';

if (!isset($_POST['email'])) die("Email manquant");

$email = $_POST['email'];
$db = config::getConnexion();

// Vérifier si l'utilisateur existe
$stmt = $db->prepare("SELECT * FROM userr WHERE email = :e");
$stmt->execute(['e' => $email]);
$user = $stmt->fetch();

if (!$user) {
    die("Aucun utilisateur trouvé avec cet email.");
}

// Générer code + expiration
$otp = rand(100000, 999999);
$expire = date("Y-m-d H:i:s", time() + 300); // 5 min

$update = $db->prepare("UPDATE userr 
    SET otp_code = :otp, otp_expire = :ex 
    WHERE email = :e");
$update->execute([
    'otp' => $otp,
    'ex'  => $expire,
    'e'   => $email
]);

// Envoi mail
$mail = new PHPMailer(true);

try {
    
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ghaithkhalfaoui982@gmail.com';
    $mail->Password = 'xsne yknu ixzq hwfi';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom('ghaithkhalfaoui982@gmail.com', 'Réinitialisation');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Réinitialisation du mot de passe';
    $mail->Body = "Bonjour,<br><br>
        Votre code de réinitialisation est : <b>$otp</b><br>
        Il expire dans <b>5 minutes</b>.";

    $mail->send();

    $_SESSION['reset_email'] = $email;
    header("Location: reset_password.php");
    exit;

} catch (Exception $e) {
    die("Erreur mail: " . $mail->ErrorInfo);
}
