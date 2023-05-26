<?php
require_once 'C:/xampp/htdocs/nomina-php/dao/employee.dao.php';
$employeeDao = new EmployeeDao();  //objeto de la clase que realiza acciones en la base de datos
$employees = $employeeDao->get_all(); // se obtienen todos los empleados registrados
?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombres</th>
            <th scope="col">Direccion</th>
            <th scope="col" class="text-center">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employees as $emp) : ?>
            <tr>
                <th><?php echo $emp['id']; ?></th>
                <td><?php echo $emp['name']; ?></td>
                <td><?php echo $emp['address']; ?></td>
                <td class="text-center">
                    <a href="./view/employee_details.php?id=<?php echo $emp['id']; ?>" type="button" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-eye fa-lg" style="color: #FFFFFF;"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>