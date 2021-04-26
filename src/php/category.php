<?php 
$title = 'Accueil';
require ('template/header.php');

$idCategory = 2;
$CategoryBooks = $db->CategoryBooks($idCategory); ?>

<?php foreach ( $CategoryBooks as $CategoryBook): ?>
    <p><?= $CategoryBook["booTitle"]; ?></p>
<?php endforeach ?>			

