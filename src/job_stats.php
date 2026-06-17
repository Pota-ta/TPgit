<?php
require_once __DIR__ . '/utils/fonctions.php';
$page_title = 'Statistiques par emploi';
$rows = getJobStats();
include __DIR__ . '/header.php';
?>
    <h1>Statistiques par emploi</h1>
    <table border="1" cellpadding="6" cellspacing="0">
        <tr><th>Emploi</th><th>Hommes</th><th>Femmes</th><th>Salaire moyen</th></tr>
        <?php foreach ($rows as $r): ?>
            <tr>
                <td><?= htmlspecialchars($r['title']) ?></td>
                <td><?= htmlspecialchars($r['males']) ?></td>
                <td><?= htmlspecialchars($r['females']) ?></td>
                <td><?= number_format(floatval($r['avg_salary']), 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="index.php">Accueil</a></p>
<?php include __DIR__ . '/footer.php';
