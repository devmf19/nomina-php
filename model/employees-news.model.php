<?php 

class EmployeesNews {
    private $employee_id;
    private $new_id;
    private $value;
    private $date;

    function __construct()
    {
        $this->employee_id = 0;
        $this->new_id = 0;
        $this->value = 0;
        $this->date = '';
    }

    public function getEmployee_id(){
		return $this->employee_id;
	}

	public function setEmployee_id($employee_id){
		$this->employee_id = $employee_id;
	}

	public function getNew_id(){
		return $this->new_id;
	}

	public function setNew_id($new_id){
		$this->new_id = $new_id;
	}

	public function getValue(){
		return $this->value;
	}

	public function setValue($value){
		$this->value = $value;
	}

	public function getDate(){
		return $this->date;
	}

	public function setDate($date){
		$this->date = $date;
	}
}

?>