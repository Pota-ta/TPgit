<?php
require_once __DIR__ . '/utils/fonctions.php';
$page_title = 'Statistiques par emploi';
$rows = getJobStats();
include __DIR__ . '/header.php';
?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2">Statistiques par emploi</h1>
            <p class="text-muted">Nombre d'hommes/femmes et salaire moyen par titre actuel.</p>
        </div>
        <a href="index.php" class="btn btn-secondary">Accueil</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Emploi</th>
                    <th>Hommes</th>
                    <th>Femmes</th>
                    <th>Salaire moyen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r): ?>
                    <tr>
                        <td><?= htmlspecialchars($r['title']) ?></td>
                        <td><?= htmlspecialchars($r['males']) ?></td>
                        <td><?= htmlspecialchars($r['females']) ?></td>
                        <td><?= number_format(floatval($r['avg_salary']), 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php include __DIR__ . '/footer.php';
