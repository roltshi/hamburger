<?php
ob_start();
$servername = "localhost";
$username = "";
$pass = "";
$databse = "";

$mysqli = new mysqli($servername, $username, $pass, $databse);

mysqli_query($mysqli, 'SET NAMES utf8');
if ($mysqli->connect_errno) {
    exit();
}
ob_end_flush();
