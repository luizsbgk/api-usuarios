<?php

require 'db.php';
require 'functions.php';

header('Content-Type: application/json');

$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'POST':
    
        $dados = file_get_contents("php://input");
        $dados_array = json_decode($dados, true);

        
        $erros = validarDados($dados_array);

        if (!empty($erros)) {
            
            http_response_code(400);
            echo json_encode(['erros' => $erros]);
            exit();
        }

        
        $email = $dados_array['email'];
        $stmt_check = $conn->prepare("SELECT COUNT(*) FROM api_usuarios WHERE email = ?");
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->bind_result($count);
        $stmt_check->fetch();
        $stmt_check->close();

        if ($count > 0) {
            
            http_response_code(409);
            echo json_encode(['erro' => 'Email já cadastrado. O cliente já existe']);
            exit();
        }

        
        $uuid = gerarUuid();
        $senha_hash = password_hash($dados_array['senha'], PASSWORD_DEFAULT);

        
        $sql = "INSERT INTO api_usuarios (uuid, nome, email, senha, telefone, endereco, estado, data_nascimento) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss",
            $uuid,
            $dados_array['nome'],
            $dados_array['email'],
            $senha_hash,
            $dados_array['telefone'],
            $dados_array['endereco'],
            $dados_array['estado'],
            $dados_array['data_nascimento']
        );

        if ($stmt->execute()) {
            
            http_response_code(201);
            echo json_encode([
                'mensagem' => 'Cliente cadastrado com sucesso',
                'cliente' => [
                    'uuid' => $uuid,
                    'nome' => $dados_array['nome'],
                    'email' => $dados_array['email'],
                    'telefone' => $dados_array['telefone'],
                    'endereco' => $dados_array['endereco'],
                    'estado' => $dados_array['estado'],
                    'data_nascimento' => $dados_array['data_nascimento'],
                    'criado_em' => date('Y-m-d H:i:s')
                ]
            ]);
        } else {
            
            http_response_code(500);
            echo json_encode(['erro' => 'Erro ao cadastrar cliente: ' . $stmt->error]);
        }
        $stmt->close();
        break;

    case 'DELETE':
        
        echo json_encode(['mensagem' => 'Endpoint DELETE - Lógica a ser implementada']);
        break;

    default:
        
        http_response_code(405);
        echo json_encode(['erro' => 'Método não permitido.']);
        break;
}

$conn->close();

