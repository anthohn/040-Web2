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
                <form method='POST' >
                    <p>Moyenne d'appréciation : <?= $books['booScoreAverage'] ?>
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
                        <input class='confirm'type='submit' name='submit' value='Ajouter'>
                </form>     
                </p>  
                <a href="#">Lien vers l'extrait</a>               
            </div>
        </div>
        <?php if(isset($_POST['submit']) && $_POST['note'] != 0) : ?>
    <?php $note = $_POST['note']; 
    $idbook = $books['idBook']; 
    print_r($idbook);
    $note = $db->addVoteBook($idbook, $note)
      ?>  
<?php endif; ?>
    <?php endforeach ?>
</div>



<?php require ('template/footer.php'); ?>