<?php
//******************************************************************************
function afficheMessageAccueil()  {
    echo "<h3> Bienvenue ".$_SESSION["login"]."</br>
    Vous êtes un ".$_SESSION["statut"]."</h3>";
}
//******************************************************************************
function afficheFormulaireConnexion(){
?>
<main class="offset-4 col-4 my-5 form-signin">
    <form id="form_connect" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post" >
        <h1 class="h3 mb-3 fw-normal">Veuillez vous connecter</h1>

        <div class="form-floating my-2">
            <input type="email" name="login" class="form-control" id="id_mail" placeholder="mail@mail.com">
            <label for="id_mail">Adresse Email</label>
        </div>
        <div class="form-floating" id='test_mdp'>
            <input type="password" name="pass" class="form-control" id="id_pass" placeholder="UnSuperMotDePasse" required size="8">
            <label for="id_pass">Mot de Passe</label>
            <p id="msg_mdp"><p>
        </div>

        <button class="w-100 btn btn-lg btn-primary mt-2" type="submit" name="connect" value="Connexion" onclick="return validMdp()">Connexion</button>
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
            <li class="nav-item"><a class="nav-link text-black" href="index.php"> Accueil</a></li>
            <li class="nav-item"><a class="nav-link text-black" href="index.php?action=liste_utilisateur_ville"> Lister les lycées par ville</a></li>
            <li class="nav-item"><a class="nav-link text-black" href="insertion.php?action=inserer_utilisateur"> Insérer un lycée</a></li>
            <li class="nav-item"><a class="nav-link text-black" href="">Supprimer un lycée</a></li>
            <li class="nav-item"><a class="nav-link text-black" href="modification.php">Modifier un lycée</a></li>
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
            <li class="nav-item"><a class="nav-link text-black" href="index.php"> Lister les lycées</a></li>
            <li class="nav-item"><a class="nav-link text-black" href="index.php?action=liste_utilisateur_ville"> Lister les lycées par ville</a></li>
            <li class="nav-item"><a class="nav-link text-black" href="index.php?action=logout" title="Déconnexion">Se deconnecter</a></li>
        </ul>
        </header>
      </div>
      <?php
}
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
			<select id="id_mail" name="noL" size="1">
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
function afficheFormulaireAjoutLycee(){
    	// connexion BDD et récupération des villes
		$madb = new PDO('sqlite:bdd/bdd.sqlite'); 
        
		$requete = "SELECT codepostal,ville FROM lycee;";
		$resultat = $madb->query($requete);//var_dump($resultat);echo "<br/>";  
		if($resultat){
			$lycees = $resultat->fetchAll(PDO::FETCH_ASSOC);			
		}
	?>
	<form  class="offset-4 col-6" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
		<fieldset> 
		    <label for="id_tel">noL : </label>    <input type="text" name="noL" id="id_noL" placeholder="LYC_XX" required size="5" pattern ='^LYC_[0-9]{1,4}' /><br />
				<label for="id_nom">Nom :   </label>    <input class='my-1' type="text" name="nom" id="id_nom" placeholder="Nom" required size="20" /><br />
				<label for="id_adresse">Adresse :   </label>    <input class='my-1'type="text" name="adr" required id="id_adr" size="10"  placeholder="adresse" /><br />
				<label for="id_tel">Téléphone :  </label>   <input class='my-1' type="tel" name="tel" id="id_tel" placeholder="06 XX XX XX XX" required size="10" pattern = '^0[0-9]{9}'/><br />
				<label for="id_ville">Ville :    </label> 
				<select class="my-1" id="id_ville" name="ville_ly" size="1">
					<?php // on se sert de value directement pour l'insertion					
						foreach($lycees as $lycee){					
							echo '<option value="'.$lycee['codepostal'].'">'.$lycee["codepostal"].' '.$lycee["ville"].'</option>';
						}					
					?>
				</select>
				</br>

				 <input type="text" name="captcha"/>
				<img class="my-1" src="image.php" onclick="this.src='image.php?' + Math.random();" alt="captcha" style="cursor:pointer;"/></br>
				<input class='my-1' type="submit" value="Insérer"/>
       		</fieldset>
    	</form>
 <?php
                
	echo "<br/>";
	}// fin afficheFormulaireAjoutLycee

