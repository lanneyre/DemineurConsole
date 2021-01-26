<?php
class Mine{
	private $x;
	private $y;
	
	function __construct($lettre, $chiffre){
		$this->x = $lettre;
		$this->y = $chiffre;
	}

	function __get($name){
		return $this->$name;
	}
	function __set($name, $value){
		$this->$name = $value;
	}
}