<div class="card" style="width: 18rem;">
			<h3 class="text-center border-dark border-bottom card-title"><?= $artist['name'] ?></h3>
			<?php if(!empty($artist['image'])): ?>
				<img class="card-img-top" src="./assets/images/artist/<?= $artist['image'] ?>" alt="Card image cap">
			<?php endif; ?>
			<div class="card-body">
        <h6>Label:</h6>
        <ul>
          <?php foreach($artist_labels as $a_label): ?>
					  <li><a href="index.php?p=label&id=<?= $a_label['id'] ?>"><h6><?= $a_label['name'] ?></h6></a> </li>
          <?php endforeach; ?>
        </ul>
        <?php if(sizeof($albums) > 0): ?>
          <h6>Album:</h6>
          <ul>
            <?php foreach($albums as $album): ?>
              <li><a href="index.php?p=album&album_id=<?= $album['id'] ?>"><h6><?= $album['name'] ?></h6></a></li>
            <?php endforeach; ?>
          </ul>
          <?php else: ?>
            <p>aucun album pour cet artiste</p>
          <?php endif; ?>
				<p class="card-text"><?= $artist['biography'] ?></p>
		</div>