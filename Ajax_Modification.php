<?php
include 'fonctions.php';
//Page appelé Ajax MOdification

//Test de l'envoie du formulaire Ajax
if (!empty($_GET) && isset($_GET["noL"]))   {

    //Fonction de modification Lycée
    modifierLycee($_GET['noL'],$_GET['nom'],$_GET['adr'],$_GET['tel']);

    //Requete pour recuperer le tableau de tout les lycées en fonction du noL
    $tab=listeLyceeParVille($_GET["noL"]);
    if ($tab) {
    echo '<h4 class="text-center mb-5"> Le lycée ' . $_GET['nom'] . ' à correctement été modifié à la base</h4>';

    //Affichage Tableau en fonction de la ville
    afficheTableauHTML($tab);
    }
    else{ //si l'insertion a échoué on affiche ce message
        echo"<h4 class='text-center'>erreure dans l'insertion";
    }
}
else{ // Si le formulaire n'a pas été envoye correctement,affiche ce message
    echo "<h4 class='text-center'>erreure dans l'insertion";
}
?>