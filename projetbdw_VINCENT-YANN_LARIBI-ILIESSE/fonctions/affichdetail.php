<?php

/*Cette fonction prend en entrée une connexion vers la base de données du chat ainsi 
que le nom d'une photo et affiche toutes les informations concernant cette derniere(image,description,nom,categorie).*/

function detail($link,$photo)
{
    $query = "SELECT * FROM Photo p NATURAL JOIN Categorie c WHERE p.nomFich = '". $photo ."' ;";
    $result = executeQuery($link, $query);
    while ($resultat = mysqli_fetch_array($result)) 
    {

     echo "<table class='table table-striped table-bordered'>
                <tr> <th colspan='2'> <img class='img-thumbnail rounded mx-auto d-block' src='./data/".$resultat['nomFich']." ' height='100' width='100'> </th> </tr>
                <tr><td class='loginInfo'>Description :</td><td>".$resultat['description']."</td></tr>
                <tr><td class='loginInfo'>Nom du fichier :</td><td>".$resultat['nomFich']."</td></tr>
                <tr><td class='loginInfo'>Categorie : </td>  <td><a href='index.php?c=".$resultat['nomCat']."'>".$resultat['nomCat']."</a></td>  </tr>
            </table>";
    }
}



?>
