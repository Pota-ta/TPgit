<?php
require_once __DIR__ . '/utils/fonctions.php';
$emp_no = intval($_GET['emp_no'] ?? 0);
if (!$emp_no) {
    header('Location: departments.php');
    exit;
}
$employe = getEmployeById($emp_no);
$page_title = 'Fiche ' . ($employe['first_name'] ?? '');
include __DIR__ . '/header.php';
?>
    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="card-title h4">Fiche employé</h1>
                    <p class="card-text"><strong>Numéro :</strong> <?= htmlspecialchars($employe['emp_no']) ?></p>
                    <p class="card-text"><strong>Nom :</strong> <?= htmlspecialchars($employe['last_name']) ?></p>
                    <p class="card-text"><strong>Prénom :</strong> <?= htmlspecialchars($employe['first_name']) ?></p>
                    <p class="card-text"><strong>Date de naissance :</strong> <?= htmlspecialchars($employe['birth_date']) ?></p>
                    <p class="card-text"><strong>Genre :</strong> <?= htmlspecialchars($employe['gender']) ?></p>
                    <p class="card-text"><strong>Date d'embauche :</strong> <?= htmlspecialchars($employe['hire_date']) ?></p>
                    <?php $longest = getLongestTitleByEmployee($emp_no); ?>
                    <?php if ($longest): ?>
                        <p class="card-text"><strong>Emploi le plus long :</strong> <?= htmlspecialchars($longest['title']) ?> (<?= intval($longest['days']) ?> jours)</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h5">Actions</h2>
                    <div class="d-grid gap-2">
                        <a class="btn btn-outline-secondary" href="departments.php">Retour aux départements</a>
                        <a class="btn btn-primary" href="salaries.php?emp_no=<?= urlencode($employe['emp_no']) ?>">Voir salaires</a>
                        <a class="btn btn-primary" href="titles.php?emp_no=<?= urlencode($employe['emp_no']) ?>">Voir titres</a>
                        <a class="btn btn-warning" href="change_dept.php?emp_no=<?= urlencode($employe['emp_no']) ?>">Changer de département</a>
                        <a class="btn btn-success" href="promote_manager.php?emp_no=<?= urlencode($employe['emp_no']) ?>">Devenir Manager</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include __DIR__ . '/footer.php';
