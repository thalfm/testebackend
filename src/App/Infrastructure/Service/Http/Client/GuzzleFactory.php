<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 12/07/2018
 * Time: 15:54
 */

namespace App\Infrastructure\Service\Http\Client;


use GuzzleHttp\Client;
use Psr\Container\ContainerInterface;

class GuzzleFactory
{
    public function __invoke(ContainerInterface $container): Client
    {
        return new Client();
    }

}