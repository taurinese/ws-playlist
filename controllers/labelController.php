<?php 
require 'models/Label.php';
require 'models/Artist.php';

if(isset($_GET['id'])){
    //Affichage d'un label en particulier
    //Vérifier que l'id existe en base de données
    $label = getLabel($_GET['id']);
    $labelArtists = getArtistsByLabelId($_GET['id']);
}
else{
    //Affichage de tous les labels
    $labels = getAllLabels();
}

include 'views/label.php';