//*******************************************************************************************
function afficheFormulaireModification($noL){
    $_SESSION['modif'] = $noL;
    // connexion BDD et récupération des villes
    $madb = new PDO('sqlite:bdd/bdd.sqlite');
    $noL = $madb->quote($noL);
    $requete = "SELECT noL,nom,adresse,telephone,ville,codepostal FROM lycee WHERE noL=$noL;";

    $resultat = $madb->query($requete);

    if($resultat){
        $lycees = $resultat->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>
    <form  class="offset-4 col-5 " action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
        <fieldset>
            <?php
                echo '<label for="id_tel">noL : </label> <input type="text" name="noL" id="id_noL" value="'.$lycees[0]['noL'].'" disabled size="5" /><br />';
                echo '<label for="id_nom">Nom : </label> <input type="text" name="nom" id="id_nom" value="'.$lycees[0]['nom'].'" required size="20" /><br />';
                echo '<label for="id_adresse">Adresse : </label> <input type="text" name="adr" id="id_adr" value="'.$lycees[0]['adresse'].'" size="10" /><br />';
                echo '<label for="id_tel">Téléphone : </label> <input type="tel" name="tel" id="id_tel" value="'.$lycees[0]['telephone'].'" required size="10" /><br />';
            ?>
            <label for="id_ville">Ville : </label>
            <select id="id_ville" name="ville_ly" size="1">
                <?php // on se sert de value directement pour l'insertion
                foreach($lycees as $lycee){
                    echo '<option value="'.$lycee['codepostal'].'">'.$lycee["codepostal"].' '.$lycee["ville"].'</option>';
                }
                ?>
            </select>
            <input type="submit" value="Modifier"/>
        </fieldset>
    </form>
    <?php
    echo "<br/>";
}// fin afficheFormulaireModification

    //*******************************************************************************************
function afficheListeLycee(){
    $madb = new PDO('sqlite:bdd/bdd.sqlite');

    $requete = "SELECT DISTINCT nom,adresse,ville,telephone FROM lycee;";

    $resultat = $madb->query($requete);

    if($resultat){
        $lycees = $resultat->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Adresse</th>
            <th scope="col">Ville</th>
            <th scope="col">Téléphone</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($lycees as $lycee)
        {
            echo '
            <tr>
                <td>'.$lycee['nom'].'</td>
                <td>'.$lycee['adresse'].'</td>
                <td>'.$lycee['ville'].'</td>
                <td>'.$lycee['telephone'].'</td>
            </tr>';
        }
        ?>
        </tbody>
    </table>
        <?php
    echo "<br/>";
}// fin afficheListeLycée
//*******************************************************************************************

function afficheFormulaireFiltre(){
    echo "<br/>";
    $madb = new PDO('sqlite:bdd/bdd.sqlite');
    $requete = "SELECT DISTINCT ville,codepostal FROM lycee;";

    $query = $madb->query($requete);

    if($query)
    {
        $villes = $query->fetchAll(PDO::FETCH_ASSOC);}

    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset>
            <label for="id_ville">Ville :</label>
            <select id="id_ville" name="ville" size="1">
                <?php // générer la liste des options à partir de $villes
                      foreach ($villes as $ville)
                      {
                          echo '<option value='.$ville['codepostal'].'> '.$ville['codepostal'].' '.$ville['ville'].' </option>';
                      }
                      ?>
                  </select>
                  <input type="submit" value="Rechercher Lycée par Ville"/>
              </fieldset>
          </form>
          <?php
          echo "<br/>";
      }// fin afficheFormulaireFiltre

      //*******************************************************************************************
      function afficheListeLyceeFiltre($cp){
          $madb = new PDO('sqlite:bdd/bdd.sqlite');

          $requete = "SELECT DISTINCT nom,adresse,ville,telephone FROM lycee WHERE codepostal=$cp;";

          $resultat = $madb->query($requete);

          if($resultat){
              $lycees = $resultat->fetchAll(PDO::FETCH_ASSOC);
          }
          ?>
          <table class="table">
              <thead>
              <tr>
                  <th scope="col">Nom</th>
                  <th scope="col">Adresse</th>
                  <th scope="col">Ville</th>
                  <th scope="col">Téléphone</th>
              </tr>
              </thead>
              <tbody>
              <?php
              foreach ($lycees as $lycee)
              {
                  echo '
            <tr>
                <td>'.$lycee['nom'].'</td>
                <td>'.$lycee['adresse'].'</td>
                <td>'.$lycee['ville'].'</td>
                <td>'.$lycee['telephone'].'</td>
            </tr>';
              }
              ?>
              </tbody>
          </table>
          <?php
          echo "<br/>";
      }// fin afficheListeLyceeFiltre
?>
