<?php include('templates/header.php'); ?>



    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Bienvenid@ al sistema</h1>
            <p>
                <?php 
                    if(isset($_SESSION['logeado'])){
                        echo "Usuario: ".$_SESSION['usuario'];
                    }
                ?>

            </p>
            <button class="btn btn-primary btn-lg" type="button">Example button</button>
        </div>
    </div>



<?php include('templates/footer.php'); ?>
  