<h2>Список баз данных</h2>
<?php
if ($databases) {
    foreach ($databases as $database): ?>
        <div class="db__item">

            <a href="<?php echo  '/databases/' . $database[0] . '.php'; ?>">
                <?php echo $database[0]; ?>
            </a>
        </div>
    <?php endforeach;
} ?>