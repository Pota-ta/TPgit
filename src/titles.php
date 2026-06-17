<?php
require_once __DIR__ . '/utils/fonctions.php';
$emp_no = intval($_GET['emp_no'] ?? 0);
if (!$emp_no) {
    header('Location: departments.php');
    exit;
}
$titles = getTitlesByEmployee($emp_no);
$employe = getEmployeById($emp_no);
$page_title = 'Titres de ' . ($employe['first_name'] ?? '');
include __DIR__ . '/header.php';
?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2">Titres de <?= htmlspecialchars($employe['first_name'] . ' ' . $employe['last_name']) ?></h1>
            <p class="text-muted">Historique des postes occupés.</p>
        </div>
        <a href="employee.php?emp_no=<?= urlencode($emp_no) ?>" class="btn btn-secondary">Retour</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Titre</th>
                    <th>Début</th>
                    <th>Fin</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($titles as $t): ?>
                    <tr>
                        <td><?= htmlspecialchars($t['title']) ?></td>
                        <td><?= htmlspecialchars($t['from_date']) ?></td>
                        <td><?= htmlspecialchars($t['to_date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php include __DIR__ . '/footer.php';
