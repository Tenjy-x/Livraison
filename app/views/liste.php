<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/CSS/style.css">
  <link href="<?= BASE_URL ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <div class="row">
    <table border = "1">
        <tr>
          <th>ID</th>
          <th>DATE</th>
          <th>DESTINATION</th>
          <th>CHAUFFEUR</th>
          <th>STATUS</th>
          <th>CARBURANT</th>
          <th>SALAIRE CHAUFFEUR</th>
          <th>COUT DE REVIENT</th>
          <th>Kg TOTAL</th>
          <th>CHIFFRE D'AFFAIRE</th>
        </tr>
      <?php
        foreach($data as $livraison) {?>
        <tr>
            <td><?php echo $livraison['id_livraison']?></td>
            <td><?php echo $livraison['date_livraison']?></td>
            <td><?php echo $livraison['adresse_de_destination']?></td>
            <td><?php echo $livraison['nom']?></td>
            <td><?php echo $livraison['Etat']?></td>
            <td><?php echo $livraison['carburant']?>AR</td>
            <td><?php echo $livraison['salaire']?>AR</td>
            <td><?php echo $livraison['cout_de_revient']?>AR</td>
            <td><?php echo $livraison['poids']?>Kg</td>
            <td><?php echo $livraison['CA']?>AR</td>
        </tr>
        <?php }
      ?>      
      </table>
  </div>
    <a href="<?= BASE_URL ?>/liste">Liste Livraison</a>

</body>
</html>