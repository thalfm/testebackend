<?php

declare(strict_types=1);

namespace App\Application\Action;

use App\Domain\Service\DataInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class ListaPaises implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;
    /**
     * @var \App\Domain\Service\DataInterface
     */
    private $clientData;

    public function __construct(TemplateRendererInterface $renderer, DataInterface $clientData)
    {
        $this->renderer = $renderer;
        $this->clientData = $clientData;
    }

    /**
     * {@inheritDoc}
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $data = $this->clientData->get();
        return new HtmlResponse($this->renderer->render(
            'app::lista-paises',
            ['data' => $data] // parameters to pass to template
        ));
    }
}
