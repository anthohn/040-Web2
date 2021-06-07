<?php
$title = 'Details du livre';
require ('template/header.php');
if(isLogged()) :?>

    <?php $idUser = $_SESSION['idUser'];

    // Vérifie que le get n'est pas vite, vérifie si le get est bien numérqiue -> rejete le code html et php (+ sécurisé)
    if(!isset($_GET['idBook']) OR !is_numeric($_GET['idBook']))
    {
        header('Location:404.php');
    }
    // Si tout est ok -> appelle les fonctions
    else
    {
        $idBook = $_GET["idBook"];
        $books = $db->getBook($idBook);
        $bookNotes = $db->getNotesBook($idBook);
        $bddNotes = $db->getNoteBook($idBook)[0]['votNote'];
        $_SESSION['bookNoteAvg'] = $idBook;    
    }

    // Si l'utilisateur est connecté récupere l'id de session dans $idUser

    


    if(isset($_POST['submit']))
    {
        // Si connecté continue sinon message erreur
        if(isLogged())
        {
            $note = $_POST['note'];
            $text = $_POST['text'];

            // Si la note n'est pas égal à 0 continue si non message erreur
            if($note != 0)
            {
                // ajoute le vote au livre
                $db->addVoteBook($idBook, $idUser, $note, $text);
                // incrémente de 1 les appréciation de l'utilisateur 
                $db->addAppreciationUser($idUser);
                // incrémente de 1 les appréciation du livre
                $db->addAppreciationBook($idBook);
                
                // actualise la page 
                header("Location:details.php?idBook=$idBook");
            }
            else
            {
                $error = '<div class="errorLoginContainer"><h4 class="errorLogin">Veuillez sélectionner la note</h4></div>';
            }
        }
        else
        {
            header('Location:connexion.php');
        }
    }
    ?>


    <div class="MainDetailBookBlock">
        <?php foreach($books as $book): ?> 

            <h1>Appréciation / Détail
                <?php if(isLogged() && (isAdmin())): ?>
                    <a href="editBook.php?idBook=<?= $book["idBook"]; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16"><path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/></svg></a>
                    <a href="deleteBook.php?idBook=<?= $book["idBook"]; ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer le livre ?')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></a>
                <?php endif; ?> 
            </h1>
            <div class="bookDetailBlock">            
                <img src="../../resources/images/books/<?= $book['idBook'];?>.jpg" alt="première de couverture"/>   
                
                <h2><?= $book['booTitle'] ?></h2>

                <h3><?= $book['autLastname'] ?> <?= $book['autFirstname'] ?></h3>

                <div class="detailTitleInfoSummary">
                    <h4>Résumé :</h4> 
                    <p class="booSummary"> <?= $book['booSummary'] ?></p> 
                </div>

                <div class="detailTitleInfo">
                    <h4>Catégorie :</h4> 
                    <p>&nbsp;<?= $book['catName'] ?></p>
                </div>

                <div class="detailTitleInfo">
                    <h4>Nombres de page :</h4> 
                    <p>&nbsp;<?= $book['booPages'] ?></p> 
                </div>

                <div class="detailTitleInfo">
                    <h4>Éditeur :</h4> 
                    <p>&nbsp;<?= $book['ediName'] ?></p>
                </div>

                <div class="detailTitleInfo">
                    <h4>Date de publication :</h4> 
                    <p>&nbsp;<?= $book['booPublicationYear'] ?></p>
                </div>

                <div class="detailTitleInfo">
                    <h4>Suggérer par : </h4>
                    &nbsp;<a id="extractLink" href="detailsUser.php?idUser=<?=$book['idUser'] ?>"><?= $book['useLogin']?></a>
                </div>

                <div class="detailExtract">
                    <p><a id="extractLink" href="<?= $book['booExtract'] ?>" target="_blank">Lien vers l'extrait</a> </p>
                </div>

                <div class="detailAvg">
                    <p>Moyenne d'appréciation : <span id="bookAvg">
                    <?php 
                        if($bddNotes == 0) {
                            echo '0';
                        }
                        else {
                            echo $bddNotes;
                        }
                    ?>
                    </span> / 5 (sur <?= $book['booNoteCount'] ?> 
                
                    <button class="btnOpenForm" onclick="openForm2()">Notes</button>)
                    <button class="open-button" onclick="openForm1()">Ajouter une note</button>
                </div>

                    
                </div>
            </div>
        <?php endforeach ?>
    </div>


    <div class="form-popup" id="myForm">
        <form method='POST' action="" class="form-container">
            <div class="tileButton">
                <h1>Ajouter une note</h1>
                <button type="button" id="btncancel" onclick="closeForm1()"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></button>
            </div>
            <div class="comment">
                <div class="addNotePopUp">
                    <div class="addNotePopUpTitle">
                        <h3>Votre Note : </h3>
                    </div>
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
                </div>
                <div class="commentPopUp">
                    <div class="commentPopUpTitle">
                        <h3>Votre Avis : </h3>
                    </div>
                    <textarea id="text" name="text"></textarea>
                    <div class="btnCommentPopUp">
                        <input id="submit" class='confirm'type='submit' name='submit' value='Ajouter'> 
                        <button type="reset" id="resetDetail">Effacer</button>
                    </div>
                </div>
            </div>   
                
                
        </form>    
    </div>



    <div class="form-popup" id="myFormResult">
        <div class="tileButton">
            <h1>Avis sur : <?= $books[0]['booTitle']; ?></h1>
            <button type="button" id="btncancel" onclick="closeForm2()"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></button>
        </div>
        <?php foreach($bookNotes as $bookNote): ?>
            <div class="comment">
                <h4><?= $bookNote['useLogin']; ?></h4>
                <p><?= $bookNote['votNote']; ?> / 5</p>
                <p><?= $bookNote['votText']; ?></p>
            </div>
            
        <?php endforeach; ?>
    </div>

    <script>
    function openForm1() {
    document.getElementById("myForm").style.display = "block";
    document.getElementById("html").style.overflow = "hidden";
    }

    function closeForm1() {
    document.getElementById("myForm").style.display = "none";
    document.getElementById("html").style.overflow = "scroll";
    }

    function openForm2() {
    document.getElementById("myFormResult").style.display = "block";
    document.getElementById("html").style.overflow = "hidden";
    }

    function closeForm2() {
    document.getElementById("myFormResult").style.display = "none";
    document.getElementById("html").style.overflow = "scroll";
    }
    </script>


    <?php
    if(isset($error))
    {
        echo $error;
    }
    ?>



    <?php require ('template/footer.php');


else : ?>

    <?php header('Location: template/404.php');  ?>

<?php endif;?>