<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 09/09/2019
 * Time: 00:54
 */

class Deputie
{
    private $conn;
    private $table_name = "elected";

    //object properties
    public $id;
    public $nomFr;
    public $nomAr;
    public $gov;
    public $img;
    public $bio;

    //constructor with $db as database connection

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function readAll(){
        //select all data
        $query = "SELECT * FROM " . $this->table_name ;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function readByGov(){
        //select all data
        $query = "SELECT * FROM " . $this->table_name . " WHERE gov=".$this->gov;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function getOne(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE elu_id=".$this->id;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function getAvg($tab){
        $query = "SELECT attributes FROM " .$tab." WHERE elu_id=".$this->id ;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function getTopAvg($tab){
        $query = "SELECT elu_id FROM " . $this->table_name . "";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $all=array();
        while ($row = $stmt->fetch()){
            $id = $row['elu_id'];
            $query1 = "SELECT * FROM ".$tab." WHERE elu_id='$id'" ;

            $stmt1 = $this->conn->prepare($query1);
            $stmt1->execute();
            $result = 0;
            while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                // extract row
                // this will make $row['name'] to
                // just $name only
                $ple = json_decode($row1['attributes'], true);
                $sum=0;
                foreach ($ple as $item) {
                    $sum+=floatval($item);
                }
                $result = $sum/sizeof($ple);
            }
            $all[$id]=$result;
        }
        $final = array();
        $final[array_keys($all,max($all))[0]]=max($all);
        return $final;
    }

    function avgAll($tab){
        $query = "SELECT elu_id FROM " . $this->table_name . "";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $all=array();
        while ($row = $stmt->fetch()){
            $id = $row['elu_id'];
            $query1 = "SELECT * FROM ".$tab." WHERE elu_id='$id'" ;

            $stmt1 = $this->conn->prepare($query1);
            $stmt1->execute();
            $result = 0;
            while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                // extract row
                // this will make $row['name'] to
                // just $name only
                $ple = json_decode($row1['attributes'], true);
                $sum=0;
                foreach ($ple as $item) {
                    $sum+=floatval($item);
                }
                $result = $sum/sizeof($ple);
            }
            $all[$id]=$result;
        }
        return array_sum($all) / count($all);
    }

}