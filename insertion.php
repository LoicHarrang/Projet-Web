<?php session_start();?>
<?php 
	include 'fonctions.php';
	include 'formulaires.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="container">

    <!-- Menu -->
    <?php
				if(empty($_SESSION)) {		
					echo "<p>Vous n'êtes pas connectés ou pas en admin</p>";
					redirect("connexion.php",1);				
				}
                if(($_SESSION["statut"]!="administrateur" )) redirect("index.php",1);				

				else {
                    ?>
    <nav class="navbar navbar-expand navbar-light bg-light py-3 sticky-top shadow p-3 mb-5 bg-white rounded">
        <?php
					afficherMenuAdmin();
                    ?>
    </nav>
    <?php
				}
			?>
    <header>
        <h2 class="h2 mb-4 my-sm-4 text-center">Page d'Insertion des Lycées de Bretagne</h2>
        <h3 class="text-center"> Bienvenue <?php echo $_SESSION["login"] ?></br> Vous êtes un
            <?php echo $_SESSION["statut"] ?></h3>
    </header>
    <article>
        <?php
				if(!empty($_SESSION) && $_SESSION['statut']=='administrateur') {
                    ?>
        <div class="container my-5" id="accueil">
            <div class="card offset-1 col-10 shadow p-3 mb-5 bg-white rounded ">
                <div class="card-body">
                    <div class="container">
                        <div class="text-center card-title">
                            <h5> Choisir l'utilisiateur à inserer</h5></br>
                        </div>
                        <div class="card-text ">
                            <p class="text-center">
                                <?php
                    
                                
                                if (!empty($_POST)) {
                                        if ($_POST['captcha'] == $_SESSION['code']) {
                                            //Si le captcha est bon

                                            //Fonction ajoutant un Lycée
                                            $res = ajoutLycee($_POST['noL'], $_POST['nom'], $_POST['adr'], $_POST['ville_ly'], $_POST['tel']);


                                            if ($res == 1) {
                                                echo '<h4 class="text-center"> Le lycée ' . $_POST['nom'] . ' à correctement été aouté à la base</h4>';
                                                afficheListeLyceeFiltre($_POST['ville_ly']);
                                            } else {
                                                echo "<h4> La création a échoué</h4>";
                                            }

                                        } //Si le captcha n'est pas bon
                                        else {
                                            echo "<p class='text-center'>Code incorrect</p>";
                                        }
                                    }
                                
                                afficheFormulaireAjoutLycee();
                            }
                        ?>
                            </p>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </article>
    <footer>
     <?php
    afficheFooter();
    ?>
    </footer>
</body>
</html>