<?php
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/CSS/style.css">
  <link href="<?= BASE_URL ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<body>
<div class="row">
  <form action="<?= BASE_URL ?>/insert" method="post">
    <div class="formulaire">
      <label for="livreur">Livreurs</label>
      <select name="Livreurs" id="livreur">
        <?php
          foreach($livreurs as $livreur){?>
            <option value="<?php echo $livreur['id_livreur']?>">
                <p><?php echo $livreur['nom']?></p>
            </option>
          <?php }
        ?>
      </select>
      <label for="vehicule">Vehicule</label>
      <select name="Vehicule" id="vehicule">
        <?php
          foreach($vehicules as $vehicule){?>
            <option value="<?php echo $vehicule['id_vehicule']?>">
                <p><?php echo $vehicule['Matricule']?></p>
                </option>
          <?php }
        ?>
      </select>
      <label for="colis">COLIS</label>
      <select name="Colis" id="colis">
        <?php
          foreach($colis as $coli){?>
            <option value="<?php echo $coli['id_colis'];?>">
                <p><?php echo $coli['nom_colis']?></p>
                <p>/<?php echo $coli['poids']?> kg</p>
            </option>
          <?php }
        ?>
      </select>
      <label for="entrepot">Entrepot</label>
      <select name="Entrepot" id="entrepot">
        <?php
          foreach($entrepot as $entrepot){?>
            <option value="<?php echo $entrepot['id_entrepot']?>">
                <p><?php echo $entrepot['adresse']?></p>
            </option>
          <?php }
        ?>
      </select>
      <label for="statut">Statut</label>
      <select name="Statut" id="statut">
        <?php
          foreach($statut as $statuts){?>
            <option value="<?php echo $statuts['id_statut']?>">
                <p><?php echo $statuts['Etat']?></p>
            </option>
          <?php }
        ?>
      </select>
      <label for="zone">Zone de Livraison</label>
      <select name="Zone" id="zone">
        <?php
          foreach($zones as $zone){?>
            <option value="<?php echo $zone['id_zone']?>">
                <p><?php echo $zone['secteur']?></p>
                </option>
          <?php }
        ?>
      </select>
      <label for="destination">Destination</label>
      <input type="text" name="Destination" id="destination">

      <label for="date">Date Livraison</label>
      <input type="date" name="date_livraison" id="date" required>

      <label for="carburant">Prix Carburant</label>
      <input type="number" name="Carburant" id="carburant" step="0.01">
      </div>
    <button type="submit">Valider</button>
  </form>
</div>
  <a href="<?= BASE_URL ?>/liste">Liste Livraison</a>
  <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>