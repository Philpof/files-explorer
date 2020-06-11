<!-- Affichage du chemin du répertoire courant -->

<?php

if(isset($_POST['selected'])) {
    if(chdir($_POST['selected'])) { //si un dossier est sélectionné aller vers ce dossier
      chdir($_POST['selected']);
    }else{
      chdir(getcwd());
    }
}
$chem_rep = getcwd(); // Récupère le chemin du répertoire courant
echo "<span class=\"font-weight-bold\">Chemin actuel :</span>"." ".$chem_rep; // Affiche le contenu de la variable $dir

?>
