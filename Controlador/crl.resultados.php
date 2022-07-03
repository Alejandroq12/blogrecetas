<?php session_start();
require_once ('Modelos/funciones.receta.php');
#Aqui evaluamos si hay algo escrito en $POST search que viene de la pagina principal
if(isset($_POST['search'])){
        $rec = Rec::getRecByTitle($_POST['search']);
}
else{
    header('Location: index.php');
}
?>