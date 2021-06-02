<?php 
$title = 'Accueil';
require ('template/header.php');
$fiveBooksNotes = $db->lastFiveBooks();
$bookNotes = $db->getNotesBook($idBook);
?>

<div class="content">
    <h1 class="contentTitle">Accueil</h1>

    <div class="explicationContainer">
        <div class="explicationTitle">
            <h1>Librarotche</h1>
        </div>
        <div class="explicationText">
            <p>
                Ce petit site, développés par trois élèves de deuxième année en apprentissage d'informatique à l'ETML, sert à répertorier de nombreux livre grâce à une base de données.
                Après vous être connecté, vous aurez la possibilité de créer et modifier des livres, ainsi que de leur donner une note d'appréciation.
            </p>
        </div>
    </div>

    <div class="mainBookblock">
        <?php foreach($fiveBooksNotes as $fiveBooksNote) : ?>
            <div class="bookBlock">
                <div class="bookImage">
                    <?php if(isLogged()): ?>
                        <a href="details.php?idBook=<?= $fiveBooksNote['idBook'];?>"><img class="imageBook"  src="../../resources/images/books/<?= $fiveBooksNote['idBook']; ?>.jpg" alt="première de couverture"/></a>
                    <?php else: ?>
                        <a href="connexion.php"><img class="imageBook" src="../../resources/images/books/<?= $fiveBooksNote['idBook'];?>.jpg" alt="première de couverture"/></a>
                    <?php endif; ?>
                </div>
                <div class="middle">
                    <?php if(isLogged()): ?>
                        <div class="zoom"><a href="details.php?idBook=<?= $fiveBooksNote['idBook'];?>"><svg class="zoomIcon" width="30" height="30" fill="currentColor" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg></a></div>
                    <?php else: ?>
                        <div class="zoom"><a href="connexion.php"><svg class="zoomIcon" width="30" height="30" fill="currentColor" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg></a></div>
                    <?php endif; ?>
                </div>
                <div class="bookInfo">
                    <p id="bookTitle"><?= $fiveBooksNote['booTitle'] ?></p> 
                    <p id="bookAuthor"><?= $fiveBooksNote['autFirstname'] ?></p> 
                    <?php 
                    if($bddNotes == 0) {
                        echo '0';
                    }
                    else {
                        echo $bddNotes;
                    }
                ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php require ('template/footer.php'); ?>