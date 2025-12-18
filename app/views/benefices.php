<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bénéfices par période</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/bootstrap/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"> -->
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/CSS/style.css">
</head>
<body class="app-body">
  <header class="border-bottom bg-white shadow-sm">
    <div class="container py-3 d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center gap-2">
        <span class="badge bg-success rounded-circle p-3"><i class="bi bi-cash-coin"></i></span>
        <div>
          <h1 class="h4 mb-0">Bénéfices par période</h1>
          <small class="text-muted">Chiffre d'affaires, coûts et marge agrégés.</small>
        </div>
      </div>
      <div class="d-flex gap-2">
        <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>/">
          <i class="bi bi-plus-lg me-1"></i> Nouvelle livraison
        </a>
        <a class="btn btn-outline-primary" href="<?= BASE_URL ?>/liste">
          <i class="bi bi-list-task me-1"></i> Liste des livraisons
        </a>
      </div>
    </div>
  </header>

  <main class="container py-5">
    <div class="row g-4 mb-4">
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div>
                <p class="text-primary fw-semibold text-uppercase small mb-0">Analyse financière</p>
                <h2 class="h5 mb-0">Bénéfices agrégés</h2>
              </div>
              <form class="row g-2 align-items-center" method="post" action="<?= BASE_URL ?>/benefices">
                <div class="col-auto">
                  <label class="form-label mb-0 text-muted small">Jour (YYYY-MM-DD)</label>
                  <input class="form-control form-control-sm" type="date" name="jour" value="<?= htmlspecialchars($jour ?? '') ?>">
                </div>
                <div class="col-auto">
                  <label class="form-label mb-0 text-muted small">Mois (1-12)</label>
                  <input class="form-control form-control-sm" type="number" name="mois" min="1" max="12" value="<?= isset($_POST['mois']) ? htmlspecialchars($_POST['mois']) : '' ?>">
                </div>
                <div class="col-auto">
                  <label class="form-label mb-0 text-muted small">Année (YYYY)</label>
                  <input class="form-control form-control-sm" type="number" min="2000" max="2100" name="annee" value="<?= htmlspecialchars($annee ?? '') ?>">
                </div>
                <div class="col-auto d-flex align-items-end">
                  <button class="btn btn-primary btn-sm" type="submit">
                    <i class="bi bi-funnel me-1"></i>Appliquer
                  </button>
                </div>
              </form>
            </div>

            <div class="table-responsive">
              <table class="table table-hover align-middle">
                <thead class="table-light">
                  <tr>
                    <th>Période</th>
                    <th class="text-end">Livraisons</th>
                    <th class="text-end">Chiffre d'affaires (Ar)</th>
                    <th class="text-end">Coûts (Ar)</th>
                    <th class="text-end">Bénéfice (Ar)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $totalCa = 0;
                    $totalCouts = 0;
                    $totalBenefice = 0;
                  ?>
                  <?php if (!empty($benefices)) { ?>
                    <?php foreach ($benefices as $row) {
                      $totalCa += (float) ($row['ca'] ?? 0);
                      $totalCouts += (float) ($row['couts'] ?? 0);
                      $totalBenefice += (float) ($row['benefice'] ?? 0);
                    ?>
                      <tr>
                        <td class="fw-semibold"><?php echo $row['periode_label']; ?></td>
                        <td class="text-end"><?php echo $row['livraisons']; ?></td>
                        <td class="text-end text-success"><?php echo number_format($row['ca'], 0, ',', ' '); ?></td>
                        <td class="text-end text-muted"><?php echo number_format($row['couts'], 0, ',', ' '); ?></td>
                        <td class="text-end fw-semibold <?php echo ($row['benefice'] ?? 0) >= 0 ? 'text-success' : 'text-danger'; ?>">
                          <?php echo number_format($row['benefice'], 0, ',', ' '); ?>
                        </td>
                      </tr>
                    <?php } ?>
                  <?php } else { ?>
                    <tr>
                      <td colspan="5" class="text-center text-muted py-4">
                        <i class="bi bi-inbox me-2"></i>Aucune donnée disponible pour cette période.
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
                <tfoot class="table-light">
                  <tr>
                    <th>Total</th>
                    <th class="text-end"><?php echo array_sum(array_column($benefices ?? [], 'livraisons')); ?></th>
                    <th class="text-end text-success"><?php echo number_format($totalCa, 0, ',', ' '); ?></th>
                    <th class="text-end text-muted"><?php echo number_format($totalCouts, 0, ',', ' '); ?></th>
                    <th class="text-end fw-semibold <?php echo $totalBenefice >= 0 ? 'text-success' : 'text-danger'; ?>">
                      <?php echo number_format($totalBenefice, 0, ',', ' '); ?>
                    </th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card shadow-sm h-100">
          <div class="card-body d-flex flex-column justify-content-between">
            <div>
              <p class="text-primary fw-semibold text-uppercase small mb-1">Lecture rapide</p>
              <h3 class="h5">Pourquoi suivre la marge ?</h3>
              <p class="text-muted mb-3">Visualisez immédiatement le CA, les coûts carburant + salaires, et la marge dégagée sur chaque période pour ajuster vos tournées.</p>
              <ul class="list-unstyled text-muted small mb-3">
                <li class="mb-2"><i class="bi bi-graph-up-arrow text-success me-2"></i>Comparer les performances par jour, mois ou année</li>
                <li class="mb-2"><i class="bi bi-fuel-pump text-primary me-2"></i>Suivi des coûts carburant intégrés</li>
                <li class="mb-2"><i class="bi bi-people text-warning me-2"></i>Salaires chauffeurs inclus dans les coûts</li>
              </ul>
            </div>
            <div class="alert alert-primary d-flex align-items-center gap-2 mb-0">
              <i class="bi bi-lightning-charge-fill"></i>
              <div>
                <strong>Astuce :</strong> filtrez par mois pour détecter les dérives de coûts récurrentes.
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

