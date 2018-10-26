<?php
namespace SupportTest\db;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Database {
    private static $entityManager;
    
    public function __construct()
    {
        $paths = array(__DIR__."/models");
        $isDevMode = true;

        $connectionOptions = array(
            'driver' => 'pdo_mysql',
            'host' => 'supportengineer.caoogqa5fxjw.us-west-2.rds.amazonaws.com',
            'dbname' => 'test',
            'user' => 'admin',
            'password' => 'testpassword123'
        );

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, '/tmp');

        self::$entityManager = EntityManager::create($connectionOptions, $config);              
    }
    
    public function getEntityManage()
    {
        return self::$entityManager;
    }

}
