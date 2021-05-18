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
    $authors = $db->getAuthor();
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
    <h1>Modification <?= $book['booTitle'] ?></h1>
        <div class="bookDetailBlock">            
            <img src="../../resources/images/books/<?= $book['idBook'];?>.jpg" alt="première de couverture"/>   

            <div class="bookContent">          
                <h2><input type="text" value="<?= $book['booTitle'] ?>"></h2>
                
                <h3><select name="type" id="type">
                        <option value='<?= $book["idAuthor"];?>'><?= $book["autLastname"] . ' ' . $book["autFirstname"];?></option>
                        <?php foreach($authors as $author) : ?>
                            <option value="<?= $author["idAuthor"]; ?>"><?= $author["autLastname"] . ' ' . $author["autFirstname"]; ?></option>
                        <?php endforeach; ?>
                    </select></h3>

                <h4>Résumé : </h4> 
                <p class="booSummary"><textarea id="w3review" name="w3review" rows="3" cols="137"><?= $book['booSumary'] ?></textarea></p> 
                <p id="catPages"><?= $book['catName'] ?> - <?= $book['booPages'] ?> pages</p> 
                <p id="editorPubliYear"><?= $book['ediName'] ?> - <?= $book['booPublicationYear'] ?></p>
                <!-- <p>< //$book['booSumary'] </p> 
                <p id="catPages">Catégorie : //$book['catName'] </p>
                <p id="catPages">Nombre de pages :  //$book['booPages'] ?></p> 
                <p id="editorPubliYear">Maison d'éditon :  //$book['ediName'] ?></p>
                <p id="editorPubliYear">Date de publication :  //$book['booPublicationYear'] ?></p>
                <p><a id="extractLink" href //$book['booExtract'] ?>"target="_blank">Lien vers l'extrait</a> </p> -->
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