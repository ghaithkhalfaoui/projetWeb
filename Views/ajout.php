<?php
include '../Models/personne.php';
include '../Controllers/personneC.php';

?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom         = $_POST['name'] ?? '';
    $email       = $_POST['email'] ?? '';
    $motdepasse  = $_POST['motdepasse'] ?? '';  // ← RÉCUPÉRATION MDP

    if ($nom !== '' && $email !== '' && $motdepasse !== '') {

        // Hashage du mot de passe (sécurité)
        $hashedPassword = password_hash($motdepasse, PASSWORD_DEFAULT);

        // insertion dans la base
        $pc = new personneC();
        $p = new personne($nom, $email, $motdepasse);  // ← PASSWORD AJOUTÉ
        $pc->addPerson($p);

        // affichage dans un cadre
        echo '
        <div class="user-card">
            <h2>Détails de l’utilisateur</h2>

            <p><strong>Nom :</strong> ' . htmlspecialchars($nom) . '</p>
            <p><strong>Email :</strong> ' . htmlspecialchars($email) . '</p>
        </div>
        ';
    } 
}
?>
<style>
/* ========== VARIABLES CYBER ========== */
:root {
    --bg-dark: #0a0a0f;
    --glass-bg: rgba(19, 19, 31, 0.75);
    --glass-border: rgba(255, 255, 255, 0.05);
    --primary: #00f2ff;
    --accent: #bc13fe;
    --text-main: #ffffff;
    --text-muted: #a0a0b0;
    --border: #2a2a35;
}

/* ========== RESET ========== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Inter', system-ui, sans-serif;
}

/* ========== BODY CYBER ========== */
body {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: var(--bg-dark);
    color: var(--text-main);
    position: relative;
    overflow: hidden;
}

/* Grille cyber */
body::before {
    content: "";
    position: fixed;
    inset: 0;
    background-image:
        linear-gradient(rgba(0,242,255,.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,242,255,.03) 1px, transparent 1px);
    background-size: 50px 50px;
    pointer-events: none;
}

/* Lumière centrale */
body::after {
    content: "";
    position: fixed;
    inset: 0;
    background: radial-gradient(circle, rgba(0,242,255,.15), transparent 70%);
    pointer-events: none;
}

/* ========== CONTAINER ========== */
.container {
    width: 220px;
    background: var(--glass-bg);
    backdrop-filter: blur(12px);
    border: 1px solid var(--glass-border);
    border-radius: 20px;
    padding: 15px;
    box-shadow: 0 0 40px rgba(0,242,255,.15);
    z-index: 1;
}

/* ========== TITRE ========== */
.container h2 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 1.8rem;
    background: linear-gradient(135deg, var(--primary), var(--accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ========== INPUTS ========== */
input, select {
    width: 100%;
    padding: 14px;
    margin-bottom: 15px;
    border-radius: 12px;
    border: 1px solid var(--border);
    background: rgba(0,0,0,.4);
    color: var(--text-main);
    outline: none;
    transition: .3s;
}

input:focus, select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 15px rgba(0,242,255,.4);
}

/* ========== BUTTON ========== */
button {
    width: 100%;
    padding: 15px;
    border-radius: 14px;
    border: none;
    background: linear-gradient(135deg, var(--primary), #00a8ff);
    font-weight: 700;
    letter-spacing: 1px;
    cursor: pointer;
    transition: .3s;
}

button:hover {
    transform: scale(1.03);
    box-shadow: 0 0 30px rgba(0,242,255,.6);
}

/* ========== MESSAGES ========== */
.success {
    margin-top: alignecentre;
    text-align: center;
    color: #2ecc71;
    font-weight: bold;
    font-size: 16px;
    text-shadow: 0 0 10px #2ecc71;
}


.error {
    color: #e74c3c;
    font-weight: bold;
    text-align: center;
    margin-bottom: 15px;
    text-shadow: 0 0 10px #e74c3c;
}

/* ========== LIEN RETOUR ========== */
.back {
    display: block;
    margin-top: 15px;
    text-align: center;
    color: var(--primary);
    text-decoration: none;
    font-weight: bold;
}

.back:hover {
    text-shadow: 0 0 10px var(--primary);
}

    </style>
</head>
<body>

<div class="container">


    <a href="index.html" class="back"> Retour </a>
</div>
<div class="success">
    ✅ Connexion réussie ! Bienvenue sur notre plateforme.
</div>


<script>
function isValidEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

document.getElementById("userForm").addEventListener("submit", function (e) {
    const username = document.querySelector("input[name='name']").value;
    const email = document.querySelector("input[name='email']").value;
    const password = document.querySelector("input[name='motdepasse']").value;

    const usernameError = document.getElementById("nameError");
    const emailError = document.getElementById("emailError");
    const passwordError = document.getElementById("passwordError");

    let valid = true;
    usernameError.textContent = "";
    emailError.textContent = "";
    passwordError.textContent = "";

    if (username.trim().length < 3) {
        e.preventDefault();
        usernameError.textContent = "Le nom doit contenir au moins 3 caractères !";
        valid = false;
    }
    if (!isValidEmail(email)) {
        e.preventDefault();
        emailError.textContent = "Veuillez entrer un email valide !";
        valid = false;
    }
    if (password.trim().length < 6) {
        e.preventDefault();
        passwordError.textContent = "Le mot de passe doit contenir au moins 6 caractères !";
        valid = false;
    }

});
</script>

</body>
</html>




