<script src="Lycee.js" type="text/javascript"></script>
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
    <form id="form_connect" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h1 class="h3 mb-3 fw-normal">Veuillez vous connecter</h1>

        <div class="form-floating my-2">
            <input type="email" name="login" class="form-control" id="id_mail" placeholder="mail@mail.com">
            <label for="id_mail">Adresse Email</label>
        </div>
        <div class="form-floating" id='test_mdp'>
            <input type="password" name="pass" class="form-control" id="id_pass" placeholder="UnSuperMotDePasse"
                required size="8">
            <label for="id_pass">Mot de Passe</label>
            <p id="msg_mdp">
            <p>
        </div>

        <button class="w-100 btn btn-lg btn-primary mt-2" type="submit" name="connect" value="Connexion"
            onclick="return validMdp()">Connexion</button>
    </form>
</main>
<?php
    }
//******************************************************************************
function afficherMenuAdmin()
{
    ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light py-3 sticky-top shadow p-3 mb-5 bg-white rounded">
    <div class="collapse navbar-collapse justify-content-center">
        <ul class="navbar-nav  ">
            <li class="nav-item"><a class="nav-link" href="index.php"> Accueil</a></li>
            <li class="nav-item"><a class="nav-link " href="index.php?action=liste_utilisateur_ville"> Lister les lycées
                    par ville</a></li>
            <li class="nav-item"><a class="nav-link " href="insertion.php?action=inserer_utilisateur"> Insérer un
                    lycée</a></li>
            <li class="nav-item"><a class="nav-link " href="modification.php">Modifier un lycée</a></li>
            <li class="nav-item"><a class="nav-link " href="index.php?action=logout" title="Déconnexion">Se
                    deconnecter</a></li>
        </ul>
    </div>
</nav>
<?php
}
//******************************************************************************
function afficherMenuUtilisateur()
{
    ?>
<div class="container ">
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link text-black" href="index.php"> Accueil</a></li>
            <li class="nav-item"><a class="nav-link text-black" href="index.php?action=liste_utilisateur_ville"> Lister
                    les lycées par ville</a></li>
            <li class="nav-item"><a class="nav-link text-black" href="index.php?action=logout" title="Déconnexion">Se
                    deconnecter</a></li>
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
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
    <fieldset>
        <div class="form-group my-2 offset-4 col-4">
            <label for="id_mail" class="form-label">Choisir un Lycée</label>
            <select id="id_mail" class="form-select custom-select-lg " name="noL" size="1" onchange="formulaireModification(this)" required>
            <option value="" selected disabled>------</option>
                <?php
					foreach ($lycees as $lycee)
                    {
                        echo '<option value='.$lycee['noL'].'> '.$lycee['nom'].'</option>';
                    }
				?>
            </select>
        </div>
    </fieldset>
</form>
<?php
    echo "<br/>";
	}// fin afficheFormulaireChoixUtilisateur

//*******************************************************************************************
function afficheFormulaireAjoutLycee(){

    $madb = new PDO('sqlite:bdd/bdd.sqlite');
    $requete = "SELECT codepostal,ville FROM lycee;";
    $resultat = $madb->query($requete);//var_dump($resultat);echo "<br/>";
    if($resultat){
        $lycees = $resultat->fetchAll(PDO::FETCH_ASSOC);
    }
	?>
<form class="offset-4 col-4 was-validated" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
        <div class="row mb-1">
            <div class="form-group col-md-6">
                <label for="id_noL" class="form-label">noL : </label>
                <input type="text" class="form-control" name="noL" id="id_noL" placeholder="LYC_XX" required size="4"
                    pattern='^LYC_[0-9]{1,4}' />
            </div>
            <div class="form-group col-6">
                <label for="id_nom" class="form-label">Nom : </label>
                <input type="text" class="form-control" name="nom" id="id_nom" placeholder="Nom" required />
            </div>
        </div>
        <div class="form-group mb-1">
            <label for="id_adresse" class="form-label">Adresse : </label> <input type="text" class="form-control"
                name="adr" required id="id_adr" size="10" placeholder="adresse" />
        </div>
        <div class="form-group mb-1">
            <label for="id_tel" class="form-label">Téléphone : </label> <input type="tel" class="form-control"
                class="form-control" name="tel" id="id_tel" placeholder="06 XX XX XX XX" required size="10"
                pattern='^0[0-9]{9}' />
        </div>
        <div class="form-group mb-1 ">
            <label for="id_ville" class="form-label">Ville : </label>

            <select id="id_ville" name="ville_ly" class="form-select custom-select-lg " size="1" required>
                <option value="" selected disabled>------</option>
                <?php // on se sert de value directement pour l'insertion					
                            foreach($lycees as $lycee){					
                                echo '<option value="'.$lycee['codepostal'].'">'.$lycee["codepostal"].' '.$lycee["ville"].'</option>';
                            }					
                        ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_captcha" class="form-label">Captcha : </label>
            <img src="image.php" onclick="this.src='image.php?' + Math.random();" alt="captcha"
                style="cursor:pointer;"></br>
            <input type="text" class="form-control" id="id_captcha" name="captcha" required /></br>
        </div>
        <input type="submit" value="Insérer" />
    </fieldset>
</form>
<?php
    echo "<br/>";
	}// fin afficheFormulaireAjoutLycee

