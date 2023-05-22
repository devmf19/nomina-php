<?php 
require_once 'abstract.dao.php';
require_once 'C:/xampp/htdocs/nomina-php/model/employee.model.php';

class EmployeeDao extends AbstractDao{
    
    //Valida si un empleado existe en la base de datos segun su ID
    public function get($id = 0){
        if($id != 0){
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
    public function get_by_id($id) {
        $this->query = "
            SELECT *
            FROM employees
            WHERE id = '$id'
            ";
        $this->get_results_from_query();
        return $this->rows[0];
    }

     //Se obtienen todos empleados registrados en la base de datos
    public function get_all() {
        $this->query = "
            SELECT *
            FROM employees
        ";
        $this->get_results_from_query();
        return $this->rows;
    }

     //Se registra un nuevo empleado en la base de datos
    public function set($employee = null) {
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
                        hours,
                        hours_value,
                        basic_pay, 
                        subsidy,
                        source_retention,
                        social_security,
                        extra_hours,
                        net_pay
                    )
                    VALUES (
                        '{$employee->getId()}', 
                        '{$employee->getName()}', 
                        '{$employee->getLastname()}', 
                        '{$employee->getHours()}',
                        '{$employee->getHours_value()}',
                        '{$employee->getBasic_pay()}',
                        '{$employee->getSubsidy()}',
                        '{$employee->getSource_retention()}',
                        '{$employee->getSocial_security()}',
                        '{$employee->getExtra_hours()}',
                        '{$employee->getNet_pay()}'
                    )
                ";
                $this->execute_single_query();
            }
        }
    }
    
     //Se actualiza un empleado de la base de datos
    public function edit($employee = null) {
        if ($employee === null) {
            $employee = new Employee();
        }
        
        $this->query = "UPDATE employees
                        SET name = '{$employee->getName()}', 
                            lastname = '{$employee->getLastname()}', 
                            hours = '{$employee->getHours()}',
                            hours_value = '{$employee->getHours_value()}',
                            basic_pay = '{$employee->getBasic_pay()}',
                            subsidy = '{$employee->getSubsidy()}',
                            source_retention = '{$employee->getSource_retention()}',
                            social_security = '{$employee->getSocial_security()}',
                            extra_hours = '{$employee->getExtra_hours()}',
                            net_pay = '{$employee->getNet_pay()}'
                        WHERE id = '{$employee->getId()}'";
        $this->execute_single_query();
    }

     //Se elimina un empledo de la base de datos
    public function delete($id = 0) {
        $this->query = "DELETE FROM employees
                        WHERE id = '{$id}'";
        $this->execute_single_query();
    }
}
