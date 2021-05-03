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
                L'écriture est la condition de l'existence du texte et du livre. C'est un système de signes linguistiques permettant de transmettre et de conserver des notions abstraites. 
                L'écriture semble s'être élaborée entre le IXe et le IVe millénaire av. J.-C., d'abord sous la forme d'images qui sont devenues des ensembles pictographiques par 
                simplification. De là sont nés ensuite les idéogrammes, puis les signes phonétiques symbolisant des sons (syllabes ou lettres).Mais le livre est également lié à son support, 
                à la volonté humaine de donner une matérialité durable à un texte. La pierre pourrait être le plus ancien support de l'écriture. Mais c'est le bois façonné en tablette à 
                écrire, qui serait le premier véritable support livresque. Les mots biblos et liber ont d'ailleurs pour premier sens écorce intérieure d'un arbre. En chinois, l'idéogramme 
                du livre est à l'image de tablettes de bambou. On a trouvé également des tablettes de bois sur l'île de Pâques.On trouve ensuite des tablettes d'argile utilisées en 
                Mésopotamie au IIIe millénaire av. J.‑C. Le calame, un morceau de roseau de section triangulaire, sert à imprimer des caractères dans l'argile encore molle. C'est l'écriture
                des Assyriens et des Sumériens, en forme de coins, d'où le nom d'écriture cunéiforme. Les tablettes étaient cuites pour être solidifiées.
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
                    <p id="bookAvg"><?= $fiveBook['booScoreAverage'] ?> / 5</p>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
<?php require ('template/footer.php'); ?>