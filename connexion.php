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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="/js/Lycee.js" type="text/javascript"></script>
</head>
<body class="text-center">
<?php

    if(!empty($_SESSION)) //Si aucune session redirection page index
    {
        redirect('index.php',1);
    }
    else // Sinon on continue page Connexion 
    {
        //Formuaire de connexion
        afficheFormulaireConnexion(); //JS de validation dans la fonction pour verifier que le mdp contien 1 Majuscule,
        //1 Minuscule,1 chiffre,1 caractère spéciale
        
        if(!empty($_POST))  //Si le mdp est valide on continue
        {
            if(!empty($_POST['login']) && !empty($_POST['pass'])); 
            {
                $verif = verifierCompte($_POST['login'],$_POST['pass']); // On verifie que le login et le pass sont bien dans la base de donnée
                if($verif)
                {
                    echo 'Connexion réussi ! Redirection en cours...';
                    $statut = isAdmin($_POST['login']); // Verification du status de admin

                    //On met tout les informations de l'utilisateur dans les variables SESSION
                    $_SESSION['login'] = $_POST['login']; 
                    $_SESSION['pass'] = $_POST['pass'];
                    $_SESSION['statut'] = $statut;

                    //Information de connection mit dans acces.log si réussie
                    setlocale(LC_TIME, "fr_FR", "French");  
                    $monfichier = fopen('access.log', 'a+');
                    fputs($monfichier, $_SESSION['login']." (Status : ".$_SESSION['statut'].") depuis la machine ".$_SERVER['REMOTE_ADDR']." le ".strftime("%A %d %B %G", strtotime(date('Y-m-d'))) ." à ".date('h:i:s A'));
                    fputs($monfichier, "\n");
                    fclose($monfichier);

                    //Puis on redirige vers index.php
                    redirect('index.php',2);
                }
                else
                {
                    //Information de connection mit dans echoué.log si erreur
                    echo '<p>Connexion impossible (Merci de vérifier vos informations)</p>';
                    setlocale(LC_TIME, "fr_FR", "French");
                    $monfichier = fopen('echoué.log', 'a+');
                    fputs($monfichier, $_POST['login']." depuis la machine ".$_SERVER['REMOTE_ADDR']." le ".strftime("%A %d %B %G", strtotime(date('Y-m-d'))) ." à ".date('h:i:s A'));
                    fputs($monfichier, "\n");
                    fclose($monfichier);
                }
            }
        }
    }
?>
</body>
</html>
