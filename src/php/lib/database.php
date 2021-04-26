<?php
/**
 * Auteur : Anthony Höhn
 * Date : 26.04.2021
 * Description : 
 */

 class Database {
    // Variable de classe
    private $connector;


    //connexion à la bdd en faisant essayant puis si erreur récupere le message et affiche le message d'erreur 
    public function __construct(){
    try{
        $this->connector = new PDO('mysql:host=localhost;dbname=p_db_040_Web2;charset=utf8', 'dbUser040', '.Etml-');
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

    //Fonction qui récupere les 5 derniers ouvrage de la table t_books
    public function LastFiveBooks(){
        $query = 'SELECT * FROM t_book JOIN t_category ON idxCategory = idCategory ORDER BY idBook DESC LIMIT 5';
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    //Fonction qui récupere les ouvrages de la table t_books par categorie avec un binds
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

}    