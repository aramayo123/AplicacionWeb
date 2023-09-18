<?php 
    include('../../bd.php');
    if($_POST){
        /* Simple if ternario, si existen datos los guardamos, sino, vacio*/
        $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
        $password = (isset($_POST['password'])) ? $_POST['password'] : '';
        $correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
        /* Preparamos la consulta para insertar */
        $sentencia = $conexion->prepare("INSERT INTO tbl_usuarios(id,usuario,password,correo) 
            VALUES(null,:usuario,:password,:correo)");
        /* Pasamos el parametro a la misma sentencia */
        $sentencia->bindParam(":usuario", $usuario);
        $sentencia->bindParam(":password", $password);
        $sentencia->bindParam(":correo", $correo);
        /* Ejecutamos */
        $sentencia->execute();
        $mensaje = "Usuario creado con exito";
        header("location:index.php?mensaje=".$mensaje);
    }
?>


<?php include('../../templates/header.php'); ?>


<div class="card">
    <div class="card-header">
        Datos del usuario
    </div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="usuario" class="form-label">Nombre del usuario</label>
              <input type="text"
                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password">
            </div>

            <div class="mb-3">
              <label for="correo" class="form-label">Correo:</label>
              <input type="email"
                class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo electronico">
            </div>

            <button type="submit" class="btn btn-success">Agregar usuario</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>

    <div class="card-footer text-muted">
        
    </div>
</div>

<?php include('../../templates/footer.php'); ?>