<!DOCTYPE html>

<?php
session_start();

if ($_SESSION['logged'] === false) {
	header("Location: ./index.php");
}

?>

<html>
<head>
	<style>
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
		}
		th, td {
			padding: 5px;
			text-align: left;    
		}
	</style>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>

	Wellcome <?php print_r($_SESSION['login']); ?>
	<a href="./logout.php">Logout</a>

	<br> <br> <br>

	<h2> Register new movie </h2>
	
	<form method="POST" action="admin.php">
		Name: <input type="text" name="name"> 
		Describe: <input type="text" name="describe"> 
		Total Seasons: <input type="number" name="seasons"> 
		<input type="submit" name="register" value="register">
	</form>


	<?php showAllSeries(); ?>   

	<?php registerSerie(); ?>      


</body>
</html>


<?php

function showAllSeries(){
	include './class/DAO/Connection.class.php';
	include './class/DAO/SerieDAO.class.php';

	$serieDAO = new SerieDAO();

	echo "<h1>Registered Series</h1>";

	echo "<table>" .
	"<tr>" .
	"<th>Name</th>" .
	"<th>Describe</th>" .
	"<th>total Seasons</th>" .
	"<th>Rate</th>" .
	"</tr>";

	foreach($serieDAO->getSeries() as $s){  
		echo "<tr>" .
		"<td>" . $s['name'] . "</td>" .
		"<td>" . $s['serieDescribe'] . "</td>" .
		"<td>" . $s['totalSeasons'] . "</td>" .
		"<td>" . $s['rate'] . "</td>" .
		"</tr>";
	}

	echo "</table>";
}

function registerSerie(){
	if ($_POST) {
		$serieDAO = new SerieDAO();

		$name = addslashes($_POST['name']);
		$describe = addslashes($_POST['describe']);
		$seasons = addslashes($_POST['seasons']);	

		$serieDAO->registerSerie($name, $describe, $seasons);
	}
}



?>
