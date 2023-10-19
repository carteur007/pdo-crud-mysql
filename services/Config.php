<?php

$database_username = 'root';
$database_password = 'Carteur@007';

$con = new PDO('mysql:host=localhost;dbname=accesdonnees', $database_username, $database_password);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
