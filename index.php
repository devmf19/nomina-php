<?php
require_once 'C:/xampp/htdocs/nomina-php/dao/employee.dao.php';
$employeeDao = new EmployeeDao();  //objeto de la clase que realiza acciones en la base de datos

$employees = $employeeDao->get_all(); // se obtienen todos los empleados registrados


//luego de realizar una accion crud, se retorna al index con un mensaje de exito o error a traves de GET
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

    <div class="container">
        <div class="row py-2" style="height: 80px;">
            <!-- Si existe el mensaje de exito o error, se muestra al usuario -->
            <?php if ($exist_message) : ?>
                <div class="alert <?php echo $alert ?> alert-dismissible fade show" role="alert">
                    <strong><?php echo $message ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

        </div>
        <div class="row">
            <div class="col-4">
                <!-- Formulario que toma los datos necesarios del empleado -->
                <form action="./controller/employee.controller.php" method="POST">
                    <div class="form-group mt-2">
                        <label for="id">ID:</label>
                        <input type="number" class="form-control mt-1" id="id" name="id" placeholder="Ingrese el ID">
                    </div>
                    <div class="form-group mt-2">
                        <label for="name">Nombres:</label>
                        <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Ingrese los nombres">
                    </div>
                    <div class="form-group mt-2">
                        <label for="lastname">Apellidos:</label>
                        <input type="text" class="form-control mt-1" id="lastname" name="lastname" placeholder="Ingrese los apellidos">
                    </div>
                    <div class="form-group mt-2">
                        <label for="hours">Horas:</label>
                        <input type="number" class="form-control mt-1" id="hours" name="hours" placeholder="Ingrese las horas">
                    </div>
                    <div class="form-group mt-2">
                        <label for="hours_value">Valor de las horas:</label>
                        <input type="number" class="form-control mt-1" id="hours_value" name="hours_value" placeholder="Ingrese el valor de las horas">
                        <input type="hidden" name="option" value="save">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Registrar</button>
                </form>
            </div>
            <div class="col-8">
                <!-- Lista de empleados registrados -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Horas</th>
                            <th scope="col">Valor hora</th>
                            <th scope="col">Salario neto</th>
                            <th scope="col" class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $emp) : ?>
                            <tr>
                                <th><?php echo $emp['id']; ?></th>
                                <td><?php echo $emp['name']; ?></td>
                                <td><?php echo $emp['lastname']; ?></td>
                                <td><?php echo $emp['hours']; ?></td>
                                <td>$<?php echo $emp['hours_value']; ?></td>
                                <td>$<?php echo $emp['net_pay']; ?></td>
                                <td class="text-center">
                                    <a href="./employee_details.php?id=<?php echo $emp['id']; ?>" type="button" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-eye fa-lg" style="color: #FFFFFF;"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>