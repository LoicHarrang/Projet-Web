<?php session_start();?>
<?php 
	include 'fonctions.php';
	include 'formulaires.php';
    include 'contenue.php';
?>
<!DOCTYPE html>
<html lang="fr" >
	<head>
		<meta charset="utf-8">
		<link href="style.css" rel="stylesheet" type="text/css" />
		<title>Lycée : Insertion</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	</head>
	<body class="container">
		<nav>
			<?php
				if(empty($_SESSION)) {		
					echo "<p>Vous n'êtes pas connectés ou pas en admin</p>";
					redirect("connexion.php",1);				
				}
                if(($_SESSION["statut"]!="administrateur" )) redirect("index.php",1);				

				else {
					afficherMenuAdmin();
                    
				}
				
			?>
		</nav>
		<article>
			<?php
				contenue_accueil_insertion();
				if(!empty($_SESSION) && $_SESSION['statut']=='administrateur')	{
					afficheFormulaireAjoutLycee();
                    /*
					if(!empty($_POST)){
						var_dump($_POST['ville_etu']);
						$res = ajoutUtilisateur($_POST['mail'],$_POST['pass'],$_POST['rue'],$_POST['ville_etu'],$_POST['status']);
						//$res = ajoutUtilisateur('ni@prof.fr','ni','24 rue fontaine','22130','Prof');
						var_dump($res);
						if ($res==1){
							$tab = listeCompte();
							afficheTableau($tab);

						}
						else{
							echo "<p> La création a échoué</p>";
						}
					}
                    */
                    ?>
                    
                                                    <br />
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
				}
				
				
			?>	
            
		</article>
		<footer>
			<p>Pied de la page <?php echo $_SERVER['PHP_SELF']; ?> </p>
			<a href="javascript:history.back()">Retour à la page précédente</a>
		</footer>
	</body>
</html>	

