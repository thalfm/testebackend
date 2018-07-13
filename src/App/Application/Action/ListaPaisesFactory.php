<?php

declare(strict_types=1);

namespace App\Application\Action;

use App\Domain\Service\DataInterface;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ListaPaisesFactory
{
    public function __invoke(ContainerInterface $container) : ListaPaises
    {
        $renderer = $container->get(TemplateRendererInterface::class);
        $clientData = $container->get(DataInterface::class);
        return new ListaPaises($renderer, $clientData);
    }
}
