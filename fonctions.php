<?php
//*******************************************************************************************
//Nom : redirect()
//Role : Permet une redirection en javascript
//Parametre : URL de redirection et Délais avant la redirection
//Retour : Aucun
//*******************


//Procédure de redirection
//Parametre : url de la page  / tps -> temps en secondes
function redirect($url,$tps)
{
$temps = $tps * 1000;

echo "<script type=\"text/javascript\">\n"
		. "<!--\n"
		. "\n"
		. "function redirect() {\n"
		. "window.location='" . $url . "'\n"
		. "}\n"
		. "setTimeout('redirect()','" . $temps ."');\n"
		. "\n"
		. "// -->\n"
		. "</script>\n";

}
//*******************************************************************************************
//Fonction de permetre de verifier le compte de l'utilisateur
//Parametre : mail  / password
//Retourne un tableau associatif en focntion du mail et du mot de passe
function verifierCompte($mail,$pass)
{
    $retour = false;
    $madb = new PDO('sqlite:bdd/bdd.sqlite');
    $mail = $madb->quote($mail);
    $pass = $madb->quote($pass);
    $requete = "SELECT * FROM comptes WHERE login=$mail and password=$pass;";
    $query = $madb->query($requete);
    $resulat = $query->fetchAll(PDO::FETCH_ASSOC);

    if(sizeof($resulat)!=0)
    {
        $retour = true;
    }
    return $retour;
}
//*******************************************************************************************
//Fonction de permetre de verifier le compte de l'utilisateur est admin
//Parametre : mail  
//Retourne un tableau associatif en focntion du mail et du mot de passe
function isAdmin($mail)
{
    $retour = false ;

    $madb = new PDO('sqlite:bdd/bdd.sqlite');
    $mail= $madb->quote($mail);
    $requete = "SELECT statut FROM comptes WHERE login = ".$mail;
    $query = $madb->query($requete);
    if($query)
    {
        $resulat = $query->fetch(PDO::FETCH_ASSOC);
        $retour = $resulat['statut'];
    }

    return $retour;
}
//*******************************************************************************************
//Fonction de permetre de recuperer les infos nom serie, specialité
//Retourne un tableau associatif des nom , serie et spécialité des lycée
function recupereInfos()
{
    $madb = new PDO('sqlite:bdd/bdd.sqlite');
    $requete = "SELECT nom,serie,specialite FROM lycee l INNER JOIN propose p ON l.noL=p.noL INNER JOIN bac b ON p.noB=b.noB;";
    $query = $madb->query($requete);
    if($query)
    {
        $resultat = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    return $resultat;
}
//*******************************************************************************************
//Procédure de permetre de verifier le compte de l'utilisateur est admin 
//Parametre : un tableau

function afficheTableauHTML($tab){
    echo '<table class="table table-bordered table-striped shadow p-3 mb-5 bg-white rounded col-12">';
    echo '<tr>';
    foreach($tab[0] as $cle=>$valeur){
        echo "<th scope='col'>$cle</th>";
    }
    echo "</tr>\n";
    foreach($tab as $ligne){
        echo '<tr>';
        foreach($ligne as $valeur)      {
            echo "<td>$valeur</td>";
        }
        echo "</tr>\n";
    }
    echo '</table>';
    echo '<hr/>';
}
//*******************************************************************************************
//Fonction de permetre d'ajouter un lycee
//Parametre : noL,nom,adresse,codepostal,telephone
//Retourne un tableau associatif avec le nouveau lycee
function ajoutLycee($noL,$nom,$adresse,$codepostal,$telephone){
    $retour=0;
    $madb = new PDO('sqlite:bdd/bdd.sqlite');
    $noL = $madb->quote($noL);		
    $nom = $madb->quote($nom);
    $adresse= $madb->quote($adresse);
    $codepostal = $madb->quote($codepostal);
    $telephone = $madb->quote($telephone);
    
    //recuperation de la ville
    $ville = "SELECT ville FROM lycee where codepostal == $codepostal;";
    $query= $madb->query($ville);
    if($query)
    {
        $res = $query->fetch(PDO::FETCH_ASSOC);
        $ville = $res['ville'];
    }
    $ville = $madb->quote($ville);

    //une fois la ville recuperer on affiche la liste des lycees
    $requete ="INSERT INTO lycee VALUES ($noL,$nom,$adresse,$codepostal,$ville,$telephone);";
    $resultat =$madb->exec($requete);
    if ($resultat == false ) 
        $retour = 0;
    else 
        $retour = $resultat;
    return $retour;
}

//*******************************************************************************************
//Fonction de permetre de modifier un lycee
//Parametre : noL,nom,adresse,telephone
//Retourne un tableau associatif avec les valeurs modifier
function modifierLycee($noL,$nom,$adresse,$tel){
    $retour=0;
    $madb = new PDO('sqlite:bdd/bdd.sqlite');
    $noL = $madb->quote($noL);
    $nom = $madb->quote($nom);
    $adresse = $madb->quote($adresse);
    $tel = $madb->quote($tel);

    $requete = "UPDATE lycee SET nom=$nom,adresse=$adresse,telephone=$tel WHERE noL=$noL";

    $query = $madb->exec($requete);
    if($query)
    {
        $retour=1;
    }
    return $retour;
}
//*********************************************************************************************
//Fonction de permetre de lister les lycées par ville
//Parametre : noL
//Retourne un tableau associatif des lycée avec le meme noL
function listeLyceeParVille($noL){
    $retour=false;
        $madb = new PDO('sqlite:bdd/bdd.sqlite');
        $noL = $madb->quote($noL);
        $requete = "SELECT * FROM lycee WHERE noL = $noL;" ;
        $resultat = $madb->query($requete);
        $tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);
        if (sizeof($tableau_assoc)!=0) $retour = $tableau_assoc;
    return $retour;
    }
?>
