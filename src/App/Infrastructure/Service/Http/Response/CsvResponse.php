<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 13/07/2018
 * Time: 11:21
 */

namespace App\Infrastructure\Service\Http\Response;


use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Zend\Diactoros\Response;
use Zend\Diactoros\Stream;

class CsvResponse extends Response
{
    public function __construct(Csv $csv, $status = 202, array $headers = [])
    {
        $headers = [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment;filename="teste.csv"',
            'Cache-Control' => 'max-age=0'
        ];

        ob_start();
        $csv->save('php://output');
        $body = new Stream('php://temp', 'wb+');
        $body->write(ob_get_clean());
        parent::__construct($body, $status, $headers);

    }
}