<?php

declare(strict_types=1);

namespace App\Application\Action;

use App\Domain\Service\DataInterface;
use App\Infrastructure\Service\Http\Response\CsvResponse;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\EmptyResponse;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\Uri;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class PaisesCsv implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /**
     * @var Csv
     */
    private $csv;


    public function __construct(TemplateRendererInterface $renderer, Csv $csv)
    {
        $this->renderer = $renderer;
        $this->csv = $csv;
    }

    /**
     * {@inheritDoc}
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        return new CsvResponse($this->csv);
    }
}
