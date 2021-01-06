<?php

//разбиваем uri на массив
$fpath = explode('/', $_SERVER['REQUEST_URI']);

//формируем имя таблицы
$table_word = $fpath[array_key_last($fpath)];
$db_name = $fpath[array_key_last($fpath) - 2];
$table_name = mb_substr($table_word, 0, -4);

//формирует путь до таблицы и до базы данных, чтобы вытащить названия и типы полей
$link_db_path =  '/databases/' . $db_name . '.php';
$table_path = 'databases/' . $db_name . '/' . $table_name . '.csv';
$db_path = 'databases/' . $fpath[array_key_last($fpath) - 2] . '.json';

if (file_exists($table_path)) {
    $records = Databases::read($table_path, 'csv');

    $tables = Databases::read($db_path, 'json');

    //ложим в $fields массив с полями
    if ($tables) {
        foreach ($tables as $table) {
            if ($table['table_name'] == $table_name) {
                $fields = $table['fields'];
            }
        }
    }
} else {
    echo "Путь ${$table_path} не верный";
}
?>
<div class="table_title">
    <?php echo "Таблица <strong> ${table_name} </strong> базы данных 
        <a href='${link_db_path}'> ${db_name} </a>";
    ?>
</div>

<table class="main__table">
    <thead class="thead">
        <tr>
            <th>
                Поле
            </th>
            <?php
            if ($fields) {
                foreach ($fields as $field) {
                    echo '<th>' . $field[0] . '</th>';
                }
            }
            ?>
        </tr>
        <tr>
            <th>
                Тип данных
            </th>
            <?php
            if ($fields) {
                foreach ($fields as $field) {
                    echo '<th>' . $field[1] . '</th>';
                }
            }
            ?>
        </tr>
    </thead>
    <tbody id="externalTbody">

    <?php
    if ($records) {
    foreach ($records as $record): ?>
        <tr>
            <th></th>
            <?php
            foreach ($record as $field) {
                echo '<th>' . $field . '</th>';
            }
            ?>
        </tr>
    <?php endforeach;
    }
    ?>

    </tbody>
</table>
<form name="create_record"  class="create_record">
    <h3>Создать запись</h3>

    <input type="text" hidden="hidden" name="table_name" value="<?php echo $table_name; ?>">
    <input type="text" hidden="hidden" name="db_name" value="<?php echo $db_name; ?>">
    <div class="create_record_group">
        <?php if ($fields) {
            foreach ($fields as $field): ?>

                <div class="create_record_input" id="create_table_field">
                    <div class="field_title"><?php echo $field[0]; ?></div>

                    <?php if ($field[1] == 'boolean'): ?>
                        <select class="field" name="<?php echo $field[0]; ?>" required>
                            <option value="true">true</option>
                            <option value="false">false</option>
                        </select>
                    <?php elseif ($field[1] == 'NULL'): ?>
                        <input type="text" class="field" maxlength="64" name="<?php echo $field[0]; ?>" value='NULL' required>
                    <?php else: ?>
                        <input type="text" class="field" maxlength="64" name="<?php echo $field[0]; ?>" required>
                    <?php endif ?>
                    <input type="text" class="field" name="<?php echo $field[0] . '_type'; ?>" value="<?php echo $field[1]; ?>" hidden="hidden">
                </div>

            <?php endforeach;
        }
        ?>
    </div>
    <button type="submit" class="create_record_btn" name="create_record_btn">Создать</button>
</form>
<script src="/../assets/js/create_record.js"></script>