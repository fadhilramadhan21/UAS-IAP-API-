<?php

$data = file_get_contents('coba.json');
$users = json_decode($data, true);

var_dump($users);
echo $users[0]["pembimbing"]["pembimbing1"];

?>