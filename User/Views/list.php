<?php ob_start(); $users = $users ?? $this->userModel->getAll(); ?>
<h1>Liste des utilisateurs</h1>
<a href="../../user/create" class="link">Ajouter un utilisateur</a>
<?php if(isset($_GET['msg'])): ?>
    <div class="msg success">
        <?= str_replace(['add_ok','update_ok','delete_ok'], ['Ajouté !','Modifié !','Supprimé !'], $_GET['msg']) ?>
    </div>
<?php endif; ?>
<table>
    <tr><th>ID</th><th>Nom</th><th>Email</th><th>Actions</th></tr>
    <?php while($u = mysqli_fetch_assoc($users)): ?>
    <tr>
        <td><?= $u['id_user'] ?></td>
        <td><?= htmlspecialchars($u['username']) ?></td>
        <td><?= htmlspecialchars($u['email']) ?></td>
        <td>
            <a href="../../user/edit/<?= $u['id_user'] ?>"><img src="../../images/write.png" width="30"></a>
            <a href="../../user/delete/<?= $u['id_user'] ?>" onclick="return confirm('Supprimer ?')">
                <img src="../../images/remove.png" width="30">
            </a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<?php $content = ob_get_clean(); $title = "Liste"; require 'layout.php'; ?>