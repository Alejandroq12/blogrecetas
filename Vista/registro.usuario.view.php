<?php 
include_once 'rutas.php';
$rutaHeader;
?>
<!-- contenedor del main de crear ussuario -->
<main class="main register">
    <!-- contenedor para centrar pagina -->
    <div class="container">
        <div class="texto">
            <h1>Registrate</h1>
            <p>Por favor rellena los campos para poder registrarte, es gratis.</p>
        </div>
        <form action="registro_usuario.php" method="post" class="formLogin" enctype="multipart/form-data">
        <!-- aca cada input se agrupa en un div(contenedor) con la clase form_group para poder centrarlos y darles el espaciado apropiado -->
            <div class="form-group">
                <!-- label nos permite poder linkear el texto a un input para que al darle click se nos seleccione el campo y asi poder escribir en el -->
                <label for="usuario">Nombre</label>
                <input id="usuario" type="text" name="nombre" class="form-control" placeholder="John" required value="<?php $message =  $errors == [] ? '' : $name; echo htmlspecialchars($message);?>">
            </div>
            <div class="form-group">
                <!-- label nos permite poder linkear el texto a un input para que al darle click se nos seleccione el campo y asi poder escribir en el -->
                <label for="usuario">Apellido</label>
                <input id="usuario" type="text" name="apellido" class="form-control" placeholder="Doe" required value="<?php $message =  $errors == [] ? '' : $lastName; echo htmlspecialchars($message);?>">
            </div>
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input id="usuario" type="text" name="username" class="form-control" placeholder="MiUsuario01" required value="<?php $message =  $errors == [] ? '' : $userName; echo htmlspecialchars($message);?>">
            </div>
            <div class="form-group">
                <label for="usuario">Correo</label>
                <input id="usuario" type="email" name="correo" class="form-control" placeholder="micorreo@micorreo.com" required value="<?php $message =  $errors == [] ? '' : $email; echo htmlspecialchars($message);?>">
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password" class="form-control" placeholder="********" required value="<?php $message =  $errors == [] ? '' : $password; echo htmlspecialchars($message);?>">
            </div>
            <div class="form-group">
                <label for="foto">Foto de perfil</label>
                <!-- este contenedor nos permite poder generar un contenedor para poder mover el elemento con la clase .custom-input-file de manera libre y asi poder ocultar el boton "SUBIR IMAGEN" y solo nos muestre el nombre del archivo -->
                <div class="custom-input-file">
                    <input type="file" id="foto" class="input-file" name="user_image">
                </div>
            </div>
            <div class="form-group">
                <!-- este input:submit nos permite poder enviar el formulario atraves del metodo seleccionado, POST o GET -->
                <input type="submit" name="submit" class="btn btn-primary" value="Sign Up">
            </div>
        </form>
        <?php if($errors != []):?>
            <div class="error">
                <ul>
                <?php foreach($errors as $error):?>
                    <li><?= $error;?></li>
                <?php endforeach;?>
                </ul>
            </div>
        <?php endif;?>
    </div>
</main>

<?php 
require_once realpath('Vista/componentes/footer.php');
?>