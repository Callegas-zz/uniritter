<?php

session_start();

if ($_SESSION['logado'] === true) {
	header("Location: ./logado.php");
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<form action="./logar.php" method="POST">
			<input name="username">
			<input name="password" type="password">
			<input type="submit">
		</form>
	</body>
</html>