<?php 
/**
* ETML 
* Author : Anthony Höhn
* Date : 04.05.2021
* Description : Edit page /!\ Not working yet
*/

$title = 'Modification du livre';
require "template/header.php";

// Check if the user is logged and admin
if(isLogged() && (isAdmin())):

    // Check the GET content, if is numeric (more secure) and if it's ok call all the utils function
    if(!isset($_GET['idBook']) OR !is_numeric($_GET['idBook']))
    {
        header('Location:404.php');
    }
    // If all ok, then call the function
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
        $db->updateBook($idBook, $_POST['name'], $_POST['author'], $_POST['summary'], $_POST['category'], $_POST['pageNumber'], $_POST['editor'], $_POST['date']);
        $error = '<div class="succesLoginContainer"><h4 class="succesLogin">Modifications effectuées avec succès !</h4></div>'; 
    }
    ?>

    <form method="POST" action="editBook.php?idBook=<?= $idBook ?>" enctype="multipart/form-data">
        <div class="MainDetailBookBlock">
        <!-- Get book's information -->
        <?php foreach($books as $book): ?> 
            <h1>Modification <?= $book['booTitle'] ?></h1>
                <div class="bookDetailBlock">            
                    <img src="../../resources/images/books/<?= $book['idBook'];?>.jpg" alt="première de couverture"/>   

                    <div class="bookContent">          
                        <h2><input type="text" name="name" value="<?= $book['booTitle'] ?>"></h2>
                        
                        <h3>
                            <select name="author">
                                <option value='<?= $book["idAuthor"];?>'><?= $book["autLastname"] . ' ' . $book["autFirstname"];?></option>
                                <!-- Display all the authors in the select -->
                                <?php foreach($authors as $author) : ?>
                                    <option value="<?= $author["idAuthor"]; ?>"><?= $author["autLastname"] . ' ' . $author["autFirstname"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </h3>

                        <h4>Résumé : </h4> 
                        <p class="booSummary"><textarea id="summary" name="summary" rows="3" cols="137"><?= $book['booSummary'] ?></textarea></p> 

                        <p id="catPages">
                            <select name="category" id="type">
                            <option value='<?= $book["idxCategory"];?>'><?= $book["catName"];?></option>
                                <!-- Display all the categorys in the select -->
                                <?php foreach($categorys as $category) : ?>
                                    <option value="<?= $category["idCategory"]; ?>"><?= $category["catName"]?></option>
                                <?php endforeach; ?>
                            </select>
                            - 
                            <input type="number" name="pageNumber" value="<?= $book['booPages'] ?>"> pages
                            
                        </p> 
                        <p id="editorPubliYear"><select name="editor" id="type">
                            <option value='<?= $book["idEditor"];?>'><?= $book['ediName']?></option>
                                <!-- Display all the editors in the select -->
                                <?php foreach($editors as $editor) : ?>
                                    <option value="<?= $editor["idEditor"]; ?>"><?= $editor["ediName"]?></option>
                                <?php endforeach; ?>
                            </select>
                            
                            - <?php $newDate = date("Y-m-d", strtotime($book["booPublicationYear"]));?>  
                                <input type="date" name="date" value="<?= $newDate;?>">
                            
                        </p>
                            <p><input minlength="40" type="text" value="<?= $book["booExtract"];?>"></p>
                        <div>
                            <button type="submit" name="btnSubmit">Modifier</button>
                        </div>
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