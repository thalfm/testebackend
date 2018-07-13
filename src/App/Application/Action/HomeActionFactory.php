<?php

declare(strict_types=1);

namespace App\Application\Action;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomeActionFactory
{
    public function __invoke(ContainerInterface $container) : HomeAction
    {
        return new HomeAction($container->get(TemplateRendererInterface::class));
    }
}
