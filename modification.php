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
    <title>Lycée - Modification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="ajax/Ajax_Modification.js" type="text/javascript"></script>


</head>
<body class="text-center">
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
    contenue_modification();
    afficheFormulaireChoixUtilisateur();
    /*
    if(isset($_POST['noL']))
    {
        afficheFormulaireModification($_POST['noL']);
    }
    */
    if(isset($_POST['nom']) && isset($_POST['adr']) && isset($_POST['tel']))
    {
        modifierLycee($_SESSION['modif'],$_POST['nom'],$_POST['adr'],$_POST['tel']);
    }
    echo "<p id='test'>e</p>";
}
?>

</body>
</html>