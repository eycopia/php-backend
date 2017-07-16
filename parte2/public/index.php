<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;


$app = new \Slim\App(["settings" => $config]);

$container = $app->getContainer();
$container['view'] = new \Slim\Views\PhpRenderer("../templates/");


$app->get('/', function (Request $request, Response $response){
    $response = $this->view->render($response, "index.php");
    return $response;
});


$app->get('/employees', function (Request $request, Response $response){
    $dt = new \App\Employee();
    $json = $dt->search();
    return $response->write($json);
});

$app->get('/employees/{id}', function (Request $request, Response $response, $args){
    $e = new \App\Employee();

    $worker = $e->find($args['id']);
    $response = $this->view->render($response, "ver.php", ['worker' => $worker]);
    return $response;
});


$app->run();