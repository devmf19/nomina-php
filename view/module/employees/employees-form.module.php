<?php
require_once './dao/news.dao.php';
$newsDao = new NewsDao();  //objeto de la clase que realiza acciones en la base de datos
$news = $newsDao->get_all(); // se obtienen todos los empleados registrados
?>

<!-- Formulario que toma los datos necesarios del empleado -->
<form action="./controller/employee.controller.php" method="POST">
    <div class="form-group mt-2">
        <label for="id">ID:</label>
        <input type="number" class="form-control mt-1" id="id" name="id" placeholder="Ingrese el ID">
    </div>
    <div class="form-group mt-2">
        <label for="name">Nombres:</label>
        <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Ingrese sus nombres">
    </div>
    <div class="form-group mt-2">
        <label for="address">Direccion:</label>
        <input type="text" class="form-control mt-1" id="address" name="address" placeholder="Ingrese su direccion">
    </div>
    <div class="form-group mt-2">
        <label for="phone">Telefono:</label>
        <input type="number" class="form-control mt-1" id="phone" name="phone" placeholder="Ingrese su numero de telefono">
    </div>
    <div class="form-group mt-2">
        <label for="dependency">Dependencia:</label>
        <input type="text" class="form-control mt-1" id="dependency" name="dependency" placeholder="Ingrese su dependencia">
    </div>
    <div class="form-group mt-2">
        <label for="news">Novedad:</label>
        <select class="form-control mt-1" id="news" name="news" require>
            <option selected>Escoge una opcion</option>
            <?php foreach ($news as $new) : ?>
                <option value="<?php echo $new['id']; ?>"><?php echo $new['description']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" name="option" value="save">
    </div>
    <button type="submit" class="btn btn-primary mt-3">Registrar empleado</button>
</form>