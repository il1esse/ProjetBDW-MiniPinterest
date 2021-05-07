<?php
session_start();
require_once 'fonctions/bd.php';
require_once 'fonctions/users.php';
?>


<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Nouvelle image</title>
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
    <h5 class="card-title centrerinscription">Ajouter une image</h5>
    <div class="loginBanner ">

        <form action="nouvelleimage.php" method="post" enctype="multipart/form-data">  <!-- formulaire méthode POST pour gérer l'ajout d'image à la base de donnée -->
              <input name="fichier" class="form-control" type="file"> <!-- formulaire pour ajouter un fichier-->
                

                <select name="pays"> <!-- menu déroulant -->
                    <option value="ESP">Espagne</option>
                    <option value="GER">Allemagne</option>
                    <option value="ENG">Angleterre</option>
                    <option value="FRA">France</option>
                    <option value="ITA">Italie</option>
                    <option value="NET">Pays-Bas</option>
                    <option value="BRA">Brésil</option>
                    <option value="POR">Portugal</option>
                    
                </select>

                <input name="nomfichier" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"> <!-- champ de texte du nom de fichier-->


            <input class="button" type="submit" name="Ajouter" value="Ajouter l'image"><!-- bouton pour ajouter une image -->

    </div>
  </div>
</div>

<?php



if(isset($_POST["Ajouter"]))
{
  $maxsize = 100000; //constante pour définir la taille max du fichier
  $valid = array('.jpg','.jpeg','.gif','.png'); //tableau qui répertorie les extensions de fichier autorisés
  $filesize = $_FILES['fichier']['size']; //récuperer la taille du fichier entrée
  $filetest = ".".strtolower(substr(strrchr($_FILES['fichier']['name'],'.'),1)); //recuperer l'extension du fichier entrée

  if(empty($_POST['nomfichier'])) // test si le champ de texte pour le nom du fichier est vide
  {
      echo "Veuillez entre un nom";
  }
  elseif($filesize > $maxsize) //tester si la taille du fichier est supérieur à 100000 octest = 100ko
  {
    echo "le fichier est trop gros!";
  }
  elseif(!in_array($filetest, $valid)) //tester si l'extension du fichier est autorisé
  {
     echo "Le fichier n'est pas une image";
  }else
  {
    if(isset($_POST["pays"]))
      {
          $categorie = $_POST["pays"]; //Récupetre la valeur du menu deroulant, puis tester les différents cas possible et attribuer un id en fonction
          if($categorie == "ESP") 
          {
            $categorieid =1;
          } 
          elseif($categorie == "GER")
          {
            $categorieid =2; 
          } 
          elseif($categorie == "ENG")
          {
            $categorieid = 3;
          }
          elseif($categorie == "FRA")
          {
            $categorieid = 4;
          }
          elseif($categorie == "ITA")
          {
            $categorieid = 5;
          }
          elseif($categorie == "NET")
          {
            $categorieid = 6;
          }
          elseif($categorie == "BRA")
          {
            $categorieid = 7;
          }
          elseif($categorie == "POR")
          {
            $categorieid = 8;
          } 
          
      }
      
      $fichier = $_FILES['fichier']['name']; //Récuperer le nom du fichier
      $nomdufichier = $_POST['nomfichier'];
      $resultat = move_uploaded_file($_FILES['fichier']['tmp_name'] , "data/".$fichier);
      $query1 = "INSERT INTO Photo VALUES (NULL,'$fichier','$nomdufichier','$categorieid');"; //requête qui ajoute le fichier entrée à la table Photo

      $link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
      executeUpdate($link,$query1);//execute la requete défénie au dessus
      if($resultat)
      {
        echo "Ajout de l'image réussis";
      }

  }
 }




?>
   
</body>
</html>

