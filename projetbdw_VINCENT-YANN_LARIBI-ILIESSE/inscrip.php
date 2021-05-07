<?php
session_start();
require_once 'fonctions/bd.php';
require_once 'fonctions/users.php';

$stateMsg = "";

if(isset($_POST["valider"])) //test clique sur le bouton s'inscrire
{ 
    $pseudo = $_POST["pseudo"]; //Récupération du pseudo entrée dans le champ de texte du pseudo
    $hashMdp = md5($_POST["mdp"]); //Récupération et cryptage du mdp entrée dans le champ de texte du mdp
    $hashConfirmMdp = md5($_POST["confirmMdp"]);
    
    $link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
    
    $available = checkAvailability($pseudo, $link); //tester si le pseudo est disponible (pas déjà présent dans la base de donnée)
    
    if($hashMdp == $hashConfirmMdp)//tester si le mdp et la 'confirmer mdp' sont les mêmes
    {
        if($available)
        {
            register($pseudo, $hashMdp, $link); //ajouter le pseudo/mdp à la base de donnée
            header('Location: index.php?subscribe=yes');
        }else{
            $stateMsg = "Le pseudo demand&eacute; est d&eacute;j&agrave; utilis&eacute;";
        }
    }else{
        $stateMsg = "Les mots de passe ne correspondent pas, veuillez r&eacute;essayer";
    }
}

?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Premiere inscription</title>
  <link rel="stylesheet" href="./lib/css/bootstrap.min.css">
  <link rel="stylesheet" href="./lib/STYLE.css">
</head>

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

<body>
<div class="card center-div" style="width: 50rem;">
  <div class="card-body">
    <h5 class="card-title centrerinscription">Inscription</h5>
    <div class="loginBanner center-div">
            <div class="errorMsg"><?php echo $stateMsg; ?></div>
            <form action="inscrip.php" method="POST"> <!-- formulaire méthode POST pour gérer l'inscription d'une personne -->
                <table>
                    <tr><td class="loginInfo">Pseudo souhait&eacute;:</td><td><input type="text" name="pseudo"></td></tr>
                    <tr><td class="loginInfo">Mot de passe:</td><td><input type="password" name="mdp"></td></tr>
                    <tr><td class="loginInfo">Confirmer mot de passe:</td><td><input type="password" name="confirmMdp"></td></tr>       
                    <br/>
                    <tr><td><input class="button btn-primary" type="submit" name="valider" value="S'inscrire">
                </table>
            </form>
            
            <a href="index.php">D&eacute;j&agrave; inscrit?</a>
        </div>
  </div>
</div>


   
</body>
</html>
