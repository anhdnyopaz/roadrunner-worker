<?php
# add compose autoload
require_once 'vendor/autoload.php';

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;

use Spiral\RoadRunner\Worker;
use Spiral\RoadRunner\Http\PSR7Worker;
use Spiral\RoadRunner\GRPC\Server;
use Spiral\RoadRunner\GRPC\Invoker;
$worker = Worker::create();
$factory = new Psr17Factory();

$psr7 = new PSR7Worker($worker,$factory,$factory,$factory);
//
//$server = new Server(new Invoker(),[
//    'debug' => true,
//]);
//
//$server->registerService(\Example\ExampleServiceInterface::class, new \Services\ExampleService());
//
//$server->serve(Worker::create());

while (true) {
    try {
        $request = $psr7->waitRequest();
        if($request == null){
            break;
        }
    } catch (\Throwable $e) {
        $psr7->respond(new Response(400));
        continue;
    }

    try {
        $psr7->respond(new Response(200, [], 'Hello World!'));
    } catch (\Throwable $e) {
        $psr7->respond(new Response(500, [], 'Internal Server Error'));
        $psr7->getWorker()->error((string)$e);
    }
}
