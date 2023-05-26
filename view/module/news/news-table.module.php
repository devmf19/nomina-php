<?php
require_once './dao/news.dao.php';
$newsDao = new NewsDao();  //objeto de la clase que realiza acciones en la base de datos
$news = $newsDao->get_all(); // se obtienen todos los empleados registrados
?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Tipo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($news as $new) : ?>
            <tr>
                <th><?php echo $new['id']; ?></th>
                <td><?php echo $new['description']; ?></td>
                <td><?php echo $new['type']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>