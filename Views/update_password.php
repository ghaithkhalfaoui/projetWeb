<?php
session_start();
include '../config.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Mise à jour mot de passe</title>

<style>
/* ================= VARIABLES ================= */
:root {
    --bg-dark: #0a0a0f;
    --panel: rgba(19, 19, 31, 0.75);
    --primary: #00f2ff;
    --accent: #bc13fe;
    --text: #ffffff;
    --muted: #a0a0b0;
    --border: rgba(255,255,255,0.08);
    --success: #2ecc71;
    --error: #e74c3c;
}

/* ================= RESET ================= */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', system-ui, sans-serif;
}

/* ================= BODY ================= */
body {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: var(--bg-dark);
    color: var(--text);
    padding: 20px;
    position: relative;
    overflow: hidden;
}

/* Grille cyber */
body::before {
    content: '';
    position: fixed;
    inset: 0;
    background:
        linear-gradient(rgba(0,242,255,0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,242,255,0.03) 1px, transparent 1px);
    background-size: 50px 50px;
    pointer-events: none;
}

/* Halo lumineux */
body::after {
    content: '';
    position: fixed;
    inset: 0;
    background: radial-gradient(circle at center,
        rgba(0,242,255,0.18),
        transparent 65%);
    animation: ambient 5s ease-in-out infinite;
    pointer-events: none;
}

@keyframes ambient {
    0%,100% { opacity: .3; }
    50% { opacity: .6; }
}

/* ================= CONTAINER ================= */
.container {
    position: relative;
    width: 420px;
    padding: 40px 35px;
    background: var(--panel);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 22px;
    border: 1px solid var(--border);
    text-align: center;
    box-shadow:
        0 0 35px rgba(0,0,0,0.6),
        inset 0 0 20px rgba(255,255,255,0.04);
    animation: appear 0.6s ease;
}

/* contour néon */
.container::before {
    content: '';
    position: absolute;
    inset: 0;
    padding: 2px;
    border-radius: 22px;
    background: linear-gradient(135deg, var(--primary), var(--accent));
    -webkit-mask:
        linear-gradient(#fff 0 0) content-box,
        linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    opacity: 0.35;
    pointer-events: none;
}

@keyframes appear {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ================= TITRE ================= */
h2 {
    font-size: 26px;
    margin-bottom: 12px;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
    background: linear-gradient(135deg, var(--primary), var(--accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ================= TEXTE ================= */
p {
    color: var(--muted);
    margin-bottom: 22px;
    font-size: 15px;
    line-height: 1.6;
}

/* ================= BOUTON / LIEN ================= */
a {
    display: inline-block;
    margin-top: 22px;
    padding: 14px 26px;
    border-radius: 14px;
    font-size: 16px;
    font-weight: 800;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #000;
    background: linear-gradient(135deg, var(--primary), #00a8ff);
    text-decoration: none;
    transition: 0.3s;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 18px rgba(0,242,255,0.4);
}

/* effet brillance */
a::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg,
        transparent,
        rgba(255,255,255,0.35),
        transparent);
    transform: translateX(-100%);
    transition: 0.5s;
}

a:hover::before {
    transform: translateX(100%);
}

a:hover {
    transform: translateY(-2px) scale(1.05);
    box-shadow:
        0 0 35px rgba(0,242,255,0.6),
        0 0 60px rgba(0,242,255,0.3);
}

/* ================= SUCCESS ================= */
.success {
    font-size: 18px;
    font-weight: 800;
    margin-bottom: 14px;
    color: var(--success);
    text-shadow: 0 0 12px rgba(46,204,113,0.6);
}

/* ================= ERROR ================= */
.error {
    font-size: 18px;
    font-weight: 800;
    margin-bottom: 14px;
    color: var(--error);
    text-shadow: 0 0 12px rgba(231,76,60,0.6);
}



</style>
</head>
<body>
<div class="container">
<?php

// Si la session n’existe pas → erreur
if (!isset($_SESSION['reset_email'])) {
    echo "<p class='error'>Erreur de session. Veuillez recommencer.</p>";
    echo "<a href='forgot_password.php'>Retour</a>";
    exit;
}

$email = $_SESSION['reset_email'];
$otp = $_POST['otp'] ?? '';
$newpass = $_POST['password'];

$db = config::getConnexion();

// Vérifier si l’utilisateur existe
$stmt = $db->prepare("SELECT otp_code, otp_expire FROM userr WHERE email = :e");
$stmt->execute(['e' => $email]);
$user = $stmt->fetch();

if (!$user) {
    echo "<p class='error'>Utilisateur introuvable.</p>";
    echo "<a href='forgot_password.php'>Retour</a>";
    exit;
}

// Vérification du code OTP
if ($otp != $user['otp_code']) {
    echo "<p class='error'>Code incorrect !</p>";
    echo "<a href='reset_password.php'>Réessayer</a>";
    exit;
}

if (strtotime($user['otp_expire']) < time()) {
    echo "<p class='error'>Code expiré !</p>";
    echo "<a href='forgot_password.php'>Envoyer un nouveau code</a>";
    exit;
}

// Mise à jour du mot de passe
$update = $db->prepare("
    UPDATE userr 
    SET motdepasse = :m, otp_code=NULL, otp_expire=NULL 
    WHERE email = :e
");
$update->execute([
    'm' => $newpass,
    'e' => $email
]);

// Fin session OTP
unset($_SESSION['reset_email']);

echo "<p class='success'>Mot de passe mis à jour avec succès !</p>";
echo "<a href='liste.php'>Se connecter</a>";
?>
</div>
</body>
</html>
