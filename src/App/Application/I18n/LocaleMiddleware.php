<?php

declare(strict_types=1);

namespace App\Application\I18n;

use \Locale;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Helper\UrlHelper;

class LocaleMiddleware implements MiddlewareInterface
{
    private $helper;

    public function __construct(UrlHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * {@inheritDoc}
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $uri = $request->getUri();

        $path = $uri->getPath();

        if (! preg_match('#^/(?P<locale>[a-z]{2,3}([-_][a-zA-Z]{2}|))/#', $path, $matches)) {
            Locale::setDefault('pt-BR');
            return $handler->handle($request);
        }

        $locale = $matches['locale'];
        Locale::setDefault(Locale::canonicalize($locale));
        $this->helper->setBasePath($locale);

        return $handler->handle($request->withUri(
            $uri->withPath(substr($path, 3))
        ));
    }
}
