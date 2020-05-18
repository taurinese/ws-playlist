<?php
require('models/Song.php');
require('models/Album.php');
require('models/Artist.php');

switch ($_GET['action']) {
    case 'list':
        $songs = getAllSongs();
        $view['content'] = 'views/songList.php';
        $view['title'] = 'Liste chansons';
    break;

    case 'add':
        if(empty($_POST['title']) || empty($_POST['artist_id'])){
		
            if(empty($_POST['title'])){
                $_SESSION['messages'][] = 'Le champ "titre" est obligatoire !';
            } 
            if(empty($_POST['artist_id'])){
                $_SESSION['messages'][] = 'Le champ "artiste" est obligatoire !';
            }
            
            $_SESSION['old_inputs'] = $_POST;
            $_SESSION['alertSuccess'] = false;
            header('Location:index.php?controller=songs&action=new');
            exit;
        }
        else{
            if(empty($_POST['album_id'])) $_POST['album_id'] = null;
            $resultAdd = addSong($_POST);
            $_SESSION['messages'][] = $resultAdd ? 'Chanson enregistrée !' : "Erreur lors de l'enregistrement de la chanson... :(";
            $_SESSION['alertSuccess'] = $resultAdd ? true : false;
            header('Location:index.php?controller=songs&action=list');
            exit;
        } 
    break;

    case 'new':
        $artists=getAllArtists();
        $albums=getAllAlbums();
        $view['content'] = 'views/songForm.php';
        $view['title'] = 'Formulaire chanson';
    break;

    case 'edit':
        $song = getSong($_GET['id']);
        $artists=getAllArtists();
        $albums=getAllAlbums();
        if(empty($_POST)){
            if(!isset($_SESSION['old_inputs'])){
                $song = getSong($_GET['id']);
                if($song == false){
                    header('Location:index.php?controller=artists&action=list');
                    exit;
                }
            }
            $view['content'] = 'views/songForm.php';
            $view['title'] = 'Formulaire chanson';
        }
        else{
            if(empty($_POST['title']) || empty($_POST['artist_id'])){
		
                if(empty($_POST['title'])){
                    $_SESSION['messages'][] = 'Le champ "titre" est obligatoire !';
                }
                if(empty($_POST['artist_id'])){
                    $_SESSION['messages'][] = 'Le champ "artiste" est obligatoire !';
                }
                
                $_SESSION['old_inputs'] = $_POST;
                $_SESSION['alertSuccess'] = false;
                header('Location:index.php?controller=songs&action=edit&id=' . $_GET['id']);
                exit;
            }
            else{
                if(empty($_POST['album_id'])) $_POST['album_id'] = null;
                $result = updateSong($_GET['id'], $_POST);
                $_SESSION['messages'][] = $result ? 'Chanson modifiée !' : "Erreur lors de la modification de la chanson... :(";
                $_SESSION['alertSuccess'] = $result ? true : false;
                header('Location:index.php?controller=songs&action=list');
                exit;
            }
        }
    break;

    case 'delete':
        $result = deleteSong(   $_GET['id']    );
        $_SESSION['messages'][] = $result ? 'Chanson supprimée !' : 'Erreur lors de la suppression... :(';
        $_SESSION['alertSuccess'] = $result ? true : false;
        header('Location:index.php?controller=songs&action=list');
        exit;
    break;

    default:
        header('Location:index.php?controller=songs&action=list');
        exit;
    break;
}