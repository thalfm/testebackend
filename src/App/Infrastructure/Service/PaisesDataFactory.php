<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 12/07/2018
 * Time: 16:44
 */

namespace App\Infrastructure\Service;


use GuzzleHttp\Client;
use Psr\Container\ContainerInterface;

class PaisesDataFactory
{
    public function __invoke(ContainerInterface $container): PaisesData
    {
        /** @var Client $client */
        $client = $container->get(Client::class);
        return new PaisesData($client);
    }
}