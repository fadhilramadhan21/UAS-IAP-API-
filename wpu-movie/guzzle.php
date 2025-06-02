<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$response = $client->request('GET', 'http://omdbapi.com', [
    'query' => [
        'apikey' => '2190a56f',
        's' => 'harry potter',
    ]
]);

$result =  json_decode($response->getBody()->getContents(), true); 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie</title>
</head>
<body>
    <?php foreach($result['Search'] as $movie) : ?>
    <ul> 
        <li>Tittle : <?= $movie['Title'];?></li>
        <li>Tahun : <?= $movie['Year'];?></li>
        <li>
            <img src="<?= $movie['Poster'];?>" width="80">
        </li>
    </ul>
    <?php endforeach;?>
</body>
</html>