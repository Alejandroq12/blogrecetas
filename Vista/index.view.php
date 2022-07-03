<?php 
include_once 'rutas.php';
$rutaHeader;
?>
<!-- contenedor main del index -->
<main class="main index">
    <!-- Contenedor para centrar el sitio web -->
    <div class="container">
    <a class="newPost" href="registrar_receta.php"> <i class="button-crearReceta" aria-hidden="true">Crear Receta</i></a>
        <!-- ciclo para mandar a llamra los posts de los usuarios -->
        <?php foreach($recetas as $receta): ?>
            <article class="post">
                <div class="imgContainer">
                    <img src="<?= $receta["imagenPost"] ?>" alt="Comida o algo">
                </div>
                <div class="texto">
                    <h2><a href="receta.php?id=<?= $receta["idReceta"] ?>"><?= $receta["tituloPost"] ?></a></h2>
                    <p class="date">Creado el <?= $receta["fecha"];?></p>
                    <p><?= $receta["descripcionPost"] ?></p>
                </div>
                <?php require ("./Vista/share.view.php");?>
            </article>
        <?php endforeach ?>
    </div>
</main>
<?php 
require_once realpath('Vista/componentes/footer.php');
?>