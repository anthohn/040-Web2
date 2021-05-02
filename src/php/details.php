<?php 
$title = 'Details du livre';
require ('template/header.php');
$id = $_GET["idBook"];
$book = $db->getBook($id); ?>



<div class="MainDetailBookBlock">
<h1>Appréciation / Détail</h1>
    <?php foreach($book as $books): ?>
        <div class="bookDetailBlock">
            <img src="../../resources/images/books/<?= $books['idBook'];?>.jpg" alt="première de couverture"/></a>
            <div class="bookContent">
                <h2><?= $books['booTitle'] ?></h2>
                <h3><?= $books['autFirstname'] ?></h3>
                <h4>Résumé : </h4> 
                <p><?= $books['booSumary'] ?></p> 
                <p><?= $books['catName'] ?> - <?= $books['booPages'] ?> pages</p> 
                <p><?= $books['ediName'] ?> <?= $books['booPublicationYear'] ?></p> 
                <p>Moyenne d'appréciation : <?= $books['booScoreAverage'] ?></p> 
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php require ('template/footer.php'); ?>