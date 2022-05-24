//*******************************************************************************************
function mdpValide(){
    var mdp = document.getElementById(id_pass).value;
    console.log(mdp);
    var res = false
    var pass = /^(?=.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/;
    res = pass.test(mdp);
    if (res == 1) {
    console.log(res);
    }
    else {
        console.log('erreur');
    }
    return false; // retourne Vrai ou Faux

}
