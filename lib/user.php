<?php

function addUser(PDO $pdo, string $first_name, string $last_name, string $email, string $password, $role = "user")
{
    /*
        @todo faire la requête d'insertion d'utilisateur et retourner $query->execute();
        Attention faire une requête préparer et à binder les paramètres
    */


    $query = $pdo->prepare("INSERT INTO users(first_name,last_name,email,password,role)VALUES (:firstname, :lastname, :email, :password, :role)");
    $query->bindValue(':firstname', $first_name, PDO::PARAM_STR);
    $query->bindValue(':lastname', $last_name, PDO::PARAM_STR);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->bindValue(':password', $password, PDO::PARAM_STR);
    $query->bindValue(':role', $role, PDO::PARAM_STR);

    return $query->execute();   //execute return la requete sql ou un flase
}

function verifyUserLoginPassword(PDO $pdo, string $email, string $password)
{
    /*
        @todo faire une requête qui récupère l'utilisateur par email et stocker le résultat dans user
        Attention faire une requête préparer et à binder les paramètres
    */

    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");  //:email c'est toujour comme si on prenais notre $email 
    // $query->bindValue(':email', $email, PDO::PARAM_STR);     //pour securite
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();
    //fetch() nous permet de récupérer une seule ligne
    $result = $query->fetch(PDO::FETCH_ASSOC);
    //$result est un tableau association qu’on peut manipuler comme on l’a vu précédemment   



    if ($result && password_verify($password, $result['password'])) {
        return $result;
    } else {
        return false;
    }

    /*
        @todo Si on a un utilisateur et que le mot de passe correspond (voir fonction  native password_verify)
              alors on retourne $user
              sinon on retourne false
    */
}
