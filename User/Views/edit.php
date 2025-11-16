<?php ob_start(); ?>

<?php
// Le contrôleur nous envoie déjà la variable $user
// Si jamais elle n’existe pas (accès direct au fichier), on bloque
if (!isset($user) || !$user) {
    die('Accès interdit ou utilisateur introuvable.');
}
?>

<h1>Modifier l'utilisateur #<?= htmlspecialchars($user['id_user']) ?></h1>

<?php
// Messages d’erreur/succès
if (isset($_GET['msg'])) {
    $messages = [
        'empty'   => 'Tous les champs sont obligatoires',
        'exists'  => 'Cet email est déjà utilisé',
        'error'   => 'Erreur lors de la modification'
    ];
    if (isset($messages[$_GET['msg']])) {
        echo '<div class="msg success" style="background:#f8d7da;color:#721c24;padding:15px;margin:15px 0;border-radius:8px;">';
        echo $messages[$_GET['msg']];
        echo '</div>';
    }
}
?>

<form action="../../user/update/<?= $user['id_user'] ?>" method="post">
    <input type="text" 
           name="username" 
           value="<?= htmlspecialchars($user['username']) ?>" 
           placeholder="Nom d'utilisateur" 
           required>
    
    <input type="email" 
           name="email" 
           value="<?= htmlspecialchars($user['email']) ?>" 
           placeholder="Email" 
           required>
    
    <input type="submit" value="Enregistrer les modifications">
</form>

<br>
<div style="text-align:center;">
    <a href="../../user" class="link">Retour à la liste</a>
</div>

<?php
$content = ob_get_clean();
$title   = "Modifier l'utilisateur";
require 'layout.php';
?>