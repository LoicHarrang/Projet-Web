<?php
include 'fonctions.php';

if (!empty($_GET) && isset($_GET["noL"]))   {
    modifierLycee($_GET['noL'],$_GET['nom'],$_GET['adr'],$_GET['tel']);
    $tab=listeLyceeParVille($_GET["noL"]);
    if ($tab) {
    echo '<h4 class="text-center mb-5"> Le lycée ' . $_GET['nom'] . ' à correctement été modifié à la base</h4>';
    afficheTableauHTML($tab);
    }
    else{
        echo"<h4 class='text-center'>erreure dans l'insertion";
    }
}
else{
    echo "<h4 class='text-center'>erreure dans l'insertion";
}
?>