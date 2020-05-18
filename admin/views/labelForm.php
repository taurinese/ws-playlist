<main class="d-flex flex-column col-9 align-items-center">

<?php if(isset($_SESSION['messages'])): ?>
	<div>
        <?php foreach($_SESSION['messages'] as $message): ?>
			<div class="alert <?= $_SESSION['alertSuccess'] == true ? 'alert-success' : 'alert-danger' ?>" role="alert">
                <?= $message ?><br>
            </div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<h2>Formulaire du label</h2><br>

<form action="index.php?controller=labels&action=<?= 
isset($label) ||(isset($_SESSION['old_inputs']) && $_GET['action'] != 'new')  ? 'edit&id=' . $_GET['id']  : 'add' ?>" 
method="post" enctype="multipart/form-data">

	<label for="name">Nom :</label>
	<input  type="text" name="name" id="name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['title'] : '' ?><?= isset($label) ? $label['name'] : '' ?>" /><br>
	<input type="submit" value="Enregistrer" />

</form>
</main>
