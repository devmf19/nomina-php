<?php
require_once '../dao/employee.dao.php';
require_once '../dao/news.dao.php';

//variable para retornar la clase de bootstrap que debe tener la alerta luego de realizar una accion
$alert_class = "alert-danger";

function validateFields($data)
{
    // Se definen en un array las reglas de que validaran los campos recibidos
    $validationRules = array(
        'id' => array('required' => true, 'type' => 'numeric', 'message' => "El campo ID es obligatorio y debe ser numérico."),
        'name' => array('required' => true, 'type' => 'string', 'message' => "El campo NOMBRES es obligatorio y debe ser una cadena de texto."),
        'address' => array('required' => true, 'type' => 'string', 'message' => "El campo DIRECCION es obligatorio y debe ser una cadena de texto."),
        'phone' => array('required' => true, 'type' => 'numeric', 'message' => "El campo TELEFONO es obligatorio y debe ser numérico."),
        'dependency' => array('required' => true, 'type' => 'string', 'message' => "El campo DEPENDENCIA es obligatorio y debe ser una cadena de texto."),
        'option' => array('required' => true, 'type' => 'string', 'message' => "Ocurrio un error. Recargue la pagina e intente nuevamente.")
    );

    // Se declara un array vacio que almacenara los errores en caso de que hayan
    $errors = array();

    // Se validan los campos y en caso de encontrar un error que viole las reglas de validacion
    // se almacena el mensaje de error en el array de errores
    foreach ($validationRules as $field => $rules) {
        if ($rules['required'] && empty($data[$field])) {
            $errors[] = $rules['message'];
        } elseif ($rules['type'] === 'numeric' && !is_numeric($data[$field])) {
            $errors[] = $rules['message'];
        } elseif ($rules['type'] === 'string' && !is_string($data[$field])) {
            $errors[] = $rules['message'];
        }
    }

    /*validar si existe la novedad buscando por su id*/

    return $errors;
}

function post_to_object()
{
    // Se asignan los datos recibidos por POST a un objeto de la clase Employee
    $employee = new Employee();
    $employee->setId($_POST['id']);
    $employee->setName($_POST['name']);
    $employee->setAddress($_POST['address']);
    $employee->setPhone($_POST['phone']);
    $employee->setDependency($_POST['dependency']);

    return $employee;
}

//La accion de eliminar se recibe a traves del metodo GET con el id del empleado a eliminar
if (isset($_GET) && !empty($_GET)) {
    $employeeDao = new EmployeeDao();
    $employeeDao->delete($_GET['id']);

    // Se retorna a la vista index con un mensaje de exito
    $message = "¡Empleado eliminado exitosamente!";
    $alert_class = "alert-success";
    header("Location: ../index.php?message=" . urlencode($message) . "&alert=" . urlencode($alert_class));
    exit;
}

//Las acciones de guardar, actualizar y eliminar se reciben a traves de POST y se diferencian por un input
// hidden que se encuentra en los formularios de registro, se llama option
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
        $employee = post_to_object();

        // Se crea una instancia de EmployeeDao y por su funcion SET se registra el empleado en la base de datos
        $employeeDao = new EmployeeDao();
        $employeeDao->set($employee);

        $news_id = $_POST['news'];
        $employee_id = $_POST['id'];
        $employeeDao->setHasNews($employee_id, $news_id);

        // Se retorna a la vista index con un mensaje de exito
        $message = "¡Empleado registrado exitosamente!";
        $alert_class = "alert-success";
        header("Location: ../index.php?message=" . urlencode($message) . "&alert=" . urlencode($alert_class));
        exit;
    }
    //Si el campo option trae el valor de update, significa que se quiere actualizar empleado existente
    else if ($_POST['option'] === 'update') {
        $employee = post_to_object();

        // Se crea una instancia de EmployeeDao y por su funcion SET se registra el empleado en la base de datos
        $employeeDao = new EmployeeDao();
        $employeeDao->edit($employee);

        // Se retorna a la vista index con un mensaje de exito
        $message = "¡Empleado actualizado exitosamente!";
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
