<?php 
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__ . '/../vendor/autoload.php';

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/../app/models'],
    isDevMode: true,
);

$conn = [
    'driver'   => env('DB_DRIVER'),
    'port'     => env('DB_PORT'),
    'host'     => env('DB_HOST'),
    'user'     => env('DB_USERNAME'), 
    'password' => env('DB_PASSWORD'),
    'dbname'   => env('DB_DATABASE'),
    'charset'  => 'utf8mb4'
];

$connection = DriverManager::getConnection($conn, $config);

$entityManager = new EntityManager($connection, $config);
