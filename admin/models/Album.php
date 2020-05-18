<?php 
function getAllAlbums()
{
    $db = dbConnect();
    $query = $db->query('SELECT * FROM albums');
    $albums = $query->fetchAll();

    return $albums;
}

function getAlbum($albumId)
{
    $db = dbConnect();
    $query = $db->prepare("SELECT * FROM albums WHERE id = ? ");
	$query->execute([	
		$albumId
	]);
	$album = $query->fetch();
	return $album;
}

function updateAlbum($id, $informations)
{
	$db = dbConnect();
	
	$query = $db->prepare("UPDATE albums SET name = :name, year = :year, artist_id = :artist_id WHERE id = :id");
	$result = $query->execute([
		'name' => $informations['name'],
		'year' => $informations['year'],
		'artist_id' => $informations['artist_id'],
		'id' => $id,
	]);
	return $result;
}

function addAlbum($informations)
{
    $db = dbConnect();
	
	$query = $db->prepare("INSERT INTO albums (name, year, artist_id) VALUES( :name, :year, :artist_id)");
	$result = $query->execute([
		'name' => $informations['name'],
		'year' => $informations['year'],
		'artist_id' => $informations['artist_id'],
    ]);
    
    return $result;
}

function deleteAlbum($id)
{
	$db = dbConnect();
	
	$query = $db->prepare('DELETE FROM albums WHERE id = ?');
	$result = $query->execute([$id]);
	
	return $result;
}