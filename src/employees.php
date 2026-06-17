<?php
require_once __DIR__ . '/utils/fonctions.php';
$page_title = 'Employés ' . ($_GET['dept_no'] ?? '');
$dept_no = $_GET['dept_no'] ?? '';
if (!$dept_no) {
    header('Location: departments.php');
    exit;
}
$employes = getEmployesByDepartment($dept_no);
include __DIR__ . '/header.php';
?>
    <h1>Employés du département <?= htmlspecialchars($dept_no) ?></h1>
    <ul>
        <?php foreach ($employes as $emp): ?>
            <li>
                <?= htmlspecialchars($emp['emp_no']) ?> - <?= htmlspecialchars($emp['first_name']) ?> <?= htmlspecialchars($emp['last_name']) ?>
                <a href="employee.php?emp_no=<?= urlencode($emp['emp_no']) ?>">Voir fiche</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <p><a href="departments.php">Retour</a></p>
<?php include __DIR__ . '/footer.php';
