<?php
require_once __DIR__ .  '/vendor/autoload.php';
$uri = 'mongodb+srv://Pavee:Gojo100@cluster0.hzseqsl.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0';
$client = new MongoDB\Client($uri);
try {
    $client->selectDatabase('admin')->command(['ping' => 1]);
    $collection = $client->guvi->profiledata;
    $cursor = $collection->find();
    foreach ($cursor as $document) {
        $field1 = $document->name;
        $field2 = $document->age;
        $field3 = $document->address;
        echo "Name: " . $field1 . "<br>";
        echo "Age: " . $field2 . "<br>";
        echo "Address: " . $field3 . "<br>";
    }
} catch (Exception $e) {
    printf($e->getMessage());
}
?>