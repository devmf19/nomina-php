<?php
require_once 'abstract.dao.php';
require_once 'C:/xampp/htdocs/nomina-php/model/news.model.php';

class NewsDao extends AbstractDao{
    
    public function get($id = 0)
    {
        if ($id != 0) {
            $this->query = "
                SELECT *
                FROM news
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

    public function get_by_id($id)
    {
        $this->query = "
            SELECT *
            FROM news
            WHERE id = '$id'
            ";
        $this->get_results_from_query();
        return $this->rows[0];
    }

    public function get_all()
    {
        $this->query = "
            SELECT *
            FROM news
        ";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function set($new = null)
    {
        if ($new === null) {
            $new = new News();
        }

        if ($new->getId() != 0) {
            $this->get($new->getId());
            if (!$this->rows) {
                $this->query = "
                    INSERT INTO news (
                        id,
                        description,
                        type
                    )
                    VALUES (
                        '{$new->getId()}', 
                        '{$new->geDescription()}', 
                        '{$new->getType()}'
                    )
                ";
                $this->execute_single_query();
            }
        }
    }

    public function edit($new = null)
    {
        if ($new === null) {
            $new = new News();
        }

        $this->query = "UPDATE news
                        SET name = '{$new->getDescription()}', 
                            lastname = '{$new->getType()}', 
                        WHERE id = '{$new->getId()}'";
        $this->execute_single_query();
    }

    public function delete($id = 0)
    {
        $this->query = "DELETE FROM news
                        WHERE id = '{$id}'";
        $this->execute_single_query();
    }
}

?>