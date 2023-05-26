<?php 

class News {
    private $id;
    private $description;
    private $type;

    function __construct()
    {
        $this->id = 0;
        $this->description = '';
        $this->type = '';
    }

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getDescription(){
		return $this->description;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function getType(){
		return $this->type;
	}

	public function setType($type){
		$this->type = $type;
	}
}


?>