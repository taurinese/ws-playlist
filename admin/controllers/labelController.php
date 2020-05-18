<?php
require('models/Label.php');

switch ($_GET['action']) {
    case 'list':
        $labels = getAllLabels();
        $view['content'] = 'views/labelList.php';
        $view['title'] = 'Liste labels'; 
    break;

    case 'add':
        if(empty($_POST['name'])){
		    $_SESSION['messages'][] = 'Le champ "nom" est obligatoire !';
            $_SESSION['old_inputs'] = $_POST;
            $_SESSION['alertSuccess'] = false;
            header('Location:index.php?controller=labels&action=new');
            exit;
        }
        else{
            $resultAdd = addLabel($_POST);
            $_SESSION['messages'][] = $resultAdd ? 'Label enregistré !' : "Erreur lors de l'enregistrement du label... :(";
            $_SESSION['alertSuccess'] = $resultAdd ? true : false;
            header('Location:index.php?controller=labels&action=list');
            exit;
        } 
    break;

    case 'new':
        $view['content'] = 'views/labelForm.php';
        $view['title'] = 'Formulaire label';
    break;

    case 'edit':
        if(empty($_POST)){
            if(!isset($_SESSION['old_inputs'])){
                $label = getLabel($_GET['id']);
                if($label == false){
                    header('Location:index.php?controller=artists&action=list');
                    exit;
                }
            }
            $view['content'] = 'views/labelForm.php';
            $view['title'] = 'Formulaire label';
        }
        else{
            if(empty($_POST['name'])){
                $_SESSION['messages'][] = 'Le champ "nom" est obligatoire !';
                $_SESSION['old_inputs'] = $_POST;
                $_SESSION['alertSuccess'] = false;
                header('Location:index.php?controller=labels&action=edit&id=' . $_GET['id']);
                exit;
            }
            else{
                $result = updateLabel($_GET['id'], $_POST);
                $_SESSION['messages'][] = $result ? 'Label modifié !' : "Erreur lors de la modification du label... :(";
                $_SESSION['alertSuccess'] = $result ? true : false;
                header('Location:index.php?controller=labels&action=list');
                exit;
            }
        }
    break;

    case 'delete':
        $result = deleteLabel(   $_GET['id']    );
        $_SESSION['messages'][] = $result ? 'Label supprimé !' : "Erreur lors de la suppression du label... :(";
        $_SESSION['alertSuccess'] = $result ? true : false;
        header('Location:index.php?controller=labels&action=list');
        exit;
    break;

    default:
        header('Location:index.php?controller=labels&action=list');
        exit;
    break;
}