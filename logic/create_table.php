<?php
require_once 'databases.php';

$table_name = $_POST["table_name"];
$db_folder = '../databases/' . $_POST['db_name'];
$db_url = $db_folder . '.json';

mkdir($db_folder);
$table_url = $db_folder . '/' . $table_name . '.csv';
Databases::create($table_url);

$fields_array =[];

for ($i = 1; $i <= count($_POST) / 2; $i++){
    if (array_key_exists("field_name${i}", $_POST) && array_key_exists("field_type${i}", $_POST)){
        $fields_array[] = [$_POST["field_name${i}"], $_POST["field_type${i}"],];
    }
}

$tables_array = [
    [
        'table_name' => $table_name,
        'fields' => $fields_array,
    ]
];


Databases::write($db_url, 'json', $tables_array);


//header('location: ' . $_SERVER['HTTP_REFERER']);
//exit();
//echo json_encode (Databases::read($table_url));

