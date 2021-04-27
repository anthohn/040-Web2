<?php 
session_start();
require ('lib/database.php');
$db = new Database();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <!--
		ETML
		Auteur      : Anthony Höhn
		Date        : 26.04.2021
		Description : 
		-->
        <meta charset="UTF-8">
        <link href="../../resources/css/style.css" rel="stylesheet" type="text/css" />
        <title><?= $title ?></title>
    </head>
    <body>
        <main>