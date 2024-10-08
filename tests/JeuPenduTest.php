<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\JeuPendu;

$jeu = new JeuPendu();

$jeu->jouer();
