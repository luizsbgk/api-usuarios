<?php



function validarDados($data) {
    $erros = [];
    
    if (empty($data['nome'])) {
        $erros[] = "O campo 'nome' é obrigatório.";
    }

    if (empty($data['email'])) {
        $erros[] = "O campo 'email' é obrigatório.";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $erros[] = "O campo 'email' é inválido.";
    }

    
    if (empty($data['senha'])) {
        $erros[] = "O campo 'senha' é obrigatório.";
    } else {
        // Pelo menos 8 caracteres, 1 maiúscula, 1 minúscula, 1 número e 1 caractere especial
        if (strlen($data['senha']) < 8) {
            $erros[] = "A senha deve ter no mínimo 8 caracteres.";
        }
        if (!preg_match('/[A-Z]/', $data['senha'])) {
            $erros[] = "A senha deve conter pelo menos uma letra maiúscula.";
        }
        if (!preg_match('/[a-z]/', $data['senha'])) {
            $erros[] = "A senha deve conter pelo menos uma letra minúscula.";
        }
        if (!preg_match('/[0-9]/', $data['senha'])) {
            $erros[] = "A senha deve conter pelo menos um número.";
        }
        if (!preg_match('/[^A-Za-z0-9]/', $data['senha'])) {
            $erros[] = "A senha deve conter pelo menos um caractere especial.";
        }
    }

    if (empty($data['telefone'])) {
        $erros[] = "O campo 'telefone' é obrigatório.";
    } elseif (!preg_match('/^\d{10,11}$/', $data['telefone'])) {
        $erros[] = "O telefone deve conter 10 ou 11 dígitos, apenas números.";
    }

    if (empty($data['endereco'])) {
        $erros[] = "O campo 'endereco' é obrigatório.";
    }

    if (empty($data['estado'])) {
        $erros[] = "O campo 'estado' é obrigatório.";
    }

    if (empty($data['data_nascimento'])) {
        $erros[] = "O campo 'data_nascimento' é obrigatório.";
    }

    return $erros;
}

function gerarUuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}
