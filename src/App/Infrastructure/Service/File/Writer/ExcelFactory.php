<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 13/07/2018
 * Time: 11:42
 */

namespace App\Infrastructure\Service\File\Writer;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer;
use Psr\Container\ContainerInterface;

class ExcelFactory
{
    public function __invoke(ContainerInterface $container): Writer\Xls
    {
        $spreadsheet = $container->get(Spreadsheet::class);

        $xls = new Writer\Xls($spreadsheet);
        return $xls;
    }
}