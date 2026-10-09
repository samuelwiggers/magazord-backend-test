<?php

namespace App\Service;

class Validator {
    public static function pessoa(string $nome, string $cpf) {
        $nome = trim($nome);
        $cpf = preg_replace('/\D/', '', $cpf);

        if ($nome === '') {
            return ['erro' => 'O nome é obrigatório.'];
        }

        if (strlen($cpf) !== 11) {
            return ['erro' => 'O CPF deve conter 11 dígitos.'];
        }

        return [
            'nome' => $nome,
            'cpf' => $cpf,
        ];
    }

    public static function contato(string $tipo, string $descricao) {
        $descricao = trim($descricao);

        if (!in_array($tipo, ['0', '1'], true)) {
            return ['erro' => 'Tipo de contato inválido.'];
        }

        if ($descricao === '') {
            return ['erro' => 'A descrição é obrigatória.'];
        }

        if ($tipo === '1' && !filter_var($descricao, FILTER_VALIDATE_EMAIL)) {
            return ['erro' => 'E-mail inválido.'];
        }

        if ($tipo === '0') {
            $telefone = preg_replace('/\D/', '', $descricao);

            if (!in_array(strlen($telefone), [10, 11], true)) {
                return ['erro' => 'Telefone inválido.'];
            }

            $descricao = $telefone;
        }

        return [
            'tipo' => (bool) $tipo,
            'descricao' => $descricao,
        ];
    }
}