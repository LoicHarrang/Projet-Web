<?php
include 'fonctions.php';

if (!empty($_GET) && isset($_GET["noL"]))   {
    modifierLycee($_GET['noL'],$_GET['nom'],$_GET['adr'],$_GET['tel']);
    $tab=listeLyceeParVille($_GET["noL"]);
    if ($tab) afficheTableauHTML($tab);
}
else{
    echo "aucun msg";
}
?>