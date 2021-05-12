<?php 
$title = 'Details du livre';
require ('template/header.php');
$idBook = $_GET["idBook"];
$books = $db->getBook($idBook); 
$bddNotes = $db->getNotesBook($idBook)[0]['votNote'];
$_SESSION['bookNoteAvg'] = $idBook;

if(isLogged())
{
    $idUser = $_SESSION['idUser'];
}

?>

<?php if(isset($_POST['submit']))
{
    if(isLogged())
    {
        $note = $_POST['note'];
        if($_POST["note"] != 0)
        {
            $db->addVoteBook($idBook, $idUser, $note);
            $db->addAppreciationUser($idUser);
            $db->addAppreciationBook($idBook);
            
            header("Location:details.php?idBook=$idBook");
        }
        else
        {
            $error = '<div class="errorLoginContainer"><h4 class="errorLogin">Veuillez sélectionner la note</h4></div>';
        }
    }
    else
    {
        $error = '<div class="errorLoginContainer"><h4 class="errorLogin">Connectez-vous pour pouvoir noter un livre !</h4></div>';
    }
}
?>


<div class="MainDetailBookBlock">
    <h1>Appréciation / Détail</h1>
    <?php foreach($books as $book): ?>
        <div class="bookDetailBlock">
            <img src="../../resources/images/books/<?= $book['idBook'];?>.jpg" alt="première de couverture"/></a>
            <div class="bookContent">
                <h2><?= $book['booTitle'] ?></h2>
                <h3><?= $book['autLastname'] ?> <?= $book['autFirstname'] ?></h3>
                <h4>Résumé : </h4> 
                <p class="booSummary"><?= $book['booSumary'] ?></p> 
                <p id="catPages"><?= $book['catName'] ?> - <?= $book['booPages'] ?> pages</p> 
                <p id="editorPubliYear"><?= $book['ediName'] ?> - <?= $book['booPublicationYear'] ?></p>
                <p><?= $book['booSumary'] ?></p> 
                <!-- <p id="catPages">Catégorie : //$book['catName'] </p>
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