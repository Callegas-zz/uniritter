<?php 

session_start();

if ($_SESSION['logado'] === true) {
	header("Location: ./logado.php");
}

require "./Usuario.php";

$_SESSION['logado'] = false;
$_SESSION['usuario'] = null;
$username = $_POST['username'];
$password = $_POST['password'];

try {
	$usuario = new Usuario($username, $password);
	$_SESSION['usuario'] = $usuario->getUserInfo();
	$_SESSION['logado'] = true;

	header("Location: logado.php");
} catch (Exception $e) {
	header("Location: login.php");
}