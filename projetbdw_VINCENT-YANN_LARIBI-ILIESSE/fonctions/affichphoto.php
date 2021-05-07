<?php

/*Cette fonction prend en entrée une connexion vers la base de données du chat ainsi 
que le nom d'une categorie et affiche toutes les photos correspondantes à la categorie.*/

function photo($link,$cat)
{
    if ($cat == "tout")
        $query = "SELECT nomFich FROM Photo;";
    else
        $query = "SELECT p.nomFich FROM Photo p NATURAL JOIN Categorie c WHERE c.nomCat = '". $cat ."' ;";
    $result = executeQuery($link, $query);
    while ($resultat = mysqli_fetch_array($result)) 
    {
    echo "<a href='description.php?c=".$resultat['nomFich']."'> <img class='img-thumbnail' src='./data/".$resultat['nomFich']."' height='200' width='200'> </a>";
    }
}

?>