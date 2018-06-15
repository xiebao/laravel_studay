<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';
/*
$greet = function ($name) {
    return sprintf("Hello %s\r\n", $name);
};

echo $greet('LaravelAcademy.org');

//现在的闭包
$numberPlusOne = array_map(function ($number) {
    return $number += 1;
}, [1, 2, 3]);

print_r($numberPlusOne);

//以前--
function myfunction($v)
{
    return($v*$v);
}

$a=array(1,2,3,4,5);
print_r(array_map("myfunction",$a));



echo "______".PHP_EOL;
class Appq {
    protected $routes = [];
    protected $responseStatus = '200 OK';
    protected $responseContentType = 'text/html';
    protected $responseBody = 'Laravel学院';

    public function addRoute($routePath, $routeCallback) {
        $this->routes[$routePath] = $routeCallback->bindTo($this, __CLASS__);
    }

    public function dispatch($currentPath) {
        foreach ($this->routes as $routePath => $callback) {
            if( $routePath === $currentPath) {
                $callback();
            }
        }
        header('HTTP/1.1 ' . $this->responseStatus);
        header('Content-Type: ' . $this->responseContentType);
        header('Content-Length: ' . mb_strlen($this->responseBody));
        echo $this->responseBody;
    }

}
$appq = new Appq();
$appq->addRoute('user/nonfu', function(){
    $this->responseContentType = 'application/json;charset=utf8';
    $this->responseBody = '{"name":"LaravelAcademy"}';
});
$appq->dispatch('user/nonfu');



die;
*/

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
