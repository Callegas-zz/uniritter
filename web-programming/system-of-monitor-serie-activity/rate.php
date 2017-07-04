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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>

  <div class="container">
    
    <form method="GET" action="rate.php">
      <div class="form-group">
        <label for="note">Note:</label>
        <input type="number" class="form-control" name="note">
      </div>
      <div class="text-right">
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </form>

  </div>


  <?php


  if (isset( $_GET["note"])) {
    $user = array_shift($activityDAO->getCurrentUserId($_SESSION['login']));
    $activityDAO->rate($user, $_GET['note'], $_SESSION['serieId']);
    header("location: index.php");

  }
  ?>

</body>
</html>
