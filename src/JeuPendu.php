<?php

namespace App;

class JeuPendu{

    private MotADeviner $motADeviner;
    private int $nbTentativeRestante;
    private array $lettrePropose;

    public function __construct(){
        $this->motADeviner = new MotADeviner();
        $this->nbTentativeRestante = 7;
        $this->lettrePropose = [];
    }

    public function jouer() : void {

        echo "Bienvenue au jeu du Pendu ^^ \n";
        echo PHP_EOL;

        //Tant que le mot à deviner n'est pas complet et qu'il reste des tentatives au joueur alors le jeu continue.
        //Autrement dit, tant qu'il n'a pas gagné (trouvé le mot) ou perdu (épuisé toute ses tentatives) le joueur rejoue.
        while (!$this->motADeviner->isComplete() && $this->nbTentativeRestante>0){

            echo "Mot à Deviner : ";
            //affiche la progession du mot à compléter (exemple "t___te").
            echo $this->afficherMotCache();
            echo PHP_EOL;

            //Montre au joueur tous ses essayes non valide.
            echo "Lettre essayée : [".implode(" ,",$this->lettrePropose)."]";
            echo PHP_EOL;

            //Affiche le nombre de tentative restante.
            echo "Nombre de tentative restante : ".$this->nbTentativeRestante;
            echo PHP_EOL;

            //Traite la lettre donnée, réalise les modifications en conséquense si la lettre est bonne ou non.
            $this->traiterLettre($this->demanderLettre());
            echo PHP_EOL;

        }

        //Une fois le jeu arrêté on verifie si il s'est arrêté à cause d'une victoire ou d'une défaite.
        if ($this->motADeviner->isComplete()){
            echo "Bravo vous avez gagné ^^, Le mot à deviner était ".$this->motADeviner->getMot().".";
        }else{
            echo "Vous avez perdu, le mot à deviner était ".$this->motADeviner->getMot().".";
        }

    }

    public function afficherMotCache() : void {
        //Affiche le mot caché (étant sous forme de tableau) sous forme de chaîne de caractères.
        echo implode("",$this->motADeviner->getMotCache());
    }

    public function demanderLettre() : string {
        //Demande à l'utilisateur de rentrer une lettre.
        $lettre = readline("Saisissez une lettre : ");
        //Verifie si la lettre est bien une lettre et si elle n'est pas déjà présente dans le tableau des tentatives.
        if (is_string($lettre)&&!in_array($lettre,$this->lettrePropose)){
            return $lettre;
        }
        //Redemande à l'utilisateur de rentrer une lettre tant que celle-ci n'est pas valide.
        return $this->demanderLettre();
    }

    public function traiterLettre(string $lettre) : void {
        //Si la lettre donnée est bien dans le mot à trouvé
        if (str_contains($this->motADeviner->getMot(),$lettre)){
            //Alors appel de la méthode "updateMotCache" qui réalise le ou les changements sur le mot cache.
            $this->motADeviner->updateMotCache($lettre);
        }else{
            //Si la lettre n'est pas dans le mot alors le joueur perd une tentative.
            $this->nbTentativeRestante -= 1;
            //La lettre est rajoutée dans le tableau des tentatives.
            $this->lettrePropose [] = $lettre;
        }

    }

}