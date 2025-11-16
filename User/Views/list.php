<?php ob_start(); ?>
<h1>Liste des utilisateurs</h1>
<a href="/projects/projetWeb/user/create" class="link">Ajouter un utilisateur</a>

<?php if(isset($_GET['msg'])): ?>
    <div class="msg success">
        <?= str_replace(['add_ok','update_ok','delete_ok'], ['Ajouté !','Modifié !','Supprimé !'], $_GET['msg']) ?>
    </div>
<?php endif; ?>

<table>
    <tr><th>ID</th><th>Nom</th><th>Email</th><th>Actions</th></tr>
    <?php 
    // Safety check
    if (isset($users) && $users !== false): 
        if (mysqli_num_rows($users) > 0):
            while($u = mysqli_fetch_assoc($users)): 
    ?>
    <tr>
        <td><?= $u['id_user'] ?></td>
        <td><?= htmlspecialchars($u['username']) ?></td>
        <td><?= htmlspecialchars($u['email']) ?></td>
        <td>
            <a href="/projects/projetWeb/user/edit/<?= $u['id_user'] ?>" class="link" style="background:#28a745;padding:8px 15px;margin-right:5px;">✏️ Modifier</a>
            <a href="/projects/projetWeb/user/delete/<?= $u['id_user'] ?>" class="link" style="background:#dc3545;padding:8px 15px;" onclick="return confirm('Supprimer définitivement cet utilisateur ?');">
                🗑️ Supprimer
            </a>
        </td>
    </tr>
    <?php 
            endwhile;
        else:
    ?>
    <tr>
        <td colspan="4" style="text-align:center;padding:30px;color:#999;">
            Aucun utilisateur pour le moment. <a href="/projects/projetWeb/user/create">Ajouter le premier</a>
        </td>
    </tr>
    <?php 
        endif;
    else:
    ?>
    <tr>
        <td colspan="4" style="text-align:center;padding:30px;color:red;">
            Erreur lors de la récupération des données
        </td>
    </tr>
    <?php endif; ?>
</table>

<?php 
$content = ob_get_clean(); 
$title = "Liste des utilisateurs"; 
require 'layout.php'; 
?>