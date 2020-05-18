<div class="card" style="width: 18rem;">
  <h3 class="text-center border-dark border-bottom card-title"><?= $song['title'] ?></h3>
  <div class="card-body">
    <h6>Artiste :
      <a href="index.php?p=artist&artist_id=<?= $song['artist_id'] ?>"><?= $artist['name'] ?></a> 
    </h6>
    <h6>Album :
      <a href="index.php?p=album&album_id=<?= $song['album_id'] ?>"><?= $album['name'] ?></a> 
    </h6>  
  </div>
</div>