<?php 
$title = 'Accueil';
require ('template/header.php');
$fiveBooks = $db->LastFiveBooks(); ?>

<h1>*Explication du site*</h1>

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
    </div>
    <?php endforeach ?>
</div>








<?= require ('template/footer.php'); ?>