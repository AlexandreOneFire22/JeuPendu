<?php

namespace App;

class JeuPendu{

    private MotADeviner $motADeviner;
    private int $nbTentativeRestante;
    private array $lettrePropose;

    /**
     * @param MotADeviner $motADeviner
     * @param int $nbTentativeRestante
     * @param array $lettrePropose
     */
    public function __construct(){
        $this->motADeviner = new MotADeviner();
        $this->nbTentativeRestante = 7;
        $this->lettrePropose = [];
    }

    public function jouer() : void {

        echo "Bienvenue au jeu du Pendu ^^ \n";
        echo PHP_EOL;

        while (!$this->motADeviner->isComplete() && $this->nbTentativeRestante>0){
            echo "Mot à Deviner : ".$this->afficherMotCache();
            echo PHP_EOL;
            echo "Lettre essayée : [".implode(" ,",$this->lettrePropose)."].";
            echo PHP_EOL;
            $this->traiterLettre($this->demanderLettre());
            echo PHP_EOL;
            echo "Nombre de tentative restante : ".$this->nbTentativeRestante;
            echo PHP_EOL;

        }
        if ($this->motADeviner->isComplete()){
            echo "Bravo vous avez gagné ^^, Le mot à deviner était ".$this->motADeviner->getMot().".";
        }else{
            echo "Vous avez perdu, le mot à deviner était ".$this->motADeviner->getMot().".";
        }

    }

    public function afficherMotCache() : void {
        echo implode("",$this->motADeviner->getMotCache());
    }

    public function demanderLettre() : string {
        $lettre = readline("Saisissez une lettre : ");
        return $lettre;
    }

    public function traiterLettre(string $lettre) : void {

        if (str_contains($this->motADeviner->getMot(),$lettre)){
            $this->motADeviner->updateMotCache($lettre);
        }else{
            $this->nbTentativeRestante -= 1;
        }

    }






















}