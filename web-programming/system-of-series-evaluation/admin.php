<!DOCTYPE html>

<?php
    session_start();
    if (!(isset($_SESSION['login']))){
        header("Location: admin.php");
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        logged
        <?php
        // put your code here
        ?>
    </body>
</html>
