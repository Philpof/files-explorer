<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Philippe PERECHODOV">
  <title>File Explorer</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

</head>

<body>

<section class="container">

  <div class="col-sm p-3 mb-2 bg-dark text-white text-center">
    <h3>Explorateur de fichier</h3>
  </div>

  <?php

  date_default_timezone_set('Europe/Paris'); // GMT pour la France

  // Création de dossier
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

  // Création de fichier
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

  // Suppression de fichier
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

  <div class="p-3 mb-2 bg-light text-dark">
    <div class="">
      <?php
        $url = getcwd(); // Récupère le chemin du répertoire courant
        echo $url; // Affiche le contenu de la variable $url
      ?>
    </div>

    <div class="">

    <?php

// Fil d'ariane cliquable (http://www.astuces-webmaster.ch/page/fil-ariane-php)
$def = "index";
$dPath = $_SERVER['PHP_SELF'];
$dChunks = explode("/", $dPath);

echo('<a class="dynNav" href="/">Accueil</a><span class="dynNav"> > </span>');
for($i=1; $i<count($dChunks); $i++ ){
	echo('<a class="dynNav" href="/');
	for($j=1; $j<=$i; $j++ ){
		echo($dChunks[$j]);
		if($j!=count($dChunks)-1){ echo("/");}
	}

	if($i==count($dChunks)-1){
		$prChunks = explode(".", $dChunks[$i]);
		if ($prChunks[0] == $def) $prChunks[0] = "";
		$prChunks[0] = $prChunks[0] . "</a>";
	}
	else $prChunks[0]=$dChunks[$i] . '</a><span class="dynNav"> > </span>';
	echo('">');
	echo(str_replace("_" , " " , $prChunks[0]));
}

    ?>

    </div>

  </div>
</section>

<section class="container"> <!-- Tableau pour afficher les répertoire et fichiers trouvés par "getcwd"-->
  <table class="table table-hover"> <!-- Tableau Bootstrap : Hoverable rows -->
    <thead>
      <tr>
        <th scope="col">Nom</th>
        <th scope="col">Type</th>
        <th scope="col">Taille</th>
        <th scope="col">Date de Modification</th>
      </tr>
    </thead>
    <tbody>
      <?php
          $contenu_url = scandir($url); // Liste des fichiers et dossiers dans un répertoire

          foreach ($contenu_url as $item) { // Boucle "Foreach" pour parcourir les tableaux. En paramètre, la fonctionne prend une variable qui contient un tableau et
          $taille = filesize($item); // Variable indiquant la taille de "item"
          $type = mime_content_type($item);
          $date = date("d-m-Y H:i:s", filemtime($item));
          $proprio = fileowner($item);

            if (is_dir("$item")) {

              echo "<tr>
                      <td><i class=\"fas fa-folder\"></i><a href=\"$item\"> ".$item."</a></td>
                      <td>".$type."</td>
                      <td>".$taille."</td>
                      <td>".$date."</td>
                    </tr>";
            }
            else {
              if (strrchr($item,'.') != '.php' && strrchr($item,'.') != '.css' && strrchr($item,'.') != '.html') { // Masque les fichier .php, .css et .html qui ne seront pas affichés
                echo "<tr>
                        <td><i class=\"fas fa-pencil-alt\"></i> <a href=\"$item\">".$item."</a></td>
                        <td>".$type."</td>
                        <td>".$taille."</td>
                        <td>".$date."</td>
                      </tr>";
              }
            }
          }
      ?>
    </tbody>
  </table> <!-- Fin du tableau de Bootstrap -->
</section>

<section class="container">
  <div class="row">
    <!-- Création de dossier -->
    <div class="col-sm p-3 mb-2 bg-dark text-white text-center rounded border border-light">
      <form class="mb-2" action="index.php" method="post">
         <label for="nom_dossier" class="text-uppercase font-weight-bold">création de dossier</label>
         <input type="text" placeholder="Nom du nouveau dossier" name="nom_dossier"><button type="submit" class="ml-1">Créer</button>
      </form>
      <?php
        echo $text_dossier;
      ?>
    </div>

    <!-- Création de fichier -->
    <div class="col-sm p-3 mb-2 bg-dark text-white text-center rounded border border-light">
      <form class="mb-2" action="index.php" method="post">
         <label for="nom_fichier" class="text-uppercase font-weight-bold">création de fichier</label>
         <input type="text" placeholder="Nom du nouveau fichier" name="nom_fichier"><button type="submit" class="ml-1">Créer</button>
      </form>
      <?php
        echo $text_fichier;
      ?>
    </div>

    <!-- Suppression de fichier -->
    <div class="col-sm p-3 mb-2 bg-dark text-white text-center rounded border border-light">
      <form class="mb-2" action="index.php" method="post">
         <label for="suppr_fichier" class="text-uppercase font-weight-bold">suppression de fichier</label>
         <input type="text" placeholder="Nom du fichier à supprimer" name="suppr_fichier"><button type="submit" class="ml-1">Supprimer</button>
      </form>
      <?php
        echo $text_suppr;
      ?>
    </div>

  </div>
</section>



<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
