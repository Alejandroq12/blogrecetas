<?php 
include_once 'rutas.php';
$rutaHeader;
?>

<main class="main index">
    <!-- contenedor para centrar el sitio web -->
    <div class="container">
        <article id="idArticulo" class="post">
            <div class="imgContainer">
                <img src="<?= $rec["imagenPost"] ?>" alt="Comida o algo">
            </div>
            <div class="texto">
                <h2><?= $rec["tituloPost"] ?></h2>
                <p class="date">Creado el <?= $rec["fecha"];?></p>
                <p><?= $rec["descripcionPost"] ?></p>
                <p>
                    <ol>
                    <?php
                        foreach($steps as $step){
                            echo "<li>$step</li>";
                        };
                    ?>
                    </ol>
                </p>
            </div>
        </article>
    </div>
</main>

<?php 
require_once realpath('Vista/componentes/footer.php');
?>