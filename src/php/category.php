<?php 
$title = 'Accueil';
require ('template/header.php');

$idCategory = 1;
$CategoryBooks = $db->CategoryBooks($idCategory); ?>

<div class="MainBookblock">
    <?php foreach ( $CategoryBooks as $CategoryBook): ?>
        <div class="bookBlock">
            <p><?= $CategoryBook['booTitle'] ?></p> 
            <p><?= $CategoryBook['booPages'] ?></p>
            <p><?= $CategoryBook['booExtract'] ?></p> 
            <p><?= $CategoryBook['booSumary'] ?></p>
            <p><?= $CategoryBook['booPublicationYear'] ?></p>
            <p><?= $CategoryBook['booScoreAverage'] ?></p>
            <p><?= $CategoryBook['catName'] ?></p>
        </div>
    <?php endforeach ?>			
</div>

<?php require ('template/footer.php'); ?>