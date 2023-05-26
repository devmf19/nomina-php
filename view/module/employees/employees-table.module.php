<?php
require_once 'C:/xampp/htdocs/nomina-php/dao/employee.dao.php';
require_once 'C:/xampp/htdocs/nomina-php/dao/employees-news.dao.php';
$employeeDao = new EmployeeDao();  //objeto de la clase que realiza acciones en la base de datos
$employee_news = new EmployeeNewsDao();
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
        <?php foreach ($employees as $emp) :
            $news = $employeeDao->getNews($emp['id']);
            $news_id = 0;
            if ($news != false) {
                $news_id = $news['id'];
            }
        ?>
            <tr>
                <th><?php echo $emp['id']; ?></th>
                <td><?php echo $emp['name']; ?></td>
                <td><?php echo $emp['address']; ?></td>
                <td class="text-center">
                    <a href="./view/employee_details.php?employee_id=<?php echo $emp['id']; ?>" type="button" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i>
                    </a>
                    <?php if ($employee_news->get_by_id($emp['id'], $news_id) == false) { ?>
                        <a href="./view/news_employee.view.php?employee_id=<?php echo $emp['id']; ?>" type="button" class="btn btn-success btn-sm">
                            <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                        </a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>