<?php
namespace SupportTest\Api\Routes;

class ApiRouter extends Slim\App
{
    public function __construct()
    {
        parent::__construct([
            'settings' => [
                'displayErrorDetails' => true
            ]
        ]);
   }

    public function registerRoute(AbstractRoute $resource)
    {
        $resource->configure($this);
    }

    public function configureGlobalAuthentication()
    {
        $this->add(function (Request $request, Response $response, callable $next)
        {
            $secureToken = $request->getHeader('Authorization');

            $fullUri = $request->getUri();
            $uri = $request->getUri()->getPath();
            $method = $request->getMethod();
            
            if (!empty($secureToken))
            {
                $tokens = explode(' ', $secureToken);

                if ($tokens[0] === 'bearer' && $tokens[1] === 'testme123')
                {
                    //Do something
                }
                else
                {
                    return $response->withStatus(401);
                }
            }
            else
            {
                return $response->withStatus(401);
            }
        });
    }
}
