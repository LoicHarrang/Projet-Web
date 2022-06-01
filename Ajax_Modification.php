<?php
include 'fonctions.php';
modifierLycee($_GET['noL'],$_GET['nom'],$_GET['adr'],$_GET['tel']);
if (!empty($_GET) && isset($_GET["noL"]))   {
    $tab=listeLyceeParVille($_GET["noL"]);
    if ($tab) afficheTableauHTML($tab);
}
else{
    echo "aucun msg";
}
?>