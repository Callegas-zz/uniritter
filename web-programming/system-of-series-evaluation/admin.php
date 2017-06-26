<!DOCTYPE html>

<?php
    session_start();
        
    if ($_SESSION['logged'] === false) {
	header("Location: ./index.php");
    }
      
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        logged
        <a href="./logout.php">Logout</a>
        <?php
        // put your code here
        ?>
    </body>
</html>
