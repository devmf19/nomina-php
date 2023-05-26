<?php
require_once 'abstract.dao.php';
require_once 'C:/xampp/htdocs/nomina-php/model/employee-news.model.php';

class EmployeeNewsDao extends AbstractDao
{

    public function get($employee_id = 0)
    {
        if ($employee_id != 0) {
            $this->query = "
                SELECT *
                FROM employee_news
                WHERE id_employee = '$employee_id'
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

    public function get_by_id($employee_id = 0, $news_id = 0)
    {
        if ($employee_id != 0 &&  $news_id != 0) {
            $this->query = "
            SELECT *
            FROM employee_news
            WHERE id_employee = '$employee_id'
            AND id_news = '$news_id'
        ";
            $this->rows = array();
            $this->get_results_from_query();

            if (!empty($this->rows) && count($this->rows) == 1) {
                return $this->rows[0];
            } else {
                return false;
            }
        }
        return false;
    }

    public function get_all()
    {
        $this->query = "
            SELECT *
            FROM employee_news
        ";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function set($employee_news = null)
    {
        if ($employee_news === null) {
            $employee_news = new EmployeeNews();
        }

        if ($employee_news->getEmployee_id() != 0 && $employee_news->getNew_id() != 0) {
            $this->get($employee_news->getEmployee_id(), $employee_news->getNew_id());
            if (!$this->rows) {
                $this->query = "
                    INSERT INTO employee_news (
                        id_employee,
                        id_news,
                        value,
                        en_date
                    )
                    VALUES (
                        '{$employee_news->getEmployee_id()}', 
                        '{$employee_news->getNew_id()}', 
                        '{$employee_news->getValue()}', 
                        '{$employee_news->getEn_date()}'
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

        $this->query = "UPDATE employee_news
                        SET value = '{$employee_news->getValue()}', 
                            date = '{$employee_news->getDate()}', 
                        WHERE id_employee = '{$employee_news->getEmployee_id()}'
                        AND id_news = '{$employee_news->getNews_id()}'
                    ";
        $this->execute_single_query();
    }

    public function delete($employee_id = 0, $news_id = 0)
    {
        $this->query = "DELETE FROM employee_news
                        WHERE id_employee = '{$employee_id}'
                        AND id_news = '{$news_id}'
                        ";
        $this->execute_single_query();
    }
}
