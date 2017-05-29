<?php

session_start();

if ($_SESSION['logado'] === false) {
	header("Location: ./login.php");
}


$_SESSION['logado'] = false;
$_SESSION['usuario'] = null;

header("Location: login.php");