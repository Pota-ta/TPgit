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
    <p><a href="departments.php">Retour aux départements</a></p>
<?php include __DIR__ . '/footer.php';
