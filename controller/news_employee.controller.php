<?php
require_once '../dao/employee.dao.php';
require_once '../dao/news.dao.php';
require_once '../dao/employees-news.dao.php';

//variable para retornar la clase de bootstrap que debe tener la alerta luego de realizar una accion
$alert_class = "alert-danger";
function post_to_object()
{
    // Se asignan los datos recibidos por POST a un objeto de la clase Employee
    $employee_news = new EmployeeNews();
    $employee_news->setEmployee_id($_POST['employee_id']);
    $employee_news->setNew_id($_POST['news_id']);
    $employee_news->setValue($_POST['value']);
    $employee_news->setEn_date($_POST['en_date']);

    return $employee_news;
}

if (isset($_POST) && !empty($_POST)) { // Se valida que el POST no este vacio

    //Se toman los datos y se asignan a un objeto de la clase EmployeeNews
    $employee_news = post_to_object();

    // Se crea una instancia de EmployeeNewsDao y por su funcion SET se registra en la base de datos
    $employee_newsDao = new EmployeeNewsDao();
    $employee_newsDao->set($employee_news);

    // Se retorna a la vista index con un mensaje de exito
    $message = "¡Novedad completada exitosamente!";
    $alert_class = "alert-success";
    header("Location: ../index.php?message=" . urlencode($message) . "&alert=" . urlencode($alert_class));
    exit;
}
//Si el POST esta vacio o no existe, se retorna al index sin ningun mensaje
else {
    header("Location: ../index.php");
    exit;
}
