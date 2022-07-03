<?php 
include_once 'rutas.php';
$rutaHeader;
?>
<main class="main">
    <div class="container">
    <?php foreach($rec as $recipe): ?>
    <article class="post">
        <div class="imgContainer">
            <img src="<?php echo $recipe["imagenPost"]?>">
        </div>
        <div class="texto">
            <h2><a href="receta.php?id=<?= $recipe["idReceta"] ?>"><?= $recipe["tituloPost"] ?></a></h2>
            <p class="date">Creado el <?= $recipe["fecha"] ?? "Miercoles 16 de Marzo de 2022" ?></p>
            <p><?= $recipe["descripcionPost"] ?></p>
        </div>
    </article>
<?php endforeach; ?>
    </div>
</main>

<?php 
require_once realpath('Vista/componentes/footer.php');
?>