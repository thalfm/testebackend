<?php

declare(strict_types=1);

namespace App\Application\I18n;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;

class LocaleMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : LocaleMiddleware
    {
        return new LocaleMiddleware($container->get(UrlHelper::class));
    }
}
