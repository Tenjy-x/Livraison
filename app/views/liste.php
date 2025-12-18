<?php
  $totalLivraisons = isset($data) ? count($data) : 0;
  $totalCA = 0;
  $totalCout = 0;
  if (!empty($data)) {
    foreach ($data as $livraison) {
      $totalCA += (float) ($livraison['CA'] ?? 0);
      $totalCout += (float) (($livraison['cout_de_revient'] ?? 0) + ($livraison['carburant'] ?? 0) + ($livraison['salaire'] ?? 0));
    }
  }
  $marge = $totalCA - $totalCout;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Suivi des livraisons</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/CSS/style.css">
</head>
<body class="app-body">
  <header class="border-bottom bg-white shadow-sm">
    <div class="container py-3 d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center gap-2">
        <span class="badge bg-primary rounded-circle p-3"><i class="bi bi-clipboard-data"></i></span>
        <div>
          <h1 class="h4 mb-0">Suivi des livraisons</h1>
          <small class="text-muted">Statut, coûts et chiffre d'affaires par tournée.</small>
        </div>
      </div>
      <a class="btn btn-outline-primary" href="<?= BASE_URL ?>/">
        <i class="bi bi-plus-lg me-1"></i> Planifier une nouvelle livraison
      </a>
    </div>
  </header>

  <main class="container py-5">
    <div class="row g-4 mb-4">
      <div class="col-md-4">
        <div class="stat-card shadow-sm">
          <div class="stat-icon bg-primary text-white"><i class="bi bi-truck"></i></div>
          <div>
            <p class="text-muted mb-0 small">Livraisons enregistrées</p>
            <h3 class="mb-0"><?= $totalLivraisons ?></h3>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="stat-card shadow-sm">
          <div class="stat-icon bg-success text-white"><i class="bi bi-graph-up"></i></div>
          <div>
            <p class="text-muted mb-0 small">Chiffre d'affaires (Ar)</p>
            <h3 class="mb-0"><?= number_format($totalCA, 0, ',', ' ') ?></h3>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="stat-card shadow-sm">
          <div class="stat-icon bg-warning text-dark"><i class="bi bi-wallet2"></i></div>
          <div>
            <p class="text-muted mb-0 small">Marge estimée (Ar)</p>
            <h3 class="mb-0"><?= number_format($marge, 0, ',', ' ') ?></h3>
          </div>
        </div>
      </div>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div>
            <p class="text-primary fw-semibold text-uppercase small mb-0">Tableau de bord</p>
            <h2 class="h5 mb-0">Livraisons et coûts opérationnels</h2>
          </div>
          <span class="badge bg-light text-secondary"><i class="bi bi-clock me-1"></i>Mis à jour</span>
        </div>

        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Destination</th>
                <th>Chauffeur</th>
                <th>Statut</th>
                <th class="text-end">Carburant (Ar)</th>
                <th class="text-end">Salaire (Ar)</th>
                <th class="text-end">Coût de revient (Ar)</th>
                <th class="text-end">Poids total (Kg)</th>
                <th class="text-end">Chiffre d'affaires (Ar)</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($data)) { ?>
                <?php foreach ($data as $livraison) { ?>
                  <tr>
                    <td class="fw-semibold"><?php echo $livraison['id_livraison']; ?></td>
                    <td><?php echo $livraison['date_livraison']; ?></td>
                    <td><?php echo $livraison['adresse_de_destination']; ?></td>
                    <td><i class="bi bi-person-check me-1 text-success"></i><?php echo $livraison['nom']; ?></td>
                    <td>
                      <span class="badge bg-<?php echo strtolower($livraison['Etat']) === 'livrée' ? 'success' : 'secondary'; ?>">
                        <?php echo $livraison['Etat']; ?>
                      </span>
                    </td>
                    <td class="text-end"><?php echo number_format($livraison['carburant'], 0, ',', ' '); ?></td>
                    <td class="text-end"><?php echo number_format($livraison['salaire'], 0, ',', ' '); ?></td>
                    <td class="text-end"><?php echo number_format($livraison['cout_de_revient'], 0, ',', ' '); ?></td>
                    <td class="text-end"><?php echo $livraison['poids']; ?></td>
                    <td class="text-end fw-semibold text-success"><?php echo number_format($livraison['CA'], 0, ',', ' '); ?></td>
                  </tr>
                <?php } ?>
              <?php } else { ?>
                <tr>
                  <td colspan="10" class="text-center text-muted py-4">
                    <i class="bi bi-inbox me-2"></i>Aucune livraison enregistrée pour le moment.
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>

  <script src="<?= BASE_URL ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>