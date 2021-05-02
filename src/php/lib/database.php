<?php
/**
 * Auteur : Anthony Höhn
 * Date : 26.04.2021
 * Description : 
 */

 class Database {
    // Variable de classe
    private $host;
    private $username;
    private $password;
    private $database;
    private $connector;

    //connexion à la bdd en faisant essayant puis si erreur récupere le message et affiche le message d'erreur 
    public function __construct($host = null, $username = null, $password = null, $database = null){
        if($host != null){
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }
            try{
            $this->connector = new PDO('mysql:host='.$this->host.';dbname='.$this->database.';charset=utf8', $this->username, $this->password);
            }
            catch(PDOException $e)
            {
                die('<h1>Impossible de se connecter à la base de données</h1> erreur :'. $e->getMessage()); 
            }
    }

    private function querySimpleExecute($query){
        $req = $this->connector->query($query);
        return $req;
    }

    private function queryPrepareExecute($query, $binds){
        $req = $this->connector->prepare($query);
        foreach($binds as $bind){
            $req->bindValue($bind['field'], $bind['value'], $bind['type']);
        }
        $req->execute();
        return $req;
    }

    private function formatData($req){
        $results = $req->fetchALL(PDO::FETCH_ASSOC);
        return $results;
    }

    //Vider le jeu d’enregistrements
    private function unsetData($req){
        $req->closeCursor(); 
    }

    //Fonction qui récupere tous les livres
    public function getBooks(){
        $query = 'SELECT * FROM t_book JOIN t_category ON idxCategory = idCategory ORDER BY idBook';
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    //Fonction qui récupere un livre grace à son ID
    public function getBook($id){
        $query = 'SELECT * FROM t_book JOIN t_write ON idBook = idxBook JOIN t_author ON idxAuthor = idAuthor JOIN t_category ON idxCategory = idCategory JOIN t_editor ON idxEditor = idEditor WHERE idBook = :id';
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

    //Fonction qui récupere les 5 derniers ouvrage de la table t_books
    public function LastFiveBooks(){
        $query = 'SELECT * FROM t_book JOIN t_write ON idBook = idxBook JOIN t_author ON idxAuthor = idAuthor JOIN t_category ON idxCategory = idCategory ORDER BY idBook DESC LIMIT 5';
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    //Fonction qui récupere les ouvrages de la table t_books par categorie
    public function CategoryBooks($idCategory){
        $query = 'SELECT * FROM t_book JOIN t_category ON idxCategory = idCategory WHERE idCategory  = :idCategory';
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

    //Fonction qui récupere toutes les catégorie
    public function getCategorys(){
        $query = 'SELECT * FROM t_category';
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    //Fonction qui récupere les éditeurs
    public function getEditors(){
        $query = 'SELECT * FROM t_editor';
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    //ajout d'un livre dans la bdd
    public function addBook($title, $category, $pages , $extract, $resume, $date){
        $query = "INSERT INTO t_book (booTitle, booCategory, booPages, booExtract, booResume, booDate) VALUES (:title, :category, :pages, :extract, :resume, :date)";
        $binds = array(
            0 => array(
                'field' => ':title',
                'value' => $title,
                'type' => PDO::PARAM_STR
            ),  
            1 => array(
                'field' => ':category',
                'value' => $category,
                'type' => PDO::PARAM_STR
            ),
            2 => array(
                'field' => ':pages',
                'value' => $pages,
                'type' => PDO::PARAM_INT
            ),
            3 => array(
                'field' => ':extract',
                'value' => $extract,
                'type' => PDO::PARAM_STR
            ),
            4 => array(
                'field' => ':resume',
                'value' => $resume,
                'type' => PDO::PARAM_STR
            ),
            5 => array(
                'field' => ':date',
                'value' => $date,
                'type' => PDO::PARAM_STR
            )
        );
        $results = $this->queryPrepareExecute($query, $binds);
    }

    //récupere tous les utilisateur
    public function getUsers(){
        $query = "SELECT * FROM t_user";
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    //ajout d'un utilisateur dans la bdd ''''''''''''''''''pas du tout fonctionel pour le moment''''''''''''''''''
    public function addUser($title, $category, $pages , $extract, $resume, $date){
        $query = "INSERT INTO t_book (booTitle, booCategory, booPages, booExtract, booResume, booDate) VALUES (:title, :category, :pages, :extract, :resume, :date)";
        $binds = array(
            0 => array(
                'field' => ':title',
                'value' => $title,
                'type' => PDO::PARAM_STR
            ),  
            1 => array(
                'field' => ':category',
                'value' => $category,
                'type' => PDO::PARAM_STR
            ),
            2 => array(
                'field' => ':pages',
                'value' => $pages,
                'type' => PDO::PARAM_INT
            ),
            3 => array(
                'field' => ':extract',
                'value' => $extract,
                'type' => PDO::PARAM_STR
            ),
            4 => array(
                'field' => ':resume',
                'value' => $resume,
                'type' => PDO::PARAM_STR
            ),
            5 => array(
                'field' => ':date',
                'value' => $date,
                'type' => PDO::PARAM_STR
            )
        );
        $results = $this->queryPrepareExecute($query, $binds);
    }

    //va chercher les livres selon ce qui est entré par l'utilisateur 
    public function getSearchedBooks($search){
        $query = 'SELECT * FROM t_book WHERE booTitle LIKE "%'.$search.'%"';
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);

        $this->unsetData($reqExecuted);
        return $results;
    }





}    