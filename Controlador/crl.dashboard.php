<?php session_start();
require_once ('Modelos/funciones.receta.php');
require_once ('Modelos/funciones.user.php');
require_once ('Controlador/functions.php');
if(!(User::getUserRol($_SESSION['user']) == 2)){
    header('Location: index.php');
}
$users = getUsers();
$rec = Rec::getAllRec();
$recId = $_GET['recipeId'] ?? NULL;
$userId = $_GET['userid'] ?? NULL;
deleteRec($recId);
deleteUserById($userId);
if(!empty($_POST['update'])){
    if ($_POST['update'] == 'Actualizar'){
        $_SESSION['recipeId'] = $_POST['recipeId'];
        header('Location: actualizar.php');
    }
}
?>