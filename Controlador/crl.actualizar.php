<?php session_start();
require_once ('Modelos/funciones.receta.php');
require_once ('Modelos/funciones.referer.php');
require_once ('Controlador/functions.php');
#rec es igual a decir receta

if(isset($_SESSION['recipeId'])){
    $rec = Rec::getRec($_SESSION['recipeId']);
    $recSteps = explode('.',$rec['pasosPost']);
}
else{
    header("Location: index.php");
}
if(!isset($_SESSION['updateSteps'])){
    $_SESSION['updateSteps'] = [];
}
if(empty($_SESSION['updateSteps'])){
    foreach($recSteps as $step){
        $_SESSION['updateSteps'][] = $step;
    }
}
if(!empty($_POST['postSteps']) && !isset($_POST['stepEditId'])){
    $_SESSION['updateSteps'][] = $_POST['postSteps'];
}
if(isset($_POST['deleteStep'])){
    unset($_SESSION['updateSteps']["{$_POST['deleteStep']}"]);
    $_SESSION['updateSteps'] = array_values($_SESSION['updateSteps']);
}
if(isset($_POST['stepEditId'])){
    $_SESSION['updateSteps']["{$_POST['stepEditId']}"] = $_POST['postSteps'];
}
if(isset($_POST['publish']) && $_POST['publish'] == 'Actualizar'){
    // la funcion clean data nos ayuda a reducir alguna inyeccion de  scripts js vease en Controlador/functions.php
    $title = clean_data($_POST['postTitle']);
    $descripcion = clean_data($_POST['descriptionPost']);
    $postSteps = implode('.',$_SESSION['updateSteps']);
    $id = clean_data($_POST['actualizarId']);
    ["imagenPost" => $imagenPost] = $_FILES;
    $imagenLast = Rec::getImagePathById($id);
    if(!empty($imagenPost) && !empty($imagenPost["tmp_name"])){
        unlink($imagenLast);
        rename($imagenLast, dirname($imagenLast) . "/" . $imagenPost["name"]);
        move_uploaded_file($imagenPost["tmp_name"], $imagenLast);
    }
    $uploadReceta = new Rec($title,$descripcion,$postSteps,$imagenLast,null,null);
    $uploadReceta->updateRecById($id);
    $_SESSION['updateSteps'] = [];
    header("Location: index.php");
}
