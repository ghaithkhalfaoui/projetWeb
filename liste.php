<?php
include '../Models/personne.php';
include '../Controllers/personneC.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container" id="container">
    
    <div class="form-box" id="login">
        <h3 class="mb-1">Veuillez saisir vos informations d'utilisateur</h3>

        <form id="loginForm" action="ajout.php" method="POST">

<div class="input-box">
            <input name="email" id="emailLogin" placeholder="Email" >
            <span id="emailError" style="color:red;"></span>
        </div>

        <div class="input-box" style="position: relative;">
            <input type="password" name="password" id="passLogin" placeholder="Mot de passe">
            <span id="togglePasswordLogin" 
                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; font-size: 1.2rem; color: #555;"></span>
            <span id="passwordError" style="color:red;"></span>
        </div>

        <!-- 🔹 Lien "Mot de passe oublié" ajouté ici -->
        <p style="text-align:right; margin-top:-5px; margin-bottom: 15px;">
            <a href="forgot_password.php" style="color:#00ffd5; text-decoration:none; font-size:0.9rem;"></a>
        </p>
        <a href="forgot_password.php">mot de passe oublier?</a>
            <button type="submit" class="btn">Se connecter</button>
            

        </form>

        <p class="switch">
            Déjà membre ?
            <button class="link-btn" onclick="toggleForm()">Inscription</button>
        </p>
    </div>


    <div class="form-box" id="signup">
        <h3 class="mb-1">Formulaire d'inscription</h3>
        <p>Veuillez saisir vos informations d'utilisateur</p>

        <form id="signupForm" action="ajout.php" method="POST">

            <div class="input-box">
                <input type="text" name="name" id="userSignup" placeholder="Nom d’utilisateur" >
            </div>

            <div class="input-box">
                <input  name="email" id="emailSignup" placeholder="Email" >
            </div>

            <div class="input-box">
                <input type="password" name="password" id="passSignup" placeholder="Mot de passe" >
            </div>
            <div class="input-box">
                <input type="password" name="confirmer" id="passSignup" placeholder="confirmer" >
            </div>

            <button type="submit" class="btn">Créer un compte</button>

        </form>

        <p class="switch">
            Déjà membre ?
            <button class="link-btn" onclick="toggleForm()">Connexion</button>
        </p>
    </div>

</div>


<script>

const container = document.getElementById("container");
function toggleForm() {
    container.classList.toggle("active");
}





function isValidGmail(email) {
    const regex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
    return regex.test(email);
}


function isValidPassword(password) {
    return password.length >= 8;
}




document.getElementById("loginForm").addEventListener("submit", function (e) {

    const email = document.getElementById("emailLogin").value;
    const pass = document.getElementById("passLogin").value;

    if (!isValidGmail(email)) {
        alert("L'email doit être une adresse Gmail valide !");
        e.preventDefault();
        return;
    }

    if (!isValidPassword(pass)) {
        e.preventDefault();
        passwordError.textContent = "Le mot de passe doit comporter au moins 8 caractères !";
        return;
    } else {
        passwordError.textContent = "";
    }
});





document.getElementById("signupForm").addEventListener("submit", function (e) {

    const username = document.getElementById("userSignup").value;
    const email = document.getElementById("emailSignup").value;
    const pass = document.getElementById("passSignup").value;

    if (username.trim().length < 3) {
        alert("Le nom d’utilisateur doit contenir au moins 3 caractères !");
        e.preventDefault();
        return;
    }

    if (!isValidGmail(email)) {
        e.preventDefault();
        emailError.textContent = "L'email n'existe pas. Tu dois créer un compte !";
        return;
    } else {
        emailError.textContent = "";
    }

    if (!isValidPassword(pass)) {
        alert("Le mot de passe doit comporter au moins 8 caractères !");
        e.preventDefault();
        return;
    }

});


</script>


</body>
</html>
