<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\Khaled\Structured Tp\Project_Palestine');

include_once("../../models/User.php");
include_once("../../controllers/UserController.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $user = new UserInfo("", $username, $password, "", "");
        $userCtrl = new UserController();

        if (isset($_POST["login"])) {
            if (empty($_POST["username"]) || empty($_POST["password"])) {
                $message = '<label>All fields are required</label>';
            } else {
                // Attempt to log in
                $loginResult = $userCtrl->login($user);

                // Check the result of the login operation
                if ($loginResult === true) {
                    // Redirect to a success page or perform other actions upon successful login
                    header("Location: success.php");
                    exit();
                } else {
                    // Display an error message for incorrect email or password
                    $message = '<label>Password or email is incorrect</label>';
                }
            }
        }
    } catch (PDOException $error) {
        $message = $error->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
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
        <h3 align="">Login</h3><br />
        <form method="post">
            <label>Username</label>
            <input type="text" name="username" class="form-control" />
            <br />
            <label>Password</label>
            <input type="password" name="password" class="form-control" />
            <br />
            <input type="submit" name="login" class="btn btn-info" value="Login" />
            <a href="../auth/register.php" class="btn btn-info">Register a new account</a>
            <a href="../../index.php" class="btn btn-info">Go Home</a>
        </form>
    </div>
    <br />
</body>

</html>
