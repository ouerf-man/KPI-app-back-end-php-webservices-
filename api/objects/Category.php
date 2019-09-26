<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 20/09/2019
 * Time: 18:11
 */

class Category
{
    private $conn;
    private $table_name = "categories";

    //object properties
    public $id;
    public $cat;

    //constructor with $db as database connection

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getAll(){
        //select all data
        $query = "SELECT * FROM " . $this->table_name ;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function addOne(){
        $query = "INSERT INTO ".$this->table_name."(cat) values (\"".$this->cat."\")";
        $stmt = $this->conn->prepare($query);
        if(!$stmt->execute()){
            die('unable to add category');
        }
    }

    function delete(){
        $query = "DELETE FROM articles WHERE cat=".$this->id;
        $stmt = $this->conn->prepare($query);
        if(!$stmt->execute()){
            die('unable to delete category');
        }
        $query = "DELETE FROM ".$this->table_name." WHERE id=".$this->id;
        $stmt = $this->conn->prepare($query);
        if(!$stmt->execute()){
            die('unable to delete category');
        }
    }
}