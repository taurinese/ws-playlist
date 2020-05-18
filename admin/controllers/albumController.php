<?php
require('models/Album.php');
require('models/Artist.php');

if(isset($_GET['action'])){
   switch ($_GET['action']) {
        case 'list':
            $albums = getAllAlbums();
            $view['content'] = 'views/albumList.php';
            $view['title'] = 'Liste albums';
        break;
        
        case 'new':
            $artists = getAllArtists();
            $view['content'] = 'views/albumForm.php';
            $view['title'] = 'Formulaire album';
        break;

        case 'add':
            if(!isset($_POST['name']) || !isset($_POST['year']) ||!isset($_POST['artist_id'])){
                if(!isset($_POST['name'])){
                    $_SESSION['messages'][] = 'Le champ "nom est obligatoire !';
                }
                if(!isset($_POST['year'])){
                    $_SESSION['messages'][] = 'Le champ "année"" est obligatoire !';
                }
                if(!isset($_POST['artist_id'])){
                    $_SESSION['messages'][] = 'Le champ "artiste" est obligatoire !';
                }
                $_SESSION['old_inputs'] = $_POST;
                $_SESSION['alertSuccess'] = false;
                header('Location:index.php?controller=albums&action=new');
                exit;
            }
            else{
                //Ajout de l'album
                $resultAdd = addAlbum($_POST);
                $_SESSION['messages'][] = $resultAdd ? 'Album enregistré !' : "Erreur lors de l'enregistrement de l'album... :(";
                $_SESSION['alertSuccess'] = $resultAdd ? true : false;
                header('Location:index.php?controller=albums&action=list');
		        exit;
	        }
        break;   

        case 'edit':                
            //$album = getAlbum($_GET['id']);
            $artists = getAllArtists();
            if(empty($_POST)){
                if(!isset($_SESSION['old_inputs'])){
                    $album = getAlbum($_GET['id']);
                    if($album == false){
                        header('Location:index.php?controller=artists&action=list');
                        exit;
                    }
                }
                $view['content'] = 'views/albumForm.php';
                $view['title'] = 'Formulaire album';
            }
            else{
                if(empty($_POST['name']) || empty($_POST['year']) || empty($_POST['artist_id'])){
                    if(empty($_POST['name'])){
                        $_SESSION['messages'][] = 'Le champ "nom est obligatoire !';
                    }
                    if(empty($_POST['year'])){
                        $_SESSION['messages'][] = 'Le champ "année" est obligatoire !';
                    }
                    if(empty($_POST['artist_id'])){
                        $_SESSION['messages'][] = 'Le champ "artiste" est obligatoire !';
                    }
                    $_SESSION['old_inputs'] = $_POST;
                    $_SESSION['alertSuccess'] = false;
                    header('Location:index.php?controller=albums&action=edit&id=' . $_GET['id']);
                    exit;
                }
                else {
                    $result = updateAlbum($_GET['id'], $_POST);
                    $_SESSION['messages'][] = $result ? 'Album modifié !' : "Erreur lors de la modification de l'album... :(";
                    $_SESSION['alertSuccess'] = $result ? true : false;
                    header('Location:index.php?controller=albums&action=list');
                    exit;
                }
            }   
        break;

        case 'delete':
            $result = deleteAlbum($_GET['id']);
            $_SESSION['messages'][] = $result ? 'Album supprimé !' : "Erreur lors de la suppression de l'album... :(";
            $_SESSION['alertSuccess'] = $result ? true : false;
            header('Location:index.php?controller=albums&action=list');
            exit;
        break;

        default:
            header('Location:index.php?controller=albums&action=list');
            exit;
        break;
    } 
}
