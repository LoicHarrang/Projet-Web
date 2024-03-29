<?php
session_start();
include 'formulaires.php';
include 'fonctions.php';
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Lycée - Modification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="ajax/Ajax_Modification.js" type="text/javascript"></script>


</head>

<!-- Body -->
<body class="container">
    <?php
    //Si l'utilisateur n'est pas connecté on e redirige vers la page connexionphp
if(empty($_SESSION))
{
    redirect('connexion.php',2);
}
// si l'utilisateur est connecté

//Si l'utilisateur n'est pas admin on le redirige
else if($_SESSION['statut']!='administrateur')
{
    redirect('index.php',2);
}
//Sinon il a accés a la pgae modification
else
{
    ?>

    <!-- Nav -->
    <nav class="navbar navbar-expand navbar-light bg-light py-3 sticky-top shadow p-3 mb-5 bg-white rounded">
        <?php
    afficherMenuAdmin();
    ?>
    </nav>
    <?php
    ?>
    <!-- Header -->
    <header>
        <h2 class="h2 mb-4 my-sm-4 text-center">Page de modification des Lycées de Bretagne</h2>
        <h3 class="text-center"> Bienvenue <?php echo $_SESSION["login"] ?></br> Vous êtes un
            <?php echo $_SESSION["statut"] ?></h3>
    </header>
    <div class="container my-5" id="accueil">
        <div class="card offset-1 col-10 shadow p-3 mb-5 bg-white rounded">
            <div class="card-body">
                <div class="container">
                    <div class="card-text ">
                        <p class="text-center">
                            <?php
                                
                                 afficheFormulaireChoixLycee();
                                echo " <p id='formulaire_tableau' ></p>";
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Article -->
    </article>
    <?php
    

?>
<!-- Footer -->
    <footer>
        <?php
         afficheFooter();
        ?>
    </footer>
</body>


</html>
<?php 
}
?>