<?php

declare(strict_types=1);

use App\Domain\Service\DataInterface;
use App\Infrastructure\Service\PaisesDataFactory;
use App\Infrastructure\Service\Http\Client\GuzzleFactory;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'aliases' to alias a service name to another service. The
        // key is the alias name, the value is the service to which it points.
        'aliases' => [
            // Fully\Qualified\ClassOrInterfaceName::class => Fully\Qualified\ClassName::class,
        ],
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories'  => [
            GuzzleHttp\Client::class => GuzzleFactory::class,
            DataInterface::class => PaisesDataFactory::class,
            PhpOffice\PhpSpreadsheet\Spreadsheet::class => App\Infrastructure\Service\Spreadsheet\SpreadsheetFactory::class,
            PhpOffice\PhpSpreadsheet\Writer\Xls::class =>  App\Infrastructure\Service\File\Writer\ExcelFactory::class,
            PhpOffice\PhpSpreadsheet\Writer\Csv::class =>  App\Infrastructure\Service\File\Writer\CsvFactory::class,

        ],
    ],
];
