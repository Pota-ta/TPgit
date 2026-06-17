<?php
require_once __DIR__ . '/utils/fonctions.php';

$emp_no = intval($_GET['emp_no'] ?? ($_POST['emp_no'] ?? 0));
if (!$emp_no) {
    header('Location: departments.php');
    exit;
}

$connexion = getConnexion();
$current = null;
$q = "SELECT dept_no, from_date FROM dept_emp WHERE emp_no = " . intval($emp_no) . " AND to_date = '9999-01-01' LIMIT 1";
$r = mysqli_query($connexion, $q);
if ($r) $current = mysqli_fetch_assoc($r);
mysqli_free_result($r);
mysqli_close($connexion);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_dept = $_POST['new_dept'] ?? '';
    $new_from = $_POST['from_date'] ?? '';
    if (!$new_dept || !$new_from) {
        $error = 'Veuillez renseigner le département et la date de début.';
    } else {
        $cur_from = $current['from_date'] ?? null;
        if ($cur_from && $new_from <= $cur_from) {
            $error = 'La date de début doit être postérieure à la date de début actuelle (' . $cur_from . ').';
        } else {
            $c = getConnexion();
            mysqli_autocommit($c, false);
            try {
                // fermer l'ancien lien
                $upd = "UPDATE dept_emp SET to_date = DATE_SUB('" . mysqli_real_escape_string($c, $new_from) . "', INTERVAL 1 DAY) WHERE emp_no = " . intval($emp_no) . " AND to_date = '9999-01-01'";
                mysqli_query($c, $upd);
                // insérer nouveau
                $ins = "INSERT INTO dept_emp (emp_no, dept_no, from_date, to_date) VALUES (" . intval($emp_no) . ", '" . mysqli_real_escape_string($c, $new_dept) . "', '" . mysqli_real_escape_string($c, $new_from) . "', '9999-01-01')";
                mysqli_query($c, $ins);
                mysqli_commit($c);
                mysqli_close($c);
                header('Location: employee.php?emp_no=' . intval($emp_no));
                exit;
            } catch (Exception $e) {
                mysqli_rollback($c);
                mysqli_close($c);
                $error = 'Erreur lors de la mise à jour : ' . $e->getMessage();
            }
        }
    }
}

$departments = getAllDepartments();
$employe = getEmployeById($emp_no);
$page_title = 'Changer de département';
include __DIR__ . '/header.php';
?>
    <h1>Changer de département - <?= htmlspecialchars($employe['first_name'] . ' ' . $employe['last_name']) ?></h1>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post">
        <input type="hidden" name="emp_no" value="<?= intval($emp_no) ?>">
        <p>Département actuel : <strong><?= htmlspecialchars($current['dept_no'] ?? 'N/A') ?></strong> (depuis <?= htmlspecialchars($current['from_date'] ?? '') ?>)</p>
        <p>Nouveau département:
            <select name="new_dept">
                <?php foreach ($departments as $d): ?>
                    <?php if ($d['dept_no'] === ($current['dept_no'] ?? '')) continue; ?>
                    <option value="<?= htmlspecialchars($d['dept_no']) ?>"><?= htmlspecialchars($d['dept_no']) ?> - <?= htmlspecialchars($d['dept_name']) ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>Date de début: <input type="date" name="from_date" required></p>
        <p><button type="submit">Valider</button> <a href="employee.php?emp_no=<?= intval($emp_no) ?>">Annuler</a></p>
    </form>
<?php include __DIR__ . '/footer.php';
