<?php

namespace App;

class MotADeviner{

    private array $listeMots;
    private string $motADeviner;
    private array $motCache;

    /**
     * @param array $listeMots
     * @param string $motADeviner
     * @param array $motCache
     */
    public function __construct()
    {
        $this->listeMots = ["test","logiciel","ordinateur"];
        $this->motADeviner = $this->listeMots[rand(0,count($this->listeMots)-1)] ;
        $this->motCache = str_split(str_repeat("_",strlen($this->motADeviner)));
    }

    public function getMot() : string {
        return $this->motADeviner;
    }

    public function getMotCache() : array {
        return $this->motCache;
    }

    public function updateMotCache(string $lettre) : void {

        $motADeviner = str_split($this->motADeviner);
        foreach ($motADeviner as $index=>$caractere){
            if ($caractere == $lettre){
                $this->motCache[$index] = $lettre;
            }
        }
    }

    public function isComplete() : bool{
        return (implode("",$this->motCache)) == $this->motADeviner;
    }













}