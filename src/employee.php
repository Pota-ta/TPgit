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
    <h1>Fiche employé</h1>
    <p>Numéro : <?= htmlspecialchars($employe['emp_no']) ?></p>
    <p>Nom : <?= htmlspecialchars($employe['last_name']) ?></p>
    <p>Prénom : <?= htmlspecialchars($employe['first_name']) ?></p>
    <p>Date de naissance : <?= htmlspecialchars($employe['birth_date']) ?></p>
    <p>Genre : <?= htmlspecialchars($employe['gender']) ?></p>
    <p>Date d'embauche : <?= htmlspecialchars($employe['hire_date']) ?></p>
    <?php $longest = getLongestTitleByEmployee($emp_no); ?>
    <?php if ($longest): ?>
        <p>Emploi le plus long : <strong><?= htmlspecialchars($longest['title']) ?></strong> (<?= intval($longest['days']) ?> jours)</p>
    <?php endif; ?>
    <p>
        <a href="departments.php">Retour aux départements</a> |
        <a href="salaries.php?emp_no=<?= urlencode($employe['emp_no']) ?>">Voir salaires</a> |
        <a href="titles.php?emp_no=<?= urlencode($employe['emp_no']) ?>">Voir titres</a>
    </p>
<?php include __DIR__ . '/footer.php';
