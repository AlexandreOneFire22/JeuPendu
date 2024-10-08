<?php

$listeMots = ["test","logiciel","ordinateur"];
$motADeviner = $listeMots[rand(0,count($listeMots)-1)] ;
$motCache [] = str_split("___");

//(implode("",$this->motCache)) == $this->motADeviner

echo "le test à donnée :   ". gettype($listeMots);
echo "le test à donnée : $motADeviner   ". gettype($motADeviner);
echo "le test à donnée : $motCache   ". gettype($motCache);