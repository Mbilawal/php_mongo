<?php

include("../vendor/autoload.php");

$client = new MongoDB\Client(
    'mongodb://localhost:27017/test?retryWrites=true&w=majority'
);

$db = $client->local;

?>
