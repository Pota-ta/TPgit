<?php
require_once __DIR__ . '/utils/fonctions.php';

$emp_no = intval($_GET['emp_no'] ?? ($_POST['emp_no'] ?? 0));
if (!$emp_no) {
    header('Location: departments.php');
    exit;
}

$departments = getAllDepartments();

// determine current dept of employee
$c = getConnexion();
$cur_dept = null;
$q = "SELECT dept_no FROM dept_emp WHERE emp_no = " . intval($emp_no) . " AND to_date = '9999-01-01' LIMIT 1";
$r = mysqli_query($c, $q);
if ($r) $curd = mysqli_fetch_assoc($r);
mysqli_free_result($r);
mysqli_close($c);

$selected_dept = $_GET['dept_no'] ?? ($curd['dept_no'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dept = $_POST['dept_no'] ?? '';
    $start = $_POST['start_date'] ?? '';
    if (!$dept || !$start) {
        $error = 'Veuillez sélectionner un département et une date.';
    } else {
        // get current manager start
        $conn = getConnexion();
        $qq = "SELECT emp_no, from_date FROM dept_manager WHERE dept_no = '" . mysqli_real_escape_string($conn, $dept) . "' AND to_date = '9999-01-01' LIMIT 1";
        $res = mysqli_query($conn, $qq);
        $curmgr = $res ? mysqli_fetch_assoc($res) : null;
        if ($res) mysqli_free_result($res);
        if ($curmgr && $start <= $curmgr['from_date']) {
            mysqli_close($conn);
            $error = 'La date de début doit être postérieure à la date de début actuelle du manager (' . $curmgr['from_date'] . ').';
        } else {
            // transaction: close old manager and insert new
            mysqli_autocommit($conn, false);
            try {
                $upd = "UPDATE dept_manager SET to_date = DATE_SUB('" . mysqli_real_escape_string($conn, $start) . "', INTERVAL 1 DAY) WHERE dept_no = '" . mysqli_real_escape_string($conn, $dept) . "' AND to_date = '9999-01-01'";
                mysqli_query($conn, $upd);
                $ins = "INSERT INTO dept_manager (dept_no, emp_no, from_date, to_date) VALUES ('" . mysqli_real_escape_string($conn, $dept) . "', " . intval($emp_no) . ", '" . mysqli_real_escape_string($conn, $start) . "', '9999-01-01')";
                mysqli_query($conn, $ins);
                mysqli_commit($conn);
                mysqli_close($conn);
                header('Location: departments.php');
                exit;
            } catch (Exception $e) {
                mysqli_rollback($conn);
                mysqli_close($conn);
                $error = 'Erreur lors de la promotion : ' . $e->getMessage();
            }
        }
    }
}

$employe = getEmployeById($emp_no);
$page_title = 'Devenir Manager';
include __DIR__ . '/header.php';
?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2">Devenir Manager - <?= htmlspecialchars($employe['first_name'] . ' ' . $employe['last_name']) ?></h1>
            <p class="text-muted">Choisissez le département et la date de début.</p>
        </div>
        <a href="employee.php?emp_no=<?= intval($emp_no) ?>" class="btn btn-secondary">Retour</a>
    </div>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post" class="row g-3">
        <input type="hidden" name="emp_no" value="<?= intval($emp_no) ?>">
        <div class="col-md-6">
            <label class="form-label">Département</label>
            <select class="form-select" name="dept_no" onchange="this.form.submit()">
                <?php foreach ($departments as $d): ?>
                    <option value="<?= htmlspecialchars($d['dept_no']) ?>" <?= ($selected_dept == $d['dept_no']) ? 'selected' : '' ?>><?= htmlspecialchars($d['dept_no']) ?> - <?= htmlspecialchars($d['dept_name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6">
            <?php if ($selected_dept): ?>
                <?php $mgr = getCurrentManagerByDepartment($selected_dept); ?>
                <label class="form-label">Manager actuel</label>
                <div class="form-control bg-white"><?= $mgr ? htmlspecialchars($mgr['first_name'] . ' ' . $mgr['last_name']) : 'N/A' ?></div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <label class="form-label">Date de début</label>
            <input class="form-control" type="date" name="start_date" required>
        </div>
        <div class="col-12">
            <button class="btn btn-success" type="submit">Promouvoir</button>
            <a class="btn btn-outline-secondary" href="employee.php?emp_no=<?= intval($emp_no) ?>">Annuler</a>
        </div>
    </form>
<?php include __DIR__ . '/footer.php';
