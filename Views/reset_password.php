<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Nouveau mot de passe</title>

<style>
/* ================= VARIABLES ================= */
:root {
    --bg-dark: #0a0a0f;
    --bg-header: #111827;
    --panel: rgba(19, 19, 31, 0.75);
    --primary: #00f2ff;
    --accent: #bc13fe;
    --text: #ffffff;
    --muted: #a0a0b0;
    --border: rgba(255,255,255,0.08);
}

/* ================= BODY ================= */
body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', system-ui, sans-serif;
    background: var(--bg-dark);
    color: var(--text);
    min-height: 100vh;
    position: relative;
    overflow-x: hidden;
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
    z-index: 0;
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
    z-index: 0;
}

@keyframes ambient {
    0%,100% { opacity: .3; }
    50% { opacity: .6; }
}

/* ================= HEADER ================= */
header {
    position: relative;
    z-index: 2;
    width: 100%;
    background: linear-gradient(135deg, #0d0d18, var(--bg-header));
    padding: 16px 45px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid var(--border);
    box-shadow: 0 0 25px rgba(0,242,255,0.15);
}

header nav a {
    color: var(--text);
    text-decoration: none;
    margin-left: 28px;
    font-size: 16px;
    transition: 0.3s;
}

header nav a:hover {
    color: var(--primary);
    text-shadow: 0 0 10px var(--primary);
}

.logo {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 22px;
    font-weight: 800;
}

.logo img {
    height: 55px;
    filter: drop-shadow(0 0 10px rgba(0,242,255,0.4));
}

/* ================= CONTAINER ================= */
.container {
    position: relative;
    z-index: 1;
    width: 380px;
    margin: 90px auto;
    padding: 35px;
    background: var(--panel);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 20px;
    border: 1px solid var(--border);
    box-shadow:
        0 0 30px rgba(0,0,0,0.6),
        inset 0 0 20px rgba(255,255,255,0.04);
    animation: appear 0.6s ease;
}

/* contour néon */
.container::before {
    content: '';
    position: absolute;
    inset: 0;
    padding: 2px;
    border-radius: 20px;
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
    from { opacity: 0; transform: translateY(25px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ================= TITRE ================= */
h2 {
    margin-bottom: 25px;
    text-align: center;
    font-size: 24px;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
    background: linear-gradient(135deg, var(--primary), var(--accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ================= LABEL ================= */
label {
    display: block;
    margin-bottom: 6px;
    font-size: 14px;
    font-weight: bold;
    color: var(--muted);
}

/* ================= INPUT ================= */
input {
    width: 100%;
    padding: 13px 15px;
    margin-bottom: 18px;
    border-radius: 12px;
    border: 1px solid var(--border);
    background: rgba(0,0,0,0.35);
    color: var(--text);
    font-size: 14px;
    outline: none;
    transition: 0.3s;
    box-shadow: inset 0 2px 5px rgba(0,0,0,0.4);
}

input::placeholder {
    color: var(--muted);
    opacity: 0.6;
}

input:focus {
    border-color: var(--primary);
    background: rgba(0,0,0,0.5);
    box-shadow:
        0 0 18px rgba(0,242,255,0.35),
        inset 0 2px 5px rgba(0,0,0,0.5);
}

/* animation password */
input[type="password"]:focus {
    animation: cyberPulse 2s infinite;
}

@keyframes cyberPulse {
    0%,100% {
        box-shadow: 0 0 15px rgba(0,242,255,0.25);
    }
    50% {
        box-shadow:
            0 0 30px rgba(0,242,255,0.45),
            0 0 45px rgba(188,19,254,0.25);
    }
}

/* ================= BUTTON ================= */
button {
    width: 100%;
    padding: 14px;
    margin-top: 20px;
    border-radius: 50px;
    border: none;
    font-size: 16px;
    font-weight: 800;
    letter-spacing: 1px;
    text-transform: uppercase;
    cursor: pointer;
    color: #000;
    background: linear-gradient(135deg, var(--primary), #00a8ff);
    transition: 0.3s;
    box-shadow: 0 4px 18px rgba(0,242,255,0.4);
    position: relative;
    overflow: hidden;
}

/* effet brillance */
button::before {
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

button:hover::before {
    transform: translateX(100%);
}

button:hover {
    transform: translateY(-2px) scale(1.03);
    box-shadow:
        0 0 35px rgba(0,242,255,0.6),
        0 0 60px rgba(0,242,255,0.3);
}


</style>

</head>
<body>

<!-- FORMULAIRE -->
<div class="container">

    <h2>Réinitialiser le mot de passe</h2>

    <form action="update_password.php" method="POST">

        <label>Code reçu :</label>
        <input type="text" name="otp" required>

        <label>Nouveau mot de passe :</label>
        <input type="password" name="password" required>

        <button type="submit">Mettre à jour</button>
    </form>

</div>

</body>
</html>
