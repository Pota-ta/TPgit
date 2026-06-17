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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2">Employés du département <?= htmlspecialchars($dept_no) ?></h1>
            <p class="text-muted">Liste des employés actuellement actifs dans ce département.</p>
        </div>
        <a href="departments.php" class="btn btn-secondary">Retour</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Numéro</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employes as $emp): ?>
                    <tr>
                        <td><?= htmlspecialchars($emp['emp_no']) ?></td>
                        <td><?= htmlspecialchars($emp['last_name']) ?></td>
                        <td><?= htmlspecialchars($emp['first_name']) ?></td>
                        <td><a class="btn btn-sm btn-primary" href="employee.php?emp_no=<?= urlencode($emp['emp_no']) ?>">Voir fiche</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php include __DIR__ . '/footer.php';
