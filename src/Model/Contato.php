<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'contatos')]
class Contato {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private bool $tipo;

    #[ORM\Column(length: 255)]
    private string $descricao;

    #[ORM\ManyToOne(targetEntity: Pessoa::class)]
    #[ORM\JoinColumn(
        name: 'idPessoa',
        referencedColumnName: 'id', 
        nullable: false,
        onDelete: 'CASCADE',
    )]
    private Pessoa $pessoa;

    public function getId() {
        return $this->id;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getPessoa() {
        return $this->pessoa;
    }

    public function setTipo(bool $tipo) {
        $this->tipo = $tipo;
    }

    public function setDescricao(string $descricao) {
        $this->descricao = $descricao;
    }

    public function setPessoa(Pessoa $pessoa) {
        $this->pessoa = $pessoa;
    }
}