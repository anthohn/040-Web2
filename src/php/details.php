<?php 
$title = 'Details du livre';
require ('template/header.php');
$id = $_GET["idBook"];
$book = $db->getBook($id); ?>

<h1>*Détails :*</h1>

<div class="MainBookblock">
    <?php foreach($book as $books): ?>
        <div class="bookBlock">
            <p><?= $books['booTitle'] ?></p> 
            <p><?= $books['booPages'] ?></p> 
            <p><?= $books['booExtract'] ?></p> 
            <p><?= $books['booSumary'] ?></p> 
            <p><?= $books['booPublicationYear'] ?></p> 
            <p><?= $books['booScoreAverage'] ?></p> 
            <p><?= $books['catName'] ?></p> 
        </div>
    <?php endforeach ?>
</div>

<?php require ('template/footer.php'); ?>