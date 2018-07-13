<?php

declare(strict_types=1);

namespace App\Application\Action;

use App\Infrastructure\Service\Http\Response\ExcelResponse;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class PaisesExcel implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;
    /**
     * @var Xls
     */
    private $xls;

    public function __construct(TemplateRendererInterface $renderer, Xls $xls)
    {
        $this->renderer = $renderer;
        $this->xls = $xls;
    }

    /**
     * {@inheritDoc}
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        return new ExcelResponse($this->xls);
    }
}
