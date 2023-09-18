<?php
    session_start();
    $url_base = "http://localhost/AplicacionWeb/";

    if(!isset($_SESSION['usuario'])){
        header("Location:". $url_base . "login.php");
    }
?>

<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
   <!-- jQuery Core - All 3.x Versions para datatables -->
    <script
    src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
    crossorigin="anonymous"></script>
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>

    <nav class="navbar navbar-expand navbar-light bg-light">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo $url_base ?>" aria-current="page">Sistema <span class="visually-hidden">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base ?>secciones/empleados">Empleados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base ?>secciones/puestos">Puestos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base ?>secciones/usuarios">Usuarios</a>
            </li>
            <?php if(isset($_SESSION['logeado'])){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base;?>cerrar.php">Cerrar Sesion</a>
                </li>
            <?php } ?>
        </ul>
    </nav>
  <main class="container">
  <br>


<?php if(isset($_GET['mensaje'])) { ?>
<script>
    Swal.fire({icon:"success", title:"<?php echo $_GET['mensaje'];?>"});

</script>
<?php } ?>