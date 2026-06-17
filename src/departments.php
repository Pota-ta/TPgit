<?php
require_once __DIR__ . '/utils/fonctions.php';
$page_title = 'Départements';
$departments = getAllDepartments();
include __DIR__ . '/header.php';
?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Liste des départements</h1>
        <a href="index.php" class="btn btn-secondary">Accueil</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Code</th>
                    <th>Nom</th>
                    <th>Manager</th>
                    <th>Employés</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departments as $dept): ?>
                    <?php $manager = getCurrentManagerByDepartment($dept['dept_no']);
                          $count = getEmployeeCountByDept($dept['dept_no']); ?>
                    <tr>
                        <td><?= htmlspecialchars($dept['dept_no']) ?></td>
                        <td><?= htmlspecialchars($dept['dept_name']) ?></td>
                        <td><?= htmlspecialchars($manager ? $manager['first_name'] . ' ' . $manager['last_name'] : 'N/A') ?></td>
                        <td><?= intval($count) ?></td>
                        <td><a class="btn btn-sm btn-primary" href="employees.php?dept_no=<?= urlencode($dept['dept_no']) ?>">Voir</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php include __DIR__ . '/footer.php';
