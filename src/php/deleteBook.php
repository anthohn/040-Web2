<?php 
/**
* ETML 
* Author : Anthony Höhn, Younes Sayeh
* Date : 04.05.2021
* Description : Delete book page 
*/
require "template/header.php";

if(isLogged() && (isAdmin()))
{     
    // Check if the GET exist, if the GET is numeric and don't execute HTML/PHP/JAVASCRIPT (more secure)
    if(!isset($_GET['idBook']) OR !is_numeric($_GET['idBook']))
    {
        header('Location:404.php');
    }
    // If it's ok then delete the book
    else
    { 
        $idBook = $_GET['idBook'];
        $db->deleteBook($idBook);
        // Problem with Header:Location so we used a script for refresh
        echo "<script type='text/javascript'>window.location.href = 'books.php';</script>";
        exit;
    } 
}
else
{
    header('Location:404.php'); 
}
?>
