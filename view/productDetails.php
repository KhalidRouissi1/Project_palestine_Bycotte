<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #4285f4;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        h1 {
            color: #4285f4;
        }

        p {
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <header>
        <h1>Product Details</h1>
    </header>

    <main>
        <?php
        if (isset($_GET['title'])) {
            $title = $_GET['title'];
            include_once(__DIR__."/../controllers/ProductController.php");
            include_once(__DIR__."/../models/Product.php");
            $products = new ProductController();
            $productInfo = $products->showProductById($title);

            // Check if productInfo is not empty
            if (!empty($productInfo)) {
                echo "<img src='../public/uploads/" . $productInfo["productImg"] . "'/>";

                ?>
                <h1><?php echo $productInfo["title"] ?></h1>
                <p><?php echo $productInfo["description"] ?></p>
                <?php
            } else {
                echo "<p>Product not found.</p>";
            }
        } else {
            echo "<p>One or more parameters not set.</p>";
        }
        ?>
    </main>
</body>
</html>
