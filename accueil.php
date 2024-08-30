<?php
session_start();
include_once "header.php";
if(!isset($_SESSION['logged_in'])|| $_SESSION['logged_in']!==true){
    header('location:login.php');
    exit();

}

$pers_connecter= $_SESSION['prenom'].'  '.$_SESSION['user_name'];
var_dump($pers_connecter);
?>
<div class="row">
    <div class="col-6">
        <h4>BIENVENUE <?php
       
        echo htmlspecialchars($pers_connecter);
        ?>
         <a href="deconnexion.php" class="btn btn-danger">Deconnexion</a>
        </h4>
    </div>
</div>