<?php
$key = json_decode($_GET['key'], true);
$table_name = $_GET['table_name'];
$message_body = [
    "TableName" => $table_name,
    "Key" => $key['Key']
];
deleteItem($message_body);
redirectTo("?mod=tables&act=detail&name=".$table_name);
?>