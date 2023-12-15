<?php

$db_server = "localhost";
$db_user = "kadu";
$db_pass = "preto";
$db_name = "teste";
$conn= "";

try {
    $connection = mysqli_connect($db_server,$db_user, $db_pass, $db_name);

}
catch (mysqli_sql_exception) {
    echo "Connection error";
}


