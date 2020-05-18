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

	<h2>Liste complète des labels : </h2>

	<?php foreach($labels as $label): ?>
		<p><?=  htmlspecialchars($label['name']) ?>
		<a href="index.php?controller=labels&action=edit&id=<?= $label['id'] ?>"><button type="button" class="btn btn-warning">Modifier</button></a>  
		<a onclick="return confirm('Are you sure?')" href="index.php?controller=labels&action=delete&id=<?= $label['id'] ?>"><button type="button" class="btn btn-danger">Supprimer</button></a></p>
    <?php endforeach; ?>
    <a href="index.php?controller=labels&action=new"><button type="button" class="btn btn-primary">Ajouter un label</button></a> 
</main>

