<?php
$fpath = $_SERVER['REQUEST_URI'];
$fpath = mb_substr($fpath, 0, -4);
$fpath = mb_substr($fpath, 1);
$dbName = str_replace('databases/', '', $fpath);
$fpath = $fpath . '.json';
if (file_exists($fpath)) {

     $tables = Databases::read($fpath, 'json');
} else {
    echo 'Такой базы данных не существует';
}
?>

<div class="title">База данных <strong><?php echo $dbName; ?> </strong></div>
<table class="main__table">
    <thead class="thead">
        <tr>
            <th>Таблица</th>
            <th class="table_manipulation">Действия</th>
        </tr>
    </thead>
    <tbody id="externalTbody">

    <?php
    if ($tables) {
        foreach ($tables as $table): ?>
            <tr>
                <th>
                    <a href="<?php echo '/' . $dbName . '/tables/' . $table['table_name'] . '.php'; ?>">
                        <?php echo $table['table_name']; ?>
                    </a>
                </th>
                <th></th>
            </tr>
        <?php endforeach;
    }
    ?>

    </tbody>
</table>

<form class="create_table" name="create_table">
    <div class="title">Создать таблицу</div>
    <div class="create_table_group">
        Имя:
        <input type="text" name="table_name" maxlength="64" required="required">
        <input type="text" hidden="hidden" name="db_name" value="<?php echo $dbName; ?>">
    </div>

    <div class="create_table_group">
        <div class="create_table_input"  >
            <div class="create_table_field">
                Название поля
                <input type="text" name="field_name1" maxlength="64" required="required">
                Тип поля
                <select  name="field_type1">
                    <option value="integer">integer</option>
                    <option value="string">string</option>
                    <option value="boolean">boolean</option>
                    <option value="NULL">NULL</option>
                </select>
            </div>
        </div>
        <button type="button" name="delete_field" class="delete_field" id="delete_field1" >-</button>
        <button type="button" name="add_field" class="add_field" id="add_field1">+</button>
    </div>

    <div class="create_table_input">
        <button type="submit" name="create_btn">Создать</button>
    </div>

</form>
<script src="../assets/js/create_table.js"></script>
