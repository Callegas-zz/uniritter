<!DOCTYPE html>

<?php
include './class/DAO/Connection.class.php';
include './class/DAO/ActivityDAO.class.php';
$activityDAO = new ActivityDAO();
session_start();
if (isset($_GET['serieId'])) {
    $_SESSION['serieId'] = $_GET['serieId'];
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

    <form method="GET" action="rate.php">
        Note: <input required type="number" name="note">
        <input type="submit" name="Enter" value="Enter">
    </form>


    <?php


    if (isset( $_GET["note"])) {
        $user = array_shift($activityDAO->getCurrentUserId($_SESSION['login']));
        $activityDAO->rate($user, $_GET['note'], $_SESSION['serieId']);
        header("location: index.php");

    }
    ?>
    
</body>
</html>