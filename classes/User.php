<?php
include_once(__DIR__. "/Db.php");

class User {
    private $firstname;
    private $lastname;
    private $email;
    private $password;


    /**
     * / Set the value of firstname
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }
    /**
     * / Set the value of lastname
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }
    /**
     * / Set the value of email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * / Set the value of password
     */

    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * / Get the value of firstname
     */
    public function getFirstname() {
        return $this->firstname;
    }
    /**
     * / Get the value of lastname
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * / Get the value of email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * / Get the value of password
     */
    public function getPassword() {
        return $this->password;
    }

    public function save() {
        //conn
        $conn = Db::getConnection();
        //insert query

        $statement = $conn->prepare("
            INSERT INTO users (firstName, lastName, email, password) 
            VALUES (:firstname, :lastname, :email, :password)
        ");

        $firstname = $this->getFirstname();
        $lastname = $this->getLastname();
        $email = $this->getEmail();
        $password = $this->getPassword();


        $statement->bindValue(":firstname", $firstname);
        $statement->bindValue(":lastname", $lastname);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":password", $password);

        $result= $statement->execute();
        return $result;
    }
    
   
}