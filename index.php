<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('./services/Service.php');

try {
    $service = new Service(con: $con);
    $service->setSql("SELECT id,nom,email,phone,adresse,date_contact FROM contacts ORDER BY id DESC LIMIT 10 ");
    $result = $service->getResult($service->execute($service->getStatement()));
} catch (\PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
$conn = null;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO-CRUD-MYSQL</title>
    <link rel="stylesheet" href="./public/css/materialize.min.css">
    <style>
        main {
            padding: 2rem;
        }
    </style>
</head>

<body>
    <header>
        <nav class="pink darken-4">
            <div class="nav-wrapper">
                <a href="#!" class="PDO-CRUD-MYSQL">
                    <img width="175" src="./public/images/logo.png" alt="PDO-CRUD-MYSQL">
                </a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="index.php">Liste des contacts</a></li>
                    <li><a href="add.php">Creer un contact</a></li>
                </ul>
            </div>
        </nav>

        <ul class="sidenav" id="mobile-demo">
            <li><a href="index.php">Liste des contacts</a></li>
            <li><a href="add.php">Creer un contact</a></li>
        </ul>
    </header>
    <main class="row">
        <h2 class="center">Liste des contacts disponible </h2>
        <table class="responsive-table striped centered">
            <thead class="pink darken-4">
                <tr style="color: #fff;">
                    <th>ID</th>
                    <th>NOM</th>
                    <th>EMAIL</th>
                    <th>PRENOM</th>
                    <th>ADRESSE</th>
                    <th>DATE</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($result)) : ?>
                    <?php foreach ($result as $row) : ?>
                        <tr class="table-row">
                            <td><?= $row["id"]; ?></td>
                            <td><?= $row["nom"]; ?></td>
                            <td><?= $row["email"]; ?></td>
                            <td><?= $row["phone"]; ?></td>
                            <td><?= $row["adresse"]; ?></td>
                            <td><?= $row["date_contact"]; ?></td>
                            <td>
                                <a class="btn btn-floating white darken-4" href='edit.php?id=<?= $row['id']; ?>'>
                                    <img src="./public/images/edit.svg" title="Editer un contact" />
                                </a>
                                <a class="btn btn-floating pink darken-4" href='delete.php?id=<?= $row['id']; ?>'>
                                    <img src="./public/images/delete.svg" title="Supprimer un contact" />
                                </a>
                                <!-- Modal Trigger -->
                                <a class="btn btn-floating  blue-grey darken-2 waves-effect waves-light btn modal-trigger" href="#Detail">
                                    <img src="./public/images/detail.svg" title="Detail du contact <?= $row["nom"] ?>" />
                                </a>
                                <!-- Modal Structure -->
                                <div id="Detail" class="modal blue-grey darken-2">
                                    <div class="modal-content">
                                        <h2 class="center white-text">Detail du Contact <?= $row['nom'] ?> </h2>
                                        <table class="responsive-table striped centered">
                                            <thead class=" grey darken-4 darken-3">
                                                <tr style="color: #fff;">
                                                    <th>ID</th>
                                                    <th>NOM</th>
                                                    <th>EMAIL</th>
                                                    <th>PRENOM</th>
                                                    <th>ADRESSE</th>
                                                    <th>DATE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><?= $row["id"]; ?></td>
                                                <td><?= $row["nom"]; ?></td>
                                                <td><?= $row["email"]; ?></td>
                                                <td><?= $row["phone"]; ?></td>
                                                <td><?= $row["adresse"]; ?></td>
                                                <td><?= $row["date_contact"]; ?></td>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer blue-grey darken-2">
                                        <a href="index.php" class="modal-close btn-small pink darken-4">Retour</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <script type="text/Javascript" src="./public/js/jquery-3.7.1.min.js"></script>
    <script type="text/Javascript" src="./public/js/materialize.min.js"></script>
    <script>
        $(".dropdown-trigger").dropdown();
        $(document).ready(function() {
            $('.sidenav').sidenav();
        });
        $(document).ready(function() {
            $('.modal').modal();
        });
    </script>
</body>

</html>