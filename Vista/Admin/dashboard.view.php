<?php 
include_once 'rutas.php';
$rutaHeader; 
?>
<main class="main dashboard">
    <div class="container">
        <section class="users">
            <h2>Usuarios</h2>
            <?php foreach($users as $user):?>
                <div class="row">
                <h2><?= $user['username']?></h2>
                <div class="links">
                    <?php if($user['idUsuario'] == $_SESSION['user']):?>
                        <a class="disable" href="">Eliminar</a>
                    <?php else:?>
                        <a href="dashboard.php?userid=<?= $user['idUsuario']?>">Eliminar</a>
                    <?php endif;?>
                </div>
                
            </div>
            <?php endforeach;?>
        </section>
        <section class="recipes">
            <h2>Recetas</h2>
            <?php if(empty($rec)):?>
                <div class="row">
                    <h2 class="empty">No hay recetas de momento</h2>
                </div>
            <?php else:?>
                <?php foreach($rec as $recipe):?>
                    <div class="row">
                        <h2><?= $recipe['tituloPost']?></h2>
                        <div class="links">
                            <a href="dashboard.php?recipeId=<?= $recipe['idReceta']?>">Eliminar</a>
                            <form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
                                <input type="hidden" value="<?= $recipe['idReceta']?>" name="recipeId">
                                <input type="submit" value="Actualizar" name="update">
                            </form>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </section>
    </div>
</main>
<?php 
require_once realpath('Vista/componentes/footer.php');
?>