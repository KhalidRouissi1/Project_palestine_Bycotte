<?php
include_once("../models/Product.php");
include_once("../controllers/ProductController.php");
$products = new ProductController();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["approve"])) {
        $products->approve($_POST["approve"]);
        header("Location: notApproved.php");
    }
    elseif (isset($_POST["delete"])) {
        $products->deleteProduct($_POST["delete"]);
        header("Location: notApproved.php");
    }
}
?>

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
          width: 900px; 
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
          max-height: 424px; 
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

      .menu-item .actions {
            display: flex;
            gap: 10px;
        }

        .menu-item .actions h2 {
            cursor: pointer;
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

            $(".delete-btn").click(function () {
                var title = $(this).closest('.menu-item').data("title");
                $("#deleteForm input[name='title']").val(title);
                $("#deleteForm").submit();
            });
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<div class="centered-div">
    <input type="text" class="search-bar" placeholder="Search...">
    <ul class="menu">
        <?php
        foreach ($products->listeNotApproved() as $product) {
            echo '<li class="menu-item">';
            echo "<span>";
            echo "<h3>".$product["title"]."</h3>";
            echo "<p>".$product["reasonOfBycoot"]."</p>";
            echo "</span>";
            echo "<img src='../public/uploads/" . $product["productImg"] . "'/>";

            echo "<span class='actions'>";
            echo '<form method="post" id="approveForm">';
            echo '<input type="hidden">';
            echo '<button name="approve" value="'.$product["title"].'" style="background-color: #4CAF50; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer;"><i class="fas fa-check"></i></button>';
            echo '</form>';
            echo '<form method="post" id="deleteForm">';
            echo '<input type="hidden">';
            echo '<button name="delete" value="'.$product["title"].'" class="delete-btn" style="background-color: #f44336; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer;"><i class="fas fa-trash"></i></button>';
            echo '</form>';
            echo "</span>";
            echo "</li>";
        }
        ?>
    </ul>
    <button style="background-color: #3498db; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; text-decoration: none; cursor: pointer; transition: background-color 0.3s ease;">
    <a href="../index.php" style="text-decoration: none; color: inherit;">Back Home</a>
</button>
</div>

</body>
</html>
