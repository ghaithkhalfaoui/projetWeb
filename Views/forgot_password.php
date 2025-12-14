<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Mot de passe oublié</title>

<style>
 /* ================= VARIABLES CYBER ================= */
:root {
    --bg-dark: #0a0a0f;
    --panel: rgba(19, 19, 31, 0.75);
    --primary: #00f2ff;
    --accent: #bc13fe;
    --text: #ffffff;
    --muted: #a0a0b0;
    --border: rgba(255,255,255,0.08);
    --glow: 0 0 20px rgba(0, 242, 255, 0.35);
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
    background: var(--bg-dark);
    color: var(--text);
    display: flex;
    flex-direction: column;
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
    padding: 18px 50px;
    background: linear-gradient(135deg, #0d0d18, #151526);
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
    font-weight: 700;
}

.logo img {
    height: 36px;
}

/* ================= CONTAINER (CARTE) ================= */
.container {
    position: relative;
    z-index: 1;
    width: 420px;
    margin: 90px auto;
    padding: 40px 35px;
    background: var(--panel);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
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
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ================= TITRE ================= */
h2 {
    margin-bottom: 30px;
    text-align: center;
    font-size: 24px;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
    background: linear-gradient(135deg, var(--primary), var(--accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ================= FORM ================= */
label {
    display: block;
    margin-bottom: 6px;
    font-size: 14px;
    color: var(--muted);
}

/* INPUTS */
input {
    width: 100%;
    padding: 14px 16px;
    margin-bottom: 18px;
    border-radius: 12px;
    border: 1px solid var(--border);
    background: rgba(0,0,0,0.35);
    color: var(--text);
    font-size: 15px;
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
    box-shadow:
        0 0 20px rgba(0,242,255,0.3),
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
    padding: 15px;
    margin-top: 25px;
    border-radius: 14px;
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

/* brillance */
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

<!-- ===== FORMULAIRE ===== -->
<div class="container">
    <h2>Mot de passe oublié</h2>

    <form action="send_reset.php" method="POST">
        <label>Email :</label>
        <input type="email" name="email" required>

        <button type="submit">Envoyer le code</button>
    </form>
</div>

</body>
</html>
