<?php

include './class/DAO/Connection.class.php';
include './class/DAO/SerieDAO.class.php';

$serieDAO = new SerieDAO();

$serieDAO->remove($_GET['id']);


header("location: index.php");
