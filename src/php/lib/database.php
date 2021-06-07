<?php
/**
 * Auteur : Anthony Höhn
 * Date : 26.04.2021
 * Description : All functions
 */


 /**
 * Class Database to connect on the database
 */
 class Database {
    // Variable de classe
    private $host;
    private $username;
    private $password;
    private $database;
    private $connector;

    public function __construct($host = null, $username = null, $password = null, $database = null)
    {
        if($host != null)
        {
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }
        /**
         * Try to open the connection on the database
         * If catch a PDOException -> show the error
         */
        try
        {
        $this->connector = new PDO('mysql:host='.$this->host.';dbname='.$this->database.';charset=utf8', $this->username, $this->password);
        }
        catch(PDOException $e)
        {
            die('<h1>Impossible de se connecter à la base de données</h1> erreur :'. $e->getMessage()); 
        }
    }

    /**
     * Function querySimpleExecute to execute a SQL query without WHERE
     * @param $query
     */
    private function querySimpleExecute($query){
        $req = $this->connector->query($query);
        return $req;
    }

    /**
     * Function queryPrepareExecute to execute a SQL query with WHERE and avoid SQL injections
     * @param $query
     * @param $binds
     */
    private function queryPrepareExecute($query, $binds){
        $req = $this->connector->prepare($query);
        foreach($binds as $bind){
            $req->bindValue($bind['field'], $bind['value'], $bind['type']);
        }
        $req->execute();
        return $req;
    }

    /**
     * Function formatData to get the result of the SQL query in an associative array
     * @param $req
     */
    private function formatData($req){
        $results = $req->fetchALL(PDO::FETCH_ASSOC);
        return $results;
    }

    /**
     * Function unsetData to empty the record set
     * @param $req
     */
    private function unsetData($req){
        $req->closeCursor(); 
    }

    /**
     * Function to get all books from the ddb
     */
    public function getBooks(){
        $query = 'SELECT * FROM t_book JOIN t_write ON idBook = idxBook JOIN t_author ON idxAuthor = idAuthor JOIN t_category ON idxCategory = idCategory ORDER BY idBook';
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /**
     * Function get all books from one user
     * @param $idUser
     */
    public function getBooksUser($idUser){
        $query = 'SELECT * FROM t_book JOIN t_write ON idBook = idxBook JOIN t_author ON idxAuthor = idAuthor JOIN t_category ON idxCategory = idCategory JOIN t_user ON idxUser = idUser WHERE idUser = :idUser';
        $binds = array(
            0 => array(
                'field' => ':idUser',
                'value' => $idUser,
                'type' => PDO::PARAM_INT
            )    
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);        
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /**
     * Function delete a book
     * @param $idBook
     */
    public function deleteBook($idBook){
        $query = 'DELETE FROM t_book WHERE idBook = :idBook';
        $binds = array(
            0 => array(
                'field' => ':idBook',
                'value' => $idBook,
                'type' => PDO::PARAM_INT
            )    
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /**
     * Function update a book
     * @param $idBook
     * @param $author
     * @param $summary
     * @param $category
     * @param $pageNumber
     * @param $editor
     * @param $date
     */
    public function updateBook($idBook, $author, $summary, $category, $pageNumber, $editor, $date){
        $query = 'UPDATE t_book SET booTitle = :booTitle,  booPages = :booPages, booExtract = :booExtract WHERE idBook = :idBook';
        $binds = array(
            0 => array(
                'field' => ':booTitle',
                'value' => $idBook,
                'type' => PDO::PARAM_INT
            ),
            1 => array(
                'field' => ':booPages',
                'value' => $pageNumber,
                'type' => PDO::PARAM_STR
            ),
            2 => array(
                'field' => ':booExtract',
                'value' => $date,
                'type' => PDO::PARAM_STR
            ),
            3 => array(
                'field' => ':idxCountry',
                'value' => $country,
                'type' => PDO::PARAM_INT
            )
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    } 

    /** 
     * Function get one book (détails book)
     * @param $id
     */ 
    public function getBook($id){
        $query = 'SELECT idBook, booTitle, booPages, booExtract, autLastname, autFirstname, booSummary, catName, ediName, idUser, useLogin, DATE_FORMAT(booPublicationYear, "%d/%m/%Y") AS booPublicationYear, booNoteCount FROM t_book JOIN t_write ON idBook = idxBook JOIN t_author ON idxAuthor = idAuthor JOIN t_category ON idxCategory = idCategory JOIN t_editor ON idxEditor = idEditor JOIN t_user ON idxUser = idUser WHERE idBook = :id';
        $binds = array(
            0 => array(
                'field' => ':id',
                'value' => $id,
                'type' => PDO::PARAM_INT
            )    
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /** 
     * Function get user books
     */ 
    public function getUserBooks() {
        $query = 'SELECT idBook, idUser, useLogin FROM t_book JOIN t_write ON idBook = idxBook JOIN t_author ON idxAuthor = idAuthor JOIN t_category ON idxCategory = idCategory JOIN t_editor ON idxEditor = idEditor JOIN t_user ON idxUser = idUser';
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /** 
     * Function get last five books from table t_books
     */ 
    public function lastFiveBooks(){
        $query = 'SELECT idBook, booTitle, autFirstname, FORMAT(AVG(votNote) , 1) AS "votNote" FROM t_book JOIN t_vote ON t_book.idBook = t_vote.idxBook JOIN t_write ON t_write.idxBook = idBook JOIN t_author ON idxAuthor = idAuthor GROUP BY t_vote.idxBook ORDER BY t_book.idBook DESC LIMIT 5';
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /** 
     * Function get notes from last five books
     */ 
    public function getNoteslastFiveBooks(){
        $query = 'SELECT votNote, votText, idxUser, useLogin FROM t_vote JOIN t_user ON idxUser = idUser ORDER BY idVote DESC';
        $reqExecuted = $this->querySimpleExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /** 
     * Function get books form a categories
     * @param $idCategory
     */ 
    public function categoryBooks($idCategory){
        $query = 'SELECT * FROM t_book JOIN t_category ON idxCategory = idCategory JOIN t_write ON idxBook = idBook JOIN t_author ON idxAuthor = idAuthor WHERE idCategory  = :idCategory';
        $binds = array(
            0 => array(
                'field' => ':idCategory',
                'value' => $idCategory,
                'type' => PDO::PARAM_INT
            )    
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /** 
     * Function get all categories
     */ 
    public function getCategorys(){
        $query = 'SELECT * FROM t_category';
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /** 
     * Function get all editors
     */ 
    public function getEditors(){
        $query = 'SELECT * FROM t_editor';
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /**
     * Function add book in db
     * @param $title
     * @param $pages
     * @param $extract
     * @param $summary
     * @param $publicationYear
     * @param $category
     * @param $user
     */
    public function addBook($title, $pages, $extract, $summary, $publicationYear, $category, $user){
        $query = 'INSERT INTO t_book (booTitle, booPages, booExtract, booSummary, booPublicationYear, idxCategory, idxUser) VALUES (:title, :pages, :extract, :summary, :publicationYear, :category, :user)';
        $binds = array(
            0 => array(
                'field' => ':title',
                'value' => $title,
                'type' => PDO::PARAM_STR
            ),  
            1 => array(
                'field' => ':pages',
                'value' => $pages,
                'type' => PDO::PARAM_INT
            ),
            2 => array(
                'field' => ':extract',
                'value' => $extract,
                'type' => PDO::PARAM_STR
            ),
            3 => array(
                'field' => ':summary',
                'value' => $summary,
                'type' => PDO::PARAM_STR
            ),
            4 => array(
                'field' => ':publicationYear',
                'value' => $publicationYear,
                'type' => PDO::PARAM_STR
            ),
            5 => array(
                'field' => ':category',
                'value' => $category,
                'type' => PDO::PARAM_INT
            ),
            6 => array(
                'field' => ':user',
                'value' => $user,
                'type' => PDO::PARAM_INT
            )
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        
        // Récupere le dernier ID (qui vient d'être inséré)
        $query2 = "SELECT LAST_INSERT_ID()";
        $results2 = $this->querySimpleExecute($query2);
        $results2 = $this->formatData($results2);

        return $results2[0]["LAST_INSERT_ID()"];
    }

    /**
     * Function ??
     * @param $??
     */
    public function addWrite($idxAuthor){
        $query = "INSERT INTO t_write (idxBook, idxAuthor) VALUES (LAST_INSERT_ID(), :idxAuthor)";
        $binds = array(  
            0 => array(
                'field' => ':idxAuthor',
                'value' => $idxAuthor,
                'type' => PDO::PARAM_INT
            )
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /**
     * Function add vote last ID
     * @param $idxBook
     * @param $idxUser
     */
    public function addVoteLastId($idxBook, $idxUser){
        $query = "INSERT INTO t_vote (idxBook, idxUser) VALUES (:idxBook, :idxUser)";
        $binds = array(  
            0 => array(
                'field' => ':idxBook',
                'value' => $idxBook,
                'type' => PDO::PARAM_INT
            ),
            1 => array(
                'field' => ':idxUser',
                'value' => $idxUser,
                'type' => PDO::PARAM_INT
            )
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /**
     * Function get users
     */
    public function getUsers(){
        $query = "SELECT idUser, useLogin, useIsAdmin, useInscriptionDate, useSuggestBook, useAppreciationNumber, usePassword FROM t_user";
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /**
     * Function add user in db
     * @param $login
     * @param $psw
     */
    public function addUser($login, $psw){
        $query = "INSERT INTO t_user (useLogin, usePassword, useInscriptionDate) VALUES (:useLogin, :usePassword, now())";
        $binds = array(
            0 => array(
                'field' => ':useLogin',
                'value' => $login,
                'type' => PDO::PARAM_STR
            ),  
            1 => array(
                'field' => ':usePassword',
                'value' => $psw,
                'type' => PDO::PARAM_STR
            )
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /**
     * Function get one user
     * @param $idUser
     */
    public function getOneUser($idUser){
        $query = 'SELECT idUser, useLogin, DATE_FORMAT(useInscriptionDate, "%d/%m/%Y") AS useInscriptionDate , useSuggestBook, useAppreciationNumber FROM t_user WHERE idUser = :id';
        $binds = array(
            0 => array(
                'field' => ':id',
                'value' => $idUser,
                'type' => PDO::PARAM_INT
            )    
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /**
     * Function delete one user from db
     * @param $idUser
     */
    public function deleteUser($idUser){
        $query = "DELETE FROM t_user WHERE idUser = :id";
        $binds = array(
            0 => array(
                'field' => ':id',
                'value' => $idUser,
                'type' => PDO::PARAM_INT
            )    
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /**
     * Function search bar 
     * @param $search
     */ 
    public function getSearchedBooks($search){
        $query = 'SELECT * FROM t_book JOIN t_category ON idxCategory = idCategory JOIN t_write ON idxBook = idBook JOIN t_author ON idxAuthor = idAuthor WHERE booTitle LIKE "%'.$search.'%"';
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);

        $this->unsetData($reqExecuted);
        return $results;
    }

    /**
     * Function search bar 
     * @param $idBook
     * @param $idUser
     * @param $note
     * @param $text
     */
    public function addVoteBook($idBook, $idUser, $note, $text){
        $query = 'INSERT INTO t_vote (idxBook, idxUser, votNote, votText) VALUES (:idxBook, :idxUser, :votNote, :votText)';
        $binds = array(
            0 => array(
                'field' => ':idxBook',
                'value' => $idBook,
                'type' => PDO::PARAM_INT
            ),
            1 => array(
                'field' => ':idxUser',
                'value' => $idUser,
                'type' => PDO::PARAM_INT
            ),
            2 => array(
                'field' => ':votNote',
                'value' => $note,
                'type' => PDO::PARAM_STR
            ),
            3 => array(
                'field' => ':votText',
                'value' => $text,
                'type' => PDO::PARAM_STR
            )
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /**
     * Function increments by one the numbers of appreciation for one book
     * @param $idBook
     */
    public function addAppreciationBook($idBook){
        $query = 'UPDATE t_book SET booNoteCount = booNoteCount + 1  WHERE idBook = :id';
        $binds = array(
            0 => array(
                'field' => ':id',
                'value' => $idBook,
                'type' => PDO::PARAM_INT
            )    
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /**
     * Function get avg not from one book
     * @param $idBook
     */
    public function getNoteBook($idBook){
        $query = 'SELECT FORMAT(AVG(votNote) , 1) AS "votNote" FROM t_vote WHERE idxBook = :id';
        $binds = array(
            0 => array(
                'field' => ':id',
                'value' => $idBook,
                'type' => PDO::PARAM_INT
            )    
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /**
     * Function get all notes from one book
     * @param $idBook
     */
    public function getNotesBook($idBook){
        $query = 'SELECT votNote, votText, idxUser, useLogin FROM t_vote JOIN t_user ON idxUser = idUser WHERE idxBook = :id ORDER BY idVote DESC';
        $binds = array(
            0 => array(
                'field' => ':id',
                'value' => $idBook,
                'type' => PDO::PARAM_INT
            )    
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /**
     * Function increments by one the number of appreciations of a user
     * @param $idUser
     */
    public function addAppreciationUser($idUser){
        $query = 'UPDATE t_user SET useAppreciationNumber = useAppreciationNumber + 1  WHERE idUser = :id';
        $binds = array(
            0 => array(
                'field' => ':id',
                'value' => $idUser,
                'type' => PDO::PARAM_INT
            )    
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    /**
     * Function get all authors
     */
    public function getAuthor(){
        $query = 'SELECT * FROM t_author';
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);
        
        $this->unsetData($reqExecuted);
        return $results;
    }
}    