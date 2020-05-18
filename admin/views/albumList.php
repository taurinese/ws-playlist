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

	<h2>Liste complète des albums : </h2>

	<?php foreach($albums as $album): ?>
		<p><?=  htmlspecialchars($album['name']) ?>
		<a href="index.php?controller=albums&action=edit&id=<?= $album['id'] ?>"><button type="button" class="btn btn-warning">Modifier</button></a>  
		<a onclick="return confirm('Are you sure?')" href="index.php?controller=albums&action=delete&id=<?= $album['id'] ?>"><button type="button" class="btn btn-danger">Supprimer</button></a></p>
    <?php endforeach; ?>
    <a href="index.php?controller=albums&action=new"><button type="button" class="btn btn-primary">Ajouter un album</button></a> 
</main>