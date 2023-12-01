<?php


class UserInfo{
    private $email,$username,$password,$bio,$avatarUrl,$isAdmin;

    public function __construct( $email="",$username="",$password="",$bio="",$avatarUrl="",$isAdmin=null) {
        $this->email = $email;
        $this->username = $username;
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $hashed_password;
        $this->bio = $bio;
        $this->avatarUrl = $avatarUrl;
        $this->isAdmin = $isAdmin;
    }


    public function getEmail(){
        return $this->email;
    }
    
    public function getUsername(){
        return $this->username;
    }
    
    public function getPassword(){
        return $this->password;
    }
    
    public function getBio(){
        return $this->bio;
    }
    
    public function getAvatrUrl(){
        return $this->avatarUrl;
    }
    
 
    public function setEmail($email){
       $this->email= $email;
    }
    
    public function setUserName($username){
        $this->username = $username;
    }
    
    public function setPassword($password){
        $this->password = $password;
    }
    
    public function setBio($bio){
       $this->bio = $bio;
    }
    
    public function setAvatarUrl($avatarUrl){
        $this->avatarUrl = $avatarUrl;
    }
}