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
    <h1>Titres de <?= htmlspecialchars($employe['first_name'] . ' ' . $employe['last_name']) ?></h1>
    <ul>
        <?php foreach ($titles as $t): ?>
            <li><?= htmlspecialchars($t['title']) ?> (<?= htmlspecialchars($t['from_date']) ?> → <?= htmlspecialchars($t['to_date']) ?>)</li>
        <?php endforeach; ?>
    </ul>
    <p><a href="employee.php?emp_no=<?= urlencode($emp_no) ?>">Retour</a></p>
<?php include __DIR__ . '/footer.php';
