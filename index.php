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
    if(empty($_SESSION))    {
        redirect('connexion.php',1);
    }
    //Sinon on affiche le Menu
    else if(isset($_SESSION['statut']) && $_SESSION['statut']=="administrateur")
    { //Menu admin
        afficherMenuAdmin();
    }
    else
    { //Menu Utilisateur
        afficherMenuUtilisateur();
    }
    
    //Si on appuie sur le bouton de déconnection on detruit la session et on est redirige vars la page de connection
	if (!empty($_SESSION) && !empty($_GET) && isset($_GET['action'])  && $_GET['action']=='logout' ){
		$_SESSION=array();
		session_destroy();
		redirect("connexion.php",1);
		}

    if(!empty($_SESSION) && isset($_SESSION['statut']))
    {
        //Texte de bienvenu
        contenue_accueil_index();

    }
    ?>

</body>
</html>