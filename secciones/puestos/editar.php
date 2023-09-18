<?php 

    include('../../bd.php');

    if(isset($_GET['txtID'])){
        $txtID = (isset($_GET['txtID']))? $_GET['txtID'] : "";
        /* Consultamos para ver si existe 
            y para mostrar los datos en los inputs
        */

        $sentencia = $conexion->prepare("SELECT * FROM tbl_puestos WHERE id=:id");
        $sentencia->bindParam(':id', $txtID);
        $sentencia->execute();
        /* Obtenemos el registro */
        $registro = $sentencia->fetch(PDO::FETCH_LAZY);
        $nombredelpuesto = $registro['nombredelpuesto']; // obtenemos el nombre de la puesto
    }

    if($_POST){
        $txtID = (isset($_POST['txtID']))? $_POST['txtID'] : "";
        /* Simple if ternario, si existen datos los guardamos, sino, vacio*/
        $nombredelpuesto = (isset($_POST['nombredelpuesto'])) ? $_POST['nombredelpuesto'] : '';
        /* Preparamos la consulta para insertar */
        $sentencia = $conexion->prepare("UPDATE tbl_puestos SET nombredelpuesto=:nombredelpuesto where id=:id");

        /* Pasamos el parametro a la misma sentencia */
        $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto);
        $sentencia->bindParam(":id", $txtID);
        /* Ejecutamos */
        $sentencia->execute();
        $mensaje = "Puesto modificado con exito";
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
            <input type="hidden" value="<?php echo $txtID;?>"
                class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            <div class="mb-3">
              <label for="nombredelpuesto" class="form-label">Nombre del puesto</label>
              <input type="text" value="<?php echo $nombredelpuesto;?>"
                class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto">
            </div>
            <button type="submit" class="btn btn-success">Actualizar puesto</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>

    <div class="card-footer text-muted">
        
    </div>
</div>

<?php include('../../templates/footer.php'); ?>