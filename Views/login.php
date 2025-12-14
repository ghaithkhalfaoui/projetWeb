<?php
include '../Models/personne.php';
include '../Controllers/personneC.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | NexusTech</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <nav class="navbar">
        <div class="container nav-content">
            <a href="index.html" class="logo">Nexus<span>Tech</span></a>
            <div class="nav-links">
                <a href="index.html" class="nav-link">Home</a>
                <a href="pages/events.html" class="nav-link">Events</a>
                <a href="pages/claims.html" class="nav-link">Claims</a>
                <a href="pages/post-view.html" class="nav-link">View Post</a>
            </div>
            <a href="register.php" class="btn btn-primary">Sign Up</a>
        </div>
    </nav>

    <main class="container" style="display: flex; align-items: center; justify-content: center; min-height: 80vh;">

        <div class="glass-panel" style="padding: 50px; width: 100%; max-width: 450px;">
            <div style="text-align: center; margin-bottom: 30px;">
                <h1 style="font-size: 2rem; margin-bottom: 10px;">Welcome Back</h1>
                <p style="color: var(--text-muted);">Enter your credentials to access your account.</p>
            </div>

            <form id="loginForm">
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-input" placeholder="you@example.com" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-input" placeholder="••••••••" required>
                </div>

                <div style="display: flex; justify-content: space-between; margin-bottom: 30px; font-size: 0.9rem;">
                    <label style="color: var(--text-muted); cursor: pointer;">
                        <input type="checkbox"> Remember me
                    </label>
                    <a href="forgot_password.php" style="color: var(--primary); text-decoration: none;">Forgot password?</a>
                </div>

                <a href="ajout.php" class="btn btn-primary" style="width:100%; margin-bottom:20px; display:block; text-align:center;">Sign In</a>

                <p style="text-align: center; color: var(--text-muted); font-size: 0.9rem;">
                    Don't have an account? <a href="register.php"
                        style="color: var(--primary); text-decoration: none;">Register</a>
                </p>
            </form>
        </div>

    </main>
    <script src="js/main.js"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', (e) => {
            e.preventDefault();
            // Simulate login
            alert('Successfully logged in!');
            window.location.href = 'index.html';
        });
    </script>
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