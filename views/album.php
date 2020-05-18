<div class="card" style="width: 18rem;">    
  <h3 class="text-center border-dark border-bottom card-title"><?= $album['name'] ?></h3>
    <div class="card-body">
      <h6> Année :
        <?= $album['year'] ?>
      </h6>
      <h6>
        Artiste:
        <a href="index.php?p=artist&artist_id=<?= $artist['id'] ?>"><?= $artist['name'] ?></a> 
      </h6>
      <?php if(sizeof($songs) > 0): ?>
      <h6> Chansons :</h6>
      <ul>
        <?php foreach($songs as $song): ?>
          <li><a href="index.php?p=song&song_id=<?= $song['id'] ?>"><?= $song['title'] ?></a></li>
        <?php endforeach; ?>
      </ul>
      <?php else: ?>
        <p>aucune chanson pour cet album</p>
      <?php endif; ?>
    </div>
</div>