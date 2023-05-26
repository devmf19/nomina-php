<?php
require_once 'abstract.dao.php';
require_once 'C:/xampp/htdocs/nomina-php/model/employee-news.model.php';

class EmployeeNewsDao extends AbstractDao{
    
    public function get($employee_id = 0, $news_id = 0)
    {
        if ($employee_id != 0 && $news_id = 0) {
            $this->query = "
                SELECT *
                FROM employees e
                INNER JOIN employees-news en 
                ON e.id = en.employee_id
                INNER JOIN news n 
                ON en.news_id = n.id
                WHERE e.id = '$employee_id'
                AND n.id = '$news_id'
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

    /*public function get_by_id($employee_id = 0, $news_id = 0)
    {
        $this->query = "
            SELECT *
            FROM employees e
            INNER JOIN employees-news en 
            ON e.id = en.employee_id
            INNER JOIN news n 
            ON en.news_id = n.id
            WHERE e.id = '$employee_id'
            AND n.id = '$news_id'
        ";
        $this->get_results_from_query();
        return $this->rows[0];
    }*/

    public function get_all()
    {
        $this->query = "
            SELECT *
            FROM employees-news
        ";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function set($employee_news = null)
    {
        if ($employee_news === null) {
            $employee_news = new EmployeeNews();
        }

        if ($employee_news->getEmployee_id() != 0 && $employee_news->getNews_id() != 0) {
            $this->get($employee_news->getEmployee_id(), $employee_news->getNews_id());
            if (!$this->rows) {
                $this->query = "
                    INSERT INTO employees-news (
                        employee_id,
                        news_id,
                        value,
                        date
                    )
                    VALUES (
                        '{$employee_news->getEmployee_id()}', 
                        '{$employee_news->getNews_id()}', 
                        '{$employee_news->geValue()}', 
                        '{$employee_news->getDate()}'
                    )
                ";
                $this->execute_single_query();
            }
        }
    }

    public function edit($employee_news = null)
    {
        if ($employee_news === null) {
            $employee_news = new EmployeeNews();
        }

        $this->query = "UPDATE employees-news
                        SET value = '{$employee_news->getValue()}', 
                            date = '{$employee_news->getDate()}', 
                        WHERE employee_id = '{$employee_news->getEmployee_id()}'
                        WHERE news_id = '{$employee_news->getNews_id()}'
                    ";
        $this->execute_single_query();
    }

    public function delete($employee_id = 0, $news_id = 0)
    {
        $this->query = "DELETE FROM employee-news
                        WHERE employee_id = '{$employee_id}'
                        WHERE news_id = '{$news_id}'
                        ";
        $this->execute_single_query();
    }
}
