<?php 
$title = 'Ajout d\'un livre';
require ('template/header.php');
if(isLogged()):

$categorys = $db->getCategorys(); 
$editors = $db->getEditors();
?>

<div class="tableContainer">
    <h1>Ajout d'un livre</h1>
    <form method="POST" action="addBook.php">

        <!-- Titre -->
        <div class="inputName input">
            <label for="title">Titre :</label>
            <input type="text" id="title" name="title">
        </div>

        <!-- Category  -->
        <div class="selectCategory input">
            <label for="category">Catégorie : </label>
            <select name="category" id="category">
                <option value="0">Sélectionner </option>
                <?php foreach($categorys as $category) : ?>
                    <option value="<?= $category["idCategory"]; ?>"><?= $category["catName"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Editors  -->
        <div class="selectEditors input">
            <label for="category">Éditeurs : </label>
            <select name="editor" id="editor">
                <option value="0">Sélectionner</option>
                <?php foreach($editors as $editor) : ?>
                    <option value="<?= $editor["idEditor"]; ?>"><?= $editor["ediName"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Nombre de pages  -->
        <div class="inputNumberPages input">
            <label for="pages">Nombre de pages :</label>
            <input type="text" id="pages" name="pages">
        </div>

        <!-- Extrait (Lien relatif vers un fichier pdf d'une page de l'ouvrage -> cdc)  -->
        <div class="extract input">
            <label for="extract">Extrait :</label>
            <textarea id="extract" name="extract"></textarea>
        </div>

        <!-- Résumé  -->
        <div class="resume input">
            <label for="extract">Résumé :</label>
            <textarea id="resume" name="resume"></textarea>
        </div>

        <!-- Année d'édition -->
        <div class="inputDate input">
            <label for="date">Année d'édition :</label>
            <input type="date" name="date">
        </div>

        <!-- Image de couverture -->
        <div class="inputImg input">
            <label for="img">image de couverture :</label>
            <input type="file" name="printscreen" id="printscreen" />
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
    <a href="home.php">retour</a>
</div>

<?php else : ?>
    <h1 class='notlogadd'>Vous devez être connecter pour pouvoir ajouter un livre</h1>
<?php endif; ?>


<?php require ('template/footer.php'); ?>