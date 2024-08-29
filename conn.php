<?php
$dbname="basededonnée";
$host="localhost";
$user="root";
$password="";
try {
    $db=new PDO("mysql:host=$host; dbname=$dbname",$user,$password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("erreur de connexion:" .$e->getMessage());
    
}