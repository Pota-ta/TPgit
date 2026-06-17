<?php
require_once __DIR__ . '/utils/fonctions.php';
$emp_no = intval($_GET['emp_no'] ?? 0);
if (!$emp_no) {
    header('Location: departments.php');
    exit;
}
$salaries = getSalariesByEmployee($emp_no);
$employe = getEmployeById($emp_no);
$page_title = 'Salaires de ' . ($employe['first_name'] ?? '');
include __DIR__ . '/header.php';
?>
    <h1>Salaires de <?= htmlspecialchars($employe['first_name'] . ' ' . $employe['last_name']) ?></h1>
    <ul>
        <?php foreach ($salaries as $s): ?>
            <li><?= htmlspecialchars($s['salary']) ?> (<?= htmlspecialchars($s['from_date']) ?> → <?= htmlspecialchars($s['to_date']) ?>)</li>
        <?php endforeach; ?>
    </ul>
    <p><a href="employee.php?emp_no=<?= urlencode($emp_no) ?>">Retour</a></p>
<?php include __DIR__ . '/footer.php';
