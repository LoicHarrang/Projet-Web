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

<body class="container">
    <?php
if(empty($_SESSION))
{
    redirect('connexion.php',2);
}
else if($_SESSION['statut']!='administrateur')
{
    redirect('index.php',2);
}
else
{

    afficherMenuAdmin();
    ?>
    <div class="container my-5" id="accueil">
        <div class="card offset-1 col-10 ">
            <div class="card-body">
                <div class="container">
                    <div class="text-center card-title">
                        <h2 class="h2 text-center mb-4 my-sm-4 ">Page de modification</h2>
                    </div>
                    <div class="card-text ">
                        <p class="text-center">
                            <?php
                                echo "<h5> Choisir l'utilisiateur à modifier</h5>";
                                afficheFormulaireChoixUtilisateur();
                                    if(isset($_POST['nom']) && isset($_POST['adr']) && isset($_POST['tel']))
                                    {
                                        var_dump(1);
                                        modifierLycee($_SESSION['modif'],$_POST['nom'],$_POST['adr'],$_POST['tel']);

                                    }
                                    echo "<p id='test'></p>";
                                    ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </article>
    <?php
    
}

?>

</body>
<?php
afficheFooter();
?>

</html>