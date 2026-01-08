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
        if (strlen($password) < 7) {
            throw new Exception("Wachtwoord moet minstens 7 tekens hebben.");
        }
        $this->password = $password;
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
     * Get the value of confirmpassword
     */ 
    public function getConfirmpassword()
    {
        return $this->confirmpassword;
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
        $options = [
            'cost' => 15,
        ];
        //conn
        $conn = Db::getConnection();
        //insert query

        $statement = $conn->prepare("
            INSERT INTO user (firstName, lastName, email, password, role, coins) 
            VALUES (:firstname, :lastname, :email, :password,'user', 1000.00)
        ");

        $firstname = $this->getFirstname();
        $lastname = $this->getLastname();
        $email = $this->getEmail();
        $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT, $options);


        $statement->bindValue(":firstname", $firstname);
        $statement->bindValue(":lastname", $lastname);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":password", $hashedPassword);

        $result= $statement->execute();
        return $result;
    }
    public static function login($email, $password) {
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        
        if (password_verify($password, $user['password'])) {
            return $user;
        } 
        }}
