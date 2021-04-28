<?php 
session_start();
require "lib/util.php";
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
        <header>
            <div class="headerContainer">
                <div class="logo">
                    <a href="home.php">Library</a>
                </div>

                <span class="separeLigne"></span>

                <div class="rest">
                    <div class="CreateLinkContainer">
                        <a href="createAccount.php" >Créer un compte</a>
                    </div>
                    <div class="loginLinkContainer">
                        <a href="connexion.php" >Se Connecter</a>
                    </div>
                </div>
            </div>
        </header>
        <nav class="navBar">
            <a href="#" class="toggleButton" id="toggleButtonID">
				<span class="bar" id="topBar"></span>
				<span class="bar" id="middleBar"></span>
				<span class="bar" id="bottomBar"></span>
			</a>

            <div class="leftnav">
                <ul class="navBarLinks">
                    <li id="homeLinkContainer"><a href="home.php" ><svg class="homeIcon" width="20" height="20" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16"><path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
                                               </svg> Accueil</a></li>
                    <li id="listBook"><a href="#" ><svg class="listIcon" width="20" height="20" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16"><path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                      </svg> Tous les livres</a></li>
                    <li id="addBook"><a href="addBook.php" ><svg class="addIcon" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                     </svg> Ajouter</a></li>
                </ul>
            </div>
        </nav>
            <main>