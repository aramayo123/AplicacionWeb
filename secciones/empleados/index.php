<?php 
    include('../../bd.php');


    if(isset($_GET['txtID'])){
        $txtID = (isset($_GET['txtID']))? $_GET['txtID'] : "";

        $sentencia = $conexion->prepare("SELECT foto,cv FROM `tbl_empleados` WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY); // obtenemos solo el registro
        if(isset($registro_recuperado['foto']) && $registro_recuperado['foto'] != ''){
            if(file_exists("./".$registro_recuperado['foto'])){
                unlink("./".$registro_recuperado['foto']);
            }
        }

        if(isset($registro_recuperado['cv']) && $registro_recuperado['cv'] != ''){
            if(file_exists("./".$registro_recuperado['cv'])){
                unlink("./".$registro_recuperado['cv']);
            }
        }
   
        $sentencia = $conexion->prepare("DELETE FROM tbl_empleados WHERE id=:id");
        $sentencia->bindParam(':id', $txtID);
        $sentencia->execute();
        $mensaje = "Empleado eliminado con exito";
        header("location:index.php?mensaje=".$mensaje);

    }


    $sentencia = $conexion->prepare("SELECT *,
    (SELECT nombredelpuesto FROM tbl_puestos WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1) as puesto
    FROM `tbl_empleados`");
    $sentencia->execute();
    $lista_tbl_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include('../../templates/header.php'); ?>

<div class="card">
    <div class="card-header">
     
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registro</a>
    </div>
    <div class="card-body">
       <div class="table-responsive-sm">
        <table class="table" id="tabla_id">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Foto</th>
                    <th scope="col">CV</th>
                    <th scope="col">Puesto</th>
                    <th scope="col">Fecha de ingreso</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista_tbl_empleados as $registro){ ?>
                    <tr class="">
                        <td scope="row"><?php echo $registro['id']; ?></td>
                        <td scope="row">
                            <?php 
                                echo $registro['primernombre'].' ';
                                echo $registro['segundonombre'].'<br>';
                                echo $registro['primerapellido'].' ';
                                echo $registro['segundoapellido']; 
                            ?>
                        </td>
                        <td>
                            <img width="100" src="<?php echo $registro['foto']; ?>" class="img-fluid rounded-top" alt="">
                        </td>
                        <td><a href="<?php echo $registro['cv']; ?>"><?php echo $registro['cv']; ?></a></td>
                        <td><?php echo $registro['puesto']; ?></td>
                        <td><?php echo $registro['fechadeingreso']; ?></td>
                        <td>
                            <div class="row">
                                <div class="col-3">
                                    <a name="" id="" class="btn btn-primary" href="carta_recomendacion.php?txtID=<?php echo $registro['id']; ?>" role="button">Carta</a>
                                </div>
                                <div class="col-3">
                                    <a class="btn btn-secondary" href="editar.php?txtID=<?php echo $registro['id']; ?>" role="button">Editar</a>
                                </div>
                                <div class="col-3">
                                    <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id']; ?>)" role="button">Eliminar</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
       </div>
       
    </div>
</div>

<?php include('../../templates/footer.php'); ?>