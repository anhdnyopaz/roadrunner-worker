<?php

namespace Services;

use Example\ExampleServiceInterface;
use Example\HelloRequest;
use Example\HelloResponse;

class ExampleService implements ExampleServiceInterface
{
    public function SayHello(\Spiral\RoadRunner\GRPC\ContextInterface $ctx, HelloRequest $in): HelloResponse
    {
        $response = new HelloResponse();
        $response->setMessage('Hello ' . $in->getName());
        return $response;
    }
}
