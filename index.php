<?php
    session_start();
    include 'formulaires.php';
    include 'fonctions.php';
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Lycée - Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</head>
<!-- Body -->
<body class="container">
    <!-- Nav -->
    <nav class="navbar navbar-expand navbar-light bg-light py-3 sticky-top shadow p-3 mb-5 bg-white rounded">
        <?php
//Si aucune session redirection vers page de connection
if (empty($_SESSION)) {
    redirect('connexion.php', 1);
} //Sinon on affiche le Menu
else{
 if (isset($_SESSION['statut']) && $_SESSION['statut'] == "administrateur") { //Menu admin
    afficherMenuAdmin();
}
 else { //Menu Utilisateur
    afficherMenuUtilisateur();
}

if (!empty($_SESSION) && !empty($_GET) && isset($_GET['action']) && $_GET['action'] == 'logout') {
    $_SESSION = array();
    session_destroy();
    redirect("connexion.php", 1);
}
?>
    </nav>
    <!-- Header -->
    <header>
        <h2 class="h2 mb-4 my-sm-4 text-center">Page d'accueil des Lycées de Bretagne</h2>
        <h3 class="text-center"> Bienvenue <?php echo $_SESSION["login"] ?></br> Vous êtes un
            <?php echo $_SESSION["statut"] ?></h3>
    </header>
    <article class='mb-5'>
        <div class="container mt-5 " id="accueil">
            <!-- Boostrap / card avec ombre sur les bords  -->
            <div class="card offset-1 col-10 shadow p-3 mb-5 bg-white rounded "> 
                <div class="card-body">
                    <div class="container">
                        <div class=" card-title">
                            <!-- Heading -->
                            <h4 class="mb-5 text-center"><br> Voici les différents BAC proposé dans votre région !<br>
                            </h4>

                        </div>
                        <div class="card-text ">
                            <p class="text-center">

                                <?php
                        // Page d'accueil
                        if(!empty($_SESSION) && isset($_SESSION['statut']) && !isset($_GET['action']) && !isset($_POST['ville']))
                        {
                            //Texte de bienvenu
                            afficheCarousel();
                            echo '<h4 class="mt-5"><br> Voici la liste des lycées de votre région<br></h4>';
                            //TOut les lycées
                            afficheListeLycee();
                        }
                        //Page listre utilisateur lycee filtre
                        if(!empty($_SESSION) && isset($_SESSION['statut'])   && !isset($_POST['ville']) && isset($_GET['action']) && $_GET['action'] == 'liste_lycee_ville' )
                        {
                            //Formulaire affichant le choix des différentes villes
                            afficheFormulaireFiltre();
                        }
                        //Page listre utilisateur lycee filtre apres le formulaire afficheFormulaireFIltre
                        if(isset($_POST['ville']))
                        //Affiche le tableau des lyée filtre
                            afficheListeLyceeFiltre($_POST['ville']);
                        ?>
                                <br />
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <!-- Footer -->
    <footer>
        <?php
        afficheFooter();
        ?>
    </footer>
    <?php
 }
 ?>
</body>

</html>