<?php

function getAllArtists()
{
    $db = dbConnect();

    $query = $db->query('SELECT * FROM artists');
	$artists =  $query->fetchAll();

    return $artists;
}

function getArtist($artist_id)
{
	$db = dbConnect();
	$query = $db->prepare("SELECT * FROM artists WHERE id = ? ");
	$query->execute([	
		$artist_id
	]);
	$artist = $query->fetch();
	return $artist;
}


function updateArtist($id, $informations)
{
	$db = dbConnect();
	
	$query = $db->prepare("UPDATE artists SET name = :name, biography = :biography WHERE id = :id");
	$result = $query->execute([
		'name' => $informations['name'],
		'biography' => $informations['biography'],
		'id' => $id,
	]);
	if($result) $result = deleteArtistLabel($id, $db);
	if($result){
		foreach($informations['label_id'] as $label){
			$result = addArtistLabel($id, $label, $db); // ici
			if(!$result){
				break;
			}
		}
	}
	if($result && !empty($_FILES['image']['tmp_name'])) $result = updateArtistImg(true, $db, $id);
	return $result;
}

function addArtist($informations)
{
	$db = dbConnect();
	
	$query = $db->prepare("INSERT INTO artists (name, biography) VALUES( :name, :biography)");
	$result = $query->execute([
		'name' => $informations['name'],
		'biography' => $informations['biography'],
	]);
	$artistId = $db->lastInsertId();
	if($result){
		foreach($informations['label_id'] as $label){
			$result = addArtistLabel($artistId, $label, $db); // ici
			if(!$result){
				break;
			}
		}
	}
	// $result vaut null ??? alors qu'en insérant une image également, $result vaut true
	if($result && !empty($_FILES['image']['tmp_name'])){
		$result = updateArtistImg(false, $db, $artistId);
	}
	
	return $result;
}

function addArtistLabel($artistId, $labelId, $db)
{
	$query = $db->prepare('INSERT INTO artists_labels (artist_id, label_id) VALUES ( :artist_id, :label_id)');
	$result = $query->execute([
		'artist_id' => $artistId,
		'label_id' => $labelId
	]);
	return $result;
}

function deleteArtistLabel($artistId, $db)
{
	$query = $db->prepare('DELETE FROM artists_labels WHERE artist_id = ?');
	$result = $query->execute([
		$artistId,
	]);
	
	return $result;
}

function updateArtistImg($fileMayExists = true, $db, $artistId)
{
	if($fileMayExists == true){
		//Vérification si image déjà présente
		$result = imageExists($artistId, $db);
		$fileMayExists = !empty($result) ? true : false;
		//Si oui, suppression de l'ancienne image
		if ($fileMayExists){
			unlink('../assets/images/artist/' . $result['image']) ;
			$fileMayExists = false;
		} 
	}
	if($fileMayExists == false){
		//Insertion de l'image
		$allowed_extensions = array( 'jpg' , 'jpeg' , 'gif', 'png', 'jfif' );
		$my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);
		if (in_array($my_file_extension , $allowed_extensions)){
			$new_file_name = $artistId . '.' . $my_file_extension ;
			$destination = '../assets/images/artist/' . $new_file_name;
			$result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);
			if($result){
				$query = $db->prepare("UPDATE artists SET image = '$new_file_name' WHERE id = ? ");
				return $query->execute([$artistId]);
			}
			
		}
	}
	return false;
	
}

function deleteArtist($id)
{
	$db = dbConnect();
	
	//ne pas oublier de supprimer le fichier lié s'il y en un
	//avec la fonction unlink de PHP
	$result = imageExists($id, $db);
	if(!empty($result)) unlink('../assets/images/artist/' . $result['image']) ;
	$query = $db->prepare('DELETE FROM artists WHERE id = ?');
	$result = $query->execute([$id]);
	
	return $result;
}

function imageExists($id, $db)
{
	$query = $db->prepare('SELECT image FROM artists WHERE id = ?');
	$query->execute([$id]);
	$result = $query->fetch();
	return $result;
}