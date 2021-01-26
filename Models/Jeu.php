<?php
class Jeu{
    private $terrain;
    
    function __construct($l=10, $h=10, $nbMines=30)
    {
        $this->terrain = new Terrain($l, $h, $nbMines);
        $this->creuser();
    }

    function __get($name)
    {
        return $this->$name;
    }

    function creuser(){
        $this->terrain->afficherTerrain();
        // echo "-----------------------\n";
        // $this->terrain->afficherSolution();
        // $lettre = readline("Entrez une lettre");
        // $chiffre = readline("Entrez un chiffre");
        do{
            $input = strtolower(readline("Entrez les coordonnées d'une case (format LettreChiffre ex : a1) : "));
            $coord["x"] = substr($input,0,1);
            $coord["y"] = substr($input,1);

            $testX = array_search($coord["x"],Terrain::$lettres);
            if(!is_bool($testX)){
                $testX = $testX <= $this->terrain->longueur;
            }

            $testY = $coord["y"] <= $this->terrain->hauteur;
            
        }while( !$testX || !$testY );

        $mine = new Mine($coord["x"], $coord["y"]);
        if(in_array($mine, $this->terrain->tabMines)){
            echo "BOOOMMM ! t'es mort !\n";
            $this->terrain->afficherSolution();
        } else {
            // var_dump($this->terrain->terrainCache[$coord["x"]][$coord["y"]]);
            $this->terrain->changeTerrain($coord["x"],$coord["y"]);
            if($this->terrain->evaluateTerrain()){
                echo "Bravo, vérifier votre chance auprès de votre conjoint(e) !";
            } else {
                echo "Essaye encore\n";
                $this->creuser();
            }
            
        }
    }
}