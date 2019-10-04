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
    public $phone;
    public $password;
    public $isActive;
    public $createdAt;
    public $rating;

    //constructor with $db as database connection

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // used when filling up the update product form
    function readOne()
    {

        // query to read single record
        $sql = "SELECT * FROM users where id =  " . $this->id;
        $stmt = $this->conn->query($sql);
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();

        } else return false;


        // set values to object properties
        $this->name = $row['name'];
        $this->email = $row['Email'];
        $this->isActive = $row['isActive'];
        $this->phone = $row['phone'];
        $this->createdAt = $row['createdAt'];
        return true;
    }

    // create user
    function create()
    {

        // query to insert record
        $query = "INSERT INTO " . $this->table_name . "(name,Email,Password,isActive,phone) values(:name,:Email,:Password,:isActive,:phone)";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->phone = htmlspecialchars(strip_tags($this->phone));

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":Email", $this->email);
        $stmt->bindParam(":Password", $this->password);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":isActive", $this->isActive);
        // test if email already exists
        $sql = "SELECT * FROM users where Email = '$this->email'";
        $stmt1 = $this->conn->query($sql);

        if ($stmt1->rowCount() > 0) {
            return false; // return 400 if email exists
        }
        // execute query
        if ($stmt->execute()) {
            $sql = "SELECT * FROM users where Email = '$this->email'";
            $stmt = $this->conn->query($sql);
            $this->id = $stmt->fetch()['id'];
            return true;
        }

        return false;

    }

    function createRating()
    {
        $this->id = htmlspecialchars(strip_tags($this->id));
        $query = "SELECT * FROM rating WHERE id=" . $this->id;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            // query to insert record
            $query = "INSERT INTO rating (id,rating) values(:id,:rating)";

            // prepare query
            $stmt = $this->conn->prepare($query);

            // sanitize
            $this->rating = htmlspecialchars(strip_tags($this->rating));
            $this->id = htmlspecialchars(strip_tags($this->id));


            // bind values
            $stmt->bindParam(":rating", $this->rating);
            $stmt->bindParam(":id", $this->id);

            // execute query
            if ($stmt->execute()) {
                return true;
            }

            return false;
        } else {
            // query to insert record
            $query = "UPDATE rating set rating=:rating WHERE id=" . $this->id;


            // prepare query
            $stmt = $this->conn->prepare($query);

            // sanitize
            $this->rating = htmlspecialchars(strip_tags($this->rating));

            // bind values
            $stmt->bindParam(":rating", $this->rating);

            // execute query
            if ($stmt->execute()) {
                return true;
            }

            return false;
        }
    }

// check if given email exist in the database
    function emailExists()
    {
        //check if email is phone ><
        if (strpos($this->email, '@') !== false) {
            // query to check if email exists
            $query = "SELECT id, name , Email , Password FROM " . $this->table_name . " WHERE Email = ?  LIMIT 0,1";

            // prepare the query
            $stmt = $this->conn->prepare($query);

            // sanitize
            $this->email = htmlspecialchars(strip_tags($this->email));

            // bind given email value
            $stmt->bindParam(1, $this->email);

            // execute the query
            $stmt->execute();

            // get number of rows
            $num = $stmt->rowCount();

            // if email exists, assign values to object properties for easy access and use for php sessions
            if ($num > 0) {

                // get record details / values
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // assign values to object properties
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->password = $row['Password'];

                // return true because email exists in the database
                return true;
            }

            // return false if email does not exist in the database
            return false;
            // now if we have a phone
        } else {
            // query to check if email exists
            $query = "SELECT id, name , Email , Password FROM " . $this->table_name . " WHERE phone = ?  LIMIT 0,1";

            // prepare the query
            $stmt = $this->conn->prepare($query);

            // sanitize
            $this->email = htmlspecialchars(strip_tags($this->email));

            // bind given email value
            $stmt->bindParam(1, $this->email);

            // execute the query
            $stmt->execute();

            // get number of rows
            $num = $stmt->rowCount();

            // if email exists, assign values to object properties for easy access and use for php sessions
            if ($num > 0) {

                // get record details / values
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // assign values to object properties
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->password = $row['Password'];

                // return true because email exists in the database
                return true;
            }

            // return false if email does not exist in the database
            return false;
        }
    }


    public function update()
    {
        $emailIsPassed = false;
        // if password needs to be updated
        $password_set = !empty($this->password) ? ", Password = :password" : "";
        // get data by id
        $sql = "SELECT * FROM users where id =  " . intval($this->id);
        $stmt = $this->conn->query($sql);
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();

        } else return false;


        // if no posted password, do not update the password
        $query = "UPDATE " . $this->table_name . "
            SET
                name = :name,
                Email = :email,
                phone = :phone
                " . $password_set . "
            WHERE id = :id";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        // sanitize
        if (!empty($this->name)) {
            $this->name = htmlspecialchars(strip_tags($this->name));
        } else {
            $this->name = $row['name'];
        }
        if (!empty($this->phone)) {
            $this->phone = htmlspecialchars(strip_tags($this->phone));
        } else {
            $this->phone = $row['phone'];
        }
        if (!empty($this->email)) {
            $this->email = htmlspecialchars(strip_tags($this->email));
        } else {
            $emailIsPassed = true;
            $this->email = $row['Email'];
        }
        // bind the values from the form
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);

        if (!empty($this->password)) {
            $this->password = htmlspecialchars(strip_tags($this->password));
            $stmt->bindParam(':password', $this->password);
        }

        // unique ID of record to be edited
        $stmt->bindParam(':id', $this->id);
        $user2 = new User($this->conn);
        $user2->email = $this->email;
        // execute the query
        if ((!$user2->emailExists() || $emailIsPassed ) && $stmt->execute()) {
            return true;
        }

        return false;
    }


    function sendPassword()
    {
        $query = "SELECT Password FROM " . $this->table_name . " WHERE Email = ?  LIMIT 0,1";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->email = htmlspecialchars(strip_tags($this->email));

        // bind given email value
        $stmt->bindParam(1, $this->email);

        // execute the query
        $stmt->execute();
        $row = $stmt->fetch();

        $userPassword = $row['Password'];

        // send email here ...
        $to_email = $this->email;
        $subject = 'password';
        $message = 'your password is ' . $userPassword;
        mail($to_email, $subject, $message);

    }

}