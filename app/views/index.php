<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Planifier une livraison</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/CSS/style.css">
</head>
<body class="app-body">
  <header class="border-bottom bg-white shadow-sm">
    <div class="container py-3 d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center gap-2">
        <span class="badge bg-primary rounded-circle p-3"><i class="bi bi-truck"></i></span>
        <div>
          <h1 class="h4 mb-0">Gestion des livraisons</h1>
          <small class="text-muted">Affecter un chauffeur, un véhicule et un colis en un instant.</small>
        </div>
      </div>
      <a class="btn btn-outline-primary" href="<?= BASE_URL ?>/liste">
        <i class="bi bi-list-task me-1"></i> Voir les livraisons
      </a>
    </div>
  </header>

  <main class="container py-5">
    <div class="row g-4">
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div>
                <p class="text-primary fw-semibold mb-0 text-uppercase small">Nouvelle livraison</p>
                <h2 class="h4 mb-0">Détails opérationnels</h2>
              </div>
              <span class="badge bg-info text-dark"><i class="bi bi-clock-history me-1"></i>Temps réel</span>
            </div>

            <form class="row g-3" action="<?= BASE_URL ?>/insert" method="post">
              <div class="col-md-6">
                <label class="form-label" for="livreur">Livreur</label>
                <select class="form-select" name="Livreurs" id="livreur" required>
                  <option value="" selected disabled>Choisir le chauffeur</option>
                  <?php foreach ($livreurs as $livreur) { ?>
                    <option value="<?php echo $livreur['id_livreur']; ?>">
                      <?php echo $livreur['nom']; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="vehicule">Véhicule</label>
                <select class="form-select" name="Vehicule" id="vehicule" required>
                  <option value="" selected disabled>Matricule / capacité</option>
                  <?php foreach ($vehicules as $vehicule) { ?>
                    <option value="<?php echo $vehicule['id_vehicule']; ?>">
                      <?php echo $vehicule['Matricule']; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="colis">Colis</label>
                <select class="form-select" name="Colis" id="colis" required>
                  <option value="" selected disabled>Sélectionner le colis</option>
                  <?php foreach ($colis as $coli) { ?>
                    <option value="<?php echo $coli['id_colis']; ?>">
                      <?php echo $coli['nom_colis']; ?> • <?php echo $coli['poids']; ?> kg
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="zone">Zone de livraison</label>
                <select class="form-select" name="Zone" id="zone" required>
                  <option value="" selected disabled>Zone / secteur</option>
                  <?php foreach ($zones as $zone) { ?>
                    <option value="<?php echo $zone['id_zone']; ?>">
                      <?php echo $zone['secteur']; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="entrepot">Entrepôt de départ</label>
                <select class="form-select" name="Entrepot" id="entrepot" required>
                  <option value="" selected disabled>Point de départ</option>
                  <?php foreach ($entrepot as $entrepotItem) { ?>
                    <option value="<?php echo $entrepotItem['id_entrepot']; ?>">
                      <?php echo $entrepotItem['adresse']; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="statut">Statut</label>
                <select class="form-select" name="Statut" id="statut" required>
                  <option value="" selected disabled>En attente, livrée...</option>
                  <?php foreach ($statut as $statuts) { ?>
                    <option value="<?php echo $statuts['id_statut']; ?>">
                      <?php echo $statuts['Etat']; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="destination">Adresse de destination</label>
                <input class="form-control" type="text" name="Destination" id="destination" placeholder="Client / adresse complète" required>
              </div>

              <div class="col-md-3">
                <label class="form-label" for="date">Date de livraison</label>
                <input class="form-control" type="date" name="date_livraison" id="date" required>
              </div>

              <div class="col-md-3">
                <label class="form-label" for="carburant">Coût carburant (Ar)</label>
                <input class="form-control" type="number" name="Carburant" id="carburant" step="0.01" min="0" placeholder="0.00">
              </div>

              <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>/liste">
                  <i class="bi bi-clipboard-data me-1"></i> Consulter les livraisons
                </a>
                <button class="btn btn-primary" type="submit">
                  <i class="bi bi-check-lg me-1"></i> Valider la fiche
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card shadow-sm h-100">
          <div class="card-body d-flex flex-column justify-content-between">
            <div>
              <p class="text-primary fw-semibold text-uppercase small mb-1">Contexte</p>
              <h3 class="h5">Fluidifier les tournées</h3>
              <p class="text-muted mb-3">Planifiez les livraisons en affectant rapidement un chauffeur, un véhicule et un colis. Gardez la traçabilité des coûts (carburant) et des statuts en quelques clics.</p>
              <ul class="list-unstyled text-muted small mb-3">
                <li class="mb-2"><i class="bi bi-shield-check text-success me-2"></i>Suivi des statuts en temps réel</li>
                <li class="mb-2"><i class="bi bi-geo-alt text-primary me-2"></i>Zones et entrepôts référencés</li>
                <li class="mb-2"><i class="bi bi-cash-coin text-warning me-2"></i>Traçabilité des coûts carburant</li>
              </ul>
            </div>
            <div class="alert alert-primary d-flex align-items-center gap-2 mb-0">
              <i class="bi bi-lightning-charge-fill"></i>
              <div>
                <strong>Astuce :</strong> validez chaque fiche avant le départ pour sécuriser le tracking.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="<?= BASE_URL ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>