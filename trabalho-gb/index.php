<?php

session_start();

if ($_SESSION['logado'] === true) {
	header("Location: ./logado.php");
} 

header("Location: ./login.php");