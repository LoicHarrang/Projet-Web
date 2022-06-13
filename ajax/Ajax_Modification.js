/*****************************************************************/
//Function
function listeFiltreUtilisateurs() {
	var req_AJAX// Objet qui sera crée
	if (window.XMLHttpRequest) {	// Mozilla, Safari
		req_AJAX = new XMLHttpRequest();
	}
	if (req_AJAX) {
        // le navigateur permet AJAX
		// on incrémente ou décrémente l'image
		var ville = document.getElementById("id_ville").value;
		var noL = document.getElementById("id_noL").value;
		var nom = document.getElementById("id_nom").value;
		var adr = document.getElementById("id_adr").value;
		var tel = document.getElementById("id_tel").value;
		var url = "Ajax_Modification.php?ville="+ville+"&noL="+noL+"&nom="+nom+"&adr="+adr+"&tel="+tel;
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
			document.getElementById("test").innerHTML = requete.responseText;
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
		// on incrémente ou décrémente l'image
		var url = "formulaireModification.php?noL="+noL;
		req_AJAX2.open("GET", url, true);
		//req_AJAX.setRequestHeader("Content-Type","application/x-www-form-urlencodesd");
		req_AJAX2.send();
		console.log(url);
		req_AJAX2.onreadystatechange = function () {
			TraiteListeFiltreUtilisateurs(req_AJAX2);
		}
	}
	else {
		alert("EnvoiRequete: pas de XMLHTTP !");
	}
    
}