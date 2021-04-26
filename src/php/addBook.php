<?php 
$title = 'Ajout d\'un livre';
require ('template/header.php');
$categorys = $db->getCategorys(); 
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
                    <select name="Category" id="Category">
                        <option value="0">Category </option>
                        <?php foreach($categorys as $category) : ?>
                            <option value="<?= $category["idCategory"]; ?>"><?= $category["catName"]; ?></option>
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
                    if(!(isset($_POST['name'])) || empty($_POST['date']) || $_POST['country'] == 0)
                     {
                        echo '<h2 id="errorMessage">Veuillez renseignez tout les champs.</h2>';
                    }
                    else {
                        $DB->addArtist($_POST['name'], $_POST['date'],  $_POST['country']);
                        echo '<h1 id="validationMessage">L\'artiste à bien été ajouté.</h1>';
                    }
                }
            ?>
        </div>
<?php


// if(isset($_POST["submit"]))
// {
//     if(empty($_POST["gender"]) || empty($_POST["name"]) || empty($_POST["surname"]) || empty($_POST["nickname"]) || empty($_POST["origin"]))
//     {
//         echo "Veuillez renseignez tous les champs.";
//     } 
//     else {
//         $teachers = $db->getAllTeachers();

//         $db->addTeacher($_POST['gender'], $_POST['name'], $_POST['surname'], $_POST['nickname'], $_POST['origin']);
//         // $db->addTeacherSection($section['idSection'], max($teachers['idTeachers']) + 1);
//         echo "<h1>L'enseigant a bien été ajouté</h1>";
//         // header('Location: index.php');
//     }
// }
?>

<?php require ('template/footer.php'); ?>