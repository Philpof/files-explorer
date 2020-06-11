<!-- Suppression de fichier -->

<?php

if (empty($_POST["suppr_fichier"])) {
  $text_suppr = "Indiquer le nom du fichier à supprimer avec son extension (par ex. : fichier.txt).";
}
else {
    $del_fichier = $_POST["suppr_fichier"]; // variable se créé après avoir vérifier si le champ est vide ou pas
    if (!file_exists($del_fichier)) {
      $text_suppr= "Le fichier $del_fichier n'existe pas.";
    }
    else {
      if (is_dir($del_fichier)) {
        $text_suppr= "$del_fichier est un dossier et non un fichier.";
      }
      else {
        unlink($del_fichier);
        if (!file_exists($del_fichier)) {
          $text_suppr = "Le fichier $del_fichier a bien été supprimé.";
        }
      }
    }
  }
?>
