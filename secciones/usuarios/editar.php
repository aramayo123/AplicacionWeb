<?php 

    include('../../bd.php');

    if(isset($_GET['txtID'])){
        $txtID = (isset($_GET['txtID']))? $_GET['txtID'] : "";
        /* Consultamos para ver si existe 
            y para mostrar los datos en los inputs
        */

        $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
        $sentencia->bindParam(':id', $txtID);
        $sentencia->execute();
        /* Obtenemos el registro */
        $registro = $sentencia->fetch(PDO::FETCH_LAZY);
        $usuario = $registro['usuario']; // obtenemos el nombre del usuario
        $password = $registro['password']; 
        $correo = $registro['correo']; 
    }

    if($_POST){
        $txtID = (isset($_POST['txtID']))? $_POST['txtID'] : "";
        $usuario = (isset($_POST['usuario']))? $_POST['usuario'] : "";
        $password = (isset($_POST['password']))? $_POST['password'] : "";
        $correo = (isset($_POST['correo']))? $_POST['correo'] : "";
    
        /* Preparamos la consulta para insertar */
        $sentencia = $conexion->prepare("UPDATE tbl_usuarios SET 
        usuario=:usuario, 
        password=:password, 
        correo=:correo 
        where id=:id");

        /* Pasamos el parametro a la misma sentencia */
        $sentencia->bindParam(":usuario", $usuario);
        $sentencia->bindParam(":password", $password);
        $sentencia->bindParam(":correo", $correo);
        $sentencia->bindParam(":id", $txtID);
        /* Ejecutamos */
        $sentencia->execute();
        $mensaje = "Usuario modificado con exito";
        header("location:index.php?mensaje=".$mensaje);
    }

?>
<?php include('../../templates/header.php'); ?>

<div class="card">
    <div class="card-header">
        Editar datos del usuario
    </div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $txtID;?>"
            class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
          
            <div class="mb-3">
              <label for="usuario" class="form-label">Nombre del usuario</label>
              <input type="text" value="<?php echo $usuario;?>"
                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password"  value="<?php echo $password;?>"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password">
            </div>

            <div class="mb-3">
              <label for="correo" class="form-label">Correo:</label>
              <input type="email" value="<?php echo $correo;?>"
                class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo electronico">
            </div>

            <button type="submit" class="btn btn-success">Actualizar usuario</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>

    <div class="card-footer text-muted">
        
    </div>
</div>


<?php include('../../templates/footer.php'); ?>