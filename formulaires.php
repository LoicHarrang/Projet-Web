<?php
//******************************************************************************
function afficheFormulaireConnexion(){
?>
<main class="offset-4 col-4 my-5 form-signin">
    <form id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h1 class="h3 mb-3 fw-normal">Veuillez vous connecter</h1>

        <div class="form-floating my-2">
            <input type="email" name="login" class="form-control" id="id_mail" placeholder="mail@mail.com">
            <label for="id_mail">Adresse Email</label>
        </div>
        <div class="form-floating">
            <input type="password" name="pass" class="form-control" id="id_pass" placeholder="UnSuperMotDePasse" required size="8">
            <label for="id_pass">Mot de Passe</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary mt-2" type="submit" name="connect" value="Connexion">Connexion</button>
    </form>
</main>
<?php
}
//******************************************************************************
function afficherMenuAdmin()     {
    ?>
    <header>
    <!-- Le menu Admin -->       
    <div class="container ">
        <header class="d-flex justify-content-center py-3">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link text-black" href="index.php?action=liste_utilisateur"> Lister les utilisateurs</a></li>
            <li class="nav-item"><a class="nav-link text-black" href="index.php?action=liste_utilisateur_ville"> Lister les utilisateurs par ville</a></li>
            <li class="nav-item"><a class="nav-link text-black" href="insertion.php?action=inserer_utilisateur"> Insérer un utilisateur</a></li>
            <li class="nav-item"><a class="nav-link text-black" href="">Supprimer un utilisateur</a></li>
            <li class="nav-item"><a class="nav-link text-black" href="modification.php">Modifier un utilisateur</a></li>
            <li class="nav-item"><a class="nav-link text-black" href="index.php?action=logout" title="Déconnexion">Se deconnecter</a></li>
        </ul>
        </header>
      </div>
      <?php
}
//******************************************************************************
function afficherMenuUtilisateur()     {
    ?>
    <header>
    <!-- Le menu Admin -->       
    <div class="container ">
        <header class="d-flex justify-content-center py-3">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link text-black" href="index.php?action=liste_utilisateur"> Lister les utilisateurs</a></li>
            <li class="nav-item"><a class="nav-link text-black" href="index.php?action=liste_utilisateur_ville"> Lister les utilisateurs par ville</a></li>
            <li class="nav-item"><a class="nav-link text-black" href="index.php?action=logout" title="Déconnexion">Se deconnecter</a></li>
        </ul>
        </header>
      </div>
      <?php
}
//******************************************************************************
function afficheFormulaireAjoutLycee()    {
    	// connexion BDD et récupération des villes
		$madb = new PDO('sqlite:bdd/bdd.sqlite'); 
        
		$requete = "SELECT codepostal,ville FROM lycee;";
		$resultat = $madb->query($requete);//var_dump($resultat);echo "<br/>";  
		if($resultat){
			$lycees = $resultat->fetchAll(PDO::FETCH_ASSOC);			
		}
	?>
	<form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
		<fieldset> 
            
			<label for="id_nom">Nom : </label><input type="text" name="nom" id="id_mail" placeholder="@mail" required size="20" /><br />
			<label for="id_adresse">Adresse : </label><input type="text" name="adr" required id="id_pass" size="10" /><br />
			<label for="id_tel">Téléphone : </label><input type="tel" name="tel" id="id_rue" placeholder="adresse" required size="20" /><br />
			<label for="id_ville">Ville : </label> 
			<select id="id_ville" name="ville_ly" size="1">
				<?php // on se sert de value directement pour l'insertion					
					foreach($lycees as $lycee){					
						echo '<option value="'.$lycee['codepostal'].'">'.$lycee["codepostal"].' '.$lycee["ville"].'</option>';
					}					
				?>
			</select>
			<input type="submit" value="Insérer"/>
		</fieldset>
	</form>
	<?php
		echo "<br/>";
	}// fin afficheFormulaireAjoutUtilisateur
//******************************************************************************
function afficheFormulaireChoixUtilisateur(){
        $madb = new PDO('sqlite:bdd/bdd.sqlite');
        $requete = "SELECT DISTINCT noL,nom FROM lycee;";
        $query = $madb->query($requete);
        if($query)
        {
            $lycees = $query->fetchAll(PDO::FETCH_ASSOC);
        }

	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<fieldset>
			<select id="id_mail" name="mail" size="1">
				<?php // on se sert de value directement
					foreach ($lycees as $lycee)
                    {
                        echo '<option value='.$lycee['noL'].'> '.$lycee['nom'].'</option>';
                    }
				?>
			</select>
            <?php
                echo '<input type="submit" value="Modifier"/>';
            ?>
		</fieldset>
	</form>
	<?php
		echo "<br/>";
	}// fin afficheFormulaireChoixUtilisateur

//*******************************************************************************************
function ajoutLycee($noL,$nom,$adresse,$codepostal,$telephone){		/* on récupère directement le code de la ville qui a été transmis dans l'attribut value de la balise <option> du formulaire
    Il n'est donc pas nécessaire de rechercher le code INSEE de la ville*/
    $retour=0;
    $madb = new PDO('sqlite:bdd/bdd.sqlite'); 	
    // filtrer les paramètres
    $noL = $madb->quote($noL);		
    $nom = $madb->quote($nom);
    $adresse= $madb->quote($adresse);
    $codepostal = $madb->quote($codepostal);
    $telephone = $madb->quote($telephone);


    //Recuperer la ville grace au code postal
    $ville = "SELECT ville FROM lycee where codepostal == $codepostal;";
    $query= $madb->query($ville);
    if($query)
    {
        $res = $query->fetch(PDO::FETCH_ASSOC);
        $ville = $res['ville'];
    }
    $ville = $madb->quote($ville);
    var_dump($ville,$noL);
    // requête
    $requete ="INSERT INTO lycee VALUES ($noL,$nom,$adresse,$codepostal,$ville,$telephone);";
    $resultat =$madb->exec($requete);
    if ($resultat == false ) 
        $retour = 0;
    else 
        $retour = $resultat;
    return $retour;

}

?>
