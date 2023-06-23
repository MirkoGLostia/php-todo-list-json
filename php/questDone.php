<?php

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');

$index = $_POST["index"];

$listElementStr = file_get_contents("data.json");
$quests = json_decode($listElementStr);

if ($quests[$index]->status == 'not done') {

    $quests[$index]->status = 'done';
} 
else {
    $quests[$index]->status = 'not done';
}

$listElementStr = json_encode($quests);

file_put_contents("data.json", $listElementStr);
echo $listElementStr;

?>