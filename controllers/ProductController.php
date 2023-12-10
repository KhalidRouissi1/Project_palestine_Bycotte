<?php

require_once(__DIR__."/../db/config.php");
require_once(__DIR__."/../models/Product.php");
require_once("UserController.php");

class ProductController extends Connect
{
    function __construct()
    {
        parent::__construct();
    } 

    function addProduct(Product $product)
    {   
        $query = "INSERT INTO products (title, description, reasonOfBycoot, productImg) VALUES (:title, :description, :reasonOfBycoot, :productImg)";
        $statement = $this->connect->prepare($query);
        $result = $statement->execute(
            array(
                'title' => $product->getTitle(),
                'description' => $product->getDescription(),
                'reasonOfBycoot' => $product->getReasonOfBycoot(),
                'productImg' => $product->getProductImg(),
            )
        );
        if ($result) {
            $message = '<label class="added">Added successful</label>';
        } else {
            $message = '<label class="notAdded">Added failed</label>';
        }
    }

    function showProducts()
    {
        $query = "SELECT * FROM products where isApproved !=0";
        $statement = $this->connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function showProductById($title)
    {
        $query = "SELECT * FROM products WHERE title = :title";
        $statement = $this->connect->prepare($query);
        $statement->bindParam(':title', $title);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function editProduct(Product $product)
    {
        $user = new UserController();
        if($user->isAdmin())
        {
            $query = "UPDATE products SET title = :title, description = :description, reasonOfBycoot = :reasonOfBycoot, productImg = :productImg WHERE title = :title";
            $statement = $this->connect->prepare($query);
            $result = $statement->execute(
                array(
                    'title' => $product->getTitle(),
                    'description' => $product->getDescription(),
                    'reasonOfBycoot' => $product->getReasonOfBycoot(),
                    'productImg' => $product->getProductImg(),
                )
            );
            if ($result) {
                $message = '<label class="edited">Edited successful</label>';
                header("Location: ../../index.php");
            } else {
                $message = '<label class="notEdited">Editing failed</label>';
            }
        }
       
    }

    function deleteProduct($title)
    {
        $query = "DELETE FROM products WHERE title = :title";
        $statement = $this->connect->prepare($query);
        $result = $statement->execute(['title' => $title]); 
        if ($result) {
            $message = '<label class="deleted">Deleted successful</label>';
            header("Location: ../../index.php");
        } else {
            $message = '<label class="notDeleted">Deletion failed</label>';
        }
    }


    function listeNotApproved(){
        $query = "SELECT * FROM products where isApproved =0";
        $statement = $this->connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function approve($title){
        $query = "UPDATE products SET isApproved = 1 WHERE title = :title";
        $statement = $this->connect->prepare($query);
        $result = $statement->execute(['title' => $title]); // Bind the parameter
        
        if ($result) {
            $message = '<label class="added">Approve with success</label>';
            header("Location: notApproved.php");
            
        } else {
            $message = '<label class="notAdded">Approve failed</label>';
        }
    }
    
}
