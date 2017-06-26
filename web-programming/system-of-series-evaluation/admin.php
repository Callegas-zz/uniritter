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

	<h2> Register new serie </h2>
	
	<form method="POST" action="admin.php">
		Name: <input type="text" name="name"> 
		Describe: <input type="text" name="describe"> 
		Total Seasons: <input type="number" name="seasons"> 
		<input type="submit" name="registerNewSerie" value="registerNewSerie">
	</form>


	<?php showAllSeries(); ?>   

	<?php registerSerie(); ?>      

	<br> <br> <br>

	<h2> Register the last episode view </h2>

	<form method="POST" action="admin.php">
		Serie: <input type="text" name="serie"> 
		Season: <input type="number" name="season"> 
		Episode: <input type="number" name="episode"> 
		<input type="submit" name="registerActivity" value="registerActivity">
	</form>

	<?php showActivity(); ?>   

	<?php registerActivity(); ?>      


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
		"<td>" . $s['serieName'] . "</td>" .
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


function showActivity(){
	include './class/DAO/ActivityDAO.class.php';

	$activityDAO = new ActivityDAO();

	echo "<h1>Activity</h1>";

	echo "<table>" .
	"<tr>" .
	"<th>Serie</th>" .
	"<th>Current Season</th>" .
	"<th>Episode</th>" .
	"</tr>";

	foreach($activityDAO->getActivity() as $a){  
		echo "<tr>" .
		"<td>" . $activityDAO->getSerieName($a['serieId'])['serieName'] . "</td>" .
		"<td>" . $a['currentSeason'] . "</td>" .
		"<td>" . $a['currentEpisode'] . "</td>" .
		"</tr>";
	}

	echo "</table>";

}

function registerActivity(){

	if ($_POST) {
		$activityDAO = new ActivityDAO();

		$serieName = addslashes($_POST['serie']);
		$season = addslashes($_POST['season']);
		$episode = addslashes($_POST['episode']);	

		$serieId = $activityDAO->getSerieId($serieName);
		$activityDAO->registerActivity($serieId, $season, $episode);
	}

}



?>
