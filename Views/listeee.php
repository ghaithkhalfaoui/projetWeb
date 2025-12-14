<?php
include '../controllers/personneC.php';
include '../Views/dashboard.html';
$pc = new personneC();



if(isset($_POST['delete_id'])){
    $pc->deletePerson((int)$_POST['delete_id']);
    header("Location: listeee.php");
    exit;
}



if(isset($_POST['update_id'])){
    $id       = (int)$_POST['update_id'];
    $name     = $_POST['name'] ?? '';
    $email    = $_POST['email'] ?? '';

    if($name && $email){
        $pc->updatePerson($id, $name, $email);
        header("Location: listeee.php");
        exit;
    } else {
        $update_error = "Tous les champs sont requis pour modifier une personne.";
    }
}



$liste = $pc->listePersonne();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des personnes</title>

    <style>
        
        <style>
        :root {
            --bg: #0f1111;
            --panel: #151717;
            --muted: #9aa3a3;
            --accent: #6ff3d6;
            --card: #1b1d1d;
            --glass: rgba(255, 255, 255, 0.03);
            --radius: 10px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial;
            background: linear-gradient(#0b0c0c, #0e0f0f);
            color: #e6f2f0;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: linear-gradient(180deg, var(--panel), #0f1111);
            padding: 28px 20px;
            position: fixed;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .sidebar h2 {
            font-size: 22px;
            font-weight: 700;
            color: var(--accent);
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: var(--muted);
            text-decoration: none;
            padding: 10px 12px;
            margin-bottom: 8px;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.02);
            color: var(--accent);
        }

        .main-content {
            margin-left: 250px;
            padding: 32px 40px;
            width: calc(100% - 250px);
        }

        .main-content h2 {
            font-size: 22px;
            font-weight: 700;
            color: #e9f9f3;
            margin-bottom: 24px;
        }

        /* Table Styles - Dark Theme */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: var(--card);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.03);
        }

        thead th {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.04), rgba(255, 255, 255, 0.02));
            padding: 16px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: var(--accent);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody tr {
            transition: background 0.2s;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            color: #cfe9e3;
            font-size: 14px;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* Form Elements */
        input[type="text"],
        input[type="email"],
        select {
            padding: 8px 12px;
            margin: 4px 0;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.03);
            color: #e6f2f0;
            font-size: 13px;
            transition: all 0.2s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus {
            outline: none;
            border-color: var(--accent);
            background: rgba(255, 255, 255, 0.05);
        }

        button {
            background: var(--accent);
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            color: #062422;
            cursor: pointer;
            margin: 4px 2px;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.2s;
        }

        button:hover {
            background: #5de0c1;
            transform: translateY(-1px);
        }

        button.secondary {
            background: rgba(255, 255, 255, 0.05);
            color: var(--muted);
        }

        button.secondary:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #e6f2f0;
        }

        button.add-btn {
            background: rgba(111, 243, 214, 0.15);
            color: var(--accent);
            border: 1px solid rgba(111, 243, 214, 0.3);
        }

        button.add-btn:hover {
            background: rgba(111, 243, 214, 0.25);
            color: #fff;
        }

        form {
            margin-bottom: 10px;
        }

        /* Alert Error */
        .alert-error {
            background: rgba(255, 107, 107, 0.1);
            border: 1px solid rgba(255, 107, 107, 0.2);
            color: #ff6b6b;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* Status Badges */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge.active {
            background: rgba(107, 224, 187, 0.12);
            color: #8ef1d7;
            border: 1px solid rgba(107, 224, 187, 0.08);
        }

        .badge.pending {
            background: rgba(255, 210, 120, 0.08);
            color: #ffd29a;
            border: 1px solid rgba(255, 210, 120, 0.06);
        }

        .badge.inactive {
            background: rgba(155, 163, 163, 0.08);
            color: var(--muted);
            border: 1px solid rgba(155, 163, 163, 0.06);
        }

        @media (max-width: 900px) {
            .sidebar {
                display: none;
            }
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }
        }
    </style>
        
    </style>
</head>


<div class="main-content">

    <h2>Liste des personnes</h2>

    <div class="card">
        

        <?php if(!empty($update_error)): ?>
            <p style="color:red;"><?= $update_error; ?></p>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($liste as $person): ?>
                <tr>
                    <td><?= $person['id']; ?></td>
                    <td><?= $person['name']; ?></td>
                    <td><?= $person['email']; ?></td>

                    <td>

                        <form action="listeee.php" method="POST">
                            <input type="hidden" name="update_id" value="<?= $person['id']; ?>">
                            <input type="text" name="name" value="<?= $person['name']; ?>" required>
                            <input type="email" name="email" value="<?= $person['email']; ?>" required>
                            <button type="submit">Modifier</button>
                        </form>

                        <form action="listeee.php" method="POST" onsubmit="return confirm('Voulez-vous supprimer cette personne ?');">
                            <input type="hidden" name="delete_id" value="<?= $person['id']; ?>">
                            <button type="submit">Supprimer</button>

                            
                        </form>
                        <a href="login.php"><button>Ajout</button></a>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            

        </table>

    </div>
</div>

</body>
</html>