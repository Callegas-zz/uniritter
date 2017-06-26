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
    </head>
    <body>
        <form method="POST" action="index.php">
            User: <input type="text" name="login"> <br />
            Password: <input type="password" name="password"> <br />
            <input type="submit" name="Enter" value="Enter">
        </form>
        
        
        
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
