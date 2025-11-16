<?php ob_start(); ?>
<h1>Ajouter un utilisateur</h1>
<?php if(isset($_GET['msg'])): ?>
    <div class="msg success">
        <?= $_GET['msg']=='empty' ? 'Champs obligatoires' : ($_GET['msg']=='email' ? 'Email invalide' : 'Ajouté avec succès !') ?>
    </div>
<?php endif; ?>
<form action="/user/store" method="post">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="submit" value="Ajouter">
</form>
<br><a href="/user" class="link">Retour liste</a>
<?php $content = ob_get_clean(); $title = "Ajouter"; require 'layout.php'; ?>