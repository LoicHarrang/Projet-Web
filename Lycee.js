
function validMdp() {
    var res = false;
    var text = document.getElementById('msg_mdp');
    var mdp = document.getElementById('id_pass').value;
    console.log(mdp);
    var pass = /^(?=.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/;
    if(pass.test(mdp)==true && mdp.length > 7){
        //alert("Votre mdp est bon");
        res = true;
       
        }
       else
       { 
           res = false;
           var message = "Le mot de passe est invalide!!! Il doit faire 8 caractères et doit contenir au moins 1 majuscule, 1 minuscule , 1 caractère speciale et un chiffre ";
           console.log(message);
           text.innerHTML = message;
           text.style.color = 'red';
           document.getElementById('test_mdp').style.color = 'red';
           document.getElementById('id_pass').style.color = 'red';

       }
   return res

}
