<!DOCTYPE html>

<?php
session_start();

if ($_SESSION['logged'] === false) {
	header("Location: ./index.php");
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
	.series{
		padding-left: 50px;
		padding-right: 50px;
		padding-bottom: 30px;
	}
	span{
		font-family: "Indie Flower";
		align-items: center;
		font-size: 1.4em;
	}
	.regtittle{
		text-align: center;
		color: green;
	}
	.banner{
		text-align: center;
	}

	</style>

</head>
<body>

	<div class="container">

		<div class="session text-right">
			Wellcome <?php print_r($_SESSION['login']); ?>
			<a href="./logout.php">logout</a>
		</div>

		<div class="banner">
			<img src="http://www.adirferreira.com.br/wp-content/uploads/2015/09/TV-Series.png" width="150px" height="150px">
		</div>

		<?php showAllSeries(); ?>

		<div class="container series">
			<div class="regtittle">
				<span> Register new serie </span>
			</div>

			<form method="POST" action="admin.php">
				<div class="form-group">
					<label for="name">Name:</label>
					<input required type="text" class="form-control" name="name">
				</div>
				<div class="form-group">
					<label for="describe">Describe:</label>
					<input required type="text" class="form-control" name="describe">
				</div>
				<div class="form-group">
					<label for="seasons">Total Seasons:</label>
					<input required type="number" class="form-control" name="seasons">
				</div>
				<div class="text-right">
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
			</form>

			<?php registerSerie(); ?>

		</div>

		<div class="banner">
			<img src="https://upload.wikimedia.org/wikipedia/commons/f/f1/Serie_televisive_1.png" width="150px" height="150px">
		</div>

		<?php showActivity(); ?>

		<div class="container series">
			<div class="regtittle">
				<span> Register new serie </span>
			</div>

			<form method="POST" action="admin.php">
				<div class="form-group">
					<label for="serie">Serie:</label>
					<input required type="text" class="form-control" name="serie">
				</div>
				<div class="form-group">
					<label for="season">Season:</label>
					<input required type="number" class="form-control" name="season">
				</div>
				<div class="form-group">
					<label for="episode">Episode:</label>
					<input required type="number" class="form-control" name="episode">
				</div>
				<div class="text-right">
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
			</form>

			<?php registerActivity(); ?>
		</div>

	</div>
</body>
</html>



<?php

function showAllSeries(){
	include './class/DAO/Connection.class.php';
	include './class/DAO/SerieDAO.class.php';


	$serieDAO = new SerieDAO();

	echo "<h1 class='text-center'>Registered Series</h1>" .

	"<table class='table table-striped'>" .
	"<tr>" .
	"<th>Name</th>" .
	"<th>Describe</th>" .
	"<th>total Seasons</th>" .
	"<th>Rating</th>" .
	"<th>Remove</th>" .
	"<th>Rate</th>" .
	"</tr>";

	foreach($serieDAO->getSeries() as $s){
		echo "<tr>" .
		"<td>" . $s['serieName'] . "</td>" .
		"<td>" . $s['serieDescribe'] . "</td>" .
		"<td>" . $s['totalSeasons'] . "</td>";


		if (array_shift($serieDAO->getRate($s['serieId'])) != null) {
			echo "<td>" .
			array_shift($serieDAO->getRate($s['serieId'])) .
			"</td>";
		}else{
			echo "<td> not rated </td>";
		}

		echo "<td><a href='removeSerie.php?id=" . $s['serieId'] . "'>remove</a>" .
		"<td><a href='rate.php?serieId=" . $s['serieId'] . "'>rate</a>" .
		"</tr>";
	}

	echo "</table>";
}

function registerSerie(){
	if (isset( $_POST["name"])) {
		$serieDAO = new SerieDAO();

		$name = addslashes($_POST['name']);
		$describe = addslashes($_POST['describe']);
		$seasons = addslashes($_POST['seasons']);

		$serieDAO->registerSerie($name, $describe, $seasons);
		header("Location: ./index.php");
	}
}


function showActivity(){
	include './class/DAO/ActivityDAO.class.php';

	$activityDAO = new ActivityDAO();

	echo "<h1 class='text-center'>Activity</h1>" .

	"<table class='table table-striped'>" .
	"<tr>" .
	"<th>Serie</th>" .
	"<th>Current Season</th>" .
	"<th>Episode</th>" .
	"<th>Remove</th>" .
	"</tr>";

	$user = array_shift($activityDAO->getCurrentUserId($_SESSION['login']));

	foreach($activityDAO->getActivity($user) as $a){
		echo "<tr>" .
		"<td>" . $activityDAO->getSerieName($a['serieId'])['serieName'] . "</td>" .
		"<td>" . $a['currentSeason'] . "</td>" .
		"<td>" . $a['currentEpisode'] . "</td>" .
		"<td><a href='removeActivity.php?id=" . $a['serie_user_id'] . "'>remove</a>" .
		"</tr>";
	}

	echo "</table>";

}

function registerActivity(){

	if (isset( $_POST["serie"])) {
		$activityDAO = new ActivityDAO();

		$serieName = addslashes($_POST['serie']);
		$season = addslashes($_POST['season']);
		$episode = addslashes($_POST['episode']);

		$serieId = $activityDAO->getSerieId($serieName);
		$userId = $activityDAO->getCurrentUserId($_SESSION['login']);

		$activityDAO->registerActivity($userId, $serieId, $season, $episode);
		header("Location: ./index.php");
	}

}



?>
