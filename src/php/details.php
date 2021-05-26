<?php 
// Vérifie que le get n'est pas vite, vérifie si le get est bien numérqiue -> rejete le code html et php (+ sécurisé)
if(!isset($_GET['idBook']) OR !is_numeric($_GET['idBook']))
{
    header('Location:404.php');
}
// Si tout est ok -> appelle les fonctions
else
{
    $title = 'Details du livre';
    require ('template/header.php');
    $idBook = $_GET["idBook"];
    $books = $db->getBook($idBook);
    $bddNotes = $db->getNotesBook($idBook)[0]['votNote'];
    $_SESSION['bookNoteAvg'] = $idBook;    
}

// Si l'utilisateur est connecté récupere l'id de session dans $idUser
if(isLogged())
{
    $idUser = $_SESSION['idUser'];
}

if(isset($_POST['submit']))
{
    // Si connecté continue sinon message erreur
    if(isLogged())
    {
        // met le post de note dans une variable
        $note = $_POST['note'];

        // Si la note n'est pas égal à 0 continue si non message erreur
        if($note != 0)
        {
            // ajoute le vote au livre
            $db->addVoteBook($idBook, $idUser, $note);
            // incrémente de 1 les appréciation de l'utilisateur 
            $db->addAppreciationUser($idUser);
            // incrémente de 1 les appréciation du livre
            $db->addAppreciationBook($idBook);
            
            // actualise la page 
            header("Location:details.php?idBook=$idBook");
        }
        else
        {
            $error = '<div class="errorLoginContainer"><h4 class="errorLogin">Veuillez sélectionner la note</h4></div>';
        }
    }
    else
    {
        header('Location:connexion.php');
    }
}
?>


<div class="MainDetailBookBlock">
    <?php foreach($books as $book): ?> 

        <h1>Appréciation / Détail
            <?php if(isLogged() && (isAdmin())): ?>
                <a href="editBook.php?idBook=<?= $book["idBook"]; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16"><path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/></svg></a>
                <a href="deleteBook.php?idBook=<?= $book["idBook"]; ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le livre ?')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></a>
            <?php endif; ?> 
        </h1>
        <div class="bookDetailBlock">            
            <img src="../../resources/images/books/<?= $book['idBook'];?>.jpg" alt="première de couverture"/>   
			 
            <h2><?= $book['booTitle'] ?></h2>
            
            <h3><?= $book['autLastname'] ?> <?= $book['autFirstname'] ?></h3>
            <h4>Résumé : </h4> 
            <p class="booSummary"><?= $book['booSummary'] ?></p> 
            <p>Catégorie : <?= $book['catName'] ?></p>
            <p>Nombres de page :  <?= $book['booPages'] ?> pages</p> 
            <p>Éditeur : <?= $book['ediName'] ?></p>
            <p>Date de publication : <?= $book['booPublicationYear'] ?></p>
            <p><a id="extractLink" href="<?= $book['booExtract'] ?>" target="_blank">Lien vers l'extrait</a> </p>
            <p><a id="extractLink" href="detailsUser.php?idUser=<?=$book['idUser'] ?>"><?= $book['useLogin']?></a></p>
            <form method='POST'>
                <p>Moyenne d'appréciation : <span id="bookAvg">
                <?php 
                    if($bddNotes == 0) {
                        echo '0';
                    }
                    else {
                        echo $bddNotes;
                    }
                ?>
                </span> / 5 (sur <?= $book['booNoteCount'] ?> votes)
                    <select name='note' id='note'>
                        <option value='0'>Votre note</option>
                        <option value='1'>1</option>
                        <option value='1.5'>1.5</option>
                        <option value='2'>2</option>
                        <option value='2.5'>2.5</option>
                        <option value='3'>3</option>
                        <option value='3.5'>3.5</option>
                        <option value='4'>4</option>
                        <option value='4.5'>4.5</option>
                        <option value='5'>5</option>
                    </select>
                    <input id="submit" class='confirm'type='submit' name='submit' value='Ajouter'> 
                </p>                    
            </form>                              
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php
if(isset($error))
{
    echo $error;
}
?>



<?php require ('template/footer.php'); ?>