//*******************************************************************************************
function afficheFormulaireModification($noL){
    $_SESSION['modif'] = $noL;
    $madb = new PDO('sqlite:bdd/bdd.sqlite');
    $noL = $madb->quote($noL);
    $requete = "SELECT noL,nom,adresse,telephone,ville,codepostal FROM lycee WHERE noL=$noL;";
    $resultat = $madb->query($requete);

    if($resultat){
        $lycees = $resultat->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>
<div class="form offset-4 col-4">
    <fieldset>
        <div class="row mb-1">
            <?php
                echo '
                    <div class="form-group mb-1>
                        <label for="id_noL" class="form-label">noL : </label>
                        <input type="text" class="form-control" name="noL" id="id_noL" value="'.$lycees[0]['noL'].'" disabled size="5" />
                    </div>
                    <div class="form-group mb-1>
                        <label for="id_nom" class="form-label">Nom : </label>
                        <input type="text" class="form-control" name="nom" id="id_nom" value="'.$lycees[0]['nom'].'" required size="20" />               
                    </div>
                </div>';
                echo '
                <div class="form-group mb-1">
                    <label for="id_adresse" class="form-label">Adresse : </label> 
                    <input class="form-control" type="text" name="adr" id="id_adr" value="'.$lycees[0]['adresse'].'" size="10"  required />
                </div>';
                echo '        
                <div class="form-group mb-1">
                    <label for="id_tel" class="form-label">Téléphone : </label><input type="tel" name="tel" id="id_tel" value="'.$lycees[0]['telephone'].'" class="form-control"
                    class="form-control" name="tel" id="id_tel" placeholder="06 XX XX XX XX" required size="10"
                    pattern="^0[0-9]{9}" />
                </div>';
            ?>
            <div class="form-group mb-2 ">
                <label for="id_ville" class="form-label">Ville : </label>

                <select id="id_ville" name="ville_ly" class="form-select custom-select-lg " size="1" required>
                    <?php // on se sert de value directement pour l'insertion					
                            foreach($lycees as $lycee){					
                                echo '<option value="'.$lycee['codepostal'].'">'.$lycee["codepostal"].' '.$lycee["ville"].'</option>';
                            }					
                        ?>
                </select>
            </div>
            <button onclick='return listeFiltreUtilisateurs()'> Modifier </button>
    </fieldset>
</div>
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
<table class="table table-bordered table-striped shadow p-3 mb-5 bg-white rounded">
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
    <div class="form-group  offset-4 col-4">
        <label for="id_ville" class="form-label">Ville :</label>
        <select id="id_ville" class="form-select custom-select-lg " name="ville"  required size="1">
        <option value="" selected disabled>------</option>
            <?php
                    foreach ($villes as $ville)
                    {
                        echo '<option value='.$ville['codepostal'].'> '.$ville['codepostal'].' '.$ville['ville'].' </option>';
                    }
                    ?>
        </select></br>
        <input type="submit" value="Rechercher Lycée par Ville" />
    </fieldset>
</form>
<?php
          echo "<br/>";
}// fin afficheFormulaireFiltre

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

//*******************************************************************************************
function afficheCarousel(){
    $madb = new PDO('sqlite:bdd/bdd.sqlite');
    $requete = "SELECT DISTINCT image FROM bac;";
    $resultat = $madb->query($requete);

    if($resultat){
        $image = $resultat->fetchAll(PDO::FETCH_ASSOC);
    }

    echo
        '<h4 class="mb-5"><br> Voici les différents BAC proposé dans votre région !<br></h4>
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="'.$image[0]['image'].'" class="d-block w-100" alt="" width="390" height="390">
                    </div>
                    <div class="carousel-item">
                        <img src="'.$image[1]['image'].'" class="d-block w-100" alt="" width="390" height="390">
                    </div>
                    <div class="carousel-item">
                        <img src="'.$image[2]['image'].'" class="d-block w-100" alt="" width="390" height="390">
                    </div>
                    <div class="carousel-item">
                        <img src="'.$image[3]['image'].'" class="d-block w-100" alt="" width="390" height="390">
                    </div>
                    <div class="carousel-item">
                        <img src="'.$image[4]['image'].'" class="d-block w-100" alt="" width="390" height="390">
                    </div>
                    <div class="carousel-item">
                        <img src="'.$image[5]['image'].'" class="d-block w-100" alt="" width="390" height="390">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        ';
}// fin afficheCarousel
//*******************************************************************************************
function afficheFooter(){
    echo '
        <footer class="bg-light text-center text-lg-start ">
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2022 Copyright:
                <a class="text-dark">Loic HARRANG et Glen MORIN</a>
            </div>
        </footer>
    ';
}
//*******************************************************************************************
function afficheContenueInsertion(){
    ?>
<div class="container my-5" id="accueil">
    <div class="card offset-1 col-10 ">
        <div class="card-body">
            <div class="container">
                <div class="text-center card-title">
                    <h2 class="h2 text-center mb-4 my-sm-4 ">Page d'Insertion</h2>
                </div>
                <div class="card-text ">
                    <p class="text-center">
                        <?php
                                echo "<h5> Choisir l'utilisiateur à inserer</h5>";

}
//*******************************************************************************************
function afficheContenueModification()
{
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

    }
?>