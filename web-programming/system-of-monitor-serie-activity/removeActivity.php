<?php

include './class/DAO/Connection.class.php';
include './class/DAO/ActivityDAO.class.php';

$activityDAO = new ActivityDAO();

$activityDAO->remove($_GET['id']);


header("location: index.php");
