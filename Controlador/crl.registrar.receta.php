<?php session_start();
require_once ('Modelos/funciones.receta.php');
require_once ('Controlador/functions.php');

if(!$_SESSION['user']){
    header('Location: login.php');
};

$errors = [];

if(empty($_SESSION['createRecipeSteps'])){
    $_SESSION['createRecipeSteps'] = [];
}

if(!empty($_POST['postSteps']) && !isset($_POST['stepEditId'])){
    $_SESSION['createRecipeSteps'][] = $_POST['postSteps'];
}

if(isset($_POST['deleteStep'])){
    unset($_SESSION['createRecipeSteps'][$_POST['deleteStep']]);
    $_SESSION['createRecipeSteps'] = array_values($_SESSION['createRecipeSteps']);
}

if(isset($_POST['stepEditId'])){
    $_SESSION['createRecipeSteps']["{$_POST['stepEditId']}"] = $_POST['postSteps'];
}

// if(isset($_POST["tituloPost"]) && isset($_POST["descripcionPost"]) && isset($_POST["postSteps"]) && isset($_FILES["imagenPost"]) && isset($_POST['publicar'])){
if(isset($_POST['publish']) && $_POST['publish'] == 'Publicar'){
    //limpiamos la data
    $RecTitle = clean_data($_POST['tituloPost']);
    $recDescription = clean_data($_POST['descripcionPost']);
    $recSteps = implode('.',$_SESSION['createRecipeSteps']);
    //para saber que es la funcion 'uploadImage()' revisar en Controlador/functions.php
    $dest_path = uploadImage($_FILES["imagenPost"],'Media/recipe/');
    //si lo que nos retorna en la posicion 1 es == false
    //y el error sera igual a la posision en 0
    if(!$dest_path[1]){
        $errors['recipeImage'] = $dest_path[0];
    }
    //si no hay errores
    if($errors == []){
        var_dump($recSteps);
        $spanishDate = SpanishDate();
        $id_usuario = $_SESSION["user"];
        $rec = new Rec($RecTitle, $recDescription, $recSteps, $dest_path[0],$spanishDate,$id_usuario);
        $rec->createRec();
        $_SESSION['createRecipeSteps'] = [];
        header("Location: index.php");
    }
}
?>
