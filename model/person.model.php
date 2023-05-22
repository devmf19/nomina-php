<?php 

class Person {
    //Salario minimo
    protected static $min_pay = 250;
    
    private $id;
    private $name;
    private $lastname;

    function __construct() {
        $this->id = "";
        $this->name = "";
        $this->lastname = "";
    }

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getLastname(){
		return $this->lastname;
	}

	public function setLastname($lastname){
		$this->lastname = $lastname;
	}

}

?>