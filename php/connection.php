<?php

require_once '../config.inc.php';

$db = mysqli_connect($database_host, $database_user, $database_pass, $group_dbnames[0]) or die(mysqli_error($db));