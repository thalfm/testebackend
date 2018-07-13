<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 12/07/2018
 * Time: 16:43
 */

namespace App\Infrastructure\Service;


use App\Domain\Entity\Paises;
use App\Domain\Service\DataInterface;
use Exception;
use GuzzleHttp\Client;
use RuntimeException;
use SplFileObject;

class PaisesData implements DataInterface
{

    /**
     * @var Client
     */
    private $client;

    const NOME_ARQUIVO =  './data/cache/lista.txt';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Paises[]|array
     */
    public function get()
    {
        try{
            $response = $this->client->get('http://www.umass.edu/microbio/rasmol/country-.txt');
            $this->createFile($response->getBody()->getContents());
        } catch (Exception $e) {

        }

        return $this->normalizeData();
    }

    /**
     * @param string $content
     */
    private function createFile(string $content): void
    {
        file_put_contents(self::NOME_ARQUIVO, $content);
    }

    /**
     * @return Paises[]|array
     * @throws Exception
     */
    private function normalizeData()
    {
        try {
            $file = $this->getFile();
            $fileInArray = $this->fileToArray($file);
            $dataInOrder = $this->orderData($fileInArray);
            $listPaises = $this->populate($dataInOrder);
        } catch (RuntimeException $e) {
            throw new Exception('Arquivo não encontrado!');
        }

        return $listPaises;
    }

    /**
     * @return SplFileObject
     */
    private function getFile(): SplFileObject
    {
        return new SplFileObject(self::NOME_ARQUIVO);
    }

    /**
     * @param SplFileObject $fileObject
     * @return array
     */
    private function fileToArray(SplFileObject $fileObject): array
    {
        $dados = [];
        foreach ($fileObject as $line_num => $line) {
            if ($line_num < 3 || $line == '') {
                continue;
            }
            $dados[] = explode("   ", $line);
        }

        array_pop($dados);

        return $dados;
    }

    /**
     * @param array $dados
     * @return array
     */
    private function orderData(array $dados): array
    {
        usort($dados, function ($a, $b) {
            return $b <=> $a;
        });
        return $dados;
    }

    /**
     * @param array $dados
     * @return Paises[]
     */
    private function populate(array $dados): array
    {
        $list = [];
        foreach ($dados as $data) {
            $list[] = new Paises($data[0], trim($data[1], PHP_EOL));
        }

        return $list;
    }

}