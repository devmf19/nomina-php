<?php 
require_once 'person.model.php';

class Employee extends Person{
    private $hours;
    private $hours_value;
    private $basic_pay;
    private $subsidy;
    private $source_retention;
    private $social_security;
    private $extra_hours;
    private $net_pay;

    function __construct() {
        parent::__construct();
        $this->hours = 0;
        $this->hours_value = 0;
        $this->basic_pay = 0;
        $this->subsidy = 0;
        $this->source_retention = 0;
        $this->social_security = 0;
        $this->extra_hours = 0;
        $this->net_pay = 0;
    }

    public function getHours(){
		return $this->hours;
	}

	public function setHours($hours){
		$this->hours = $hours;
	}

	public function getHours_value(){
		return $this->hours_value;
	}

	public function setHours_value($hours_value){
		$this->hours_value = $hours_value;
	}

	public function getBasic_pay(){
		return $this->basic_pay;
	}

	public function setBasic_pay(){
		//El salario base se calcula multiplicando el numero de horas laboradas por el valor de la hora
		$this->basic_pay = $this->hours * $this->hours_value;
	}

	public function getSubsidy(){
		return $this->subsidy;
	}

	//Si el salario base es menor a dos salarios minimos, el subsidio sera de un 10% sobre el valor de salario base
	public function setSubsidy(){
		$this->subsidy = $this->less_than_min_pay(2) ? ($this->basic_pay * 0.1) : 0;
	}

	public function getSource_retention(){
		return $this->source_retention;
	}

	public function setSource_retention(){
		//Si el salario base es menor a dos salarios minimos, no se cobra fueente de retencion
        if ($this->less_than_min_pay(2)){
            $this->source_retention = 0;
        }
		//Si el salario base esta entre 2 y 4 salarios minimos, se cobra el 7% sobre el valor del salario base
        else if (!$this->less_than_min_pay(2) && $this->less_than_min_pay(4)){
            $this->source_retention = $this->basic_pay * 0.07;
        }
		//Si el salario base supera los 4 salarios minimos, se cobra el 13% sobre el valor de salario base
		else {
            $this->source_retention = $this->basic_pay * 0.13;
        }
	}

	public function getSocial_security(){
		return $this->social_security;
	}

	public function setSocial_security(){
		//Se cobra obligatoriamente un seguro social del 4% sobre el valor del salario base
		$this->social_security = $this->basic_pay * 0.04;
	}

	public function getExtra_hours(){
		return $this->extra_hours;
	}

	public function setExtra_hours(){
		//Si el empleado ha laborado mas de 48 horas, se contaran las adiconales como horas extras y el valor sera el doble
        $times = $this->hours - 48;
        if($times > 0) {
            $this->extra_hours = $times * (2 * $this->hours_value);
        } else {
            $this->extra_hours = 0;
        }
	}

	public function getNet_pay(){
		return $this->net_pay;
	}

	public function setNet_pay(){
		//El sueldo neto se calcula sumando el sueldo base, el subsidio, las horas extras y restando el seguro social y la fuente de retencion
		$this->net_pay = $this->basic_pay + $this->subsidy + $this->extra_hours - $this->source_retention - $this->social_security;
	}

	//Metodo reutilizable que permite saber si el salario base es menor cierta cantidad de veces que el salario minimo
    private function less_than_min_pay($times){
        return $this->basic_pay < ($times * Person::$min_pay);
    }
}
