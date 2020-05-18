<main class="d-flex flex-row col-9 justify-content-around">
	
	<div> <!-- Div du formulaire -->
		<?php if(isset($_SESSION['messages'])): ?>
			<div>
				<?php foreach($_SESSION['messages'] as $message): ?>
					<div class="alert <?= $_SESSION['alertSuccess'] == true ? 'alert-success' : 'alert-danger' ?>" role="alert">
						<?= $message ?><br>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?> <br>
		<h2>Formulaire de l'artiste</h2>
		<form action="index.php?controller=artists&action=<?= 
		isset($artist) ||(isset($_SESSION['old_inputs']) && $_GET['action'] != 'new')  ? 'edit&id=' . $_GET['id']  : 'add' ?>" 
		method="post" enctype="multipart/form-data">

			<label for="name">Nom :</label>
			<input  type="text" name="name" id="name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['name'] : '' ?><?= isset($artist) ? $artist['name'] : '' ?>" /><br>
			
			<label for="label_id">Label :</label>
			<!--<input  type="text" name="label_id" id="label_id" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['label'] : '' ?><?= isset($artist) ? $artist['label'] : '' ?>" /><br>-->
			<select name="label_id[]" id="label_id" multiple>
				<?php foreach($labels as $label): ?>
					<option value="<?= $label['id'] ?>" <?php if(isset($artist_labels)) foreach($artist_labels as $a_label): ?><?php if(isset($artist) && $label['name'] == $a_label['name']): ?> selected="selected" <?php endif; ?><?php endforeach; ?> ><?= $label['name'] ?></option>
				<?php endforeach; ?>
			</select><br>

			<label for="biography">Bio :</label>
			<textarea name="biography" id="biography"><?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['biography'] : '' ?><?= isset($artist) ? $artist['biography'] : '' ?></textarea><br>
			
			<?php if(isset($artist) && $artist['image'] != null): ?> 
				<span class="badge badge-danger">/!\ Attention, une image existe déjà pour cet artiste /!\</span>
			<?php endif; ?><br>
			<label for="image">image :</label>
			<input type="file" name="image" id="image" /><br>
			
			<input type="submit" value="Enregistrer" />

		</form>
	</div>
	<?php if(isset($artist)): ?>
		<div class="card" style="width: 18rem;">
			<h3 class="border-dark border-bottom">Affichage de l'artiste</h3>
			<?php if(!empty($artist['image'])): ?>
				<img class="card-img-top" src="../assets/images/artist/<?= $artist['image'] ?>" alt="Card image cap">
			<?php endif; ?>
			<div class="card-body">
				<h5 class="card-title"><?= $artist['name'] ?></h5>
				<?php foreach($artist_labels as $a_label): ?>
					<h6 class="card-title"><?= $a_label['name'] ?></h6>
				<?php endforeach; ?>
				<p class="card-text"><?= $artist['biography'] ?></p>
		</div>
	<?php endif; ?>
</main>
