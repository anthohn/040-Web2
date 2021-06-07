<?php 
/**
* ETML 
* Author : Anthony Höhn
* Date : 04.05.2021
* Description : Detail user
*/

// Check the GET content, if is numeric (more secure) and if it's ok call all the utils function
if(!isset($_GET['idUser']) OR !is_numeric($_GET['idUser']))
{
    header('Location:404.php');
}
// If it's ok the call the function
else
{
    $title = 'Details du utilisateur';
    require ('template/header.php');
    $idUser = $_GET['idUser'];
    $userInfos = $db->getOneUser($idUser);
    $books = $db->getBooksUser($idUser);
}
?>
<div class="content">
    <div class="accountFormcontent">
        <form>
            <?php foreach($userInfos as $userInfo): ?>
                <h2><?= $userInfo['useLogin']?></h2>
                <table>
                    <tr>
                        <td>
                            <div class="logo">
                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                            </div>    
                            <p>Livres suggérés : <?= $userInfo['useSuggestBook'] ?></p>
                            <p>Appréciations : <?= $userInfo['useAppreciationNumber'] ?></p>
                            <p>Inscription : <?= $userInfo['useInscriptionDate'] ?></p>
                        </td>
                    </tr>
                </table>
            <?php endforeach ?>
        </form>
    </div> 

    <?php

    if(empty($books)) : ?>
    
        <?php $error = '<div class="errorLoginContainer"><h4 class="notBookUser">Cet utilisateur n\'a suggéré aucun livre.</h4></div>'; ?>
    
    <?php else : ?>
    
        <h1>Livre suggéré</h1>

        <div class='mainBookblock'>
        <!-- Display all the suggest book by the user -->
        <?php foreach ($books as $book) : ?>
            <div class='bookBlock'>
                <div class='bookImage'>
                    <a href="details.php?idBook=<?= $book['idBook'];?>"><img class="imageBook" src="../../resources/images/books/<?= $book['idBook'];?>.jpg" alt="première de couverture"/></a>
                </div>
                <div class="middle">
                    <div class="zoom"><a href="details.php?idBook=<?= $book['idBook'];?>"><svg class="zoomIcon" width="30" height="30" fill="currentColor" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg></a></div>
                </div>
                <div class="bookInfo">
                    <p id="bookTitle"><?= $book['booTitle'] ?></p> 
                    <p id="bookAuthor"><?= $book['autFirstname'] ?></p> 
                </div>  
            </div>
        <?php endforeach ?>
    </div>  

    <?php endif; ?>   
</div>

<?php
if(isset($error))
{
    echo $error;
}
?>

<?php require ('template/footer.php'); ?>