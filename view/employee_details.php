<?php
// Se valida la recepcion del id para consultar toda la informacion del empleado
if (!isset($_GET['employee_id'])) {
    header("Location: ./index.php");
    exit;
}
require_once 'C:/xampp/htdocs/nomina-php/dao/employee.dao.php';
require_once 'C:/xampp/htdocs/nomina-php/dao/news.dao.php';
require_once 'C:/xampp/htdocs/nomina-php/dao/employees-news.dao.php';
$id = $_GET['employee_id'];
$employeeDao = new EmployeeDao();
$newsDao = new NewsDao();
$employee_newsDao = new EmployeeNewsDao();
$employee_news;

// Se obtiene toda la informacion del empleado
$employee = $employeeDao->get_by_id($id);
$news = $employeeDao->getNews($id);
if ($news != false) {
    $employee_news = $employee_newsDao->get_by_id($employee['id'], $news['id']);
}
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
                <strong>Id del empleado: </strong><?php echo $employee['id']; ?> <br>
                <?php if ($news != false) { ?>
                    <strong>Novedad: </strong><?php echo $news['description']; ?> <br>
                    <strong>Tipo de novedad: </strong><?php echo $news['type']; ?> <br>
                    <?php if ($employee_news != false) { ?>
                        <strong>Valor de novedad: </strong>$ <?php echo $employee_news['value']; ?> <br>
                        <strong>Fecha de novedad: </strong><?php echo $employee_news['en_date']; ?> <br>
                    <?php  } else { ?>
                        <strong>El CLIENTE NO HA COMPLETADO NOVEDAD</strong><br>
                    <?php  } ?>
                <?php  } else { ?>
                    <strong>El CLIENTE NO REGISTRA NOVEDAD</strong><br>
                <?php  } ?>

            </div>
            <div class="card-body">
                <!-- Formulario que permite actualizar solo los datos necesarios del empleado -->
                <form action="../controller/employee.controller.php" method="POST">
                    <div class="form-group mt-2">
                        <label for="name">Nombres:</label>
                        <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Ingrese los nombres" value="<?php echo $employee['name']; ?>">
                    </div>
                    <div class="form-group mt-2">
                        <label for="address">Direccion:</label>
                        <input type="text" class="form-control mt-1" id="address" name="address" placeholder="Ingrese los apellidos" value="<?php echo $employee['address']; ?>">
                    </div>
                    <div class="form-group mt-2">
                        <label for="phone">Telefono:</label>
                        <input type="number" class="form-control mt-1" id="phone" name="phone" placeholder="Ingrese las horas" value="<?php echo $employee['phone']; ?>">
                    </div>
                    <div class="form-group mt-2">
                        <label for="dependency">Dependencia:</label>
                        <input type="text" class="form-control mt-1" id="dependency" name="dependency" placeholder="Ingrese el valor de las horas" value="<?php echo $employee['dependency']; ?>">
                        <input type="hidden" name="option" value="update">
                        <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
                    </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-9">
                        <a href="../index.php" class="btn btn-secondary">Volver</a>
                    </div>
                    <div class="col-3 text-left">
                        <button type="submit" class="btn btn-primary ">Actualizar</button>
                        <a href="../controller/employee.controller.php?id=<?php echo $employee['id'] ?>" class="btn btn-danger">Eliminar</a>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </div>
</body>

</html>