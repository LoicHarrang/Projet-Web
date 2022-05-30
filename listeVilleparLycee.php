<?php 
include 'formulaires.php';
include 'fonctions.php';


 if (!empty($_GET) && isset($_GET["choix"]))   {	
    $tab=listeLyceeParVille($_GET["choix"]); 
    if ($tab) afficheTableauHTML($tab);
    }
else{
    echo "aucun msg";
}
?>