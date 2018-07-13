<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 13/07/2018
 * Time: 09:34
 */

namespace App\Infrastructure\Service\Spreadsheet;


use App\Domain\Entity\Paises;
use App\Domain\Service\DataInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Psr\Container\ContainerInterface;

class SpreadsheetFactory
{
    public function __invoke(ContainerInterface $container): Spreadsheet
    {
        $clientData = $container->get(DataInterface::class);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'UF');
        $sheet->setCellValue('B1', 'Nome');

        $this->createSheet($clientData, $sheet);

        return $spreadsheet;
    }

    private function createSheet(DataInterface $data, Worksheet $sheet)
    {
        $paisesList = $data->get();

        /**
         * @var int $i
         * @var Paises $paises
         */
        foreach ($paisesList as $i => $paises) {
            $numCell = 2 + $i;
            $sheet->setCellValue("A$numCell", $paises->getUf());
            $sheet->setCellValue("B$numCell", $paises->getNome());
        }
    }
}