<?php
// Petit projet PHP Hello World

$message = "Bonjour le monde !";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Hello World</title>
</head>
<body>
    <h1><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></h1>
    <p>Fichier : <strong>index.php</strong></p>
</body>
</html>
