<?php 

require('models/Artist.php');
require('models/Label.php');

if($_GET['action'] == 'list'){
	$artists = getAllArtists();
	$view['content'] = 'views/artistList.php';
	$view['title'] = 'Liste artistes';
}
elseif($_GET['action'] == 'new'){
	$labels = getAllLabels();
	$view['content'] = 'views/artistForm.php';
	$view['title'] = 'Formulaire artiste';
}
elseif($_GET['action'] == 'add'){
	//die(var_dump($_POST));
	if(empty($_POST['name']) /*|| empty($_POST['label_id'])*/){
		
		if(empty($_POST['name'])){
			$_SESSION['messages'][] = 'Le champ "nom" est obligatoire !';
		}
		/* if(empty($_POST['label_id'])){
			$_SESSION['messages'][] = 'Le champ "label" est obligatoire !';
		} */
		$_SESSION['alertSuccess'] = false;
		$_SESSION['old_inputs'] = $_POST;
		header('Location:index.php?controller=artists&action=new');
		exit;
	}
	else{
		$resultAdd = addArtist($_POST);
		$_SESSION['messages'][] = $resultAdd ? 'Artiste enregistré !' : "Erreur lors de l'enregistrement de l'artiste... :(";
		$_SESSION['alertSuccess'] = $resultAdd ? true : false;
		header('Location:index.php?controller=artists&action=list');
		exit;
	}
}
elseif($_GET['action'] == 'edit'){

	$labels = getAllLabels();
	$artist_labels = getLabelByArtistId($_GET['id']);
	if(empty($_POST)){
		// On récupère les infos pour le pré-remplissage
		if(!isset($_SESSION['old_inputs'])){
			$artist = getArtist($_GET['id']);
			if($artist == false){
				header('Location:index.php?controller=artists&action=list');
				exit;
			}
		}
		$view['content'] = 'views/artistForm.php';
		$view['title'] = 'Formulaire artiste';
	}
	else{
		if(empty($_POST['name'])){
			$_SESSION['messages'][] = 'Le champ nom est obligatoire !';		
			$_SESSION['old_inputs'] = $_POST;
			$_SESSION['alertSuccess'] = false;
			header('Location:index.php?controller=artists&action=edit&id=' . $_GET['id']);
			exit;
		}
		else {
			$result = updateArtist($_GET['id'], $_POST);
			$_SESSION['messages'][] = $result ? 'Artiste modifié !' : "Erreur lors de la modification de l'artiste... :(";
			$_SESSION['alertSuccess'] = $result ? true : false;
			header('Location:index.php?controller=artists&action=list');
			exit;
		}

	}
}
elseif($_GET['action'] == 'delete'){
	$result = deleteArtist(   $_GET['id']    );
	$_SESSION['messages'][] = $result ? 'Artiste supprimé !' : 'Erreur lors de la suppression... :(';
	$_SESSION['alertSuccess'] = $result ? true : false;
	header('Location:index.php?controller=artists&action=list');
	exit;
}

