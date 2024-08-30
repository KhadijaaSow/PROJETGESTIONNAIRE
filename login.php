<?php
session_start();
include_once "header.php";

if(isset($_SESSION['logged_in'])&& $_SESSION['logged_in']==true){
    header('location:accueil.php');
    exit();
    
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
if(isset($_POST['email'],$_POST['password'])&& !empty(trim('email'))&& !empty(trim('password'))){
    include_once "conn.php";
    $email=filter_var(trim($_POST['email']),FILTER_VALIDATE_EMAIL);
    $password=filter_var(trim($_POST['password']));
    if($email===false){
        $_SESSION['error']="address email invalide";
        header('location:accueil.php');
        exit();
    }
    try {
        // var_dump($_POST);
        $sql=$db->prepare('select id, nom, prenom, email, password from user where email=?');
        $sql->execute([$email]); 
        $user=$sql->fetch(PDO::FETCH_ASSOC);
        if($user){
            if(password_verify($password, $user['password'])){
                var_dump($user['nom']);
                $_SESSION['user_name']=$user['nom'];
                $_SESSION['user_id']=$user['id'];
                $_SESSION['prenom']=$prenom['prenom'];
                $_SESSION['logged_in']=true;
                header('location:accueil.php');
            
        }else{
            $_SESSION['error']='mot de passe incorect';
        }
        

            }else{
                $_SESSION['error']='email incorect';
            }
    
            
        
            
}catch (PDOException $e) {
    die("erreur".$e->getMessage());
 }
}
}
?>
<div class="row">
    <div class="card" style="width:50%; margin: 7%; ">
    <?php
    if(isset($_SESSION['error'])){
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
    //   unset($_SESSION['error']);//permet de supprimer le message deja afficher//
}
    
    ?>
        <h4 class="card-tittle text-center text-success" >Connexion</h4>
        <div class="card-body">
        <form method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>
  
  <button type="submit" class="btn btn-primary">Connexion</button>
</form>
        </div>
    </div>
</div>