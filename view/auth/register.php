<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\Khaled\Structured Tp\Project_Palestine');
include_once("../../models/User.php");
include_once("../../controllers/UserController.php");
$host = "localhost";
$username = "root";
$password = "";
$database = "psproject";
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

try {
    $username=  $_POST["username"];
    $email=  $_POST["email"];
    $password=  $_POST["password"];
    $bio = $_POST["bio"];
    $avatar_url = $_POST["avatar_url"];
    $user=new UserInfo($email,$username,$password,$bio,$avatar_url);
    $userCtrl=new UserController();
    
    if (isset($_POST["register"])) {
     
        if (empty($username) || empty($email) || empty($password)) {
            $message = '<label>All fields are required</label>';
        } else {
             $userCtrl->register($user);
        }

    } elseif (isset($_POST["login"])) {
        header("Location: login.php");
        exit();
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
    <br />  
    <div class="container" style="width:500px;">
        <?php
        if (isset($message)) {
            echo '<label class="text-danger">' . $message . '</label>';
        }
        ?>
        <h3 align="">Register</h3><br />
        <form method="post">
            <label>Username</label>
            <input type="text" name="username" class="form-control" />
            <br />
            <label>Password</label>
            <input type="password" name="password" class="form-control" />
            <br />
            <label>Email</label>
            <input type="email" name="email" class="form-control" />
            <br />
            <br />
            <label>Bio</label>
            <input type="text" name="bio" class="form-control" />
            <br />
            <label>Img Url</label>
            <input type="text" name="avatar_url" class="form-control" />
            
            <input type="submit" name="register" class="btn btn-info" value="Register" />
            <a href="login.php" class="btn btn-info" >Login</a>
            <a href="../index.php" class="btn btn-info" >Go Home</a>

        </form>
    </div>
    <br />
</body>

</html>
