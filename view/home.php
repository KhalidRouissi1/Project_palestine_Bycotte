<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

  .centered-div {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 100%;
            width: 900px; /* Adjust the width as needed */
            height: 500px;
        }

        .search-bar {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .menu {
            list-style-type: none;
            display: flex;
            flex-direction: column;
            padding: 0;
            margin: 0;
            gap: 10px;
            max-height: 424px; /* Adjust the max height as needed */
            overflow-y: auto;
        }

        .menu-item {
            background-color: #025B70;
            border-radius: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
            cursor: pointer;
            color: #ECD9C8;
            display: flex;
            justify-content: space-between;
        }

        .menu-item span {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
        }

        .menu-item img {
            border-radius: 50%;
            max-width: 120px;
            border: #ECD9C8 solid 1px;
        }

        .menu-item:last-child {
            border-bottom: none;
        }

        body {
            overflow-x: hidden; /* Add this line to hide the horizontal scrollbar */
        }

        @media (max-width: 768px) {
            .centered-div {
                width: 90%;
            }
        }

        @media (max-width: 480px) {
            .centered-div {
                width: 100%;
            }
        }

    </style>
     <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".search-bar").on("input", function () {
                var searchTerm = $(this).val().toLowerCase();
                $(".menu-item").each(function () {
                    var title = $(this).find("h3").text().toLowerCase();
                    if (title.includes(searchTerm) || searchTerm === "") {
                        $(this).removeClass("hide").show();
                    } else {
                        $(this).addClass("hide").hide();
                    }
                });
            });
        });
    </script>
</head>
<body>

<div class="centered-div">
    <input type="text" class="search-bar" placeholder="Search...">
    <ul class="menu">
  
        <?php
            include_once(__DIR__."/../controllers/ProductController.php");
            include_once(__DIR__."/../models/Product.php");

            $prodcuts = new ProductController();

            foreach ($prodcuts->showProducts() as $prodcut) {
                echo '<li class="menu-item">';
                echo "<span>";
                echo "<h3>".$prodcut["title"]."</h3>";
                echo "<p>".$prodcut["reasonOfBycoot"]."</p>";
                echo  "</span>";
                echo "<img src='".$prodcut["productImg"]."'/>";
                echo"</li>";
            }
        ?>
    </ul>
</div>

</body>
</html>
