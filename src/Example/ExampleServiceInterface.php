<?php
# Generated by the protocol buffer compiler (roadrunner-server/grpc). DO NOT EDIT!
# source: proto/example.proto

namespace Example;

use Spiral\RoadRunner\GRPC;

interface ExampleServiceInterface extends GRPC\ServiceInterface
{
    // GRPC specific service name.
    public const NAME = "example.ExampleService";

    /**
    * @param GRPC\ContextInterface $ctx
    * @param HelloRequest $in
    * @return HelloResponse
    *
    * @throws GRPC\Exception\InvokeException
    */
    public function SayHello(GRPC\ContextInterface $ctx, HelloRequest $in): HelloResponse;
}
