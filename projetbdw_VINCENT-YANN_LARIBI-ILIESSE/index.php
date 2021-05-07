<?php

session_start();
require_once 'fonctions/bd.php';
require_once 'fonctions/affichphoto.php';
require_once 'fonctions/users.php';

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);




?>

<!doctype html>


<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Bienvenue sur l'afficheur de photo</title> <!-- Page Principale du site -->
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./lib/css/bootstrap.min.css">
  <link rel="stylesheet" href="./lib/STYLE.css">
</head>

<body>
<section class="BASE">
      <div class="BASE TEXTE">
        <h1 class="title">PROJET BDW1 - Mini Pinterest</h1>
        <h1 class="subtitle">VINCENT YANN / LARIBI ILIESSE</h1>
      </div>
      <?php
      if(isset($_SESSION["user"]))
      {
        $nompseudo = $_SESSION['user'];
        echo "Bonjour $nompseudo";
      }
      ?>
</section>

</br>
</br>

<?php


$deco =false;
if(isset($_POST["deco"]))
  {
  if (isset($_SESSION["user"]))
  {
    $pseudo = $_SESSION["user"];
    setDisconnected($pseudo, $link);
    unset($_SESSION["user"]);
    $deco = true;
  }
}

  if(isset($_SESSION["user"]))
    echo '<form action="index.php" method="post"><tr><td><input class="button btn-dark" type="submit" name="deco" value="Se deconnecter"></form>';
  else
    echo "<div class='card'>
            <div class='card-body'>
                <form action='connexion.php' method='post'><a class='loginInfo' href='connexion.php'><input class='button btn-primary'  type='submit' name='connexion' value='Se Connecter'></a></form>
             </div>
           </div>";
  
  if($deco){
      echo ("Vous etes déconnecté"); 
      $deco = false;
  }
  


  ?>



<section>
<form action="?" method="post"> <!-- formulaire méthode POST pour gérer l'affichage d'image selon la catégorie sélectionné -->
  <select name="comp">
  <option value="tout">Tout</option>
  <option value="ESP">Espagne</option>
  <option value="GER">Allemagne</option>
  <option value="ENG">Angleterre</option>
  <option value="FRA">France</option>
  <option value="ITA">Italie</option>
  <option value="NET">Pays-Bas</option>
  <option value="BRA">Brésil</option>
  <option value="POR">Portugal</option>
  </select>
  <input class="button btn-dark" type="submit" name="testselect" value="Afficher">
</form>
<?php
  if(isset($_SESSION["user"]))
      echo "<a class='loginInfo' href='nouvelleimage.php'><input class='button btn-dark' type='submit' value='NOUVELLE IMAGE'></a>";
?>

</section>

<?php 


if(isset($_POST["testselect"]))
{
  $test = $_POST["comp"]; //variable pour recuperer la valeur du menu déroulant
  photo($link,$test);//affichage des photos en fonction de la catégorie du menu déroulant

}



if (isset($_GET['c']))
{
  $c = $_GET['c']; //récupere la variable 'c' dans l'url
  photo($link,$c); //affichage des photos.
}




if(isset($_GET["subscribe"])){
  $successMsg = "<div class='sucessMsg'>L'inscription a bien &eacute;t&eacute; effectu&eacute;e, vous pouvez vous connecter</div>";
  echo $successMsg;
}



?>
</body>
</html>