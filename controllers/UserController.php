<?php

require_once(__DIR__."/../db/config.php");
require_once(__DIR__."/../models/user.php");
class UserController extends Connect{
    function __construct() {
    parent::__construct();
    }

    function register(UserInfo $user){
        session_start();
        $_SESSION['username'] = $user->getUsername();
        $query = "INSERT INTO users (username, password, email,bio,avatar_url) VALUES (:username, :password, :email,:bio,:avatar_url)";
        $statement = $this->connect->prepare($query);
        $result = $statement->execute(
            array(
                'username' => $user->getUsername(),
                'password' => $user->getPassword(),
                'email' => $user->getEmail(),
                'avatar_url' => $user->getAvatrUrl(),
                'bio' => $user->getBio(),
            )
        );
        if ($result) {
            $message = '<label>Registration successful, please login</label>';
            if($_POST['username']!="")
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
                header("location: ../../index.php");
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

    function getInfosByName($username){
        $query = "SELECT * FROM users WHERE username = :username";
        $statement = $this->connect->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}    