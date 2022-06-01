<?php
include 'formulaires.php';
include 'fonctions.php';


 if (!empty($_GET) && isset($_GET["noL"]))   {
    $tab=listeLyceeParVille($_GET["noL"]);
    if ($tab) afficheTableauHTML($tab);
    }
else{
    echo "aucun msg";
}
?>