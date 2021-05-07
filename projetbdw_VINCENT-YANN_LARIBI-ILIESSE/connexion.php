<?php
session_start();
require_once 'fonctions/bd.php'; //inclusion du fichier bd.php
require_once 'fonctions/affichphoto.php'; //inclusion du fichier affichphoto.php
require_once 'fonctions/users.php'; //inclusion du fichier users.php

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);

$stateMsg = "";

if(isset($_POST["valider"]))
{
    $pseudo = $_POST["pseudo"]; //variable qui recupere le pseudo entrée
    $hashMdp = md5($_POST["mdp"]); //variable qui recupere le mdp entrée
     
    $exist = getUser($pseudo, $hashMdp, $link); //vérifie que le couple pseudo/mdp existe
    if($exist) 
    {
        setConnected($pseudo, $link);//si le pseudo/mdp existe on attribue la valeur connecté au pseudo dans la base de donnée
        $_SESSION["user"] = $pseudo;
    }else{
        $stateMsg = "Le couple pseudo/mot de passe ne correspond &agrave; aucun utilisateur enregistr&eacute;";
    }
}

if(isset($_GET["subscribe"])){
    $successMsg = "<div class='sucessMsg'>L'inscription a bien &eacute;t&eacute; effectu&eacute;e, vous pouvez vous connecter</div>";
}
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Connexion</title>
  <link rel="stylesheet" href="./lib/css/bootstrap.min.css">
  <link rel="stylesheet" href="./lib/STYLE.css">
</head>
<body>


<section class="BASE">
      <div class="BASE TEXTE">
        <h1 class="title">PROJET BDW1  - Mini Pinterest</h1>
        <h1 class="subtitle">VINCENT YANN / LARIBI ILIESSE</h1>
      </div>
      <?php
      echo '<form action="index.php" method="post">
            <a href="index.php"><input class="button btn-light" type="submit" name="Accueil" value="Accueil"></a>
            </form>';
            
      if(isset($_SESSION["user"]))
      {
        $nompseudo = $_SESSION['user'];
        echo "Bonjour $nompseudo";
      }
      ?>
</section>

</br>
</br>

<section>
<div class="card " style="width: 30rem">

  <div class="card-body center-div">
      <h5 class="card-title centrerinscription">Connexion</h5>
        <?php 
            if(isset($successMsg))
            {echo $successMsg;} 
            
            if (isset($_SESSION["user"]))
            {
                $nom = $_POST["pseudo"];
                echo "<p>Bonjour $nom</p>";
            }
            else
            {
                echo    '<form  action="connexion.php" method="POST">
                        <table>
                            <tr><td class="loginInfo">Pseudo:</td><td><input type="text" name="pseudo"></td></tr>
                            <tr><td class="loginInfo">Mot de passe:</td><td><input type="password" name="mdp"></td></tr>
                            <br>
                            <tr><td class="loginInfo"><input class="btn btn-primary" type="submit" name="valider" value="Se connecter"></td></tr>
                        </table>
                        </form>
                        <a class="loginInfo" href="inscrip.php">Premi&egrave;re connexion?</a>';
            }

        ?>
        <div class="errorMsg">
        <?php 
          echo $stateMsg; 
        ?>
      </div >
  </div>
</div>
</section>
</body>
</html>




