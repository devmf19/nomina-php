<?php
// Se valida la recepcion del id para consultar toda la informacion del empleado
if (!isset($_GET['employee_id'])) {
    header("Location: ./index.php");
    exit;
}
require_once 'C:/xampp/htdocs/nomina-php/dao/employee.dao.php';
require_once 'C:/xampp/htdocs/nomina-php/dao/news.dao.php';
$id = $_GET['employee_id'];
$employeeDao = new EmployeeDao();
$newsDao = new NewsDao();

// Se obtiene toda la informacion del empleado
$employee = $employeeDao->get_by_id($id);
$news = $employeeDao->getNews($id);

?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de novedad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="card mt-5" style="width: 80%; margin:auto">
            <div class="card-body">
                <h5 class="card-title">Detalles de la novedad</h5>
                <br>
                <!-- Se muestran todos los datos relacionados con el salario -->
                <strong>Empleado: </strong><?php echo $employee['name']; ?> <br>
                <strong>Novedad: </strong><?php echo $news['description']; ?> <br>
            </div>
            <div class="card-body">
                <!-- Formulario que permite actualizar solo los datos necesarios del empleado -->
                <form action="../controller/news_employee.controller.php" method="POST">
                    <div class="form-group mt-2">
                        <label for="value">Valor:</label>
                        <input type="number" class="form-control mt-1" id="value" name="value" placeholder="Ingrese el valor de la novedad" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="en_date">Fecha:</label>
                        <input type="date" class="form-control mt-1" id="en_date" name="en_date" placeholder="Fecha de la novedad" value="<?php echo date('Y-m-d'); ?>" required>
                        <input type="hidden" name="employee_id" value="<?php echo $id; ?>">
                        <input type="hidden" name="news_id" value="<?php echo $news['id']; ?>">
                    </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-6">
                        <a href="../index.php" class="btn btn-secondary">Volver</a>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </div>
</body>

</html>