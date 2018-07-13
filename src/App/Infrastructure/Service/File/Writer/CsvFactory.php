<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 13/07/2018
 * Time: 08:56
 */

namespace App\Infrastructure\Service\File\Writer;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer;
use Psr\Container\ContainerInterface;

class CsvFactory
{
    public function __invoke(ContainerInterface $container): Writer\Csv
    {
        $spreadsheet = $container->get(Spreadsheet::class);

        $csv = new Writer\Csv($spreadsheet);
        return $csv;
    }
}