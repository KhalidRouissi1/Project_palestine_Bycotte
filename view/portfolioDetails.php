<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
        }

        .image-container {
            flex: 1;
            overflow: hidden;
        }

        .image-container img {
            width: 100%;
            height: auto;
            display: block;
        }

        .bio-container {
            flex: 1;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
            line-height: 1.6;
        }
        .bigContainer{
            display: flex;
            flex-direction: column;
            width: 30%;
            margin: auto;
        }
    </style>
</head>
<body>
<?php
        session_start();
        if(isset($_SESSION["username"]))
            $user = $_SESSION["username"];
        set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\Khaled\Structured Tp\Project_Palestine');
        include_once("../controllers/UserController.php");
        $userCtrl = new UserController();
        $userInfo  = $userCtrl->getInfosByName($user);
       ;
?>
<div class="bigContainer">
<div class="container">
    <div class="image-container">
        <img src="../public/uploads/<?php echo $userInfo['avatar_url']?>" alt="Portfolio Image">
    </div>
    <div class="bio-container">
        <h1>Name:<?php  echo $userInfo["username"]?></h1>
        <p>
            This is my BIO:
        <?php  echo $userInfo["bio"]?>
        </p>
        <?php
        if($userInfo['isAdmin']!=null)
        {
            echo '<a href="adminPage.php">Admin Actions</a>';
        }?>
    </div>
    
</div>
<button style="background-color: #3498db; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; text-decoration: none; cursor: pointer; transition: background-color 0.3s ease;">
    <a href="../index.php" style="text-decoration: none; color: inherit;">Back Home</a>
</button>
</div>



</body>
</html>
