<?php
$page_title = 'Base Employees';
include __DIR__ . '/header.php';
?>
    <div class="bg-light p-5 rounded-3">
        <h1 class="display-6">TP Employees</h1>
        <p class="lead">Application simple sur la base de données employees.</p>
        <div class="list-group">
            <a href="departments.php" class="list-group-item list-group-item-action">Liste des départements</a>
            <a href="employees.php?dept_no=d001" class="list-group-item list-group-item-action">Exemple : employés du département d001</a>
            <a href="employee.php?emp_no=10001" class="list-group-item list-group-item-action">Exemple : fiche employé 10001</a>
            <a href="job_stats.php" class="list-group-item list-group-item-action">Statistiques par emploi</a>
        </div>
    </div>
<?php include __DIR__ . '/footer.php';
