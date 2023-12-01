<?php
require_once("db/config.php");
require_once ("models/User.php");
class UserController extends Connect{
    function __construct() {
    parent::__construct();
    }

    function register(UserInfo $user){
        session_start();
        $_SESSION['username'] = $user->getUsername();
        $query = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
        $statement = $this->connect->prepare($query);
        $result = $statement->execute(
            array(
                'username' => $user->getUsername(),
                'password' => $user->getPassword(),
                'email' => $user->getEmail(),
            )
        );
        if ($result) {
            $message = '<label>Registration successful, please login</label>';
            $_SESSION['username'] = $_POST["username"]; 
            header("Location: ../../index.php");

        } else {
            $message = '<label>Registration failed</label>';
        }
    }

    function login(UserInfo $user){
        session_start();
        $_SESSION['username'] = $user->getUsername();
        $query = "SELECT * FROM users WHERE username = :username";
        $statement = $this->connect->prepare($query);
        $result = $statement->execute(
            array(
                'username' => $user->getUsername(),
            )
        );
        $count = $statement->rowCount();
        if ($count > 0) {
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            if (password_verify($_POST["password"], $user['password'])) {
                $_SESSION["username"] = $_POST["username"];
                header("location: loginSuccess.php");
            } else {
                $message = '<label>Wrong Password</label>';
            }
        } else {
            $message = '<label>User not found</label>';
        }
    }
    function isAdmin(){
        session_start();
         
        $query = "SELECT * FROM users WHERE username = :username";
        $statement = $this->connect->prepare($query);
        $result = $statement->execute(
            array(
                'username' =>$_SESSION['username'],
            )
        );
        $count = $statement->rowCount();
        if ($count > 0) {
            return true;
        }
        return false;

    }
  
}    