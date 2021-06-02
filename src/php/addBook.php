<?php 
/**
* ETML 
* Author : Younes Sayeh
* Date : 04.05.2021
* Description : Add a book
*/
$title = 'Ajout d\'un livre';
require ('template/header.php');
if(isLogged()):

$categorys = $db->getCategorys(); 
$authors = $db->getAuthor();
?>

<div class="content">
    <h1 class="contentTitle">Ajout d'un livre</h1>
    <div class="tableContainer">
        <form method="POST" action="addBook.php" enctype="multipart/form-data">
            <div class="halfFormContainer">
                <div class="iptNamePages">
                    <!-- Titre -->
                    <div class="inputName input" id="titleContainer">
                        <label for="title">Titre</label>
                        <input type="text" id="title" name="title" placeholder="Titre du livre">
                    </div>

                    <!-- Nombre de pages  -->
                    <div class="inputNumberPages input">
                        <label for="pages">Nombre de pages</label>
                        <input type="number" id="pages" name="pages" placeholder="Nombre de pages">
                    </div>
                    
                </div>

                <div class="iptExtractCategory">

                    <!-- Extrait (Lien relatif vers un fichier pdf d'une page de l'ouvrage -> cdc)  -->
                    <div class="extract input">
                        <label for="extract">Lien de l'extrait</label>
                        <input type="url" id="extract" name="extract" placeholder="Lien de l'extrait">
                    </div>

                    <!-- Category  -->
                    <div class="selectCategoryAdd input">
                        <label for="Category">Categorie</label>
                        <select name="Category" id="Category">
                            <option value="0">Séléctionnez</option>
                            <?php foreach($categorys as $category) : ?>
                                <option value="<?= $category["idCategory"]; ?>"><?= $category["catName"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="halfFormContentContainer">
                <div class="authorYearDateImgContainer">
                    <div class="iptAuthorYear">
                        <!-- Auteur -->
                        <div class="inputAuthor input">
                            <label for="author">Auteur</label>
                            <select name="author" id="author">
                                <option value="0">Séléctionnez </option>
                                <?php foreach($authors as $author) : ?>
                                    <option value="<?= $author["idAuthor"]; ?>"><?= $author["autFirstname"] . ' ' . $author["autLastname"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Année d'édition -->
                        <div class="inputDate input">
                            <label for="date">Année d'édition</label>
                            <input type="date" name="date" id="date">
                        </div>
                    </div>

                    
                    <div class="imgResumeBtn">
                        <!-- Image de couverture -->
                        <div class="inputImg input">
                            <label for="img" id="imgLbl">Image de couverture</label>
                            <div class="uploadContent">
                                <input type="file" name="upload" id="upload" accept=".jpg" hidden />
                                <label for="upload" id="uploadLbl"><svg width="20" height="20" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16"><path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/><path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/></svg></label>
                                <span id="fileChosen">Aucun fichier choisi</span>
                            </div>
                        </div>

                        <div class="resumeBtnContainer">
                            <div class="btnAndResume">
                                <!-- Résumé  -->
                                <div class="resume input">
                                    <label for="resume">Résumé</label>
                                    <textarea id="resume" name="resume" placeholder="Résumé du livre"></textarea>
                                </div>

                                <!-- Boutton Ajouter -->
                                <div class="button">
                                    <div class="btnAdding">
                                        <input type="submit" id="btnSubmitBooks" name="btnSubmitBooks" value="Ajouter" />
                                    </div>

                                    <!-- Boutton pour supprimer ce qui est acctuellement entré -->
                                    <div class="btnDeleting">
                                        <button type="reset" id="btnDelete" name="btnDelete">Effacer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
<<<<<<< HEAD
        <?php 
            if(isset($_POST['btnSubmitBooks'])) {
                if(!(isset($_POST['title']))  || empty($_POST['pages']) || empty($_POST['extract']) || empty($_POST['resume']) || empty($_POST['date']) || !(isset($_POST['Category'])) || !(isset($_POST['author'])) || !file_exists($_FILES['upload']['tmp_name']) || !is_uploaded_file($_FILES['upload']['tmp_name'])) {
                    echo '<h2 id="errorMessage">Veuillez renseignez tout les champs.</h2>';
=======
        <?php
        if(isset($_POST['btnSubmitBooks'])) {
            if(!(isset($_POST['title']))  || empty($_POST['pages']) || empty($_POST['extract']) || empty($_POST['resume']) || empty($_POST['date']) || !(isset($_POST['Category'])) || !(isset($_POST['author'])) /*|| !(isset($_POST['upload']))*/) {
                echo '<h2 id="errorMessage">Veuillez renseignez tout les champs.</h2>';
            }
            else {
                $newID = $db->addBook($_POST['title'],  $_POST['pages'], $_POST['extract'], $_POST['resume'], $_POST['date'], $_POST['Category']);
                $db->addWrite($_POST['author']);

                if($newID >= 0) {
                    $source = $_FILES["upload"]["tmp_name"];
                    $destination = "../../resources/images/books/$newID.jpg";
                    move_uploaded_file($source, $destination);
                    echo '<h1 id="validationMessage">Le Livre a bien été ajouté.</h1>';
>>>>>>> 6be19196c2c9a730a76f9b2904302b8f613c8e1f
                }

                else {
                    $newID = $db->addBook($_POST['title'],  $_POST['pages'], $_POST['extract'], $_POST['resume'], $_POST['date'], $_POST['Category'], $_SESSION['idUser']);
                    $db->addWrite($_POST['author']);

                    if($newID >= 0) {
                        $db->addVoteLastId($newID, $_SESSION['idUser']);
                        $source = $_FILES["upload"]["tmp_name"];
                        $destination = "../../resources/images/books/$newID.jpg";
                        move_uploaded_file($source, $destination);
                        echo '<h1 id="validationMessage">Le Livre a bien été ajouté.</h1>';
                    }

                    else {
                        echo '<h2 id="errorMessage">Erreur d\'upload</h2>';
                    }    
                    
                }
            }
        }
        ?>
    </div>
</div>

<?php else : ?>
   <?php header('location:connexion.php'); ?>
<?php endif; ?>

<?php require ('template/footer.php'); ?>