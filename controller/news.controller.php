<?php
require_once '../dao/news.dao.php';

//variable para retornar la clase de bootstrap que debe tener la alerta luego de realizar una accion
$alert_class = "alert-danger";

function validateFields($data)
{
    // Se declara un array vacio que almacenara los errores en caso de que hayan
    $errors = array();
    if(empty($data['description']) || !is_string($data['description'])){
        $errors[] = "El campo DESCRIPCION es obligatorio y debe ser una cadena de texto.";
    } else if($data['type']!="Descuento" && $data['type']!="Bonificacion") {
        $errors[] = "Seleccione un tipo de novedad valido.";
    }
    
    return $errors;
}

function post_to_object()
{
    // Se asignan los datos recibidos por POST a un objeto de la clase News
    $news = new News();
    $news->setDescription($_POST['description']);
    $news->setType($_POST['type']);

    return $news;
}

//La accion de eliminar se recibe a traves del metodo GET con el id de la novedad a eliminar
if (isset($_GET) && !empty($_GET)) {
    $news = new NewsDao();
    $news->delete($_GET['id']);

    // Se retorna a la vista index con un mensaje de exito
    $message = "¡Novedad eliminada exitosamente!";
    $alert_class = "alert-success";
    header("Location: ../index.php?message=" . urlencode($message) . "&alert=" . urlencode($alert_class));
    exit;
}

if (isset($_POST) && !empty($_POST)) { // Se valida que el POST no este vacio

    // Obtener los datos de $_POST
    $data = $_POST;
    // Validar los campos
    $errors = validateFields($data);

    if (!empty($errors)) {
        // Se retorna a la vista index con un mensaje sobre el primer error encontrado
        $message = $errors[0];
        header("Location: ../index.php?message=" . urlencode($message) . "&alert=" . urlencode($alert_class));
        exit;
    }

    //Si el campo option trae el valor de save, significa que se quiere registrar un nuevo empleado
    if ($_POST['option'] === 'save') {

        //Se toman los datos y se asignan a un objeto de la clase Employee
        $news = post_to_object();

        // Se crea una instancia de EmployeeDao y por su funcion SET se registra el empleado en la base de datos
        $newsDao = new NewsDao();
        $newsDao->set($news);

        // Se retorna a la vista index con un mensaje de exito
        $message = "¡Novedad registrada exitosamente!";
        $alert_class = "alert-success";
        header("Location: ../index.php?message=" . urlencode($message) . "&alert=" . urlencode($alert_class));
        exit;
    }
    //Si el campo option trae el valor de update, significa que se quiere actualizar empleado existente
    else if ($_POST['option'] === 'update') {
        $news = post_to_object();

        // Se crea una instancia de EmployeeDao y por su funcion SET se registra el empleado en la base de datos
        $newsDao = new NewsDao();
        $newsDao->edit($news);

        // Se retorna a la vista index con un mensaje de exito
        $message = "¡Novedad actualizada exitosamente!";
        $alert_class = "alert-success";
        header("Location: ../index.php?message=" . urlencode($message) . "&alert=" . urlencode($alert_class));
        exit;
    }
}
//Si el POST esta vacio o no existe, se retorna al index sin ningun mensaje
else {
    header("Location: ../index.php");
    exit;
}