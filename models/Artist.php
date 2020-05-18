<?php
function getArtists($artistId = false){
    $db = dbConnect();
    if($artistId != false){
        $query = $db->prepare("SELECT * FROM artists WHERE id = ?" );
        $query->execute([$artistId]);
        $artists = $query->fetchAll();
    }
    else {
        $query = $db->query('SELECT * FROM artists ');
        $artists = $query->fetchAll();
    }
    return $artists;
}

function getArtist($id){
    $db = dbConnect();
    $query = $db->prepare('SELECT * FROM artists WHERE id = ?');
    $result = $query->execute([$id]);
    if ($result){                   //Si la requête est réussie alors $result == true donc on récupère les données
        return $query->fetch();
    }
    else {                          //Si la requête est ratée alors $result == false donc on retourne false
        return false;
    }
}

function getArtistsByLabelId($labelId)
{
    $db = dbConnect();
    $query = $db->prepare("SELECT a.* FROM artists a INNER JOIN artists_labels al ON a.id = al.artist_id WHERE al.label_id = ? ");
    $query->execute([ $labelId ]);

    return $query->fetchAll();
}
