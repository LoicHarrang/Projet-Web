<?php
include 'fonctions.php';
if(isset($_POST['nom']) && isset($_POST['adr']) && isset($_POST['tel']))
{
    modifierLycee($_SESSION['modif'],$_POST['nom'],$_POST['adr'],$_POST['tel']);

}
?>