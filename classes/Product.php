<?php
include_once(__DIR__ . "/Db.php");

class Product {

    private $productName;
    private $brand;
    private $price;
    private $categoryId;
    private $stock;
    private $image;
    private $colorOptions;
    private $depthOptions;
    private $description;
    private $id;


    /**
     * Get the value of productName
     */ 
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set the value of productName
     *
     * @return  self
     */ 
    public function setProductName($productName)
    {
        if (empty($productName)) { throw new Exception("Productnaam mag niet leeg zijn."); }
        $this->productName = $productName;
        return $this;
    }

    /**
     * Get the value of brand
     */ 
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set the value of brand
     *
     * @return  self
     */ 
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        if ($price < 0) { throw new Exception("Prijs mag niet negatief zijn."); }
        $this->price = $price;
        return $this;
    }

    /**
     * Get the value of categoryId
     */ 
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set the value of categoryId
     *
     * @return  self
     */ 
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get the value of stock
     */ 
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */ 
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of colorOptions
     */ 
    public function getColorOptions()
    {
        return $this->colorOptions;
    }

    /**
     * Set the value of colorOptions
     *
     * @return  self
     */ 
    public function setColorOptions($colorOptions)
    {
        $this->colorOptions = $colorOptions;

        return $this;
    }

    /**
     * Get the value of depthOptions
     */ 
    public function getDepthOptions()
    {
        return $this->depthOptions;
    }

    /**
     * Set the value of depthOptions
     *
     * @return  self
     */ 
    public function setDepthOptions($depthOptions)
    {
        $this->depthOptions = $depthOptions;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        if (empty($description)) { throw new Exception("Beschrijving mag niet leeg zijn."); }
        $this->description = $description;
        return $this;
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
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function save() {
        $conn = Db::getConnection();
        $stmt = $conn->prepare("INSERT INTO Products (ProductName, Brand, Price, CategoryId, Stock, Image, ColorOptions, DepthOptions, Description) 
        VALUES (:name, :brand, :price, :catId, :stock, :image, :colors, :depths, :description)");
    
        $stmt->bindValue(":name", $this->getProductName());
        $stmt->bindValue(":brand", $this->getBrand());
        $stmt->bindValue(":price", $this->getPrice());
        $stmt->bindValue(":catId", $this->getCategoryId());
        $stmt->bindValue(":stock", $this->getStock());
        $stmt->bindValue(":image", $this->getImage());
        $stmt->bindValue(":colors", $this->getColorOptions());
        $stmt->bindValue(":depths", $this->getDepthOptions());
        $stmt->bindValue(":description", $this->getDescription()); 
    
        return $stmt->execute();
    }
    public function update() {
        $conn = Db::getConnection();
        $stmt = $conn->prepare("UPDATE Products SET 
        ProductName = :name, 
        Brand = :brand, 
        Price = :price, 
        CategoryId = :catId, 
        Stock = :stock, 
        Image = :image,
        ColorOptions = :colors,
        DepthOptions = :depths,
        Description = :description 
        WHERE ProductId = :id");

    $stmt->bindValue(":name", $this->getProductName());
    $stmt->bindValue(":brand", $this->getBrand());
    $stmt->bindValue(":price", $this->getPrice());
    $stmt->bindValue(":catId", $this->getCategoryId());
    $stmt->bindValue(":stock", $this->getStock());
    $stmt->bindValue(":image", $this->getImage());
    $stmt->bindValue(":colors", $this->getColorOptions());
    $stmt->bindValue(":depths", $this->getDepthOptions());
    $stmt->bindValue(":description", $this->getDescription());
    $stmt->bindValue(":id", $this->getId(), PDO::PARAM_INT);

    return $stmt->execute();
}

public static function deleteById(int $id) {
    $conn = Db::getConnection();
    $stmt = $conn->prepare("DELETE FROM Products WHERE ProductId = :id");
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    return $stmt->execute();
}


    
    public static function getAll(int $categoryId = 0): array {
        $conn = Db::getConnection();
        $sql = "SELECT * FROM Products";
        $array = [];

        if ($categoryId > 0) {
            $sql .= " WHERE CategoryId = :cat";
            $array[':cat'] = $categoryId;
        }

        $sql .= " ORDER BY ProductName";

        $stmt = $conn->prepare($sql);
        $stmt->execute($array);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getById(int $id): ?array
    {
        $conn = Db::getConnection();

        $stmt = $conn->prepare("
            SELECT * 
            FROM Products 
            WHERE ProductId = :id
            LIMIT 1
        ");

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($product) {
            $product['depths'] = !empty($product['DepthOptions']) ? explode(',', $product['DepthOptions']) : [];
            $product['colors'] = !empty($product['ColorOptions']) ? explode(',', $product['ColorOptions']) : [];
        }
        return $product;
        
    }

    public static function getDepthOptionsStatic(int $productId): array
    {
        $conn = Db::getConnection();

        $stmt = $conn->prepare("
            SELECT Depth 
            FROM product_depths 
            WHERE ProductId = :id
            ORDER BY Depth
        ");

        $stmt->bindValue(':id', $productId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function getColors(int $productId): array
    {
        $conn = Db::getConnection();

        $stmt = $conn->prepare("
            SELECT ColorName, ColorClass 
            FROM product_colors 
            WHERE ProductId = :id
        ");

        $stmt->bindValue(':id', $productId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getCartDetails(array $ids): array {
        if (empty($ids)) {
            return array();
        } else {
            $conn = Db::getConnection();
    
            $vraagtekens = "";
            $teller = 0;
    
            foreach ($ids as $id) {
                if ($teller == 0) {
                    $vraagtekens = $vraagtekens . "?";
                } else {
                    $vraagtekens = $vraagtekens . ",?";
                }
                $teller = $teller + 1;
            }
    
            $sql = "SELECT * FROM Products WHERE ProductId IN (" . $vraagtekens . ")";
            $stmt = $conn->prepare($sql);
    
            $stmt->execute(array_values($ids)); 
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}