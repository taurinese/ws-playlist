<?php
function getAllLabels()
{
    $db = dbConnect();
    $query = $db->query('SELECT * FROM labels');
    $labels = $query->fetchAll();

    return $labels;
}

function getLabel($labelId)
{
    $db = dbConnect();
    $query = $db->prepare("SELECT * FROM labels WHERE id = ? ");
	$query->execute([	
		$labelId
	]);
	$label = $query->fetch();
	return $label;
}

function getLabelByArtistId($artistId)
{
    $db = dbConnect();
    $query = $db->prepare("SELECT l.* FROM labels l INNER JOIN artists_labels al ON l.id = al.label_id WHERE al.artist_id = ? ");
    $query->execute([ $artistId ]);

    return $query->fetchAll();
}

function updateLabel($id, $informations)
{
	$db = dbConnect();
	
	$query = $db->prepare("UPDATE labels SET name = :name WHERE id = :id");
	$result = $query->execute([
        'name' => $informations['name'],
        'id' => $id
	]);
	return $result;
}

function addLabel($informations)
{
    $db = dbConnect();
	
	$query = $db->prepare("INSERT INTO labels (name) VALUES( :name )");
	$result = $query->execute([
		'name' => $informations['name']
    ]);
    
    return $result;
}

function deleteLabel($id)
{
	$db = dbConnect();
	
	$query = $db->prepare('DELETE FROM labels WHERE id = ?');
	$result = $query->execute([$id]);
	
	return $result;
}