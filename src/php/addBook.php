<?php 
$title = 'Ajout d\'un livre';
require ('template/header.php');
if(isLogged()):

$categorys = $db->getCategorys(); 
$authors = $db->getAuthor();
?>

<div class="content">
    <h1 class="contentTitle">Ajout d'un livre</h1>
    <div class="tableContainer">
        <form method="POST" action="addBook.php">
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
                        <input type="text" id="extract" name="extract" placeholder="Lien de l'extrait">
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

            <!-- <hr class="hzLine"> -->

            <div class="halfFormContainer" id="secondHalf">
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
                                <label for="img">image de couverture</label>
                                <input type="file" name="printscreen" id="printscreen" />
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
                                        <input type="submit" id="btnSubmit" name="btnSubmit" value="Ajouter" />
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
        </form>
        <?php 
            if(isset($_POST['btnSubmit'])) {
                if(!(isset($_POST['name'])) || empty($_POST['date']) || $_POST['country'] == 0)
                {
                    echo '<h2 id="errorMessage">Veuillez renseignez tout les champs.</h2>';
                }
                else {
                    echo '<h1 id="validationMessage">L\'artiste à bien été ajouté.</h1>';
                }
            }
        ?>
            <!-- </div> -->
        </form>
        <?php 
            if(isset($_POST['btnSubmit'])) {
                if(!(isset($_POST['title']))  || empty($_POST['pages']) || empty($_POST['extract']) || empty($_POST['resume']) || empty($_POST['date']) )
                    {
                    echo '<h2 id="errorMessage">Veuillez renseignez tout les champs.</h2>';
                }
                else {
                    $db->addBook( $_POST['title'],  $_POST['pages'], $_POST['extract'], $_POST['resume'], $_POST['date']);
                    echo '<h1 id="validationMessage">Le Livre a bien été ajouté.</h1>';
                }
            }
        ?>
    </div>
</div>

<?php else : ?>
<div class="notLog">
    <h2>Connectez-vous pour pouvoir ajouter un livre.</h2>
</div>
<?php endif; ?>

<?php require ('template/footer.php'); ?>