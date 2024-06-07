<?php
#include vendor autoload
require 'vendor/autoload.php';

use Example\ExampleServiceClient;
use Example\HelloRequest;

$client = new ExampleServiceClient('172.17.0.2:9001', [
    'credentials' => Grpc\ChannelCredentials::createInsecure(),
]);

$request = new HelloRequest();
$request->setName('World');

list($response, $status) = $client->SayHello($request)->wait();

if ($status->code !== Grpc\STATUS_OK) {
    echo "gRPC call failed: " . $status->details . PHP_EOL;
    exit(1);
}

echo $response->getMessage() . PHP_EOL;
