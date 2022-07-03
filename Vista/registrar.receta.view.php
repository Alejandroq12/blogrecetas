<?php 
include_once 'rutas.php';
$rutaHeader;
?>

<main class="main crearReceta">
    <div class="container">
        <form name="form" action="registrar_receta.php" method="post" enctype="multipart/form-data">
            <div class="rowi">
                <h1>Crear receta</h1>
            </div>
            <div class="rowi">
                <label for="tituloPost">Titulo de la receta</label>
                <input type="text" name="tituloPost" id="tituloPost" value="<?php $message =  !isset($_POST['tituloPost']) ? '' : $_POST['tituloPost']; echo htmlspecialchars($message);?>" required>    
            </div>
            <div class="rowi">
                <label for="descripcionPost">Descripcion de la receta</label>
                <input type="text" name="descripcionPost" id="descripcionPost" value="<?php $message =  !isset($_POST['descripcionPost']) ? '' : $_POST['descripcionPost']; echo htmlspecialchars($message);?>" required>
            </div>
            <div class="rowi">
                <label for="postSteps">Pasos a seguir</label>
                <input class="itemsInput" type="text" name="postSteps" id="postSteps" value="<?php if(isset($_POST['editStep'])){echo htmlspecialchars($_SESSION['createRecipeSteps']["{$_POST['editStep']}"]);};?>">
                <?php if(isset($_POST['editStep'])):?>
                    <input type="hidden" name="stepEditId" value="<?= htmlspecialchars($_POST['editStep']);?>">
                <?php endif;?>
                <input class="items Submit" type="submit" value="Agregar" name="agregar">
            </div>
            <div class="items">
                <ol>
                <?php foreach($_SESSION['createRecipeSteps'] as $id => $step):?>
                    <div class='pasoRow'>
                        <li><?= $step;?></li>
                        <div class="editButtons">
                            <button type='submit' name='deleteStep' value='<?= $id;?>'>Borrar</button>
                            <button type='submit' name='editStep' value='<?= $id;?>'>Editar</button>
                        </div>
                    </div>
                <?php endforeach;?>
                </ol>
            </div>
            <div class="rowi">
                <label for="postSteps">Foto del platillo</label>
                <input type="file" name="imagenPost">
            </div>
            <input type="submit" name="publish" value="Publicar">
        </form>
    </div>
</main>
<?php 
require_once realpath('Vista/componentes/footer.php');
?>