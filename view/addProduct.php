
<?php


include_once(__DIR__."/../controllers/ProductController.php");
include_once(__DIR__."/../models/Product.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $products = new ProductController();
    try {
        $title = $_POST["titleE"];
        $description = $_POST["descriptionE"];
        $reasonOfBycoot = $_POST["reasonOfBycootE"];
        //Put the image in a file 
        $uploadDir = __DIR__ . "/../public/uploads/";
        //get the name of the image
        $uploadedFileName = basename($_FILES["productimg"]["name"]);
        $uploadedFilePath = $uploadDir . $uploadedFileName;

        if (move_uploaded_file($_FILES["productimg"]["tmp_name"], $uploadedFilePath)) {
            $prod = new Product($title, $description, $reasonOfBycoot, $uploadedFileName);
        if (empty($title)) {
            echo "nothing";
            $message = '<label>Title field is required</label>';
        } else {
            $products->addProduct($prod);
            header("Location: ../index.php");

        }
    }
    } catch (PDOException $error) {
        // Handle the exception, if needed
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
    </style>
</head>
<body>
 
    <form  method="post" enctype="multipart/form-data">
        <h2>The Product will wait for approve </h2>

        <!-- Title -->
        <label for="title">Title:</label>
        <input type="text" id="title" name="titleE" required>
        <!-- Description -->
        <label for="description">Description:</label>
        <textarea id="description" name="descriptionE" rows="4" required></textarea>
        <!-- Reason -->
        <label for="reasonOfBycoot">Reason of Bycoote:</label>
        <input type="text" id="reasonOfBycoot" name="reasonOfBycootE"  value="">
        <!-- Product Image -->
        <label for="productimg">Product Image:</label>
        <input type="file" id="productimg" name="productimg" accept="image/*" required>

        <!-- Submit Button -->
        <input type="submit" value="Submit">
        <button style="background-color: #3498db; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; text-decoration: none; cursor: pointer; transition: background-color 0.3s ease;">
    <a href="../index.php" style="text-decoration: none; color: inherit;">Back Home</a>
</button>
    </form>
</body>
</html>
