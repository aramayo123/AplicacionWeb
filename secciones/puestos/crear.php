<?php 
    include('../../bd.php');
    if($_POST){
        /* Simple if ternario, si existen datos los guardamos, sino, vacio*/
        $nombredelpuesto = (isset($_POST['nombredelpuesto'])) ? $_POST['nombredelpuesto'] : '';
        /* Preparamos la consulta para insertar */
        $sentencia = $conexion->prepare("INSERT INTO tbl_puestos(id,nombredelpuesto) 
            VALUES(null,:nombredelpuesto)");
        /* Pasamos el parametro a la misma sentencia */
        $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto);
        /* Ejecutamos */
        $sentencia->execute();
        $mensaje = "Puesto agregado con exito";
        header("location:index.php?mensaje=".$mensaje);
    }
?>

<?php include('../../templates/header.php'); ?>


<div class="card">
    <div class="card-header">
        Puestos
    </div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="nombredelpuesto" class="form-label">Nombre del puesto</label>
              <input type="text"
                class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto">
            </div>
            <button type="submit" class="btn btn-success">Agregar puesto</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>

    <div class="card-footer text-muted">
        
    </div>
</div>

<?php include('../../templates/footer.php'); ?>