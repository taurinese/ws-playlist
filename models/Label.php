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
    $query = $db->prepare('SELECT * FROM labels WHERE id = ?');
    $query->execute([ $labelId ]);

    return $query->fetch();
}

function getLabelByArtistId($artistId)
{
    $db = dbConnect();
    $query = $db->prepare("SELECT l.* FROM labels l INNER JOIN artists_labels al ON l.id = al.label_id WHERE al.artist_id = ? ");
    $query->execute([ $artistId ]);

    return $query->fetchAll();
}
