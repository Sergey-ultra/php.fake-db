<?php
require_once 'databases.php';


$tables_array = Databases::read('../databases/' . $_POST['db_name'] . '.json', 'json');

foreach ($tables_array as $table){
    if ($table['table_name'] == $_POST['table_name']){
        $fields = $table['fields'];
    }
}

foreach($fields as $field){
    $field_name = $field[0];
    $field_type = $field[1];
    $field_value = $_POST[$field_name];

    //преобразуем входные поля в нужный тип данных
    settype ( $field_value , $field_type);
    $record[] = $field_value;
}

if ($record) {
    $table_url = '../databases/' . $_POST['db_name'] . '/' . $_POST['table_name'] . '.csv';
    Databases::write($table_url, 'csv', $record);
} else {
    echo 'Поля не заполнены';
}

