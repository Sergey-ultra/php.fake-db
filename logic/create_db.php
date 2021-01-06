<?php
require_once 'databases.php';

$db_name = $_POST['db_name'];

Databases::write('db_list.csv','csv', [$db_name]);
Databases::create('../databases/' . $db_name . '.json');

header('location: ' . '/databases/' . $db_name . '.php');
exit();