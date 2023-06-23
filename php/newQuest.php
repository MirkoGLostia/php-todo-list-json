<?php

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');

$quest = $_POST;

$listElementStr = file_get_contents("data.json");
$quests = json_decode($listElementStr);

$quests[] = $quest;

$listElementStr = json_encode($quests);

file_put_contents("data.json", $listElementStr);
echo $listElementStr;