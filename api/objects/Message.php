<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 07/09/2019
 * Time: 21:15
 */

class Message
{
    private $conn;
    private $table_name = "messages";

    //object properties
    public $id;
    public $subject;
    public $message;
    public $email;

    //constructor with $db as database connection

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function create()
    {

        // query to insert record
        $query = "INSERT INTO " . $this->table_name . "(subject,message,email) values(:subject,:message,:email)";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->subject = htmlspecialchars(strip_tags($this->subject));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->message = htmlspecialchars(strip_tags($this->message));

        // bind values
        $stmt->bindParam(":subject", $this->subject);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":message", $this->message);
        // test if email already exists

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

}