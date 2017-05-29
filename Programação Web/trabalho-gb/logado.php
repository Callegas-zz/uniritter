<?php

session_start();

if ($_SESSION['logado'] === false) {
	header("Location: ./login.php");
}

?>

<pre>
	<?php print_r($_SESSION['usuario']); ?>
</pre>

<a href="./logout.php">Logout</a>