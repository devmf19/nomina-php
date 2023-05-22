<?php
// Se valida la recepcion del id para consultar toda la informacion del empleado
if (!isset($_GET['id'])) {
    header("Location: ./index.php");
    exit;
}
require_once 'C:/xampp/htdocs/nomina-php/dao/employee.dao.php';
$id = $_GET['id'];
$employeeDao = new EmployeeDao();

// Se obtiene toda la informacion del empleado
$employee = $employeeDao->get_by_id($id);

?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="card mt-5" style="width: 80%; margin:auto">
            <div class="card-body">
                <h5 class="card-title">Detalles del empleado</h5>
                <br>
                <!-- Se muestran todos los datos relacionados con el salario -->
                <strong>Sueldo basico: </strong>$ <?php echo $employee['basic_pay']; ?> <br>
                <strong>Subsidio: </strong>$ <?php echo $employee['subsidy']; ?> <br>
                <strong>Fuente de retencion: </strong>$ <?php echo $employee['source_retention']; ?> <br>
                <strong>Seguridad social: </strong>$ <?php echo $employee['social_security']; ?> <br>
                <strong>Horas extras: </strong>$ <?php echo $employee['extra_hours']; ?> <br>
                <strong>Sueldo neto: $<?php echo $employee['net_pay']; ?></strong>
            </div>
            <div class="card-body">
                <!-- Formulario que permite actualizar solo los datos necesarios del empleado -->
                <form action="./controller/employee.controller.php" method="POST">
                    <div class="form-group mt-2">
                        <label for="name">Nombres:</label>
                        <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Ingrese los nombres" value="<?php echo $employee['name']; ?>">
                    </div>
                    <div class="form-group mt-2">
                        <label for="lastname">Apellidos:</label>
                        <input type="text" class="form-control mt-1" id="lastname" name="lastname" placeholder="Ingrese los apellidos" value="<?php echo $employee['lastname']; ?>">
                    </div>
                    <div class="form-group mt-2">
                        <label for="hours">Horas:</label>
                        <input type="number" class="form-control mt-1" id="hours" name="hours" placeholder="Ingrese las horas" value="<?php echo $employee['hours']; ?>">
                    </div>
                    <div class="form-group mt-2">
                        <label for="hours_value">Valor de las horas:</label>
                        <input type="number" class="form-control mt-1" id="hours_value" name="hours_value" placeholder="Ingrese el valor de las horas" value="<?php echo $employee['hours_value']; ?>">
                        <input type="hidden" name="option" value="update">
                        <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
                    </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-9">
                        <a href="./index.php" class="btn btn-secondary">Volver</a>
                    </div>
                    <div class="col-3 text-left">
                        <button type="submit" class="btn btn-primary ">Actualizar</button>
                        <a href="./controller/employee.controller.php?id=<?php echo $employee['id'] ?>" class="btn btn-danger">Eliminar</a>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </div>
</body>

</html>