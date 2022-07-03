<?php session_start();
require_once ('Modelos/funciones.user.php');
require_once ('Controlador/functions.php');
$errors = [];
if(isset($_POST['submit'])){
    //la funcion clean data nos ayuda a reducir alguna inyeccion de  scripts js vease en Controlador/functions.php
    $userEmail = strtolower(clean_data($_POST['username']));
    $password = ($_POST['password']);
    if(!empty($userEmail) && !empty($password)){
        //verificamos que haya una coincodencia con el usuario/correo introducido
        if(User::verifyUserEmail($userEmail) == 1){
            $hash = User::getUserPassword($userEmail);
            //con esta funcion verificamos que las contraseñas sean iguales
            if(password_verify($password,$hash)){
                $user = User::getUserbyEmailUser($userEmail);
                $_SESSION['user'] =  $user['idUsuario'];
                header('Location: index.php');
            }
            else{
                $errors['errors'] = 'Nombre de usuario/correo o contraseña incorrectos';
            }
        }
        else{
            $errors['errors'] = 'Nombre de usuario/correo o contraseña incorrectos';
        }
    }
    else{
        $errors['errors'] = 'Todos los campos son requeridos';
    }
}
//por lo que lei es bueno dejar los controladores sin cerrar para evitar XSS