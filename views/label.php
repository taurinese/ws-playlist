<h1>Label view</h1>

<?php if(isset($_GET['id'])): ?>
    <h2>Nom du label : <?= $label['name'] ?> </h2><br>
    <h3>Artistes liés à <?= $label['name'] ?> : </h3>
    <ul>
        <?php foreach($labelArtists as $artist): ?>
            <li><a href="index.php?p=artist&artist_id=<?= $artist['id'] ?>"><?= $artist['name'] ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <?php foreach($labels as $label): ?>
        <h2>Nom du label : <a href="index.php?p=label&id=<?= $label['id'] ?>"><?= $label['name'] ?></a>  </h2><br>
    <?php endforeach; ?>
<?php endif;?>
