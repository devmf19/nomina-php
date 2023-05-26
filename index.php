<?php
//Luego de realizar una accion crud, se retorna al index con un mensaje de exito o error a traves de GET
$exist_message = false;
$message = "";
$alert = "";
if (isset($_GET['message'])) {
    $exist_message = true;
    $message = $_GET['message'];
    $alert = $_GET['alert'];
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <nav class="navbar navbar-light bg-light">
        <span class="navbar-brand mb-0 h1 px-5 py-2">Nomina de empleados</span>
    </nav>

    <!-- ALERTA -->
    <div class="row py-2 mx-5" style="height: 80px;">
        <!-- Si existe el mensaje de exito o error, se muestra al usuario -->
        <?php if ($exist_message) : ?>
            <div class="alert <?php echo $alert ?> alert-dismissible fade show" role="alert">
                <strong><?php echo $message ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

    </div>

    <!-- FORMULARIOS -->
    <div class="row mx-2">
        <!-- Formulario de empleados -->
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Registro de empleados</h5>
                    <?php require_once './view/module/employees/employees-form.module.php'; ?>
                </div>
            </div>
        </div>
        <!-- Formulario de novedades -->
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Registro de novedades</h5>
                    <?php require_once './view/module/news/news-form.module.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- TABLAS -->
    <div class="row mx-2 mt-4">
        <!-- Tabla de empleados -->
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lista empleados</h5>
                    <?php require_once './view/module/employees/employees-table.module.php'; ?>
                </div>
            </div>
        </div>
        <!-- Tabla de novedades -->
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lista novedades</h5>
                    <?php require_once './view/module/news/news-table.module.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>