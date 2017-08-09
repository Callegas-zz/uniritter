<?php
session_start();
if ($_SESSION['logged'] === false) {
	header("Location: ./index.php");
}
$_SESSION['logged'] = false;
$_SESSION['login'] = null;
header("Location: ./index.php");
