<?php
require_once 'abstract.dao.php';
require_once 'C:/xampp/htdocs/nomina-php/model/employee.model.php';

class EmployeeDao extends AbstractDao
{

    //Valida si un empleado existe en la base de datos segun su ID
    public function get($id = 0)
    {
        if ($id != 0) {
            $this->query = "
                SELECT *
                FROM employees
                WHERE id = '$id'
            ";

            $this->get_results_from_query();

            if (!empty($this->rows) && count($this->rows) == 1) {
                foreach ($this->rows[0] as $field => $value) {
                    $this->$field = $value;
                }
            } else {
                return false;
            }
        }
        return true;
    }

    //Se obtienen todos los datos de un empleado de la base de datos segun su id
    public function get_by_id($id)
    {
        $this->query = "
            SELECT *
            FROM employees
            WHERE id = '$id'
            ";
        $this->get_results_from_query();
        return $this->rows[0];
    }

    //Se obtienen todos empleados registrados en la base de datos
    public function get_all()
    {
        $this->query = "
            SELECT *
            FROM employees
        ";
        $this->get_results_from_query();
        return $this->rows;
    }

    //Se registra un nuevo empleado en la base de datos
    public function set($employee = null)
    {
        if ($employee === null) {
            $employee = new Employee();
        }

        if ($employee->getId() != 0) {
            $this->get($employee->getId());
            if (!$this->rows) {
                $this->query = "
                    INSERT INTO employees (
                        id,
                        name,
                        lastname,
                        address,
                        phone,
                        dependency
                    )
                    VALUES (
                        '{$employee->getId()}', 
                        '{$employee->getName()}', 
                        '{$employee->getLastname()}', 
                        '{$employee->getAddress()}',
                        '{$employee->getPhone()}',
                        '{$employee->getDependency()}'
                    )
                ";
                $this->execute_single_query();
            }
        }
    }

    //Se actualiza un empleado de la base de datos
    public function edit($employee = null)
    {
        if ($employee === null) {
            $employee = new Employee();
        }

        $this->query = "UPDATE employees
                        SET name = '{$employee->getName()}', 
                            lastname = '{$employee->getLastname()}', 
                            address = '{$employee->getAddress()}',
                            phone = '{$employee->getPhone()}',
                            dependency = '{$employee->getBasic_pay()}'
                        WHERE id = '{$employee->getDependency()}'";
        $this->execute_single_query();
    }

    //Se elimina un empledo de la base de datos
    public function delete($id = 0)
    {
        $this->query = "DELETE FROM employees
                        WHERE id = '{$id}'";
        $this->execute_single_query();
    }
}
