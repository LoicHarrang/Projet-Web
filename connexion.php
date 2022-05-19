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
</head>
<body class="text-center">
<?php
    if(!empty($_SESSION))
    {
        redirect('index.php',1);
    }
    else
    {
        afficheFormulaireConnexion();
        if(!empty($_POST))
        {
            if(!empty($_POST['login']) && !empty($_POST['pass']));
            {
                $verif = verifierCompte($_POST['login'],$_POST['pass']);
                if($verif)
                {
                    echo 'Connexion réussi ! Redirection en cours...';
                    $statut = isAdmin($_POST['login']);
                    $_SESSION['login'] = $_POST['login'];
                    $_SESSION['pass'] = $_POST['pass'];
                    $_SESSION['statut'] = $statut;
                    redirect('index.php',2);
                }
                else
                {
                    echo '<p>Connexion impossible (Merci de vérifier vos informations)</p>';
                }
            }
        }
    }
?>
</body>
</html>
