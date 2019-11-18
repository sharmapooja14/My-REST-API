
<?php
class QueriesCurd{
 
    // database connection and table name
    private $conn;
    private $table_name = "login";
 
    // object properties
    public $id;
    public $username;
    public $password;
   
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
   
    // login user
    function login(){
        // select all query
        $query = "SELECT
                    `id`, `username`, `password`
                FROM
                    " . $this->table_name . " 
                WHERE
                    username='".$this->username."' AND password='".$this->password."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                username='".$this->username."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}