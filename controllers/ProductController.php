<?php
require_once("db/config.php");
require_once("models/Product.php");
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
            header("Location: ../../index.php");
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

    function showProductById($id)
    {
        $query = "SELECT * FROM products WHERE id = :id";
        $statement = $this->connect->prepare($query);
        $statement->bindParam(':id', $id);
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
        $statement->bindParam(':id', $title);
        $result = $statement->execute();
        if ($result) {
            $message = '<label class="deleted">Deleted successful</label>';
            header("Location: ../../index.php");
        } else {
            $message = '<label class="notDeleted">Deletion failed</label>';
        }
    }
}
