<?php

// $mahasiswa = [ 
//     [
//         "nama" => "Fadhil Ramadhan",
//         "nim"  => "2217020083",
//         "email"=> "ahmadfadhilramadhan23@gmail.com"
//     ],
//     [
//         "nama" => "Ahmad Fadhil",
//         "nim"  => "2217020083",
//         "email"=> "ahmadfadhilramadhan23@gmail.com"
//     ]
// ];

$dbh = new PDO ('mysql:host=localhost;dbname=kantor', 'root', '');
$db = $dbh->prepare('SELECT * FROM users');
$db->execute();
$users = $db->fetchAll(PDO::FETCH_ASSOC);

$data = json_encode($users);
echo $data;
 
?>