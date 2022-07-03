<?php 
include_once 'rutas.php';
$rutaHeader;
$userImage = User::getUserImagePath($_SESSION["user"]);
?>

<main class="main perfil">
    <div class="container">
        <section class="card">
            <div class="header">
                <div class="profileContainer">
                    <img src="<?= str_contains($userImage,"/") ? $userImage : "./Controlador/default/guest.webp" ?>" alt="foto de perfil">
                </div>
            </div>
            <div class="body">
                <table>
                <tr>
                    <td>Nombre</td>
                    <td><?= $name;?></td>
                </tr>
                <tr>
                    <td>Nombre de usuario</td>
                    <td><?= $username;?></td>
                </tr>
                <tr>
                    <td>Correo</td>
                    <td><?= $email;?></td>
                </tr>
                </table>
            </div>
        </section>
        <section class="info">
            <h1>Posts creados por <?= $name?>:</h1>
            <h2><?php echo count($rec) ?> <?php echo count($rec) === 1 ? "post" : "posts" ?></h2>
        </section>
        <?php foreach($rec as $recipe): ?>
        <article class="post">
            <div class="imgContainer">
                <img src="<?= $recipe["imagenPost"]; ?>" alt="Comida o algo">
            </div>
            <div class="texto">
                <h2><a href="receta.php?id=<?= $recipe["idReceta"]; ?>"><?= $recipe["tituloPost"]; ?></a></h2>
                <p class="date">Creado el <?= $recipe["fecha"] ?? "Miercoles 16 de Marzo de 2022"; ?></p>
                <p><?= $recipe["descripcionPost"] ?></p>
            </div>
        </article>
        <?php endforeach; ?>
        <a class="newPost" href="registrar_receta.php"> <i class="button-crearReceta" aria-hidden="true">Crear Receta</i></a>
    </div>
</main>
<?php 
require_once realpath('Vista/componentes/footer.php');
?>