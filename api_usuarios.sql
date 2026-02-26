CREATE TABLE `api_usuarios` (
  `uuid` VARCHAR(36) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,	
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `endereco` TEXT NOT NULL,
  `estado` VARCHAR(2) NOT NULL,
  `data_nascimento` DATE NOT NULL,
  `criado_em` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`uuid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
