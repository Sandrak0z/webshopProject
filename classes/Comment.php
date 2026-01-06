<?php

include_once(__DIR__ . "/Db.php");

class Comment {
    private $text;
    private $userId;
    private $productId;


    /**
     * Get the value of productId
     */ 
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set the value of productId
     *
     * @return  self
     */ 
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    public function save() {
        $conn = Db::getConnection();
        $statement = $conn->prepare("INSERT INTO comments (text, productId, userId) VALUES (:text, :productId, :userId)");
        
        $text = $this->getText();
        $userId = $this->getUserId();
        $productId = $this->getProductId();


        $statement->bindValue(":text", $this->getText());
        $statement->bindValue(":productId", $this->getProductId());
        $statement->bindValue(":userId", $this->getUserId());

        $result= $statement->execute();
        return $result;
    }
}