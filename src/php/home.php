<?php 
$title = 'Accueil';
require ('template/header.php');
$fiveBooks = $db->LastFiveBooks(); ?>

<h1>*du site*</h1>

<div class="MainBookblock">
    <?php foreach ($fiveBooks as $fiveBook) : ?>
        <div class="bookBlock">
            <p><?= $fiveBook['booTitle'] ?></p> 
            <p><?= $fiveBook['booPages'] ?></p>
            <p><?= $fiveBook['booExtract'] ?></p> 
            <p><?= $fiveBook['booSumary'] ?></p>
            <p><?= $fiveBook['booPublicationYear'] ?></p>
            <p><?= $fiveBook['booScoreAverage'] ?></p>
            <p><?= $fiveBook['catName'] ?></p>
            <a href="details.php?idBook=<?= $fiveBook['idBook'];?>">Lien vers le livre</a>
        </div>
    <?php endforeach ?>
</div>
<<<<<<< HEAD
=======
<a href="addbook.php">ajout de livre</a>










>>>>>>> 23dc380dd870cd3851ef1478d7fea5ef16e45c9f
<?= require ('template/footer.php'); ?>