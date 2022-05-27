<?php
function getAllTablesDetail(){
    $API_GetTableDetails = "https://aytm5kpem6.execute-api.us-east-1.amazonaws.com/gettabledetails/api/v1/gettabledetails";$res = json_decode(CallAPI("POST",$API_GetTableDetails),True);
    $res = json_decode(CallAPI("POST",$API_GetTableDetails),True);
    return $res;
}

function getAllItemsByTableName($table_name){
    $API_GetItemsByTableName = "https://2l8rbpvqqd.execute-api.us-east-1.amazonaws.com/getitemsbytablename/api/v1/getitemsbytablename";
    $data_arr = ["TableName"=>$table_name];
    $data = json_encode($data_arr);
    $res = json_decode(CallAPI("POST",$API_GetItemsByTableName,$data),True);
    return $res;
}

function createTable($inp){
    $msg_body = json_encode($inp, JSON_UNESCAPED_UNICODE);
    $url = "https://sqs.us-east-1.amazonaws.com/549480557245/TriggerCreateTable";
    sendMessage($msg_body,$url);
}

function deleteTable($table_name){
    $URL_triggerDeleteTable = "https://sqs.us-east-1.amazonaws.com/549480557245/TriggerDeleteTable";
    $inp = ["TableName" => $table_name];
    $msg_body = json_encode($inp, JSON_UNESCAPED_UNICODE);
    sendMessage($msg_body, $URL_triggerDeleteTable);
}

function createItem($inp){
    $URL_triggerCreateItem = "https://sqs.us-east-1.amazonaws.com/549480557245/TriggerCreateItem";
    $msg_body = json_encode($inp,JSON_UNESCAPED_UNICODE);
    sendMessage($msg_body,$URL_triggerCreateItem);
}

function deleteItem($inp){
    $URL_triggerDeleteItem = "https://sqs.us-east-1.amazonaws.com/549480557245/TriggerDeleteItem";
    $msg_body = json_encode($inp, JSON_UNESCAPED_UNICODE);
    sendMessage($msg_body,$URL_triggerDeleteItem);
}
?>