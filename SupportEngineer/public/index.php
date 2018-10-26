<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

use SupportTest\db\Database;
use SupportTest\db\models\User;

session_start();

$app = new \Slim\App([
            'settings' => [
                'displayErrorDetails' => true
            ]
        ]);

$database = new Database();

$app->get('/card/{id}', function (Request $request, Response $response, array $args) {
    return $response;
});

$app->post('/card', function (Request $request, Response $response, array $args) {
    $params = $request->getParsedBody();
    if (!empty($params) && !empty($params['cardId']))
    {
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->withJson(["message"=>"Card ID is ".$params['cardId']]);
    }
    
    return $response->withStatus(400)
        ->withHeader('Content-Type', 'application/json')
        ->withJson(["message"=>"failed"]);
});

$app->post('/register', function (Request $request, Response $response, array $args) {
    global $database;
    
    $params = $request->getParsedBody();
    $email = $params['email'];
    $password = $params['password'];
    
    $user = new User();
    $user->setEmail($email);
    $user->setPassword($password);
    
    $entityManager = $database->getEntityManage();
    $entityManager->persist($user);
    $entityManager->flush();
    
    return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->withJson(['id' => $user->getId()]);    
});

$app->get('/login', function (Request $request, Response $response, array $args) {
    global $database;
    
    $params = $request->getParams();
    $email = $params['email'];
    $password = $params['password'];
    
    $entityManager = $database->getEntityManage();

    $userRepository = $entityManager->getRepository('SupportTest\\db\\models\\User');
    $user = $userRepository->findOneBy(['email'=>$email]);
        
    if ($user->getPassword() === $password)
    {        
        session_destroy();
        session_start();

        $_SESSION['email'] = $email;
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->withJson(['name' => 'Test Me']);
    }
    else
    {
        return $response->withStatus(400)
        ->withHeader('Content-Type', 'application/json')
        ->withJson(["message"=>"failed"]);
    }

    return $response;
});

$app->get('/user/{id}', function (Request $request, Response $response, array $args) {
    global $database;
    $id = $args['id'];
    $entityManager = $database->getEntityManage();

    $userRepository = $entityManager->getRepository('SupportTest\\db\\models\\User');
    $user = $userRepository->findOneBy(['id'=>$id]);
    
    $data = [
        'email' => $user->getEmail()
            ];
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->withJson($data);

    return $response;
});



$app->run();