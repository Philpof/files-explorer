<!-- Affichage du chemin du répertoire courant -->

<?php

if(isset($_POST['url'])) {
    if(chdir($_POST['url'])) { //si un dossier est sélectionné aller vers ce dossier
      chdir($_POST['url']);
    }else{
      chdir(getcwd());
    }
}
$chem_rep = getcwd(); // Récupère le chemin du répertoire courant
$aff_chem_rep = "<span class=\"font-weight-bold\">Chemin actuel :</span>"." ".$chem_rep; // Affiche le contenu de la variable $dir

?>
