<?php $title = 'Modification du livre';
require "template/header.php";

// Vérifie si l'utilisateur est loggé ET admin
if(isLogged() && (isAdmin())):

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
        $bddNotes = $db->getNotesBook($idBook)[0]['votNote'];
        $authors = $db->getAuthor();
        $categorys = $db->getCategorys();
        $editors = $db->getEditors();
    }


    if(isset($_POST['btnSubmit']))
    {
        // if(empty($_POST['booTitle']), empty($_POST['booSummary']), empty($_POST['booPages']))
        // {
            // $error = '<div class="errorLoginContainer"><h4 class="errorLogin">Veuillez renseigner tous les champs !</h4></div>';  
        // } 
        // else
        // {   
            $db->updateBook($idBook, $_POST['booTitle'], $_POST['author'], $_POST['booSummary'], $_POST['country']);
            $error = '<div class="succesLoginContainer"><h4 class="succesLogin">Modifications effectuées avec succès !</h4></div>'; 
        // }
    }
    ?>

    <form method="POST" action="editBook.php?idBook=<?= $idBook ?>" enctype="multipart/form-data">
        <div class="MainDetailBookBlock">
        <?php foreach($books as $book): ?> 
            <h1>Modification <?= $book['booTitle'] ?></h1>
                <div class="bookDetailBlock">            
                    <img src="../../resources/images/books/<?= $book['idBook'];?>.jpg" alt="première de couverture"/>   

                    <div class="bookContent">          
                        <h2><input type="text" name="name" value="<?= $book['booTitle'] ?>"></h2>
                        
                        <h3>
                            <select name="author">
                                <option value='<?= $book["idAuthor"];?>'><?= $book["autLastname"] . ' ' . $book["autFirstname"];?></option>
                                <?php foreach($authors as $author) : ?>
                                    <option value="<?= $author["idAuthor"]; ?>"><?= $author["autLastname"] . ' ' . $author["autFirstname"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </h3>

                        <h4>Résumé : </h4> 
                        <p class="booSummary"><textarea id="w3review" name="w3review" rows="3" cols="137"><?= $book['booSummary'] ?></textarea></p> 

                        <p id="catPages">
                            <select name="type" id="type">
                            <option value='<?= $book["idxCategory"];?>'><?= $book["catName"];?></option>
                                <?php foreach($categorys as $category) : ?>
                                    <option value="<?= $category["idCategory"]; ?>"><?= $category["catName"]?></option>
                                <?php endforeach; ?>
                            </select>
                            - 
                            <input type="number" value="<?= $book['booPages'] ?>"> pages
                            
                        </p> 
                        <p id="editorPubliYear"><select name="type" id="type">
                            <option value='<?= $book["idEditor"];?>'><?= $book['ediName']?></option>
                                <?php foreach($editors as $editor) : ?>
                                    <option value="<?= $editor["idEditor"]; ?>"><?= $editor["ediName"]?></option>
                                <?php endforeach; ?>
                            </select>
                            
                            - <?php $newDate = date("Y-m-d", strtotime($book["booPublicationYear"]));?>  
                                <input type="date" name="date" value="<?= $newDate;?>">
                            
                        </p>
                        <div>
                            <button type="submit" name="btnSubmit">Modifier</button>
                        </div>
                        <!-- <div class="test">
                            <a href="allArtists.php"><img width="50px" src="../../userContent/icon/backArrow.svg"></img></a>
                        </div> -->
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </form>

    <?php
    if(isset($error))
    {
        echo $error;
    }

endif;  

if(isset($error))
{
    echo $error;
}
elseif(isset($succes))
{
    echo $succes;
}


require ('template/footer.php'); ?>