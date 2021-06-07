<?php 
/**
* ETML 
* Author : Anthony Höhn
* Date : 04.05.2021
* Description : Delete book page 
*/
require "template/header.php";

if(isLogged() && (isAdmin()))
{     
    // Vérifie que le get n'est pas vite, vérifie si le get est bien numérqiue -> rejete le code html et php (+ sécurisé)
    if(!isset($_GET['idBook']) OR !is_numeric($_GET['idBook']))
    {
        header('Location:404.php');
    }
    // Si tout est ok -> appelle les fonctions
    else
    { 
        $idBook = $_GET['idBook'];
        $db->deleteBook($idBook);
        header('Location: books.php');    
    } 
}
else
{
    header('Location: template/404.php'); 
}
?>
