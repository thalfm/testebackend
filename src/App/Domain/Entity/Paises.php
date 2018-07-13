<?php
/**
 * Created by PhpStorm.
 * User: thalesmartins
 * Date: 12/07/2018
 * Time: 15:41
 */

namespace App\Domain\Entity;


class Paises
{

    /**
     * @var string
     */
    private $uf;
    /**
     * @var string
     */
    private $nome;

    public function __construct(string $uf, string $nome)
    {
        $this->uf = $uf;
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getUf(): string
    {
        return $this->uf;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }
}