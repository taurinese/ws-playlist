<?php
function getAllSongs()
{
    $db = dbConnect();
    $query = $db->query('SELECT * FROM songs');
    $songs = $query->fetchAll();

    return $songs;
}

function getSong($songId)
{
    $db = dbConnect();
    $query = $db->prepare("SELECT * FROM songs WHERE id = ? ");
	$query->execute([	
		$songId
	]);
	$song = $query->fetch();
	return $song;
}

function updateSong($id, $informations)
{
	$db = dbConnect();
	
	$query = $db->prepare("UPDATE songs SET title = :title, artist_id = :artist_id, album_id = :album_id WHERE id = :id");
	$result = $query->execute([
		'title' => $informations['title'],
		'artist_id' => $informations['artist_id'],
		'album_id' => $informations['album_id'],
		'id' => $id,
	]);
	return $result;
}

function addSong($informations)
{
    $db = dbConnect();
	
	$query = $db->prepare("INSERT INTO songs (title, artist_id, album_id) VALUES( :title, :artist_id, :album_id)");
	$result = $query->execute([
		'title' => $informations['title'],
		'artist_id' => $informations['artist_id'],
		'album_id' => $informations['album_id'],
    ]);
    
    return $result;
}

function deleteSong($id)
{
	$db = dbConnect();
	
	$query = $db->prepare('DELETE FROM songs WHERE id = ?');
	$result = $query->execute([$id]);
	
	return $result;
}