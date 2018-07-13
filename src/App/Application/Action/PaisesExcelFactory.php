<?php

declare(strict_types=1);

namespace App\Application\Action;

use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class PaisesExcelFactory
{
    public function __invoke(ContainerInterface $container) : PaisesExcel
    {
        $renderer = $container->get(TemplateRendererInterface::class);
        $xls = $container->get(Xls::class);
        return new PaisesExcel($renderer, $xls);
    }
}
