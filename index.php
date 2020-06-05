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

</head>

<body>

<?php
//date_default_timezone_set('Europe/Paris');

  // -----Création de fichiers-----
  // fopen permet de créer un nouveau fichier
  // Si on utilise fopen avec un fichier qui n'existe pas, le fichier va être créé dans le même répertoire que le script qui lance la commande,
  // si on uilise l'option "w" ou "a"
  // https://www.w3schools.com/php/php_file_create.asp
  //
  // if (!file_exists("nouveau_fichier_cree.txt")) {
  //   $myfile = fopen("nouveau_fichier_cree.txt", "w") or die("Unable to open file!");
  //   $txt = "Salut !\n";
  //   fwrite($myfile, $txt);
  //   $txt = "Ca va ?\n";
  //   fwrite($myfile, $txt);
  //   fclose($myfile);
  // }


// $url = getcwd(); // Récupère le chemin du répertoire courant
// echo $url; // Affiche le contenu de la variable $url
//
// $contenu = scandir($url); // Liste des fichiers et dossiers dans un répertoire
// // echo $contenu; // Affiche la liste des dossiers et fichiers du répertoire --> [Ne fonctionne pas car erreur "Array to string" (la fonctionne scandir renvoi à un tableau)]
//
// foreach ($contenu as $item) { // Boucle "Foreach" pour parcourir les tableaux. En paramètre, la fonctionne prend une variable qui contient un tableau et
//   $size = filesize($item); // On initialise des variables qui contiennent des fonctions récupérant des informations sur les items
//   $type = mime_content_type($item);
//   $date = date("d-m-Y H:i:s", filemtime($item));
//   $owner = fileowner($item);
//
//   echo "<br>".$item." ".$size." ".$type." ".$date." ".$owner;
// }
//
?>

 <div class="container">
   <div class="col-sm mt-3 mb-2 text-center">
       <h2>Files Explorer</h2>
   </div>

     <div class="row">
       <div class="col-sm mt-3 mb-2">

         <?php
         // BREADCRUMBS
         $url = getcwd(); // Récupère le chemin du répertoire courant
         $parts = parse_url($url); // analyse l'url et retourne ses composants
         $path = pathinfo($parts['path']); // retourne les infos sur le chemin du répertoire

         // explode sépare chaque élément, trim = supprime les espaces
         $segments = explode('/', trim($path['dirname'],'/'));

         $breadcrumbs[] = '<a href="/">Home</a>';
         $crumb_path = '';

         foreach ($segments as $segment)
         {
             $crumb_path .= '/' . $segment;

             // ucfirst : majuscule première lettre du mot
             $value = ucfirst($segment);

             $breadcrumbs[] = '<a href="' . $crumb_path . '">' . $value . '</a>';
         }

         $breadcrumbs[] = ucwords(str_replace('_', ' ', $path['filename']));
         $breadcrumbs   = implode(' > ', $breadcrumbs);

         ?>

         <nav aria-label="breadcrumb">
           <ol class="breadcrumb">
             <li class="breadcrumb-item"><?php echo $breadcrumbs; ?></li>
           </ol>
         </nav>



       </div>
     </div>
   </div>

 <div class="container">
   <div class="row">
     <div class="col-sm mt-3">
 <?php
   $url = getcwd(); //gets the current working directory
   $contents = scandir($url); //scan the directory
 ?>

 <table class="table table-sm table-hover mb-5">
   <thead>
     <tr>
       <th scope="col">Nom</th>
       <th scope="col">Taille</th>
       <th scope="col">Type</th>
       <th scope="col">Propriétaire</th>
       <th scope="col">Date modif</th>
     </tr>
   </thead>
   <tbody>
 <?php
   foreach ($contents as $item) {
      $size = "<span style='font-size:12px;'>".filesize($item)."</span>";
      $type = "<span style='font-size:12px;'>".mime_content_type($item)."</span>";
      $date = "<span style='font-size:12px;'>".date("d-m-Y H:i:s", filemtime($item))."</span>";
      $owner = "<span style='font-size:12px;'>".fileowner($item)."</span>";

      if (is_dir("$item")) {
         echo "<tr><td><i class=\"fas fa-folder-open\"></i> <a href=\"$item\">$item</a></td><td>$size<td>$type</td><td>$owner</td><td>$date</td>";
      }
      else {
         echo "<tr><td><i class=\"fas fa-file\"></i> <a href=\"$item\">$item</a></td><td>$size</td><td>$type</td><td>$owner</td><td>$date</td></tr>";
      }
   } //for each
   echo "</tbody></table>";
 ?>

   </div>
 </div>
 </div>




<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>
