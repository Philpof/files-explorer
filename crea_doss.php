<!-- Création de dossier -->

<?php

if (empty($_POST["nom_dossier"])) {
  $text_dossier = "Indiquer le nom du dossier à créer.";
}
else {
    $nouveau_dossier = $_POST["nom_dossier"]; // variable se créé après avoir vérifier si le champ est vide ou pas
    if (file_exists($nouveau_dossier) && is_dir($nouveau_dossier)) {
      $text_dossier = "Le dossier $nouveau_dossier existe déjà.";
    }
    else {
      mkdir($nouveau_dossier);
      if (file_exists($nouveau_dossier) && is_dir($nouveau_dossier)) {
        $text_dossier = "Le dossier $nouveau_dossier a bien été créé.";
      }
    }
  }

?>
