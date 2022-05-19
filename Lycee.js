//*******************************************************************************************
function mdpValide(mdp){
    var reg = /^[a-z0-9._-!*?]+[a-z0-9.-!*?]{8,}[.][a-z]{2,3}$/;
    return (reg.test(mdp)); // retourne Vrai ou Faux
}