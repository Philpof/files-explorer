<!-- Création de fichier -->

<?php

if (empty($_POST["nom_fichier"])) {
  $text_fichier = "Indiquer le nom du fichier à créer.<br>(il sera créé en .txt)";
}
else {
    $nouveau_fichier = $_POST["nom_fichier"]; // variable se créé après avoir vérifier si le champ est vide ou pas
    if (file_exists($nouveau_fichier.".txt") && !is_dir($nouveau_fichier.".txt")) {
      $text_fichier = "Le fichier $nouveau_fichier.txt existe déjà.";
    }
    else {
      touch($nouveau_fichier.".txt");
      if (file_exists($nouveau_fichier.".txt") && !is_dir($nouveau_fichier.".txt")) {
        $text_fichier = "Le fichier $nouveau_fichier.txt a bien été créé.";
      }
    }
  }

?>
