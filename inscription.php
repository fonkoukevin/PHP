<?php
require_once 'lib/config.php';
require_once 'lib/tools.php';
require_once 'lib/pdo.php';
require_once 'lib/user.php';

require_once 'templates/header.php';

$errors = [];
$messages = [];
if (isset($_POST['addUser'])) {
    /*
        @todo On appelle addUser pour ajouter l'utilisateur
        si true a été retourné, on affiche un message "Merci pour votre inscription"
        sinon on affiche une erreur "Une erreur s'est produite lors de votre inscription"
    */
    $first_name= $_POST["first_name"];
    $last_name= $_POST["last_name"];
    $email=$_POST["email"];
    $password=$_POST["password"];
//   $role =$_POST["role"];

   $adduser= addUser($pdo,$first_name,$last_name,$email,$password);
   if($adduser){
    $messages[] = "Merci pour votre inscription";
    // header('Location: index.php'); 

}
else{
    $errors[] ="Une erreur s'est produite lors de votre inscription";
}
}
?>

        
        
            <?php 
            if(!empty($messages)){
            foreach($messages as $message){?>
            <div class="alert alert-success" role="alert">
                    <?= $message; ?>
            </div>
          <?php   
            }} 
            if(isset($messages)){
            foreach($errors as $error){?>
                <div class="alert alert-danger" role="alert">
                    <?= $error; ?>
                </div>

         <?php   }}?>
       


    <h1>Inscription</h1>


    <?php // @todo afficher les erreurs ?>

    <form method="POST">
        <div class="mb-3">
            <label for="first_name" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="first_name" name="first_name">
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="last_name" name="last_name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de psse</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <input type="submit" name="addUser" class="btn btn-primary" value="Enregistrer">

    </form>

    <?php
require_once 'templates/footer.php';
?>