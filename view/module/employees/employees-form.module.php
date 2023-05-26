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
        <label for="type">Novedad:</label>
        <select class="form-control mt-1" id="type" name="type required">
            <option selected>Escoge una opcion</option>
            <option value="no">No tiene</option>
            <option value="idNovedad">Descripcion novedad</option>
        </select>
        <input type="hidden" name="option" value="save">
    </div>
    <button type="submit" class="btn btn-primary mt-3">Registrar empleado</button>
</form>