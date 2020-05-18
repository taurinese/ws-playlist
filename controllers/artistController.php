<?php

if(!isset($_GET['artist_id']) || !ctype_digit($_GET['artist_id'])){
  header('Location:index.php');
  exit;
}

require 'models/Album.php';
require 'models/Artist.php';
require 'models/Label.php';

$artist = getArtist($_GET['artist_id']);


if($artist == false){
  header('Location:index.php');
  exit;
}

$artist_labels = getLabelByArtistId($_GET['artist_id']);
$albums = getAlbums($artist['id']);

include 'views/artist.php';
