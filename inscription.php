<?php
session_start();
include_once "header.php";

    

if(isset($_POST['nom'])&& isset($_POST['prenom'])&& isset($_POST['email'])&& isset($_POST['password'])&& isset($_POST['telephone'])
&& !empty(trim($_POST['nom']))
&& !empty(trim($_POST['prenom']))
&& !empty(trim($_POST['email']))
&& !empty(trim($_POST['password']))
&& !empty(trim($_POST['telephone']))
){
   
$nom=htmlspecialchars(trim($_POST['nom']));
$prenom=htmlspecialchars(trim($_POST['prenom']));
$email=htmlspecialchars(trim($_POST['email']),FILTER_VALIDATE_EMAIL);
$password=htmlspecialchars(trim($_POST['password']));
$telephone=htmlspecialchars(trim($_POST['telephone']));

if($email===false){
    $_SESSION['error']="email invalide";
    header('location:inscription.php');
}
include_once "conn.php";
$password_hasher=password_hash($password,PASSWORD_BCRYPT);

try {
    // var_dump($_POST);
    $sql=$db->prepare("INSERT INTO user(nom, prenom, email, password, telephone) VALUES( ?, ?, ?, ?, ?)");
    $sql->execute([$nom, $prenom, $email, $password_hasher, $telephone]);

$_SESSION['user_name']=$nom;
$_SESSION['user_id']=$db->lastInsertId();
$_SESSION['prenom']=$prenom;
$_SESSION['logged_in']=true;









    $_SESSION['message']="employer creer avec succes";
    header('location:accueil.php');
} catch (PDOException $e) {
   die("erreur".$e->getMessage());
}
} else{
    $_SESSION['error']="veiller remplir tous les champs";
    
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    
    <div class="row">
        <div class="col-md-6">
        <?php
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
 if(!empty($_SESSION['error'] )){
    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
      unset($_SESSION['error']);//permet de supprimer le message deja afficher//
}
}
        ?>
        <form method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nom</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nom">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Prenom</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="prenom">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Email</label>
    <input type="email" class="form-control" id="exampleInputPassword1" name="email">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Telephone</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="telephone">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
        </div>
        <div class="col-md-6"></div>
    </div>
</body>
</html>