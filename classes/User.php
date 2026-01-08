<?php
include_once(__DIR__. "/Db.php");

class User {
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $confirmpassword;
    private $id;



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
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set the value of id
     */ 
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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

        $conn = Db::getConnection();
        

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
    public static function verifyPassword($userId, $password) {
        $user = self::getById($userId);
        if ($user && password_verify($password, $user['password'])) {
            return true;
        }
        return false;
    }
    public function updatePassword($newPassword) {
        $conn = Db::getConnection();
        $options = ['cost' => 15];
        $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT, $options);
    
        $stmt = $conn->prepare("UPDATE user SET password = :password WHERE customerId = :id");
        $stmt->bindValue(":password", $passwordHash);
        $stmt->bindValue(":id", $this->getId()); 
        
        return $stmt->execute();
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
        }
    public static function getById($id) {
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT * FROM user WHERE customerId = :id"); 
        $stmt->bindValue(":id", $id);
        $stmt->execute(); 
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function updateCoins($userId, $amount) {
        $conn = Db::getConnection();
        $stmt = $conn->prepare("UPDATE user SET coins = coins + :amount WHERE customerId = :id");
        $stmt->bindValue(":amount", $amount);
        $stmt->bindValue(":id", $userId);
        return $stmt->execute();
    }
}