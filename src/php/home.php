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
                des Assyriens et des Sumériens, en forme de coins, d'où le nom d'écriture cunéiforme. Les tablettes étaient cuites pour être solidifiées. À Ninive, 22 000 tablettes ont été
                retrouvées, datant du viie siècle av. J.-C. ; c'est la bibliothèque des rois d'Assyrie, qui disposaient d'ateliers de copistes et de lieux de conservation. Cela suppose une
                organisation autour du livre, une réflexion sur la conservation, le classement, etc.La soie, en Chine, fut aussi un support de l'écriture. On écrivait à l'aide de pinceaux. 
                Bien d'autres supports furent utilisés : os, bronze, poterie, écaille de tortue, etc. En Inde, par exemple, on utilisa des feuilles de palmier séchées. Tous les matériaux qui 
                permettent de conserver et de transmettre un texte sont donc susceptibles de devenir des livres. Dans ce cas, le corps humain pourrait être aussi considéré comme un livre, 
                avec le tatouage, et, si l'on admet que la mémoire humaine se développe ou se transforme avec l'apparition de l'écriture, il n'est peut-être pas absurde de penser que cette 
                faculté fait de l'homme un livre vivant2. Il est important de rappeler que pendant des siècles, de nombreux pans de la production textuelle et donc du savoir, passeront par 
                l'oralité et la mémorisation : ainsi, sans parler du védisme, l'Iliade fut transmise par des aèdes.
            </p>
        </div>
    </div>

    <div class="mainBookblock">
        <?php foreach ($fiveBooks as $fiveBook) : ?>
            <div class="bookBlock">
                <div class="bookImage">
                    <a href="details.php?idBook=<?= $fiveBook['idBook'];?>"><img src="../../resources/images/books/petit-pays.jpg" alt="première de couverture"/></a>
                </div>
                <div class="bookInfo">
                    <p id="bookTitle"><?= $fiveBook['booTitle'] ?></p> 
                    <p id="bookAuthor">Auteur</p> 
                    <p id="bookAvg"><?= $fiveBook['booScoreAverage'] ?></p>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
<<<<<<< HEAD
=======

>>>>>>> 6ac2926793b3e9130890efc6530cdb91844ed47b
<?= require ('template/footer.php'); ?>