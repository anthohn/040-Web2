<?php 
$title = 'Tous les livres';
require ('template/header.php');
$books = $db->books(); ?>


<div class="MainBookblock">
    <?php foreach ($books as $book) : ?>
        <div class="bookBlock">
            <p><?= $book['booTitle'] ?></p> 
            <p><?= $book['booPages'] ?></p>
            <p><?= $book['booExtract'] ?></p> 
            <p><?= $book['booSumary'] ?></p>
            <p><?= $book['booPublicationYear'] ?></p>
            <p><?= $book['booScoreAverage'] ?></p>
            <p><?= $book['catName'] ?></p>
            <a href="details.php?idBook=<?= $book['idBook'];?>">Lien vers le livre</a>
        </div>
    <?php endforeach ?>
</div>

<?= require ('template/footer.php'); ?>