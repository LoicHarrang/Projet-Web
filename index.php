<?php
    session_start();
    include 'formulaires.php';
    include 'fonctions.php';
    include 'contenue.php';
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Lycée - Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="text-center">
<?php
//Si aucune session redirection vers page de connection
if (empty($_SESSION)) {
    redirect('connexion.php', 1);
} //Sinon on affiche le Menu
else if (isset($_SESSION['statut']) && $_SESSION['statut'] == "administrateur") { //Menu admin
    afficherMenuAdmin();
} else { //Menu Utilisateur
    afficherMenuUtilisateur();
}

if (!empty($_SESSION) && !empty($_GET) && isset($_GET['action']) && $_GET['action'] == 'logout') {
    $_SESSION = array();
    session_destroy();
    redirect("connexion.php", 1);
}
?>
<div  class ="container mt-5" id="accueil">

    <div class="card offset-1 col-10 ">
        <div class="card-body">
            <div class="container">
                <div class="text-center card-title">
                    <!-- Heading -->
                    <h2 class="h2 text-center mb-4 my-sm-4 ">Page d'accueil des Lycées de France</h2>
                </div>
                <div class="card-text ">
                    <p class="text-center">

                        <?php
                        if(!empty($_SESSION) && isset($_SESSION['statut']) && !isset($_GET['action']) && !isset($_POST['ville']))
                        {
                            //Texte de bienvenu
                            echo "<h3> Bienvenue ".$_SESSION["login"]."</br> Vous êtes un ".$_SESSION["statut"]."</h3>";
                            afficheListeLycee();
                        }

                        if(!empty($_SESSION) && isset($_SESSION['statut']) && !isset($_POST['ville']) && isset($_GET['action']) && $_GET['action'] == 'liste_utilisateur_ville' )
                        {
                            echo "<h3> Bienvenue ".$_SESSION["login"]."</br> Vous êtes un ".$_SESSION["statut"]."</h3>";
                            afficheFormulaireFiltre();
                        }

                        if(isset($_POST['ville']))
                            afficheListeLyceeFiltre($_POST['ville']);
                        ?>
                        <br />
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>