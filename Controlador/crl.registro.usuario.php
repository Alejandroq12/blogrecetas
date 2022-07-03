<?php session_start();
// require_once ('Controlador/crl.config.php');
require_once ('Controlador/functions.php');
require_once ('Modelos/funciones.receta.php');
require_once ('Modelos/funciones.user.php');
//inicializamos un array vacio para almacenar los errores
$errors = [];
if(isset($_POST['submit'])){
    $name = clean_data($_POST['nombre']);
    $lastName = clean_data($_POST['apellido']);
    $username = clean_data($_POST['username']);
    $email = clean_data($_POST['correo']);
    $password = clean_data($_POST['password']);
    //verificar nombre
    $checkText = checkText($name,[4,20],'/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/',['Porfavor ingresa un nombre valido','El nombre debe de ser entre 4 y 20 caracteres']);
    if(!$checkText[0]){
            $errors['name'] = $checkText[1];
    }
    //verificar appellido
    $checkText = checkText($lastName,[4,20],'/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/',['Porfavor ingresa un apellido valido','El apellido debe de ser entre 4 y 20 caracteres']);
    if(!$checkText[0]){
        $errors['lastName'] = $checkText[1];
    }
    // verificar correo
    if(strlen($email) >= 10 && strlen($email) <= 50){
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Pordavor ingresa un correo valido';
        }
        if(User::existsEmail($email) > 0){
            $errors['email'] = 'El correo ya esta en uso. <a href="login.php">Iniciar sesion?<a>';
        }
    }
    else{
        $errors['email'] = 'Porfavor ingresa un correo valido';
    }
    //verficar contraseña
    $checkText = checkText($password,[8,30],'/^[a-zA-Z0-9-_%*?!@#$]+$/',['Caracteres especiales permitidos: -_%*?!@#$','Usa una contraseña entre 8 y 30 caracteres']);
    if(!$checkText[0]){
        $errors['password'] = $checkText[1];
    }
    //verificar usuario
    $checkText = checkText($username,[4,10],'/^[a-zA-Z0-9_]+$/',['Nombre de usuario solo puede contener numeros y guion bajo "_"','El nombre de usuario debe de ser entre 4 y 10 caracteres']);
    if(!$checkText[0]){
        $errors['username'] = $checkText[1];
    }
    if($checkText[0] && User::existsUser($username) > 0){
        $errors['username'] = 'El nombre de usuario ya ha sido tomado, selecciona otro';
    }
    //verificando el tipo de archivo
    //no es obligatorio subir una foto de perfil
    if(isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK){
        //para saber que es la funcion 'uploadImage()' revisar en Controlador/functions.php
        $dest_path = uploadImage($_FILES['user_image'],'Media/profilePhoto/','Media/');
        if(!$dest_path[1]){
            $errors['user_image'] = $dest_path[0];
        }
        else{
            $dest_path = $dest_path[0];
        }
    }
    //si no se sube se tomara esta ruta por defecto
    else{
        $dest_path = 'https://i.imgur.com/GvUsGWz.jpg';
    }
    //si no hay errores podemos crear el usuario
    if($errors == []){
        //key es una llave aleatoria solo para encriptar el texto plano usando md5
        $key = '5e83b87c6ff6b1cc4d941bf315281da1';
        //este token nos permitira validar a la hora de hacer cambios mas adelante
        $token = md5($email.$password.$key);
        //encriptamos la contraseña
        $password = User::encPass($password);
        //convertimos el nombre de usuario a minusculas para evitar problems por mayusculas
        $username = strtolower($username);
        $email = strtolower($email);
        $user = new User($token,$name,$lastName,$username,$password,$email,$dest_path);
        $user->makeUser();
        header('Location: login.php');
    }
}
//por lo que lei es bueno dejar los controladores sin cerrar para evitar XSS