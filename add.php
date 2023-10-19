<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('./services/Config.php');
require_once('./services/Service.php');

if (!empty($_POST["ajouter_contact"])) :
    if (!isset($POST['nom']) && !isset($POST['phone']) && !isset($POST['adresse']) && !isset($POST['email'])) :
        $nom =  htmlspecialchars($_POST['nom']);
        $email =  htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $adresse = htmlspecialchars($_POST['adresse']);
        try {
            $service = new Service(con: $con);
            $service->setSql("INSERT INTO contacts ( nom, email, phone, adresse ) VALUES ( :nom, :email, :phone, :adresse)");
            $stm = $service->getStatement();
            $stm->bindParam(':nom', $nom);
            $stm->bindParam(':email', $email);
            $stm->bindParam(':phone', $phone);
            $stm->bindParam(':adresse', $adresse);
            $result = $service->execute($stm);
            if (!empty($result)) {
                header('location:index.php');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    endif;
endif;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>PDO-PHP-CRUD-AJOUTER</title>
    <link rel="stylesheet" href="./public/css/materialize.min.css">
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
        <h2 class="center">Ajouter un contact</h2>
        <div class="col sm12 m12 l12">
            <a href="index.php" class="indigo-text right">Liste des contacts</a>
            <div class="row">
                <form class="col s12" action="" method="POST">
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="nom" name="nom" type="text" class="validate" required>
                            <label for="nom">Nom</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="email" name="email" type="email" class="validate" required>
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="phone" name="phone" type="text" class="validate" required>
                            <label for="phone">Téléphone</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="adresse" name="adresse" type="text" class="validate" required>
                            <label for="adresse">Adresse</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6 offset-s5">
                            <input class="btn btn-large pink darken-4" name="ajouter_contact" type="submit" value="Ajouter contact">
                            </input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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