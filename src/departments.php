<?php
require_once __DIR__ . '/utils/fonctions.php';
$page_title = 'Départements';
$departments = getAllDepartments();
include __DIR__ . '/header.php';
?>
    <h1>Liste des départements</h1>
    <ul>
        <?php foreach ($departments as $dept): ?>
            <?php $manager = getCurrentManagerByDepartment($dept['dept_no']); ?>
            <li>
                <?= $dept['dept_no'] ?> - <?= $dept['dept_name'] ?>
                (manager: <?= $manager ? $manager['first_name'] . ' ' . $manager['last_name'] : 'N/A' ?>)
                <a href="employees.php?dept_no=<?= urlencode($dept['dept_no']) ?>">Voir</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <p><a href="index.php">Accueil</a></p>
<?php include __DIR__ . '/footer.php';
