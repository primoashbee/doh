<?php
session_start();
require "../config.php";
require "../functions.php";

$data = qryOutbreak();
var_dump($data[0]);
?>