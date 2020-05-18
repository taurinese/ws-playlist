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

	<h2>Liste complète des artistes : </h2>

	<?php foreach($artists as $artist): ?>
		<p><?=  htmlspecialchars($artist['name']) ?>
		<a href="index.php?controller=artists&action=edit&id=<?= $artist['id'] ?>"><button type="button" class="btn btn-warning">Modifier</button></a>  
		<a onclick="return confirm('Are you sure?')" href="index.php?controller=artists&action=delete&id=<?= $artist['id'] ?>"><button type="button" class="btn btn-danger">Supprimer</button></a></p>
	<?php endforeach; ?>
	<a href="index.php?controller=artists&action=new"><button type="button" class="btn btn-primary">Ajouter un artiste</button></a> 

</main>

