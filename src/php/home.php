<?php 
$title = 'Accueil';
require ('template/header.php');
$fiveBooks = $db->LastFiveBooks(); ?>

<div class="content">
    <h1 class="contentTitle">Accueil</h1>

    <div class="explicationContainer">
        <div class="explicationTitle">
            <h1>Titre</h1>
        </div>
        <div class="explicationText">
            <p>
               YOUNES IL EST NULL COMME LA VALEUR
            </p>
        </div>
    </div>

    <div class="mainBookblock">
        <?php foreach ($fiveBooks as $fiveBook) : ?>
            <div class="bookBlock">
                <div class="bookImage">
                    <a href="details.php?idBook=<?= $fiveBook['idBook'];?>"><img class="imageBook"  src="../../resources/images/books/<?= $fiveBook['idBook'];?>.jpg" alt="première de couverture"/></a>
                </div>
                <div class="middle">
                    <div class="zoom"><a href="details.php?idBook=<?= $fiveBook['idBook'];?>"><svg class="zoomIcon" width="30" height="30" fill="currentColor" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg></a></div>
                </div>
                <div class="bookInfo">
                    <p id="bookTitle"><?= $fiveBook['booTitle'] ?></p> 
                    <p id="bookAuthor"><?= $fiveBook['autFirstname'] ?></p> 
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
<?php require ('template/footer.php'); ?>