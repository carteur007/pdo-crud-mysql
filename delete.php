<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('./services/Config.php');
require_once('./services/Service.php');
if (!empty($_GET["id"])) :
    $id = htmlspecialchars($_GET['id']);
    try {
        $service = new Service(con: $con);
        $service->setSql("delete from contacts where id=" . $id);
        $stm = $service->execute($service->getStatement());
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
endif;

header('location:index.php');
