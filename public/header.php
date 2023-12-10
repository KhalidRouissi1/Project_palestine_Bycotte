
<?php
session_start();
if(isset($_SESSION["username"]))
    $user = $_SESSION["username"];
?>

<header>
    <div class="flagLogoContainer">

        <img src="./public/ps_flag.png" class="flagLogo" style="width: 30px;" alt="Project Test Logo">
        <span>PROJECT PALESTINE</span>
    </div>
    <nav>

    
        <ul>
           <?php
            if(isset($user)){
                include_once(__DIR__ . "/../controllers/UserController.php");
                $userCtrl = new UserController();
                $userInfo  = $userCtrl->getInfosByName($user);
            
                echo '<li><a href="view/portfolioDetails.php" style="color:black;text-transform:capitalize;">' . $userInfo['username'] . '</a></li>' .
                    '<li><a href="view/addProduct.php">Add Product</a></li>' .
                    '<li><a href="view/auth/logout.php">Logout</a></li>' .
                    '<li><a href="view/scanBarCode.php">Scan BarCode</a></li>';
           
            }
            else{
                echo '<li><a href="view/auth/login.php">Login</a></li>' .
                '<li><a href="view/auth/register.php">Register</a></li>' .
                '<li><a href="view/scanBarCode.php">Scan BarCode</a></li>';
            }
           ?>
        </ul>
    </nav>
</header>


