<?php
namespace SupportTest\Api\Routes;

class UserRequestRoute extends AbstractRoute
{    
    public function configure(ApiRouter $router) {        
        $router->get('/user/{id}', 'SupportTest\Api\Controllers\UserRequestController:get')->
        add(function($request, $response, callable $next) {
            $params = $request->getParams();

            return $next($request, $response, $params);
        });
    }
}
