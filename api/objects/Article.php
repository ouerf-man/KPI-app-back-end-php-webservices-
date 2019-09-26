<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 21/09/2019
 * Time: 13:25
 */

class Article
{
    private $conn;
    private $table_name = "articles";

    //object properties
    public $id;
    public $cat;
    public $title;
    public $file;

    //constructor with $db as database connection

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getOne(){
        $query = "SELECT * FROM " . $this->table_name ." WHERE id =". $this->id ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function getAll(){
        //select all data
        $query = "SELECT * FROM " . $this->table_name ." WHERE cat =". $this->cat ;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function getAllNoFiltrage(){
        $query = "SELECT * FROM " . $this->table_name ;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function addOne(){
        $query = "INSERT INTO ".$this->table_name."(title,file,cat) values (\"".$this->title."\",\"".$this->file."\",".$this->cat.")";
        $stmt = $this->conn->prepare($query);
        if(!$stmt->execute()){
            die('unable to add article');
        }else{
            header('location:../article.php?idC='.$this->cat);
        }
    }

    function delete(){
        $query = "DELETE FROM articles WHERE id=".$this->id;
        $stmt = $this->conn->prepare($query);
        if(!$stmt->execute()){
            die('unable to delete category');
        }
    }
}