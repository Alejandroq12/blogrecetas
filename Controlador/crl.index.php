<?php session_start();
require_once ('Modelos/funciones.receta.php');
if(!$_SESSION['user']){
    header('Location: login.php');
};
$recetas = Rec::getAllRec();
?>