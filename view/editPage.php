<?php
include_once(__DIR__."/../controllers/ProductController.php");
include_once(__DIR__."/../models/Product.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $products = new ProductController();
    try {
        $title = isset($_POST["titleE"]) ? $_POST["titleE"] : "";
        $description = isset($_POST["descriptionE"]) ? $_POST["descriptionE"] : "";
        $reasonOfBycoot = isset($_POST["reasonOfBycootE"]) ? $_POST["reasonOfBycootE"] : "";
        
        // Retrieve file information
        $productimg = isset($_FILES["productimg"]["name"]) ? $_FILES["productimg"]["name"] : "";
        $uploadDir = __DIR__ . "/../public/uploads/";
        $uploadedFilePath = $uploadDir . $productimg;

        // Check if a file is provided
        if (!empty($productimg)) {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["productimg"]["tmp_name"], $uploadedFilePath)) {
                // File uploaded successfully
            } else {
                // Failed to move file
                throw new Exception("Failed to move the uploaded file.");
            }
        }

        $productEdited = new Product($title, $description, $reasonOfBycoot, $productimg);

        if (empty($title)) {
            $message = '<label>Title field is required</label>';
        } else {
            $products->editProduct($productEdited);
            header("Location: ../index.php");
            exit(); 
        }
    } catch (PDOException $error) {
        // Handle PDO exceptions
    } catch (Exception $error) {
        // Handle other exceptions
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Feedback Form</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        select {
            appearance: none;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2185c5;
        }
        .container{
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <div class="container">
    <form method="POST" enctype="multipart/form-data">
        <?php
        $title = isset($_POST['title']) ? $_POST['title'] : "";
        $productInfo = $products->showProductById($title);
        ?>
        <h2>Product Feedback Form</h2>
        <label for="title">Title:</label>
        <input type="text" id="titleE" name="titleE" value="<?php echo $productInfo["title"]?>" required>
        <!-- Description -->
        <label for="description">Description:</label>
        <textarea id="description" name="descriptionE" rows="4" required><?php echo $productInfo["description"]?></textarea>

        <!-- Bycot Reson -->
        <label for="reasonOfBycoot">Reason of Bycoote:</label>
        <input type="text" id="reasonOfBycoot" name="reasonOfBycootE" value="<?php echo $productInfo['reasonOfBycoot'] ?>" >
        <!-- Product Image -->
        <label for="productimg">Product Image:</label>
        <input type="file" id="productimg" name="productimg" accept="image/*" required>

        <!-- Submit Button -->
        <input type="submit">

    </form>

    <button style="background-color: #3498db; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; text-decoration: none; cursor: pointer; transition: background-color 0.3s ease;">
        <a href="../index.php" style="text-decoration: none; color: inherit;">Back Home</a>
    </button>
    </div>

</body>
</html>
