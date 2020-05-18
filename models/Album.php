<?php
function getAlbums($artistId = false){

  $db = dbConnect();
  if($artistId != false){
      $query = $db->prepare('SELECT * FROM albums WHERE artist_id = ?');
      $query->execute([$artistId]);
      $selectedAlbums = $query->fetchAll();
  }
  else{
      $query = $db->query('SELECT * FROM albums ');
      $selectedAlbums = $query->fetchAll();
  }

  return $selectedAlbums;
}

function getAlbum($id){
    $db = dbConnect();
    $query = $db->prepare('SELECT * FROM albums WHERE id = ?');
    $result = $query->execute([$id]);
    if($result){                    //Si la requête est réussie alors $result == true donc on récupère les données
        return $query->fetch();
    }
    else {                          //Si la requête est ratée alors $result == false donc on retourne false
        return false;
    }
}
