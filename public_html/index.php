<?php
declare(strict_type = 1);
session_start();

require __DIR__ . '/lib/Form/Form.php';
require __DIR__ . '/lib/Form/FormBuilder.php';
require __DIR__ . '/lib/Form/FormChecker.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progetto gestione Form</title>
</head>
<body>
    <?php
        echo (new Form(__DIR__ . '/config/reg.php'))->render();
    ?>
</body>
</html>