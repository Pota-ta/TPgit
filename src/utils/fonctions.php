<?php

// Fonctions pour employees

require_once __DIR__ . '/connexion.php';

function getAllEmployes()
{
    $connexion = getConnexion();
    $query = "SELECT * FROM employees LIMIT 10";
    $result = mysqli_query($connexion, $query);

    if (!$result) {
        echo 'Erreur SQL : ' . mysqli_error($connexion);
        return null;
    }

    $employes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $employes[] = $row;
    }
    mysqli_free_result($result);
    mysqli_close($connexion);
    return $employes;
}

function getEmployeById($emp_no)
{
    $connexion = getConnexion();
    $query = "SELECT * FROM employees WHERE emp_no = " . intval($emp_no);
    $result = mysqli_query($connexion, $query);

    if (!$result) {
        echo 'Erreur SQL : ' . mysqli_error($connexion);
        return null;
    }

    $employe = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($connexion);
    return $employe;
}


function getAllDepartments()
{
    $connexion = getConnexion();
    $query = "SELECT * FROM departments";
    $result = mysqli_query($connexion, $query);

    if (!$result) {
        echo 'Erreur SQL : ' . mysqli_error($connexion);
        return null;
    }

    $departments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $departments[] = $row;
    }
    mysqli_free_result($result);
    mysqli_close($connexion);
    return $departments;
}


function getCurrentManagerByDepartment($dept_no)
{
    $connexion = getConnexion();
    $query = "SELECT e.first_name, e.last_name FROM employees e
              INNER JOIN dept_manager dm ON e.emp_no = dm.emp_no
              WHERE dm.dept_no = '" . mysqli_real_escape_string($connexion, $dept_no) . "'
              AND dm.to_date = '9999-01-01'
              LIMIT 1";
    $result = mysqli_query($connexion, $query);

    if (!$result) {
        echo 'Erreur SQL : ' . mysqli_error($connexion);
        return null;
    }

    $manager = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($connexion);
    return $manager;
}


function getEmployesByDepartment($dept_no)
{
    $connexion = getConnexion();
    $query = "SELECT e.* FROM employees e
              INNER JOIN dept_emp de ON e.emp_no = de.emp_no
              WHERE de.dept_no = '" . mysqli_real_escape_string($connexion, $dept_no) . "'
              AND de.to_date = '9999-01-01'";
    $result = mysqli_query($connexion, $query);

    if (!$result) {
        echo 'Erreur SQL : ' . mysqli_error($connexion);
        return null;
    }

    $employes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $employes[] = $row;
    }
    mysqli_free_result($result);
    mysqli_close($connexion);
    return $employes;
}


function getSalariesByEmployee($emp_no)
{
    $connexion = getConnexion();
    $query = "SELECT * FROM salaries WHERE emp_no = " . intval($emp_no) . " ORDER BY from_date DESC";
    $result = mysqli_query($connexion, $query);

    if (!$result) {
        echo 'Erreur SQL : ' . mysqli_error($connexion);
        return null;
    }

    $salaries = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $salaries[] = $row;
    }
    mysqli_free_result($result);
    mysqli_close($connexion);
    return $salaries;
}


function getTitlesByEmployee($emp_no)
{
    $connexion = getConnexion();
    $query = "SELECT * FROM titles WHERE emp_no = " . intval($emp_no) . " ORDER BY from_date DESC";
    $result = mysqli_query($connexion, $query);

    if (!$result) {
        echo 'Erreur SQL : ' . mysqli_error($connexion);
        return null;
    }

    $titles = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $titles[] = $row;
    }
    mysqli_free_result($result);
    mysqli_close($connexion);
    return $titles;
}


function getEmployeeCountByDept($dept_no)
{
    $connexion = getConnexion();
    $query = "SELECT COUNT(*) AS cnt FROM dept_emp WHERE dept_no = '" . mysqli_real_escape_string($connexion, $dept_no) . "' AND to_date = '9999-01-01'";
    $result = mysqli_query($connexion, $query);
    if (!$result) {
        mysqli_close($connexion);
        return 0;
    }
    $row = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($connexion);
    return intval($row['cnt']);
}


function getJobStats()
{
    $connexion = getConnexion();
    $query = "SELECT t.title AS title, 
                 SUM(e.gender = 'M') AS males, 
                 SUM(e.gender = 'F') AS females, 
                 AVG(s.salary) AS avg_salary
              FROM titles t
              JOIN employees e ON t.emp_no = e.emp_no
              JOIN salaries s ON s.emp_no = e.emp_no
              WHERE t.to_date = '9999-01-01' AND s.to_date = '9999-01-01'
              GROUP BY t.title
              ORDER BY avg_salary DESC";
    $result = mysqli_query($connexion, $query);
    if (!$result) {
        echo 'Erreur SQL : ' . mysqli_error($connexion);
        mysqli_close($connexion);
        return [];
    }
    $rows = [];
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }
    mysqli_free_result($result);
    mysqli_close($connexion);
    return $rows;
}


function getLongestTitleByEmployee($emp_no)
{
    $connexion = getConnexion();
    $emp_no = intval($emp_no);
    $query = "SELECT title, SUM(DATEDIFF(CASE WHEN to_date = '9999-01-01' THEN CURDATE() ELSE to_date END, from_date)) AS days
              FROM titles
              WHERE emp_no = " . $emp_no . "
              GROUP BY title
              ORDER BY days DESC
              LIMIT 1";
    $result = mysqli_query($connexion, $query);
    if (!$result) {
        mysqli_close($connexion);
        return null;
    }
    $row = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($connexion);
    return $row;
}
