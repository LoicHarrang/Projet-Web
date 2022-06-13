<!-- Script de mdp-->
<script src="js/Lycee.js" type="text/javascript"></script> 
<?php
//******************************************************************************
//Procédure permettant d'afficher le formulaire de connection
//Methode Post
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
        <!-- Fonction JS de validation de conformité mot de passe/ Fonction Lycée.js -->
        <button class="w-100 btn btn-lg btn-primary mt-2" type="submit" name="connect" value="Connexion"
            onclick="return validMdp()">Connexion</button> 
            
    </form>
</main>
<?php
    }
//******************************************************************************
//Procédure qui permet d'afficher le menu ADMIN
function afficherMenuAdmin()
{
    ?>
<div class="collapse navbar-collapse justify-content-center">
    <ul class="navbar-nav  ">
        <li class="nav-item"><a class="nav-link" href="index.php"> Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?action=liste_utilisateur_ville"> Lister les lycées
                par ville</a></li>
        <li class="nav-item"><a class="nav-link " href="insertion.php?action=inserer_utilisateur"> Insérer un
                lycée</a></li>
        <li class="nav-item"><a class="nav-link " href="modification.php">Modifier un lycée</a></li>
        <li class="nav-item"><a class="nav-link " href="index.php?action=logout" title="Déconnexion">Se
                deconnecter</a></li>
    </ul>
</div>

<?php
}
//******************************************************************************
//Procédure qui permet d'afficher le menu Utilisateur
function afficherMenuUtilisateur()
{
    ?>
<div class="collapse navbar-collapse justify-content-center">
    <ul class="navbar-nav  ">
        <li class="nav-item"><a class="nav-link" href="index.php"> Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?action=liste_utilisateur_ville"> Lister les lycées
                par ville</a></li>
        <li class="nav-item"><a class="nav-link " href="index.php?action=logout" title="Déconnexion">Se
                deconnecter</a></li>
    </ul>
</div>
<?php
}
//******************************************************************************
//Procédure qui permet d'afficher le formulaire avec un menu déroulant de choix de ville
//Methode Get
function afficheFormulaireChoixLycee(){
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
            <select id="id_mail" class="form-select custom-select-lg " name="noL" size="1"
                onchange="formulaireModification(this)" required>
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
//Procédure d'un formulaire avec le noL,nom,adresse, téléphone,la ville et le captcha
//Methode Post
function afficheFormulaireAjoutLycee(){

    $madb = new PDO('sqlite:bdd/bdd.sqlite');
    $requete = "SELECT codepostal,ville FROM lycee;";
    $resultat = $madb->query($requete);//var_dump($resultat);echo "<br/>";
    if($resultat){
        $lycees = $resultat->fetchAll(PDO::FETCH_ASSOC);
    }
	?>
    <!-- Bootstrap was-validated permettant de crée un formulaire qui se valide de facon dynamique grace a du js selon les pattern et les required -->
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
        <!-- Captcha qui va chercher dans image.php une image au hasard et son on recick deçu va chercher une autre image de façon dynamique -->
        <div class="form-group">
            <
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
//Procédure qui affiche un formulaire préremplie grace au information du noL et va mettre des valeurs qui sront fixes (ex : noL,ville)
//Parametre noL
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
            <!-- Ajax, on envoie pas le formulaire mais on active la fonction javascript listeFIltreUtilisateurs (repetoir : ajax/Ajax_MOdification) -->
            <button onclick='return listeFiltreUtilisateurs()'> Modifier </button>
    </fieldset>
</div>
<?php
    echo "<br/>";
}// fin afficheFormulaireModification

//*******************************************************************************************
//Procédure qui affiche la liste des lycée
function afficheListeLycee(){
    $madb = new PDO('sqlite:bdd/bdd.sqlite');
    $requete = "SELECT DISTINCT nom,adresse,ville,telephone FROM lycee;";
    $resultat = $madb->query($requete);

    if($resultat){
        $lycees = $resultat->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>
<!-- Boostrap qui permet d'avoir un tableau avec des couleurs qui alternent et une ombre autour de ce tableau -->
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
//Procédure qui affiche un formulaire avec une liste déroulante pour choisir la ville qu'on veut avoir comme filtre
//Methode Post
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
            <select id="id_ville" class="form-select custom-select-lg " name="ville" required size="1">
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
//*******************************************************************************************
//Procédure qui affiche la tableau des vill en fonction d'un code postale
function afficheListeLyceeFiltre($cp){
    $madb = new PDO('sqlite:bdd/bdd.sqlite');

    $requete = "SELECT DISTINCT nom,adresse,ville,telephone FROM lycee WHERE codepostal=$cp;";

    $resultat = $madb->query($requete);

    if($resultat){
        $lycees = $resultat->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>
<table class="table table-bordered table-striped shadow p-3 mb-5 bg-white rounded">
    <thead>
        <tr>
            <th scope="col m">Nom</th>
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
//Procédure qui affiche un Carrousel boostrap
function afficheCarousel(){
    $madb = new PDO('sqlite:bdd/bdd.sqlite');
    $requete = "SELECT DISTINCT image FROM bac;";
    $resultat = $madb->query($requete);

    if($resultat){
        $image = $resultat->fetchAll(PDO::FETCH_ASSOC);
    }
    //On va cherche les images dans la bdd
    echo '
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
                    <div class="carousel-item">
                    <img src="'.$image[6]['image'].'" class="d-block w-100" alt="" width="390" height="390">
                    </div>
                    <div class="carousel-item">
                    <img src="'.$image[7]['image'].'" class="d-block w-100" alt="" width="390" height="390">
                    </div>
                    <div class="carousel-item">
                    <img src="'.$image[8]['image'].'" class="d-block w-100" alt="" width="390" height="390">
                    </div>
                    <div class="carousel-item">
                    <img src="'.$image[9]['image'].'" class="d-block w-100" alt="" width="390" height="390">
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
//*****************************************************************************************
//Procédure affichant le footer
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

?>