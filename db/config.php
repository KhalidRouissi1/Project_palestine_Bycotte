<?php
abstract class Connect {
protected $connect;
function __construct()
{
$this->connect =new PDO("mysql:host=localhost; dbname=psproject", "root", "");  
$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

}
function __destruct()
{
$this->pdo=null;
}



}
?>