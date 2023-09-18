<?php 
    include('../../bd.php');
     
    if(isset($_GET['txtID'])){
        $txtID = (isset($_GET['txtID']))? $_GET['txtID'] : "";
        $sentencia = $conexion->prepare("SELECT *,
        (SELECT nombredelpuesto FROM tbl_puestos WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1) as puesto
        FROM tbl_empleados WHERE id=:id");
        $sentencia->bindParam(':id', $txtID);
        $sentencia->execute();
        $registro = $sentencia->fetch(PDO::FETCH_LAZY);

        $primernombre = $registro['primernombre'];
        $segundonombre = $registro['segundonombre'];
        $primerapellido = $registro['primerapellido'];
        $segundoapellido = $registro['segundoapellido'];
        $foto = $registro['foto'];
        $cv = $registro['cv'];
        $puesto = $registro['puesto'];
        $fechadeingreso = $registro['fechadeingreso'];


        $nombrecompleto = $primernombre. " ". $segundonombre. " ". $primerapellido. " ". $segundoapellido;

        $fechaInicio = new DateTime($fechadeingreso);
        $fechaFin = new DateTime(date('Y-m-d'));
        $diferencia = date_diff($fechaInicio, $fechaFin);
    }
    
    ob_start(); //estamos diciendo que va a guardar todo el html a partir de esta linea para recojerlo al final
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de recomendacion</title>
</head>
<body>
    <h1>Carta de recomendacion Laboral</h1>
    <br><br>
    Salta Capital, Argentina <strong><?php echo date('d M Y;');?> </strong>
    <br><br>
    A quien pueda interesar:
    <br><br>
    Reciba un cordial y respetuoso saludo.
    <br><br>
    A traves de estas lineas deseo hacer su reconocimiento que Sr(a) <strong><?php echo $nombrecompleto;?></strong>,
    quien laboro  en mi organizacion durante <strong><?php echo $diferencia->y;?> años.</strong> 
    es un ciuidadano con una conducta intachable. Ha demostrado ser un gran trabajador,
    comprometido, responsable y fiel cumplidor de sus tareas.
    siempre ha manifestado preocupacion por mejorar, capacitarse y actualizar sus conocimientos.
    <br><br>
    Durante estos años se ha desempeñado como <strong><?php echo $puesto;?></strong>
    Es por ello le sugiero considere esta recomendacion, con la confianza de que estara siempre a la altura 
    de sus compromisos y responsabilidades.
    Sin mas nada a que referirme y esperando que esta maisiva sea tomada en cuenta, dejo mi numero de contacto
    para cualquier informacion de interes.
    <br><br><br><br><br><br>
    ________________________________<br>
    Atentamente: EMPRESA RESPONSABLE

</body>
</html>



<?php

    $HTML = ob_get_clean(); // aca decimos donde termina el html

    require_once('../../libs/dompdf/autoload.inc.php');
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();
    $opciones = $dompdf->getOptions();
    $opciones->set(array("isRemoteEnable"=>true));
    $dompdf->setOptions($opciones);

   


    $dompdf->loadHTML($HTML);
    $dompdf->setPaper('letter'); // tipo de papel
    $dompdf->render(); // renderizamos
    $dompdf->stream("archivo.pdf",array("Attachment" => false)); // esto nos permite descargar, y pasamos variables
    


?>