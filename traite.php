
<?php
 session_start();

   try{

    $bdd= new PDO("mysql:host=localhost;dbname=exo_incriptionconnexion","root",'');
    $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
   }
   catch(PDOException $e){
    echo'ERREUR DE CONNEXION'.$e->getMessage();
   }

   if(isset($_POST['inscrit'])){
    $nom=$_POST['nom'];
    $email=$_POST['email'];
    $pass=$_POST['pass'];


    $req=$bdd->prepare("INSERT INTO utilisateur VALUES (0,?,?,?)");
    $req->execute(array($nom,$email,$pass));

    $recupUsers=$bdd->prepare("SELECT * FROM utilisateur WHERE nom=? AND email=? AND pass=?");
    $recupUsers->execute(array($nom,$email,$pass));

    if($recupUsers->rowCount()>0){
        $_SESSION['nom']=$nom;
        $_SESSION['email']=$email;
        $_SESSION['pass']=$pass;
        $_SESSION['id']=$recupUsers->fetch()['id'];  
    }

    echo $_SESSION['id'];

    
   }


   



   







?>