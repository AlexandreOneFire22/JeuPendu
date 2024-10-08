<?php

namespace App;

class MotADeviner{

    private array $listeMots;
    private string $motADeviner;
    private array $motCache;


    public function __construct()
    {
        //Récupère sous forme de tableau la liste de mots présent dans le fichier "listeMots.txt".
        $this->listeMots = explode("\n",file_get_contents(__DIR__."/listeMots.txt"));

        //Prend aléatoirement un mot du tableau "$this->listeMots".
        $this->motADeviner = $this->listeMots[rand(0,count($this->listeMots)-1)] ;

        //Crée un tableau composé de "_" de la même taille que le mots "$this->motADeviner".
        $this->motCache = str_split(str_repeat("_",strlen($this->motADeviner)));
    }

    public function getMot() : string {
        return $this->motADeviner;
    }

    public function getMotCache() : array {
        return $this->motCache;
    }

    public function updateMotCache(string $lettre) : void {

        //Crée un tableau qui contient lettre par lettre le mot à faire deviner.
        $motADeviner = str_split($this->motADeviner);

        foreach ($motADeviner as $index=>$caractere){

            //Si la lettre rentrer par le joueur est égale à une lettre du mot.
            if ($caractere == $lettre){

                //Alors à l'emplacement de la lettre trouvé, la lettre prendra la place du "_" dans le mots caché (composer que de "_").
                $this->motCache[$index] = $lettre;
            }
        }
    }

    public function isComplete() : bool{
        //Renvoie True si le mot à été entièrement trouvé, sinon renvoie False.
        return (implode("",$this->motCache)) == $this->motADeviner;
    }













}