<?php
include_once(__DIR__. "/Db.php");

class User {
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $confirmpassword;


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
     * Get the value of confirmpassword
     */ 
    public function getConfirmpassword()
    {
        return $this->confirmpassword;
    }

    /**
     * Set the value of confirmpassword
     *
     * @return  self
     */ 
    public function setConfirmpassword($confirmpassword)
    {
        $this->confirmpassword = $confirmpassword;

        return $this;
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

    public function validate() {
        if (empty($this->firstname) || empty($this->lastname) || empty($this->email) || empty($this->password) || empty($this->confirmpassword)) {
            throw new Exception("Vul alle velden in.");
        }

        if ($this->password !== $this->confirmpassword) {
            throw new Exception("De wachtwoorden komen niet overeen.");
        }

        return true;
    }


    public function save() {
        $this->validate();
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
    }}