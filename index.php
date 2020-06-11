<?php
include "header.php";
include "GMT.php";
include "crea_doss.php";
include "crea_fich.php";
include "suppr_fich.php";
?>

<section class="container">

  <div class="col-sm p-3 mb-2 mt-2 bg-dark text-white text-center rounded">
    <h3>Explorateur de fichier</h3>
  </div>

  <div class="p-3 mb-2 bg-light text-dark rounded border">
    <div class="row d-flex justify-content-between">
      <div class="">
        <?php include "chem_rep.php"; ?>
      </div>

      <div class="">
        <button type="button" class="btn btn-outline-dark mr-2">Afficher les dossiers cachés</button>
      </div>
    </div>

    <div class="">
    <?php
    // Fil d'Ariane

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
        <th scope="col">Taille (en octet)</th>
        <th scope="col">Date de Modification</th>
      </tr>
    </thead>
    <tbody>
      <?php
      include "tableau.php";
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
      <?php echo $text_dossier; ?>
    </div>

    <!-- Création de fichier -->
    <div class="col-sm p-3 mb-2 bg-dark text-white text-center rounded border border-light">
      <form class="mb-2" action="index.php" method="post">
         <label for="nom_fichier" class="text-uppercase font-weight-bold">création de fichier</label>
         <input type="text" placeholder="Nom du nouveau fichier" name="nom_fichier"><button type="submit" class="ml-1">Créer</button>
      </form>
      <?php echo $text_fichier; ?>
    </div>

    <!-- Suppression de fichier -->
    <div class="col-sm p-3 mb-2 bg-dark text-white text-center rounded border border-light">
      <form class="mb-2" action="index.php" method="post">
         <label for="suppr_fichier" class="text-uppercase font-weight-bold">suppression de fichier</label>
         <input type="text" placeholder="Nom du fichier à supprimer" name="suppr_fichier"><button type="submit" class="ml-1">Supprimer</button>
      </form>
      <?php echo $text_suppr; ?>
    </div>

  </div>
</section>

<?php include "footer.php";?>
