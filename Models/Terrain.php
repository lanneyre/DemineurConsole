<?php
class Terrain{
	private $longueur;
	private $hauteur;
	private $tabMines;
	private $terrainCache;
	public static $lettres = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j"];
	
	function __construct($l, $h, $mines){
		$this->longueur = $l;
		$this->hauteur = $h;
		$this->tabMines = array();
		if($mines >= ($l*$h)/3){
			$mines = ($l*$h)/3;
		}
		//pour le moment, les mines en dur :
		for($i=0;$i<$mines;$i++){
			do{
				$x = self::$lettres[rand(0, $l-1)];
				$y = rand(1, $h);
				$m = new Mine($x, $y);
			} while(in_array($m, $this->tabMines));
			
			$this->tabMines[] = $m;
		}
		$this->genereAffichageTerrain();
	}
	
	//fonction permettant d'afficher dans la console le terrain avec les mines révélées
	function afficherSolution(){	
		//d'abord on crée un tableau contenant les "cases" à afficher
		$tabTerrain = array();
		//on crée une à une les lignes du tableau

		$tabTerrain[" "][0] = " ";
		for($i=1;$i<=$this->hauteur;$i++){
			$tabTerrain[self::$lettres[$i-1]][] = self::$lettres[$i-1];
		}
		for($i=0;$i<$this->longueur;$i++){
			$tabTerrain[" "][] = $i+1;
		}
		for($i=0;$i<$this->hauteur;$i++){
			//dedans, on crée les colonnes et on remplit chaque case
			for($j=1;$j<=$this->longueur;$j++){
				$tabTerrain[self::$lettres[$i]][$j] = "O";
			}
		}
		
		//on note les mines
		foreach($this->tabMines as $value){
			$tabTerrain[$value->x][$value->y] = "X";
		}
		//on fait l'affichage
		foreach($tabTerrain as $value){
			foreach($value as $case){
				print($case." ");
			}
			print("\n");
		}
		
	}

	function genereAffichageTerrain(){
		//d'abord on crée un tableau contenant les "cases" à afficher
		$this->terrainCache = array();
		//on crée une à une les lignes du tableau
		$this->terrainCache[" "][0] = " ";
		for($i=1;$i<=$this->hauteur;$i++){
			$this->terrainCache[self::$lettres[$i-1]][] = self::$lettres[$i-1];
		}

		for($i=0;$i<$this->longueur;$i++){
			$this->terrainCache[" "][] = $i+1;
		}

		for($i=0;$i<$this->hauteur;$i++){
			//dedans, on crée les colonnes et on remplit chaque case
			for($j=1;$j<=$this->longueur;$j++){
				$this->terrainCache[self::$lettres[$i]][$j] = "O";
			}
		}
	}

	function changeTerrain($l, $h, $txt= " "){
		$tabCoordToTest = array();
		// var_dump($h);
		$indexLMin = array_search($l,Terrain::$lettres)-1;
		$indexHMin = $h-1;
		$indexLMax = array_search($l,Terrain::$lettres)+1;
		$indexHMax = $h+1;

		if($indexLMin < 0){
			$indexLMin = 0;
		}
		if($indexHMin < 0){
			$indexHMin = 0;
		}
		if($indexLMax > $this->longueur){
			$indexLMax = $this->longueur;
		}
		if($indexHMax > $this->hauteur){
			$indexHMax = $this->hauteur;
		}
		// var_dump($indexLMin, $indexLMax);
		for ($i=$indexLMin; $i <= $indexLMax; $i++) { 
			# code...
			for ($j=$indexHMin; $j <= $indexHMax; $j++) { 
				# code...
				$tabCoordToTest[] = new Mine(self::$lettres[$i], $j);
			}
		}
		$compteur = 0;
		var_dump($tabCoordToTest);
		foreach ($tabCoordToTest as $m) {
			# code...
			if(in_array($m, $this->tabMines)){
				$compteur++;
			}
		}
		$this->terrainCache[$l][$h] = $compteur;
	}

	//fonction permettant d'afficher dans la console le terrain avec les mines révélées
	function afficherTerrain(){			
		//on fait l'affichage
		foreach($this->terrainCache as $value){
			foreach($value as $case){
				print($case." ");
			}
			print("\n");
		}
		
	}
	
	function __get($name){
		return $this->$name;
	}
	function __set($name, $value){
		$this->$name = $value;
	}
	
}