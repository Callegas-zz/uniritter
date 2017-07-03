<!DOCTYPE html>

<?php
session_start();
if ($_SESSION['logged'] === true) {
  header("Location: ./admin.php");
}
?>

<html>
<head>
  <meta charset="UTF-8">
  <title></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Indie+Flower" />

  <style>

  h1{
    font-family: "Indie Flower";
  }

  .banner{
    text-align: center;
  }

  </style>

</head>
<body>

  <div class="container">

    <div class="banner">
      <img src="http://blog.myvideo.ge/wp-content/uploads/2015/03/serielabi.png">
    </div>

    <h1 class="text-center"> Wellcome to the system form your watching activity </h1>

    <form method="POST" action="index.php">
      <div class="form-group">
        <label for="login">User:</label>
        <input type="text" class="form-control" name="login">
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <?php
  if ($_POST) {
    include './class/DAO/Connection.class.php';
    include './class/DAO/UserDAO.class.php';

    $userDAO = new UserDAO();

    $login = addslashes($_POST['login']);
    $password = addslashes($_POST['password']);

    $user = $userDAO->login($password, $login);

    if ($user == true) {
      session_start();
      $_SESSION['login'] = $login;
      $_SESSION['logged'] = true;
      header("location: admin.php");
    }else {
      header("location: index.php?error=password");
    }
  }
  ?>

  <?php
  if ($_GET) {
    if (isset($_GET['error'])) {
      echo 'Invalid user or password!';
    }
  }
  ?>
</body>
</html>
