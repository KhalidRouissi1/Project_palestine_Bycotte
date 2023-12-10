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
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $bio = $_POST["bio"];

        // Put the image in a file 
        $uploadDir = __DIR__ . "/../../public/uploads/";

        // Check if the form has been submitted with a file
        if (isset($_FILES["avatar_url"])) {
            $uploadedFileName = basename($_FILES["avatar_url"]["name"]);
            $uploadedFilePath = $uploadDir . $uploadedFileName;

            if (move_uploaded_file($_FILES["avatar_url"]["tmp_name"], $uploadedFilePath)) {
                $userCtrl = new UserController();

                if (isset($_POST["register"])) {
                    if (empty($username) || empty($email) || empty($password)) {
                        $message = '<label>All fields are required</label>';
                    } else {
                        // Assuming UserInfo is a class with constructor
                        $userInfo = new UserInfo( $email, $username,$password, $bio,$uploadedFileName);
                        $userCtrl->register($userInfo);
                    }
                } elseif (isset($_POST["login"])) {
                    header("Location: login.php");
                    exit();
                }
            } else {
                $message = '<label>Failed to upload the file</label>';
            }
        } else {
            $message = '<label>File not provided</label>';
        }
    } catch (Exception $error) {
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
        <form method="post" enctype="multipart/form-data">
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
            <input type="file" id="avatar_url" name="avatar_url" accept="image/*" class="control">

            <input type="submit" name="register" class="btn btn-info" value="Register" />
            <a href="login.php" class="btn btn-info">Login</a>
            <a href="../index.php" class="btn btn-info">Go Home</a>
        </form>
    </div>
    <br />
</body>

</html>
