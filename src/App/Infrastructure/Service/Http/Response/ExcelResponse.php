<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 13/07/2018
 * Time: 11:48
 */

namespace App\Infrastructure\Service\Http\Response;


use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Zend\Diactoros\Response;
use Zend\Diactoros\Stream;

class ExcelResponse extends Response
{
    public function __construct(Xls $csv, $status = 202, array $headers = [])
    {
        $headers = [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment;filename="teste.xls"',
            'Cache-Control' => 'max-age=0'
        ];

        ob_start();
        $csv->save('php://output');
        $body = new Stream('php://temp', 'wb+');
        $body->write(ob_get_clean());
        parent::__construct($body, $status, $headers);

    }
}