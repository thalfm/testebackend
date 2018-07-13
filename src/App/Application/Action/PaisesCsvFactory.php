<?php

declare(strict_types=1);

namespace App\Application\Action;

use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class PaisesCsvFactory
{
    public function __invoke(ContainerInterface $container) : PaisesCsv
    {
        $renderer = $container->get(TemplateRendererInterface::class);
        $csv = $container->get(Csv::class);
        return new PaisesCsv($renderer, $csv);
    }
}
