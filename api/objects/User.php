<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 06/09/2019
 * Time: 19:58
 */

class User
{
    private $conn;
    private $table_name = "users";

    //object properties
    public $id;
    public $name;
    public $email;
    public $password;

    //constructor with $db as database connection

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create user
    function create()
    {

        // query to insert record
        $query = "INSERT INTO " . $this->table_name . "(name,Email,Password) values(:name,:Email,:Password)";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":Email", $this->email);
        $stmt->bindParam(":Password", $this->password);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }
}