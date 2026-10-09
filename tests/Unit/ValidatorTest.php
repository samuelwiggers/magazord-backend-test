<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Service\Validator;

class ValidatorTest extends TestCase {
    public function testNomeObrigatorio() {
        $resultado = Validator::pessoa('', '12345678901');

        $this->assertEquals(
            'O nome é obrigatório.',
            $resultado['erro']
        );
    }

    public function testCpfComMenosDeOnzeDigitos() {
        $resultado = Validator::pessoa('Samuel', '123');

        $this->assertEquals(
            'O CPF deve conter 11 dígitos.',
            $resultado['erro']
        );
    }

    public function testPessoaValida() {
        $resultado = Validator::pessoa(
            'Samuel',
            '123.456.789-01'
        );

        $this->assertEquals('Samuel', $resultado['nome']);
        $this->assertEquals('12345678901', $resultado['cpf']);
    }

    public function testEmailInvalido() {
        $resultado = Validator::contato('1', 'email-invalido');

        $this->assertEquals(
            'E-mail inválido.',
            $resultado['erro']
        );
    }

    public function testEmailValido() {
        $resultado = Validator::contato(
            '1',
            'samuel@email.com'
        );

        $this->assertTrue($resultado['tipo']);
        $this->assertEquals(
            'samuel@email.com',
            $resultado['descricao']
        );
    }

    public function testTelefoneInvalido() {
        $resultado = Validator::contato('0', '123');

        $this->assertEquals(
            'Telefone inválido.',
            $resultado['erro']
        );
    }

    public function testTelefoneValido() {
        $resultado = Validator::contato(
            '0',
            '(47) 99999-9999'
        );

        $this->assertFalse($resultado['tipo']);
        $this->assertEquals(
            '47999999999',
            $resultado['descricao']
        );
    }
}