<?php

session_start();
require_once 'fonctions/bd.php';
require_once 'fonctions/affichdetail.php';

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);

?>


<!doctype html>
<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="./lib/css/bootstrap.min.css">
<link rel="stylesheet" href="./lib/STYLE.css">


<html>
    
<section class="BASE">
      <div class="BASE TEXTE">
        <h1 class="title">PROJET BDW1</h1>
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
</html>


</body>
</html>


<?php

if(isset($_GET['c']))
{
  $c = $_GET['c']; //récupere la variable 'c' dans l'url
  detail($link,$c); //affichage des détails de la citation
}


if(isset($_SESSION["user"]))
{
  if($_SESSION["user"] == "admin") //Si l'utilisateur connecté est l'admin. 
  {
    echo "<form action='description.php?c=".$_GET['c']."' method='post'><tr><td><input class='button' type='submit' name='sup' value='Supprimer'></td></tr></form>";

  }
}

if(isset($_GET['c']))
{
  if(isset($_POST["sup"])){   //Si on clique le bouton supprimer 
    $query = "DELETE FROM Photo WHERE nomFich = '".$c."' ;";  //alors on execute cette requete(suppression de la photo dans la base donnée).
    executeUpdate($link, $query); //execution de la requete    
    echo ("Cette photo a bien été supprimé.");
  }
}

?>
