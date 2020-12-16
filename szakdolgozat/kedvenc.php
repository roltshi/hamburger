<?php
ob_start();
include 'connection.php';


$kedvenc = $_POST['kedvenc'];
$id = $_POST['id'];

$sql = "UPDATE hamburgerek SET kedvenc = '$kedvenc' WHERE id = '$id'";

$mysqli->query($sql);

$mysqli->close();
ob_end_flush();
