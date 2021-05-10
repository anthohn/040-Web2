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
            <!-- </div> -->

            <!-- <hr class="hzLine"> -->

            <!-- <div class="halfFormContainer" id="secondHalf"> -->
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
                                <label for="img">Image de couverture</label>
                                <div class="uploadContent">
                                    <input type="file" id="upload" hidden/>
                                    <label for="upload"><svg width="20" height="20" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16"><path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/><path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/></svg></label>
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
                                        <button type="submit" id="btnSubmit" name="btnSubmit">
                                            <span>Ajouter</span>
                                            <div class="success">
                                                <svg xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  viewBox="0 0 29.756 29.756" style="enable-background:new 0 0 29.756 29.756;" xml:space="preserve"><path d="M29.049,5.009L28.19,4.151c-0.943-0.945-2.488-0.945-3.434,0L10.172,18.737l-5.175-5.173   c-0.943-0.944-2.489-0.944-3.432,0.001l-0.858,0.857c-0.943,0.944-0.943,2.489,0,3.433l7.744,7.752   c0.944,0.943,2.489,0.943,3.433,0L29.049,8.442C29.991,7.498,29.991,5.953,29.049,5.009z"/></svg>
                                            </div>
                                        </button>
                                        <!-- <input type="submit" id="btnSubmit" name="btnSubmit" value="Ajouter" /> -->
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