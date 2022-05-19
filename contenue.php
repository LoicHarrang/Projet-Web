<?php //Page avec tout le contenue des pages en fontion des utilisateurs

//******************************************************************************


//******************************************************************************
function contenue_accueil_index()  {
    ?>
            <div  class ="container mt-5" id="accueil">

                <div class="card offset-1 col-10 ">
                    <div class="card-body">
                        <div class="container">
                            <div class="text-center card-title">
                                <!-- Heading -->
                                <h2 class="h2 text-center mb-4 my-sm-4 ">Page d'accueil des Lycées de France</h2>
                            </div>
                            <div class="card-text ">
                                <p class="text-center">
                                    <?php 
                                    echo "<h3> Bienvenue ".$_SESSION["login"]."</br>
                                    Vous êtes un ".$_SESSION["statut"]."</h3>";
                                    ?>
                                    <br />
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <?php
}

//******************************************************************************
function contenue_accueil_insertion()  {
    ?>
        
            <div  class ="container my-5" id="accueil">

                <div class="card offset-1 col-10 ">
                    <div class="card-body">
                        <div class="container">
                            <div class="text-center card-title">
                                <!-- Heading -->
                                <h2 class="h2 text-center mb-4 my-sm-4 ">Page d'Insertion</h2>
                            </div>
                            <div class="card-text ">
                                <p class="text-center">
                                    <?php
                                    echo "<h5> Choisir l'utilisiateur à inserer</h5>";
}

function contenue_modification()  {
    ?>

    <div  class ="container my-5" id="accueil">

        <div class="card offset-1 col-10 ">
            <div class="card-body">
                <div class="container">
                    <div class="text-center card-title">
                        <!-- Heading -->
                        <h2 class="h2 text-center mb-4 my-sm-4 ">Page de modification</h2>
                    </div>
                    <div class="card-text ">
                        <p class="text-center">
    <?php
    echo "<h5> Choisir l'utilisiateur à modifier</h5>";
}
?>