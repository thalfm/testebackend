<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 13/07/2018
 * Time: 12:18
 */

namespace AppTest\Infrastructure\Service;


use App\Infrastructure\Service\PaisesData;
use App\Infrastructure\Service\PaisesDataFactory;
use function getcwd;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;

class PaisesDataTest extends TestCase
{
    /** @var ContainerInterface|ObjectProphecy */
    protected $container;

    protected function setUp()
    {
        $dir =  dirname(__DIR__) . '/../../../';
        chdir($dir);
        $this->container = $this->prophesize(ContainerInterface::class);
        $client = $this->prophesize(Client::class);

        $this->container->get(Client::class)->willReturn($client);
    }

    public function testFactoryPaisesData()
    {
        $factory = new PaisesDataFactory();
        $paisesData = $factory($this->container->reveal());
        $this->assertInstanceOf(PaisesData::class, $paisesData);
    }

    public function testGetDataPaisesData()
    {
        $paisesData = new PaisesData(new Client());
        $data = $paisesData->get();
        $this->assertNotEmpty($data);
    }
}