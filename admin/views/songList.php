<main class="col-9">
	<?php if(isset($_SESSION['messages'])): ?>
	<div>
		<?php foreach($_SESSION['messages'] as $message): ?>
			<div class="alert <?= $_SESSION['alertSuccess'] == true ? 'alert-success' : 'alert-danger' ?>" role="alert">
                <?= $message ?><br>
            </div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>

	<h2>Liste complète des chansons : </h2>

	<?php foreach($songs as $song): ?>
		<p><?=  htmlspecialchars($song['title']) ?>
		<a href="index.php?controller=songs&action=edit&id=<?= $song['id'] ?>"><button type="button" class="btn btn-warning">Modifier</button></a>  
		<a onclick="return confirm('Are you sure?')" href="index.php?controller=songs&action=delete&id=<?= $song['id'] ?>"><button type="button" class="btn btn-danger">Supprimer</button></a></p>
    <?php endforeach; ?>
    <a href="index.php?controller=songs&action=new"><button type="button" class="btn btn-primary">Ajouter une chanson</button></a> 
</main>

