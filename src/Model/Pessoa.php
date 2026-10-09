<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'pessoas')]
class Pessoa {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 250)]
    private string $nome;

    #[ORM\Column(length: 11, unique: true)]
    private string $cpf;

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setNome(string $nome) {
        $this->nome = $nome;
    }

    public function setCpf(string $cpf) {
        $this->cpf = $cpf;
    }
}