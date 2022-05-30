/*****************************************************************/
function listeFiltreUtilisateurs() {
	var req_AJAX// Objet qui sera crée
	if (window.XMLHttpRequest) {	// Mozilla, Safari
		req_AJAX = new XMLHttpRequest();
	}
	if (req_AJAX) {
        // le navigateur permet AJAX
		// on incrémente ou décrémente l'image
		var ville = document.getElementById("id_ville").value;
		var url = "listeVilleparLycee.php?choix="+ville;
		req_AJAX.open("GET", url, true);
		//req_AJAX.setRequestHeader("Content-Type","application/x-www-form-urlencodesd");
		req_AJAX.send();
		console.log(url);
		req_AJAX.onreadystatechange = function () {
			TraiteListeFiltreUtilisateurs(req_AJAX);
		}
	}
	else {
		alert("EnvoiRequete: pas de XMLHTTP !");
	}
} // fin fonction listeUtilisateurs()

function TraiteListeFiltreUtilisateurs(requete) {
	var ready = requete.readyState;
	if (ready) {
		document.getElementById("test").innerHTML = "en cours";
		var status = requete.status;

		if (status == 200) {
			data = document.getElementById("test").innerHTML = "c'est bon";
			console.log(data);
			document.getElementById("test").innerHTML = requete.responseText;
		}
		else {
			document.getElementById("test").innerHTML = "la requete a echoué";
		}
	}
}

function formulaireModification()   {
    var noL = document.getElementById('id_mail').value;
    var req_AJAX// Objet qui sera crée
    console.log(noL);
	if (window.XMLHttpRequest) {	// Mozilla, Safari
		req_AJAX = new XMLHttpRequest();
	}
	if (req_AJAX) {
        // le navigateur permet AJAX
		// on incrémente ou décrémente l'image
		var url = "formulaireModication.php?choix="+noL;
		req_AJAX.open("GET", url, true);
		//req_AJAX.setRequestHeader("Content-Type","application/x-www-form-urlencodesd");
		req_AJAX.send();
		console.log(url);
		req_AJAX.onreadystatechange = function () {
			TraiteListeFiltreUtilisateurs(req_AJAX);
		}
	}
	else {
		alert("EnvoiRequete: pas de XMLHTTP !");
	}
    
}