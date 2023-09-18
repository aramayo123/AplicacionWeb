<?php 

  include('../../bd.php');
  if(isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID']))? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $primernombre = $registro['primernombre'];
    $segundonombre = $registro['segundonombre'];
    $primerapellido = $registro['primerapellido'];
    $segundoapellido = $registro['segundoapellido'];
    $foto = $registro['foto'];
    $cv = $registro['cv'];
    $idpuesto = $registro['idpuesto'];
    $fechadeingreso = $registro['fechadeingreso'];

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_puestos`");
    $sentencia->execute();
    $lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
  }
  


  if($_POST){
    $txtID = (isset($_POST['txtID']))? $_POST['txtID'] : "";
    $primernombre = (isset($_POST['primernombre'])) ? $_POST['primernombre'] : '';
    $segundonombre = (isset($_POST['segundonombre']))? $_POST['segundonombre'] : '';
    $primerapellido = (isset($_POST['primerapellido']))? $_POST['primerapellido'] : '';
    $segundoapellido = (isset($_POST['segundoapellido']))? $_POST['segundoapellido'] : '';

    $idpuesto = (isset($_POST['idpuesto']))? $_POST['idpuesto'] : '';
    $fechadeingreso = (isset($_POST['fechadeingreso']))? $_POST['fechadeingreso'] : '';
    $sentencia = $conexion->prepare("UPDATE tbl_empleados SET
    primernombre=:primernombre, 
    segundonombre=:segundonombre, 
    primerapellido=:primerapellido, 
    segundoapellido=:segundoapellido, 
    idpuesto=:idpuesto, 
    fechadeingreso=:fechadeingreso WHERE id=:id");
    $sentencia->bindParam(":primernombre", $primernombre);
    $sentencia->bindParam(":segundonombre", $segundonombre);
    $sentencia->bindParam(":primerapellido", $primerapellido);
    $sentencia->bindParam(":segundoapellido", $segundoapellido);
    $sentencia->bindParam(":idpuesto", $idpuesto);
    $sentencia->bindParam(":fechadeingreso", $fechadeingreso);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();


    $fecha_actual = new DateTime();

    $foto = (isset($_FILES['foto']['name']))? $_FILES['foto']['name'] : '';
    $nombreArchivo_foto = ( $foto != '') ? $fecha_actual->getTimestamp()."_".$_FILES['foto']['name'] : '';
    $tmp_foto = $_FILES['foto']['tmp_name'];
    if($tmp_foto != '') {
      move_uploaded_file($tmp_foto, "./".$nombreArchivo_foto);
      $sentencia = $conexion->prepare("SELECT foto,cv FROM `tbl_empleados` WHERE id=:id");
      $sentencia->bindParam(":id", $txtID);
      $sentencia->execute();
      $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY); // obtenemos solo el registro
      if(isset($registro_recuperado['foto']) && $registro_recuperado['foto'] != ''){
          if(file_exists("./".$registro_recuperado['foto'])){
            unlink("./".$registro_recuperado['foto']);
          }
      }

      $sentencia = $conexion->prepare("UPDATE tbl_empleados SET foto=:foto WHERE id=:id");
      $sentencia->bindParam(":foto", $nombreArchivo_foto);
      $sentencia->bindParam(":id", $txtID);
      $sentencia->execute();

    }
    $cv = (isset($_FILES['cv']['name']))? $_FILES['cv']['name'] : '';
    $nombreArchivo_cv = ( $cv != '') ? $fecha_actual->getTimestamp()."_".$_FILES['cv']['name'] : '';
    $tmp_cv = $_FILES['cv']['tmp_name'];
    if($tmp_cv != '') {
      move_uploaded_file($tmp_cv, "./".$nombreArchivo_cv);
      $sentencia = $conexion->prepare("SELECT foto,cv FROM `tbl_empleados` WHERE id=:id");
      $sentencia->bindParam(":id", $txtID);
      $sentencia->execute();
      $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY); // obtenemos solo el registro
      if(isset($registro_recuperado['cv']) && $registro_recuperado['cv'] != ''){
        if(file_exists("./".$registro_recuperado['cv'])){
          unlink("./".$registro_recuperado['cv']);
        }
      }
      $sentencia = $conexion->prepare("UPDATE tbl_empleados SET cv=:cv WHERE id=:id");
      $sentencia->bindParam(":cv", $nombreArchivo_cv);
      $sentencia->bindParam(":id", $txtID);
      $sentencia->execute();
    }
    
    $mensaje = "Empleado modificado con exito";
    header("location:index.php?mensaje=".$mensaje);
  }

?>


<?php include('../../templates/header.php'); ?>

<div class="card">
    <div class="card-header">
        Editar datos del empleado
    </div>
    <div class="card-body">
      <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $txtID;?>" name="txtID">

        <div class="mb-3">
          <label for="primernombre" class="form-label">Primer nombre</label>
          <input type="text" value="<?php echo $primernombre;?>"
            class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Primer nombre">
        </div>

        <div class="mb-3">
          <label for="segundonombre" class="form-label">Segundo nombre</label>
          <input type="text" value="<?php echo $segundonombre;?>"
            class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="Segundo nombre">
        </div>

        <div class="mb-3">
          <label for="primerapellido" class="form-label">Primer apellido</label>
          <input type="text" value="<?php echo $primerapellido;?>"
            class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer apellido">
        </div>

        <div class="mb-3">
          <label for="segundoapellido" class="form-label">Segundo apellido</label>
          <input type="text" value="<?php echo $segundoapellido;?>"
            class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo apellido">
        </div>


        <div class="mb-3">
          <label for="" class="form-label">Foto:</label>
          <br><img width="100" src="<?php echo $foto;?>" class="img-fluid rounded-top" alt=""><br>
          <input type="file" 
            class="form-control" name="foto" id="" aria-describedby="helpId" placeholder="Foto">
        </div>

        <div class="mb-3">
          <label for="cv" class="form-label">CV(PDF):</label>
          <a href="<?php echo $cv;?>"><?php echo $cv;?></a> 
          <input type="file" class="form-control" name="cv" id="cv" placeholder="CV" aria-describedby="fileHelpId">
        </div>

        <div class="mb-3">
            <label for="idpuesto" class="form-label">Puesto:</label>
            <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
                <?php foreach ($lista_tbl_puestos as $puesto){ ?>
                  <option <?php echo ($idpuesto == $puesto['id']) ? "selected":"";?> value="<?php echo $puesto['id']; ?>"><?php echo $puesto['nombredelpuesto']; ?></option>
                <?php }?>
            </select>
        </div>

        <div class="mb-3">
          <label for="fechadeingreso" class="form-label">Fecha de ingreso:</label>
          <input type="date" value="<?php echo $fechadeingreso;?>"
          class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso">
        </div>

        <button type="submit" class="btn btn-success">Actualizar registro</button>
        <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
      </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php include('../../templates/footer.php'); ?>