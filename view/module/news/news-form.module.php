<!-- Formulario que toma los datos necesarios del empleado -->
<form action="./controller/news.controller.php" method="POST">
    <div class="form-group mt-2">
        <label for="description">Descripcion:</label>
        <input type="text" class="form-control mt-1" id="description" name="description" placeholder="Descripcion de la novedad">
    </div>
    <div class="form-group mt-2">
        <label for="type">Tipo:</label>
        <select class="form-control mt-1" id="type" name="type" required>
            <option selected>Escoge una opcion</option>
            <option value="Descuento">Desuento</option>
            <option value="Bonificacion">Bonificacion</option>
        </select>
        <input type="hidden" name="option" value="save">
    </div>
    <button type="submit" class="btn btn-primary mt-3">Registrar novedad</button>
</form>