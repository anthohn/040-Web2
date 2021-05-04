<?php 
$title = 'Tous les livres';
require ('template/header.php');
$books = $db->getBooks();
$categorys = $db->getCategorys();
?>
<?php 
	$books = $db->getBooks();

	if(isset($_GET['search']) && !empty($_GET['search'])) {
		$search = htmlspecialchars($_GET['search']);
		$books = $db->getSearchedBooks($search);
	}
?> 
<div class="content">
    <h1 class="allBooksTitle" >Liste de tout les livres</h1>
    <form method="GET">
        <div class="searchBarInputContainer">
            <div class="searchIcon">
                <button class="icon" name="envoyer" type="submit"><svg id="icon" viewBox="0 0 24 24" fill="grey" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg></button>
            </div>
            <div class="searchBarInput">
                <input autocomplete="off" type="text" name="search" id="search" placeholder="Rechercher . . ."/>
            </div>
        </div>
    </form>

    <div class="selectCategory">
        <form method='POST' class="searchForm">
            <div class='selectCategory input' id="selectBookList">
                <select name='category' id='category'>
                    <option value='0'>Séléctionnez</option>
                    <?php foreach($categorys as $category) : ?>
                        <option value='<?= $category['idCategory']; ?>'><?= $category['catName']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input class='confirm' type='submit' name='submit' value='Valider'>
        </form>
        <div class="result">
            <?php 
                if(isset($_GET['search']) && !empty($_GET['search'])) {
                    if(count($books) > 0) {
                        foreach($books as $book) {    
                        }
                        echo "<h2>Résultat pour : $search</h2>";
                    }
                    else {
                        echo "<h2>Aucun résultat pour : $search</h2>";
                    }
                }
            ?>
        </div>

        <?php if(isset($_POST['submit'])) : ?>
            <?php $idCategory = $_POST['category']; 
                  $categorys = $db->CategoryBooks($idCategory); ?>
                <div class="mainBookblock">
                <?= $categorys[0]['catName']; ?>
                <?php foreach ($categorys as $category) : ?>
                    <div class='bookBlock'>
                            
                        <div class='bookImage'>
                            <a href="details.php?idBook=<?= $category['idBook'];?>"><img class="imageBook" src="../../resources/images/books/<?= $category['idBook'];?>.jpg" alt="première de couverture"/></a>
                        </div>
                        <div class="middle">
                            <div class="zoom"><a href="details.php?idBook=<?= $category['idBook'];?>"><svg class="zoomIcon" width="30" height="30" fill="currentColor" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg></a></div>
                        </div>
                        <div class="bookInfo">
                            <p id="bookTitle"><?= $category['booTitle'] ?></p> 
                            <p id="bookAuthor"><?= $category['autFirstname'] ?></p> 
                            <p id="bookAvg"><?= $category['booScoreAverage'] ?> / 5</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>    
        <?php endif; ?>
    </div>

    <div class='mainBookblock'>
        <?php foreach ($books as $book) : ?>
            <div class='bookBlock'>
                <div class='bookImage'>
                    <a href="details.php?idBook=<?= $book['idBook'];?>"><img class="imageBook" src="../../resources/images/books/<?= $book['idBook'];?>.jpg" alt="première de couverture"/></a>
                </div>
                <div class="middle">
                    <div class="zoom"><a href="details.php?idBook=<?= $book['idBook'];?>"><svg class="zoomIcon" width="30" height="30" fill="currentColor" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg></a></div>
                </div>
                <div class="bookInfo">
                    <p id="bookTitle"><?= $book['booTitle'] ?></p> 
                    <p id="bookAuthor"><?= $book['autFirstname'] ?></p> 
                    <p id="bookAvg"><?= $book['booScoreAverage'] ?> / 5</p>
                </div>
            </div>
        <?php endforeach ?>
    </div>       
</div>

<?php require ('template/footer.php'); ?>