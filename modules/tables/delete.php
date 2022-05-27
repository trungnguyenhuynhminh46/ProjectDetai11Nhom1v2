<?php
$table_name = $_GET['name'];
deleteTable($table_name);
redirectTo("?mod=tables&act=main");
?>