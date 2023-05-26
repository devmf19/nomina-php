<?php
require_once 'person.model.php';

class Employee extends Person
{
	private $address;
	private $phone;
	private $dependency;

	function __construct()
	{
		parent::__construct();
		$this->address = '';
		$this->phone = '';
		$this->dependency = '';
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function setAddress($address)
	{
		$this->address = $address;
	}

	public function getPhone()
	{
		return $this->phone;
	}

	public function setPhone($phone)
	{
		$this->phone = $phone;
	}

	public function getDependency()
	{
		return $this->dependency;
	}

	public function setDependency($dependency)
	{
		$this->dependency = $dependency;
	}
}
