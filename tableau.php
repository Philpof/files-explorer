<!-- Affichage le tableau -->

<?php

$contenu_url = scandir($chem_rep); // Liste des fichiers et dossiers dans un répertoire

foreach ($contenu_url as $item) { // Boucle "Foreach" pour parcourir les tableaux. En paramètre, la fonctionne prend une variable qui contient un tableau et
$taille = filesize($item); // Variable indiquant la taille de "item"
$type = mime_content_type($item);
$date = date("d-m-Y H:i:s", filemtime($item));
$proprio = fileowner($item);

  if (is_dir(realpath($item))) {
    echo "<tr>
            <td><i class='fas fa-folder'></i><a href='$item'> $item</a></td>
            <td>".$type."</td>
            <td>".$taille."</td>
            <td>".$date."</td>
          </tr>";
  }
  else {
    // if (strrchr($item,'.') != '.php' && strrchr($item,'.') != '.css' && strrchr($item,'.') != '.html') { // Masque les fichier .php, .css et .html qui ne seront pas affichés
      echo "<tr>
              <td><i class='fas fa-pencil-alt'></i><a href='$item'> $item</a></td>
              <td>".$type."</td>
              <td>".$taille."</td>
              <td>".$date."</td>
            </tr>";
    // }
  }
}

?>
