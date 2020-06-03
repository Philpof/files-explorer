<?php

date_default_timezone_set('UTC');
$annee_en_cours = date('Y');

$ma_date_de_naissance = $_POST["birthdate"];

$mon_prenom = $_POST["name"];

$mon_age = $annee_en_cours - $ma_date_de_naissance;

echo "Bonjour, je suis " . $mon_prenom . " et j'ai " . $mon_age . " ans";
