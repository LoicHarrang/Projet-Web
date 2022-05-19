<?php
//*******************************************************************************************
//Nom : redirect()
//Role : Permet une redirection en javascript
//Parametre : URL de redirection et Délais avant la redirection
//Retour : Aucun
//*******************
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

function afficheTableauHTML($tab){
    echo '<table>';
    // les entetes des colonnes qu'on lit dans le premier tableau par exemple
    echo '<tr>';
    foreach($tab[0] as $cle=>$valeur){
        echo "<th>$cle</th>";
    }
    echo "</tr>\n";
    // le corps de la table
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
?>