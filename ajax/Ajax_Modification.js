/*****************************************************************/
//Function
function listeFiltreUtilisateurs() {
	var req_AJAX// Objet qui sera crée
	if (window.XMLHttpRequest) {	// Mozilla, Safari
		req_AJAX = new XMLHttpRequest();
	}
	if (req_AJAX) {
        // le navigateur permet AJAX

		//On récupere les différentes values
		var ville = document.getElementById("id_ville").value;
		var noL = document.getElementById("id_noL").value;
		var nom = document.getElementById("id_nom").value;
		var adr = document.getElementById("id_adr").value;
		var tel = document.getElementById("id_tel").value;

		//On crée l'url grace a ces valeurs
		var url = "Ajax_Modification.php?ville="+ville+"&noL="+noL+"&nom="+nom+"&adr="+adr+"&tel="+tel;
		
		req_AJAX.open("GET", url, true); //Action que l'on va demander au serveur / requete Get vec l'url préciser avant
		//req_AJAX.setRequestHeader("Content-Type","application/x-www-form-urlencodesd");

		//ON envoie la requete
		req_AJAX.send();

		//Permet de voir l'url envoié
		console.log(url);
		req_AJAX.onreadystatechange = function () {//onreadystatechange spécifie une fonction (callback) appelée automatiquement lorsque la requête change d’état (traitement asynchrone)
			//Appelle la fonction qui affichera le contenue sur la page
			TraiteListeFiltreUtilisateurs(req_AJAX);
			
		}
	}
	else {
		alert("EnvoiRequete: pas de XMLHTTP !");
	}
} // fin fonction listeUtilisateurs()

function TraiteListeFiltreUtilisateurs(requete) {// On reçoit en paramètre l'objet XMLHttpRequest
	var ready = requete.readyState; // récupère l'état de la requête
	if (ready) {
		document.getElementById("formulaire_tableau").innerHTML = "en cours";
		//On recupere la valeur de le code HTTP de la requete
		var status = requete.status;

		if (status == 200) {
			//On affiche sur la pgae modification le contenue de la page qui avait été appellé grace a l'url
			document.getElementById("formulaire_tableau").innerHTML = requete.responseText;
		}
		else {
			console.log("la requete a echoué");
		}
	}
}

function formulaireModification()   {
    var noL = document.getElementById('id_mail').value;
    var req_AJAX2// Objet qui sera crée
    console.log(noL);
	if (window.XMLHttpRequest) {	// Mozilla, Safari
		req_AJAX2 = new XMLHttpRequest();
	}
	if (req_AJAX2) {
        // le navigateur permet AJAX

		//On crée l'url grace au noL
		var url = "formulaireModification.php?noL="+noL;

		req_AJAX2.open("GET", url, true);
		//req_AJAX.setRequestHeader("Content-Type","application/x-www-form-urlencodesd");

		//ON envoie la requete 
		req_AJAX2.send();

		//ON affiche l'url dans les log
		console.log(url);
		req_AJAX2.onreadystatechange = function () {//onreadystatechange spécifie une fonction (callback) appelée automatiquement lorsque la requête change d’état (traitement asynchrone)
			//Appelle la fonction qui affichera le contenue sur la page
			TraiteListeFiltreUtilisateurs(req_AJAX2);
		}
	}
	else {
		alert("EnvoiRequete: pas de XMLHTTP !");
	}
    
}