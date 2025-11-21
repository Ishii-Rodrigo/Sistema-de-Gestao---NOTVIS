-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/11/2025 às 16:47
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `laravel`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf_cnpj` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `telefone_celular` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `cpf_cnpj`, `telefone`, `telefone_celular`, `email`, `data_nascimento`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `complemento`, `created_at`, `updated_at`) VALUES
(5, 'Rodrigo Toshihide Ishii', '254.789.563-14', '(44) 3631-2377', '(44) 99941-1676', 'mtrodrigo@hotmail.com', '1985-05-20', '87254-154', 'Rua Ladeira Baixa', '325', 'Centro', 'Cianorte', 'PR', 'Apto 609', '2025-11-19 18:13:31', '2025-11-21 20:14:48'),
(6, 'Domingos Toshihide Ishii', '254.789.654-12', '(44) 3629-1458', '(44) 99977-2547', 'teste1@teste.com', '1959-02-02', '87211-458', 'Rua Do Beco', '2', 'Zona 02', 'Cianorte', 'PR', NULL, '2025-11-19 18:41:58', '2025-11-19 18:41:58'),
(7, 'João Silva', '111.111.111-11', NULL, '(44) 98765-4321', 'joao.silva@teste.com', '1980-05-15', '87000-001', 'Rua A', '100', 'Centro', 'Maringá', 'PR', NULL, '2024-01-05 13:00:00', '2024-01-05 13:00:00'),
(8, 'Maria Santos', '222.222.222-22', NULL, '(44) 98765-4322', 'maria.santos@teste.com', '1995-08-20', '87000-002', 'Rua B', '250', 'Zona 07', 'Maringá', 'PR', NULL, '2024-01-10 14:00:00', '2024-01-10 14:00:00'),
(9, 'Pedro Oliveira', '333.333.333-33', NULL, '(44) 98765-4323', 'pedro.oliver@teste.com', '1975-01-01', '87200-000', 'Av. Principal', '500', 'Industrial', 'Cianorte', 'PR', NULL, '2024-01-15 15:00:00', '2024-01-15 15:00:00'),
(10, 'Ana Costa', '444.444.444-44', NULL, '(44) 98765-4324', 'ana.costa@teste.com.br', '2000-11-25', '87200-100', 'Rua Secundária', '120', 'Centro', 'Cianorte', 'PR', NULL, '2024-01-20 16:00:00', '2025-11-21 16:40:43'),
(11, 'Carlos Pereira', '555.555.555-55', NULL, '(44) 98765-4325', 'carlos.per@teste.com', '1968-03-10', '87300-000', 'Rua C', '300', 'Jardim', 'Campo Mourão', 'PR', NULL, '2024-01-25 17:00:00', '2024-01-25 17:00:00'),
(12, 'Juliana Lima', '666.666.666-66', NULL, '(44) 98765-4326', 'juliana.lima@teste.com', '1990-09-30', '87300-100', 'Av. Teste', '450', 'Zona 01', 'Campo Mourão', 'PR', NULL, '2024-01-30 18:00:00', '2024-01-30 18:00:00'),
(13, 'Roberto Almeida', '777.777.777-77', NULL, '(44) 98765-4327', 'roberto.alm@teste.com', '1983-07-07', '87500-000', 'Rua D', '600', 'Morada do Sol', 'Umuarama', 'PR', NULL, '2024-02-05 19:00:00', '2024-02-05 19:00:00'),
(14, 'Lucia Mendes', '888.888.888-88', NULL, '(44) 98765-4328', 'lucia.men@teste.com', '1970-04-12', '87500-100', 'Rua E', '750', 'Alto Paraná', 'Umuarama', 'PR', NULL, '2024-02-10 20:00:00', '2024-02-10 20:00:00'),
(15, 'Fernando Rocha', '999.999.999-99', NULL, '(44) 98765-4329', 'fernando.rocha@teste.com', '1988-02-29', '87500-200', 'Rua F', '900', 'Centro', 'Umuarama', 'PR', NULL, '2024-02-15 21:00:00', '2024-02-15 21:00:00'),
(16, 'Gabriela Barros', '101.101.101-01', NULL, '(44) 98765-4330', 'gabriela.barros@teste.com', '1998-12-05', '87000-003', 'Rua G', '150', 'Zona 03', 'Maringá', 'PR', NULL, '2024-02-20 12:00:00', '2024-02-20 12:00:00'),
(17, 'Henrique Ferreira', '111.222.333-44', NULL, '(44) 98765-4331', 'henrique.ferreira@teste.com', '1972-06-18', '87200-200', 'Av. João Pessoa', '220', 'Jardim Alvorada', 'Cianorte', 'PR', NULL, '2024-02-25 13:00:00', '2024-02-25 13:00:00'),
(18, 'Isabela Gomes', '121.314.151-61', NULL, '(44) 98765-4332', 'isabela.gomes@teste.com', '1993-10-02', '87200-300', 'Rua Curitiba', '380', 'Centro', 'Cianorte', 'PR', NULL, '2024-03-01 14:00:00', '2024-03-01 14:00:00'),
(19, 'Diogo Souza', '131.415.161-71', NULL, '(44) 98765-4333', 'diogo.souza@teste.com', '1986-01-20', '87300-200', 'Rua São Paulo', '510', 'Jardim Alegre', 'Campo Mourão', 'PR', NULL, '2024-03-05 15:00:00', '2024-03-05 15:00:00'),
(20, 'Laura Martins', '141.516.171-81', NULL, '(44) 98765-4334', 'laura.martins@teste.com', '2002-07-14', '87300-300', 'Rua Rio Grande', '640', 'Vila Nova', 'Campo Mourão', 'PR', NULL, '2024-03-10 16:00:00', '2024-03-10 16:00:00'),
(21, 'Marcelo Ribeiro', '151.617.181-91', NULL, '(44) 98765-4335', 'marcelo.ribeiro@teste.com', '1978-04-28', '87500-300', 'Av. Brasil', '780', 'Centro', 'Umuarama', 'PR', NULL, '2024-03-15 17:00:00', '2024-03-15 17:00:00'),
(22, 'Natalia Alves', '161.718.191-01', NULL, '(44) 98765-4336', 'natalia.alves@teste.com', '1991-03-08', '87000-004', 'Rua Londrina', '910', 'Zona 04', 'Maringá', 'PR', NULL, '2024-03-20 18:00:00', '2024-03-20 18:00:00'),
(23, 'Otávio Santos', '171.819.101-11', NULL, '(44) 98765-4337', 'otavio.santos@teste.com', '1965-12-03', '87200-400', 'Rua Paraná', '105', 'Vila Operária', 'Cianorte', 'PR', NULL, '2024-03-25 19:00:00', '2024-03-25 19:00:00'),
(24, 'Patrícia Moura', '181.910.111-21', NULL, '(44) 98765-4338', 'patricia.moura@teste.com', '1989-08-17', '87300-400', 'Rua Mato Grosso', '235', 'Centro', 'Campo Mourão', 'PR', NULL, '2024-03-30 20:00:00', '2024-03-30 20:00:00'),
(25, 'Quirino Lima', '191.011.121-31', NULL, '(44) 98765-4339', 'quirino.lima@teste.com', '1974-02-09', '87500-400', 'Rua Goias', '365', 'Parque Industrial', 'Umuarama', 'PR', NULL, '2024-04-05 21:00:00', '2024-04-05 21:00:00'),
(26, 'Renata Mendes', '201.213.141-51', NULL, '(44) 98765-4340', 'renata.mendes@teste.com', '1997-06-01', '87000-005', 'Av. São Paulo', '495', 'Zona 05', 'Maringá', 'PR', NULL, '2024-04-10 12:00:00', '2024-04-10 12:00:00'),
(27, 'Victor Hugo', '212.314.151-61', NULL, '(44) 98765-4341', 'victor.hugo@teste.com', '1990-05-10', '87200-500', 'Rua Bahia', '405', 'Jardim Universitário', 'Cianorte', 'PR', NULL, '2024-04-15 16:00:00', '2024-04-15 16:00:00'),
(28, 'Sofia Souza', '222.425.161-71', NULL, '(44) 98765-4342', 'sofia.souza@teste.com', '1982-11-03', '87300-500', 'Av. Paraná', '115', 'Centro', 'Campo Mourão', 'PR', 'Sala 2', '2024-04-20 17:00:00', '2024-04-20 17:00:00'),
(29, 'Thiago Rocha', '232.526.171-81', NULL, '(44) 98765-4343', 'thiago.rocha@teste.com', '1977-08-28', '87500-500', 'Rua Tocantins', '820', 'Jardim Panorama', 'Umuarama', 'PR', NULL, '2024-04-25 18:00:00', '2024-04-25 18:00:00'),
(30, 'Elisa Pereira', '242.627.181-91', NULL, '(44) 98765-4344', 'elisa.pereira@teste.com', '2001-01-19', '87000-006', 'Rua Ceará', '270', 'Zona 06', 'Maringá', 'PR', NULL, '2024-04-30 19:00:00', '2024-04-30 19:00:00'),
(52, 'Vitória Santos', '311.121.131-22', NULL, '(51) 98765-1052', 'vitoria.santos@exemplo.com', '1971-08-11', '90000-022', 'Rua dos Andradas', '1200', 'Centro', 'Porto Alegre', 'RS', NULL, '2024-05-01 21:30:00', '2024-05-01 21:30:00'),
(53, 'Ricardo Oliveira', '311.121.131-23', NULL, '(43) 98765-1053', 'ricardo.oliveira@exemplo.com', '2002-02-09', '86000-023', 'Av. Saul Elkind', '300', 'Cinco Conjuntos', 'Londrina', 'PR', 'Casa C', '2024-05-02 11:00:00', '2024-05-02 11:00:00'),
(54, 'Leticia Souza', '311.121.131-24', NULL, '(19) 98765-1054', 'leticia.souza@exemplo.com', '1994-04-01', '13000-024', 'Av. Aquidabã', '700', 'Centro', 'Campinas', 'SP', NULL, '2024-05-02 11:30:00', '2024-05-02 11:30:00'),
(55, 'Paulo Pereira', '311.121.131-25', NULL, '(41) 98765-1055', 'paulo.pereira@exemplo.com', '1967-10-13', '80000-025', 'Rua Chile', '80', 'Rebouças', 'Curitiba', 'PR', NULL, '2024-05-02 12:00:00', '2024-05-02 12:00:00'),
(56, 'Giovana Almeida', '311.121.131-26', NULL, '(11) 98765-1056', 'giovana.almeida@exemplo.com', '1988-11-06', '01000-026', 'Rua Líbero Badaró', '40', 'Centro', 'São Paulo', 'SP', 'Sala 20', '2024-05-02 12:30:00', '2024-05-02 12:30:00'),
(57, 'Antônio Carvalho', '311.121.131-27', NULL, '(21) 98765-1057', 'antonio.carvalho@exemplo.com', '2005-01-28', '20000-027', 'Rua da Assembleia', '87', 'Centro', 'Rio de Janeiro', 'RJ', NULL, '2024-05-02 13:00:00', '2024-05-02 13:00:00'),
(58, 'Clara Rodrigues', '311.121.131-28', NULL, '(31) 98765-1058', 'clara.rodrigues@exemplo.com', '1974-06-24', '30000-028', 'Av. Do Contorno', '3000', 'Savassi', 'Belo Horizonte', 'MG', NULL, '2024-05-02 13:30:00', '2024-05-02 13:30:00'),
(59, 'Bruno Gomes', '311.121.131-29', NULL, '(71) 98765-1059', 'bruno.gomes@exemplo.com', '1991-03-16', '40000-029', 'Rua Conselheiro Saraiva', '20', 'Comércio', 'Salvador', 'BA', 'Ap 202', '2024-05-02 14:00:00', '2024-05-02 14:00:00'),
(60, 'Larissa Martins', '311.121.131-30', NULL, '(51) 98765-1060', 'larissa.martins@exemplo.com', '1986-07-07', '90000-030', 'Av. Protásio Alves', '150', 'Independência', 'Porto Alegre', 'RS', NULL, '2024-05-02 14:30:00', '2024-05-02 14:30:00'),
(61, 'Caio Lima', '311.121.131-31', NULL, '(43) 98765-1061', 'caio.lima@exemplo.com', '1978-09-19', '86000-031', 'Rua Sergipe', '100', 'Centro', 'Londrina', 'PR', NULL, '2024-05-02 15:00:00', '2024-05-02 15:00:00'),
(62, 'Juliana Ferreira', '311.121.131-32', NULL, '(19) 98765-1062', 'juliana.ferreira@exemplo.com', '1997-12-05', '13000-032', 'Av. Júlio de Mesquita', '200', 'Cambuí', 'Campinas', 'SP', 'Loja A', '2024-05-02 15:30:00', '2024-05-02 15:30:00'),
(63, 'Daniel Ribeiro', '311.121.131-33', NULL, '(41) 98765-1063', 'daniel.ribeiro@exemplo.com', '1960-01-26', '80000-033', 'Rua Ébano Pereira', '50', 'Centro', 'Curitiba', 'PR', NULL, '2024-05-02 16:00:00', '2024-05-02 16:00:00'),
(64, 'Patrícia Costa', '311.121.131-34', NULL, '(11) 98765-1064', 'patricia.costa@exemplo.com', '1984-03-14', '01000-034', 'Rua XV de Novembro', '250', 'Centro', 'São Paulo', 'SP', 'Conj 5', '2024-05-02 16:30:00', '2024-05-02 16:30:00'),
(65, 'Diego Freitas', '311.121.131-35', NULL, '(21) 98765-1065', 'diego.freitas@exemplo.com', '1976-05-09', '20000-035', 'Rua Laranjeiras', '350', 'Laranjeiras', 'Rio de Janeiro', 'RJ', NULL, '2024-05-02 17:00:00', '2024-05-02 17:00:00'),
(66, 'Renata Barbosa', '311.121.131-36', NULL, '(31) 98765-1066', 'renata.barbosa@exemplo.com', '2004-10-31', '30000-036', 'Rua Curitiba', '1000', 'Centro', 'Belo Horizonte', 'MG', 'Casa B', '2024-05-02 17:30:00', '2024-05-02 17:30:00'),
(67, 'Enzo Pinto', '311.121.131-37', NULL, '(71) 98765-1067', 'enzo.pinto@exemplo.com', '1993-08-03', '40000-037', 'Av. Oceânica', '180', 'Ondina', 'Salvador', 'BA', NULL, '2024-05-02 18:00:00', '2024-05-02 18:00:00'),
(68, 'Sandra Mendes', '311.121.131-38', NULL, '(51) 98765-1068', 'sandra.mendes@exemplo.com', '1969-11-20', '90000-038', 'Rua 24 de Outubro', '125', 'Moinhos de Vento', 'Porto Alegre', 'RS', NULL, '2024-05-02 18:30:00', '2024-05-02 18:30:00'),
(69, 'Fábio Nascimento', '311.121.131-39', NULL, '(43) 98765-1069', 'fabio.nascimento@exemplo.com', '1981-04-29', '86000-039', 'Rua Paranaguá', '500', 'Centro', 'Londrina', 'PR', 'Sala 5', '2024-05-02 19:00:00', '2024-05-02 19:00:00'),
(70, 'Viviane Rocha', '311.121.131-40', NULL, '(19) 98765-1070', 'viviane.rocha@exemplo.com', '2000-06-16', '13000-040', 'Av. Orosimbo Maia', '600', 'Vila Itapura', 'Campinas', 'SP', NULL, '2024-05-02 19:30:00', '2024-05-02 19:30:00'),
(71, 'Lucas Santos', '311.121.131-41', NULL, '(41) 98765-1071', 'lucas.santos@exemplo.com', '1970-12-08', '80000-041', 'Rua Alferes Poli', '90', 'Centro', 'Curitiba', 'PR', NULL, '2024-05-02 20:00:00', '2024-05-02 20:00:00'),
(72, 'Maria Oliveira', '311.121.131-42', NULL, '(11) 98765-1072', 'maria.oliveira@exemplo.com', '1999-02-02', '01000-042', 'Rua da Consolação', '120', 'Consolação', 'São Paulo', 'SP', 'Ap 12', '2024-05-02 20:30:00', '2024-05-02 20:30:00'),
(73, 'Gabriel Souza', '311.121.131-43', NULL, '(21) 98765-1073', 'gabriel.souza@exemplo.com', '1987-07-27', '20000-043', 'Rua Barata Ribeiro', '400', 'Copacabana', 'Rio de Janeiro', 'RJ', NULL, '2024-05-02 21:00:00', '2024-05-02 21:00:00'),
(74, 'Ana Pereira', '311.121.131-44', NULL, '(31) 98765-1074', 'ana.pereira@exemplo.com', '1963-04-19', '30000-044', 'Rua Espírito Santo', '50', 'Centro', 'Belo Horizonte', 'MG', 'Loja', '2024-05-02 21:30:00', '2024-05-02 21:30:00'),
(75, 'Mateus Almeida', '311.121.131-45', NULL, '(71) 98765-1075', 'mateus.almeida@exemplo.com', '1995-10-10', '40000-045', 'Av. Paralela', '200', 'Patamares', 'Salvador', 'BA', NULL, '2024-05-03 11:00:00', '2024-05-03 11:00:00'),
(76, 'Laura Carvalho', '311.121.131-46', NULL, '(51) 98765-1076', 'laura.carvalho@exemplo.com', '1980-01-01', '90000-046', 'Rua Mostardeiro', '110', 'Moinhos de Vento', 'Porto Alegre', 'RS', 'Apto 44', '2024-05-03 11:30:00', '2024-05-03 11:30:00'),
(77, 'Rafael Rodrigues', '311.121.131-47', NULL, '(43) 98765-1077', 'rafael.rodrigues@exemplo.com', '2001-05-05', '86000-047', 'Av. Duque de Caxias', '150', 'Centro', 'Londrina', 'PR', NULL, '2024-05-03 12:00:00', '2024-05-03 12:00:00'),
(78, 'Isabela Gomes', '311.121.131-48', NULL, '(19) 98765-1078', 'isabela.gomes@exemplo.com', '1972-11-21', '13000-048', 'Rua Conceição', '30', 'Centro', 'Campinas', 'SP', NULL, '2024-05-03 12:30:00', '2024-05-03 12:30:00'),
(79, 'Felipe Martins', '311.121.131-49', NULL, '(41) 98765-1079', 'felipe.martins@exemplo.com', '1996-03-12', '80000-049', 'Rua Cândido Lopes', '20', 'Centro', 'Curitiba', 'PR', NULL, '2024-05-03 13:00:00', '2024-05-03 13:00:00'),
(80, 'Beatriz Lima', '311.121.131-50', NULL, '(11) 98765-1080', 'beatriz.lima@exemplo.com', '1983-09-06', '01000-050', 'Rua Haddock Lobo', '500', 'Cerqueira César', 'São Paulo', 'SP', 'Conj 3', '2024-05-03 13:30:00', '2024-05-03 13:30:00'),
(82, 'Lívia Ribeiro', '311.121.131-52', NULL, '(31) 98765-1082', 'livia.ribeiro@exemplo.com', '2004-02-18', '30000-052', 'Rua da Bahia', '10', 'Centro', 'Belo Horizonte', 'MG', NULL, '2024-05-03 14:30:00', '2024-05-03 14:30:00'),
(83, 'Thiago Costa', '311.121.131-53', NULL, '(71) 98765-1083', 'thiago.costa@exemplo.com', '1975-06-25', '40000-053', 'Rua Alfredo de Brito', '5', 'Pelourinho', 'Salvador', 'BA', NULL, '2024-05-03 15:00:00', '2024-05-03 15:00:00'),
(84, 'Helena Freitas', '311.121.131-54', NULL, '(51) 98765-1084', 'helena.freitas@exemplo.com', '1998-08-14', '90000-054', 'Av. Osvaldo Aranha', '1000', 'Bom Fim', 'Porto Alegre', 'RS', 'Casa 1', '2024-05-03 15:30:00', '2024-05-03 15:30:00'),
(85, 'Gustavo Barbosa', '311.121.131-55', NULL, '(43) 98765-1085', 'gustavo.barbosa@exemplo.com', '1965-03-07', '86000-055', 'Rua Piauí', '300', 'Centro', 'Londrina', 'PR', NULL, '2024-05-03 16:00:00', '2024-05-03 16:00:00'),
(86, 'Manuela Pinto', '311.121.131-56', NULL, '(19) 98765-1086', 'manuela.pinto@exemplo.com', '1990-10-04', '13000-056', 'Av. Dr. Moraes Salles', '150', 'Nova Campinas', 'Campinas', 'SP', 'Ap 12', '2024-05-03 16:30:00', '2024-05-03 16:30:00'),
(87, 'Eduardo Mendes', '311.121.131-57', NULL, '(41) 98765-1087', 'eduardo.mendes@exemplo.com', '1973-01-22', '80000-057', 'Rua Padre Anchieta', '200', 'Mercês', 'Curitiba', 'PR', NULL, '2024-05-03 17:00:00', '2024-05-03 17:00:00'),
(88, 'Sophia Nascimento', '311.121.131-58', NULL, '(11) 98765-1088', 'sophia.nascimento@exemplo.com', '2002-05-11', '01000-058', 'Rua Peixoto Gomide', '80', 'Jardim Paulista', 'São Paulo', 'SP', NULL, '2024-05-03 17:30:00', '2024-05-03 17:30:00'),
(89, 'Marcelo Rocha', '311.121.131-59', NULL, '(21) 98765-1089', 'marcelo.rocha@exemplo.com', '1981-11-27', '20000-059', 'Rua Senador Dantas', '55', 'Centro', 'Rio de Janeiro', 'RJ', NULL, '2024-05-03 18:00:00', '2024-05-03 18:00:00'),
(90, 'Fernanda Campos', '311.121.131-60', NULL, '(31) 98765-1090', 'fernanda.campos@exemplo.com', '1993-02-09', '30000-060', 'Av. Afonso Pena', '100', 'Centro', 'Belo Horizonte', 'MG', 'Ap 5', '2024-05-03 18:30:00', '2024-05-03 18:30:00'),
(91, 'Roberto Ferreira', '311.121.131-61', NULL, '(71) 98765-1091', 'roberto.ferreira@exemplo.com', '1970-07-30', '40000-061', 'Rua Direita', '10', 'Centro', 'Salvador', 'BA', NULL, '2024-05-03 19:00:00', '2024-05-03 19:00:00'),
(92, 'Aline Souza', '311.121.131-62', NULL, '(51) 98765-1092', 'aline.souza@exemplo.com', '2000-12-12', '90000-062', 'Av. Carlos Gomes', '50', 'Auxiliadora', 'Porto Alegre', 'RS', NULL, '2024-05-03 19:30:00', '2024-05-03 19:30:00'),
(93, 'Marcos Lima', '311.121.131-63', NULL, '(43) 98765-1093', 'marcos.lima@exemplo.com', '1985-04-03', '86000-063', 'Rua Belo Horizonte', '450', 'Vila Nova', 'Londrina', 'PR', 'Sala 10', '2024-05-03 20:00:00', '2024-05-03 20:00:00'),
(94, 'Sofia Rocha', '311.121.131-64', NULL, '(19) 98765-1094', 'sofia.rocha@exemplo.com', '1978-08-28', '13000-064', 'Av. Brasil', '900', 'Jardim Guanabara', 'Campinas', 'SP', NULL, '2024-05-03 20:30:00', '2024-05-03 20:30:00'),
(95, 'Lucas Silva', '311.121.131-65', NULL, '(41) 98765-1095', 'lucas.silva@exemplo.com', '1995-10-17', '80000-065', 'Rua Visconde de Guarapuava', '10', 'Centro', 'Curitiba', 'PR', NULL, '2024-05-03 21:00:00', '2024-05-03 21:00:00'),
(96, 'Giovana Carvalho', '311.121.131-66', NULL, '(11) 98765-1096', 'giovana.carvalho@exemplo.com', '1977-03-24', '01000-066', 'Rua Barão de Itapetininga', '150', 'República', 'São Paulo', 'SP', 'Sala 1', '2024-05-03 21:30:00', '2024-05-03 21:30:00'),
(97, 'Antônio Rodrigues', '311.121.131-67', NULL, '(21) 98765-1097', 'antonio.rodrigues@exemplo.com', '1991-06-19', '20000-067', 'Rua Siqueira Campos', '80', 'Copacabana', 'Rio de Janeiro', 'RJ', NULL, '2024-05-04 11:00:00', '2024-05-04 11:00:00'),
(98, 'Clara Gomes', '311.121.131-68', NULL, '(31) 98765-1098', 'clara.gomes@exemplo.com', '1986-11-13', '30000-068', 'Rua Tupis', '120', 'Centro', 'Belo Horizonte', 'MG', 'Casa A', '2024-05-04 11:30:00', '2024-05-04 11:30:00'),
(99, 'Bruno Martins', '311.121.131-69', NULL, '(71) 98765-1099', 'bruno.martins@exemplo.com', '1962-09-05', '40000-069', 'Largo do Pelourinho', '1', 'Pelourinho', 'Salvador', 'BA', NULL, '2024-05-04 12:00:00', '2024-05-04 12:00:00'),
(100, 'Carla Oliveira', '311.121.131-70', NULL, '(51) 98765-1100', 'carla.oliveira@exemplo.com', '2003-01-10', '90000-070', 'Rua Barão do Amazonas', '500', 'Petrópolis', 'Porto Alegre', 'RS', NULL, '2024-05-04 12:30:00', '2024-05-04 12:30:00'),
(101, 'Daniel Souza', '311.121.131-71', NULL, '(43) 98765-1101', 'daniel.souza@exemplo.com', '1979-05-25', '86000-071', 'Av. Rio Branco', '100', 'Centro', 'Londrina', 'PR', 'Ap 2', '2024-05-04 13:00:00', '2024-05-04 13:00:00'),
(102, 'Elisa Costa', '311.121.131-72', NULL, '(19) 98765-1102', 'elisa.costa@exemplo.com', '1968-10-18', '13000-072', 'Rua Bento de Arruda', '300', 'Taquaral', 'Campinas', 'SP', NULL, '2024-05-04 13:30:00', '2024-05-04 13:30:00'),
(103, 'Felipe Gomes', '311.121.131-73', NULL, '(41) 98765-1103', 'felipe.gomes@exemplo.com', '1997-03-02', '80000-073', 'Av. Sete de Setembro', '20', 'Centro', 'Curitiba', 'PR', NULL, '2024-05-04 14:00:00', '2024-05-04 14:00:00'),
(104, 'Gisele Lima', '311.121.131-74', NULL, '(11) 98765-1104', 'gisele.lima@exemplo.com', '1984-06-15', '01000-074', 'Rua Major Diogo', '50', 'Bela Vista', 'São Paulo', 'SP', 'Lote 3', '2024-05-04 14:30:00', '2024-05-04 14:30:00'),
(105, 'Hugo Martins', '311.121.131-75', NULL, '(21) 98765-1105', 'hugo.martins@exemplo.com', '2000-09-29', '20000-075', 'Rua República do Peru', '100', 'Copacabana', 'Rio de Janeiro', 'RJ', NULL, '2024-05-04 15:00:00', '2024-05-04 15:00:00'),
(106, 'Isadora Nogueira', '311.121.131-76', NULL, '(31) 98765-1106', 'isadora.nogueira@exemplo.com', '1976-12-04', '30000-076', 'Rua Curvelo', '300', 'Floresta', 'Belo Horizonte', 'MG', NULL, '2024-05-04 15:30:00', '2024-05-04 15:30:00'),
(107, 'João Pedro', '311.121.131-77', NULL, '(71) 98765-1107', 'joao.pedro@exemplo.com', '1993-03-08', '40000-077', 'Av. Tancredo Neves', '50', 'Caminho das Árvores', 'Salvador', 'BA', 'Ap 1', '2024-05-04 16:00:00', '2024-05-04 16:00:00'),
(108, 'Karina Pires', '311.121.131-78', NULL, '(51) 98765-1108', 'karina.pires@exemplo.com', '1969-07-22', '90000-078', 'Av. Farrapos', '100', 'Floresta', 'Porto Alegre', 'RS', NULL, '2024-05-04 16:30:00', '2024-05-04 16:30:00'),
(109, 'Leonardo Quintana', '311.121.131-79', NULL, '(43) 98765-1109', 'leonardo.quintana@exemplo.com', '1988-11-17', '86000-079', 'Rua Santa Catarina', '20', 'Centro', 'Londrina', 'PR', NULL, '2024-05-04 17:00:00', '2024-05-04 17:00:00'),
(110, 'Mariana Reis', '311.121.131-80', NULL, '(19) 98765-1110', 'mariana.reis@exemplo.com', '2005-01-01', '13000-080', 'Rua Barão de Jaguara', '400', 'Centro', 'Campinas', 'SP', NULL, '2024-05-04 17:30:00', '2024-05-04 17:30:00'),
(111, 'Lucas Almeida', '311.121.131-81', NULL, '(41) 98765-1111', 'lucas.almeida@exemplo.com', '1982-06-10', '80000-081', 'Rua Doutor Faivre', '400', 'Centro', 'Curitiba', 'PR', NULL, '2024-05-04 18:00:00', '2024-05-04 18:00:00'),
(112, 'Maria Batista', '311.121.131-82', NULL, '(11) 98765-1112', 'maria.batista@exemplo.com', '1966-09-04', '01000-082', 'Av. Ipiranga', '120', 'República', 'São Paulo', 'SP', NULL, '2024-05-04 18:30:00', '2024-05-04 18:30:00'),
(113, 'Gabriel Costa', '311.121.131-83', NULL, '(21) 98765-1113', 'gabriel.costa@exemplo.com', '1990-12-19', '20000-083', 'Rua Uruguaiana', '30', 'Centro', 'Rio de Janeiro', 'RJ', NULL, '2024-05-04 19:00:00', '2024-05-04 19:00:00'),
(114, 'Ana Dantas', '311.121.131-84', NULL, '(31) 98765-1114', 'ana.dantas@exemplo.com', '1971-05-23', '30000-084', 'Rua dos Inconfidentes', '650', 'Savassi', 'Belo Horizonte', 'MG', 'Ap 40', '2024-05-04 19:30:00', '2024-05-04 19:30:00'),
(115, 'Mateus Souza', '311.121.131-85', NULL, '(71) 98765-1115', 'mateus.souza@exemplo.com', '1999-08-07', '40000-085', 'Rua Ewerton Visco', '200', 'Pituba', 'Salvador', 'BA', NULL, '2024-05-04 20:00:00', '2024-05-04 20:00:00'),
(116, 'Laura Ferreira', '311.121.131-86', NULL, '(51) 98765-1116', 'laura.ferreira@exemplo.com', '1985-11-01', '90000-086', 'Rua General Salustiano', '15', 'Cidade Baixa', 'Porto Alegre', 'RS', NULL, '2024-05-04 20:30:00', '2024-05-04 20:30:00'),
(117, 'Rafael Machado', '311.121.131-87', NULL, '(43) 98765-1117', 'rafael.machado@exemplo.com', '1970-02-14', '86000-087', 'Av. Paraná', '80', 'Centro', 'Londrina', 'PR', 'Sala 8', '2024-05-04 21:00:00', '2024-05-04 21:00:00'),
(118, 'Isabela Pinto', '311.121.131-88', NULL, '(19) 98765-1118', 'isabela.pinto@exemplo.com', '2001-04-28', '13000-088', 'Rua dos Alecrins', '50', 'Jardim Flamboyant', 'Campinas', 'SP', NULL, '2024-05-04 21:30:00', '2024-05-04 21:30:00'),
(119, 'Felipe Mendes', '311.121.131-89', NULL, '(41) 98765-1119', 'felipe.mendes@exemplo.com', '1994-07-13', '80000-089', 'Rua Emiliano Perneta', '300', 'Centro', 'Curitiba', 'PR', NULL, '2024-05-05 11:00:00', '2024-05-05 11:00:00'),
(120, 'Beatriz Pires', '311.121.131-90', NULL, '(11) 98765-1120', 'beatriz.pires@exemplo.com', '1978-10-27', '01000-090', 'Rua Augusta', '1500', 'Consolação', 'São Paulo', 'SP', 'Apto 2', '2024-05-05 11:30:00', '2024-05-05 11:30:00'),
(121, 'Victor Santos', '311.121.131-91', NULL, '(21) 98765-1121', 'victor.santos@exemplo.com', '1962-01-01', '20000-091', 'Av. Nossa Senhora de Copacabana', '100', 'Copacabana', 'Rio de Janeiro', 'RJ', NULL, '2024-05-05 12:00:00', '2024-05-05 12:00:00'),
(122, 'Lívia Costa', '311.121.131-92', NULL, '(31) 98765-1122', 'livia.costa@exemplo.com', '1995-03-05', '30000-092', 'Rua Sergipe', '200', 'Funcionários', 'Belo Horizonte', 'MG', NULL, '2024-05-05 12:30:00', '2024-05-05 12:30:00'),
(123, 'Thiago Almeida', '311.121.131-93', NULL, '(71) 98765-1123', 'thiago.almeida@exemplo.com', '1981-06-18', '40000-093', 'Rua Rio de Janeiro', '45', 'Comércio', 'Salvador', 'BA', 'Sala 1', '2024-05-05 13:00:00', '2024-05-05 13:00:00'),
(124, 'Helena Barbosa', '311.121.131-94', NULL, '(51) 98765-1124', 'helena.barbosa@exemplo.com', '2003-09-30', '90000-094', 'Rua Padre Chagas', '30', 'Moinhos de Vento', 'Porto Alegre', 'RS', NULL, '2024-05-05 13:30:00', '2024-05-05 13:30:00'),
(125, 'Gustavo Lima', '311.121.131-95', NULL, '(43) 98765-1125', 'gustavo.lima@exemplo.com', '1977-12-14', '86000-095', 'Rua Pará', '150', 'Centro', 'Londrina', 'PR', NULL, '2024-05-05 14:00:00', '2024-05-05 14:00:00'),
(126, 'Manuela Rocha', '311.121.131-96', NULL, '(19) 98765-1126', 'manuela.rocha@exemplo.com', '1991-02-27', '13000-096', 'Av. Francisco Glicério', '800', 'Centro', 'Campinas', 'SP', NULL, '2024-05-05 14:30:00', '2024-05-05 14:30:00'),
(127, 'Eduardo Pinto', '311.121.131-97', NULL, '(41) 98765-1127', 'eduardo.pinto@exemplo.com', '1967-02-18', '80000-097', 'Rua Treze de Maio', '80', 'Centro', 'Curitiba', 'PR', NULL, '2024-05-05 15:00:00', '2024-05-05 15:00:00'),
(128, 'Sophia Mendes', '311.121.131-98', NULL, '(11) 98765-1128', 'sophia.mendes@exemplo.com', '1994-05-04', '01000-098', 'Rua Teodoro Sampaio', '1000', 'Pinheiros', 'São Paulo', 'SP', 'Conj 7', '2024-05-05 15:30:00', '2024-05-05 15:30:00'),
(129, 'Marcelo Nascimento', '311.121.131-99', NULL, '(21) 98765-1129', 'marcelo.nascimento@exemplo.com', '1975-08-20', '20000-099', 'Rua Visconde de Pirajá', '50', 'Ipanema', 'Rio de Janeiro', 'RJ', NULL, '2024-05-05 16:00:00', '2024-05-05 16:00:00'),
(130, 'Camila Rocha', '311.121.131-00', NULL, '(31) 98765-1130', 'camila.rocha@exemplo.com', '1989-11-26', '30000-100', 'Rua Rio de Janeiro', '400', 'Centro', 'Belo Horizonte', 'MG', NULL, '2024-05-05 16:30:00', '2024-05-05 16:30:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '0001_01_01_000000_create_users_table', 1),
(14, '0001_01_01_000001_create_cache_table', 1),
(15, '0001_01_01_000002_create_jobs_table', 1),
(16, '2025_09_26_010038_create_produtos_table', 1),
(17, '2025_10_21_120000_create_clientes_table', 1),
(18, '2025_10_22_134940_create_veiculos_table', 1),
(19, '2025_10_30_132748_create_vendas_table', 2),
(20, '2025_11_12_113544_add_estoque_atual_to_produtos_table', 3),
(21, '2025_11_17_140958_create_venda_items_table', 4),
(22, '2025_11_18_130958_add_estoque_atual_to_produtos_table', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `unidade_medida` varchar(10) NOT NULL,
  `preco_custo` decimal(10,2) NOT NULL,
  `preco_venda` decimal(10,2) NOT NULL,
  `estoque_minimo` int(11) NOT NULL DEFAULT 0,
  `estoque_atual` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `unidade_medida`, `preco_custo`, `preco_venda`, `estoque_minimo`, `estoque_atual`, `created_at`, `updated_at`) VALUES
(5, 'AMORTECEDOR DIANTEIRO', 'New Fiesta', 'UN', 50.00, 120.00, 1, 8.00, '2025-11-19 18:37:03', '2025-11-19 18:44:45'),
(6, 'DISCO DE FREIO', 'New Fiesta', 'UN', 89.00, 250.00, 1, 19.00, '2025-11-19 18:44:15', '2025-11-19 18:44:45'),
(7, 'Vela de Ignição NGK', 'Jogo de 4 velas para motor 1.0/1.6', 'JG', 35.00, 79.90, 5, 50.00, '2024-01-01 13:00:00', '2024-01-01 13:00:00'),
(8, 'Filtro de Óleo Mann', 'Filtro de óleo para linha GM', 'UN', 15.00, 35.00, 10, 80.00, '2024-01-01 13:01:00', '2024-01-01 13:01:00'),
(9, 'Pastilha de Freio Cobreq', 'Jogo de pastilhas dianteiras', 'JG', 45.00, 99.00, 8, 45.00, '2024-01-01 13:02:00', '2024-01-01 13:02:00'),
(10, 'Óleo Motor 5W30 Sintético', 'Óleo de motor 100% sintético (1 Litro)', 'LT', 25.00, 49.90, 20, 150.00, '2024-01-01 13:03:00', '2024-01-01 13:03:00'),
(11, 'Filtro de Ar Esportivo', 'Filtro cônico lavável', 'UN', 50.00, 120.00, 3, 10.00, '2024-01-01 13:04:00', '2024-01-01 13:04:00'),
(12, 'Bomba D\'água Urba', 'Bomba d água (Modelo Universal)', 'UN', 70.00, 160.00, 2, 15.00, '2024-01-01 13:05:00', '2024-01-01 13:05:00'),
(13, 'Correia Alternador V', 'Correia tipo V', 'UN', 10.00, 25.00, 15, 60.00, '2024-01-01 13:06:00', '2024-01-01 13:06:00'),
(14, 'Disco de Freio Ventilado', 'Par de discos de freio', 'JG', 150.00, 350.00, 4, 18.00, '2024-01-01 13:07:00', '2024-01-01 13:07:00'),
(15, 'Kit Troca de Óleo 15W40', 'Óleo semi-sintético 15W40 (4 Litros) + Filtro de Óleo', 'JG', 80.00, 175.00, 5, 25.00, '2024-01-01 13:08:00', '2024-01-01 13:08:00'),
(16, 'Lâmpada Farol H4 Philips', 'Lâmpada H4 12V (Unidade)', 'UN', 12.00, 29.90, 30, 100.00, '2024-01-01 13:09:00', '2024-01-01 13:09:00'),
(17, 'Amortecedor Traseiro Cofap', 'Amortecedor traseiro (Unidade)', 'UN', 60.00, 139.90, 5, 20.00, '2024-01-01 13:10:00', '2024-01-01 13:10:00'),
(18, 'Pneu Aro 14', 'Pneu 175/70 R14 (Unidade)', 'UN', 130.00, 320.00, 4, 15.00, '2024-01-01 13:11:00', '2024-01-01 13:11:00'),
(19, 'Bateria 60Ah Heliar', 'Bateria 12V 60 Amperes', 'UN', 200.00, 450.00, 3, 12.00, '2024-01-01 13:12:00', '2024-01-01 13:12:00'),
(20, 'Jogo de Tapetes Universal', 'Jogo 4 peças carpete', 'JG', 30.00, 65.00, 10, 40.00, '2024-01-01 13:13:00', '2024-01-01 13:13:00'),
(21, 'Filtro de Combustível', 'Filtro de linha', 'UN', 8.00, 19.90, 15, 90.00, '2024-01-01 13:14:00', '2024-01-01 13:14:00'),
(22, 'Buzina 12V', 'Buzina tipo caracol', 'UN', 30.00, 65.00, 5, 20.00, '2024-01-01 13:15:00', '2024-01-01 13:15:00'),
(23, 'Terminal de Bateria', 'Par de terminais de bateria', 'JG', 15.00, 30.00, 10, 40.00, '2024-01-01 13:16:00', '2024-01-01 13:16:00'),
(24, 'Cabo de Vela', 'Jogo de cabos de vela 4 cilindros', 'JG', 45.00, 99.00, 4, 18.00, '2024-01-01 13:17:00', '2024-01-01 13:17:00'),
(25, 'Óleo de Freio DOT 4', 'Fluido de freio (500ml)', 'UN', 12.00, 28.00, 8, 35.00, '2024-01-01 13:18:00', '2024-01-01 13:18:00'),
(26, 'Palheta Limpador Padrão', 'Palheta dianteira (unidade)', 'UN', 10.00, 25.00, 20, 50.00, '2024-01-01 13:19:00', '2024-01-01 13:19:00'),
(27, 'Reservatório de Água Radiador', 'Reservatório de expansão', 'UN', 30.00, 70.00, 5, 15.00, '2024-01-01 13:20:00', '2024-01-01 13:20:00'),
(28, 'Radiador de Água', 'Radiador (Modelo Universal)', 'UN', 180.00, 420.00, 2, 8.00, '2024-01-01 13:21:00', '2024-01-01 13:21:00'),
(29, 'Kit Bucha Suspensão', 'Jogo de buchas (Balança)', 'JG', 40.00, 95.00, 5, 22.00, '2024-01-01 13:22:00', '2024-01-01 13:22:00'),
(30, 'Cubo de Roda Dianteiro', 'Cubo com rolamento', 'UN', 80.00, 190.00, 3, 10.00, '2024-01-01 13:23:00', '2024-01-01 13:23:00'),
(31, 'Rolamento de Roda Traseiro', 'Rolamento simples', 'UN', 20.00, 48.00, 10, 30.00, '2024-01-01 13:24:00', '2024-01-01 13:24:00'),
(32, 'Kit Limpeza de Bico Injetor', 'Fluido para limpeza (500ml)', 'UN', 15.00, 35.00, 10, 45.00, '2024-01-01 13:25:00', '2024-01-01 13:25:00'),
(33, 'Ventoinha Radiador', 'Ventoinha completa 12V', 'UN', 150.00, 350.00, 2, 6.00, '2024-01-01 13:26:00', '2024-01-01 13:26:00'),
(34, 'Módulo de Ignição Universal', 'Módulo de potência', 'UN', 70.00, 150.00, 2, 8.00, '2024-01-01 13:27:00', '2024-01-01 13:27:00'),
(35, 'Reparo Motor Partida Básico', 'Kit de reparo básico', 'JG', 20.00, 50.00, 5, 25.00, '2024-01-01 13:28:00', '2024-01-01 13:28:00'),
(36, 'Kit Farol de Milha Completo', 'Kit completo com chicote e botão', 'JG', 100.00, 220.00, 2, 5.00, '2024-01-01 13:29:00', '2024-01-01 13:29:00'),
(37, 'Junta do Cabeçote Aço', 'Junta de aço (Modelo Universal)', 'UN', 55.00, 130.00, 3, 10.00, '2024-01-01 13:30:00', '2024-01-01 13:30:00'),
(38, 'Válvula Termostática Padrão', 'Válvula termostática', 'UN', 30.00, 70.00, 5, 15.00, '2024-01-01 13:31:00', '2024-01-01 13:31:00'),
(39, 'Bomba de Combustível Interna', 'Bomba de combustível interna', 'UN', 90.00, 210.00, 3, 10.00, '2024-01-01 13:32:00', '2024-01-01 13:32:00'),
(40, 'Homocinética Universal', 'Junta homocinética', 'UN', 65.00, 145.00, 4, 16.00, '2024-01-01 13:33:00', '2024-01-01 13:33:00'),
(41, 'Kit Reparo de Pneu', 'Kit com macarrão e cola', 'JG', 10.00, 25.00, 15, 55.00, '2024-01-01 13:34:00', '2024-01-01 13:34:00'),
(42, 'Bieleta', 'Bieleta da barra estabilizadora', 'UN', 25.00, 55.00, 6, 24.00, '2024-01-01 13:35:00', '2024-01-01 13:35:00'),
(43, 'Coxim do Motor', 'Coxim do motor', 'UN', 60.00, 140.00, 3, 15.00, '2024-01-01 13:36:00', '2024-01-01 13:36:00'),
(44, 'Lâmpada Led Pingo', 'Lâmpada T10 LED', 'UN', 3.00, 8.00, 50, 200.00, '2024-01-01 13:37:00', '2024-01-01 13:37:00'),
(45, 'Silicone para Vedação', 'Tubo de silicone (alta temperatura)', 'UN', 15.00, 35.00, 10, 40.00, '2024-01-01 13:38:00', '2024-01-01 13:38:00'),
(46, 'Cabo Auxiliar de Partida', 'Cabo "chupeta" 200A', 'UN', 40.00, 85.00, 5, 15.00, '2024-01-01 13:39:00', '2024-01-01 13:39:00'),
(47, 'Fusível Lâmina Kit', 'Kit com 10 fusíveis variados', 'JG', 5.00, 15.00, 20, 120.00, '2024-01-01 13:40:00', '2024-01-01 13:40:00'),
(48, 'Filtro de Ar Condicionado', 'Filtro de cabine', 'UN', 10.00, 25.00, 10, 50.00, '2024-01-01 13:41:00', '2024-01-01 13:41:00'),
(49, 'Tensor da Correia', 'Tensor da correia dentada', 'UN', 45.00, 105.00, 3, 12.00, '2024-01-01 13:42:00', '2024-01-01 13:42:00'),
(50, 'Macaco Sanfona', 'Macaco tipo sanfona 1.5 Ton', 'UN', 35.00, 75.00, 5, 10.00, '2024-01-01 13:43:00', '2024-01-01 13:43:00'),
(51, 'Triângulo de Sinalização', 'Triângulo de segurança', 'UN', 15.00, 30.00, 10, 50.00, '2024-01-01 13:44:00', '2024-01-01 13:44:00'),
(52, 'Chave de Roda Cruz', 'Chave de roda em cruz', 'UN', 20.00, 45.00, 8, 20.00, '2024-01-01 13:45:00', '2024-01-01 13:45:00'),
(53, 'Anti-ferrugem Spray', 'Spray protetor (300ml)', 'UN', 18.00, 40.00, 10, 30.00, '2024-01-01 13:46:00', '2024-01-01 13:46:00'),
(54, 'Limpa Contato Spray 300ml', 'Limpa contato elétrico (Spray 300ml)', 'UN', 15.00, 35.00, 5, 20.00, '2024-01-01 13:47:00', '2024-01-01 13:47:00'),
(55, 'Graxa para Rolamento Pote', 'Pote de graxa', 'UN', 12.00, 28.00, 8, 30.00, '2024-01-01 13:48:00', '2024-01-01 13:48:00'),
(56, 'Pastilha de Freio Traseira', 'Jogo de pastilhas traseiras', 'JG', 35.00, 85.00, 5, 25.00, '2024-01-01 13:49:00', '2024-01-01 13:49:00'),
(57, 'Disco de Freio Traseiro Sólido', 'Par de discos de freio traseiros', 'JG', 100.00, 240.00, 3, 10.00, '2024-01-01 13:50:00', '2024-01-01 13:50:00'),
(58, 'Cilindro de Roda', 'Cilindro de roda traseira (unidade)', 'UN', 20.00, 50.00, 10, 35.00, '2024-01-01 13:51:00', '2024-01-01 13:51:00'),
(59, 'Tambor de Freio', 'Tambor de freio traseiro', 'UN', 80.00, 180.00, 2, 8.00, '2024-01-01 13:52:00', '2024-01-01 13:52:00'),
(60, 'Sapata de Freio', 'Jogo de sapatas de freio', 'JG', 30.00, 70.00, 5, 20.00, '2024-01-01 13:53:00', '2024-01-01 13:53:00'),
(61, 'Cilindro Mestre de Freio', 'Cilindro mestre', 'UN', 90.00, 210.00, 3, 12.00, '2024-01-01 13:54:00', '2024-01-01 13:54:00'),
(62, 'Reservatório de Óleo de Freio', 'Reservatório de óleo', 'UN', 20.00, 45.00, 8, 30.00, '2024-01-01 13:55:00', '2024-01-01 13:55:00'),
(63, 'Coxim do Câmbio', 'Coxim do câmbio', 'UN', 55.00, 125.00, 4, 15.00, '2024-01-01 13:56:00', '2024-01-01 13:56:00'),
(64, 'Kit de Batente e Coifa Amortecedor', 'Kit completo (2 lados)', 'JG', 40.00, 90.00, 5, 25.00, '2024-01-01 13:57:00', '2024-01-01 13:57:00'),
(65, 'Mola Dianteira', 'Par de molas helicoidais dianteiras', 'JG', 110.00, 250.00, 2, 10.00, '2024-01-01 13:58:00', '2024-01-01 13:58:00'),
(66, 'Mola Traseira', 'Par de molas helicoidais traseiras', 'JG', 100.00, 230.00, 2, 8.00, '2024-01-01 13:59:00', '2024-01-01 13:59:00'),
(67, 'Pivô de Suspensão', 'Pivô da bandeja (unidade)', 'UN', 30.00, 75.00, 6, 20.00, '2024-01-02 10:00:00', '2024-01-02 10:00:00'),
(68, 'Terminal de Direção', 'Terminal de direção (unidade)', 'UN', 25.00, 60.00, 8, 22.00, '2024-01-02 10:01:00', '2024-01-02 10:01:00'),
(69, 'Caixa de Direção Hidráulica', 'Caixa completa remanufaturada', 'UN', 300.00, 650.00, 1, 5.00, '2024-01-02 10:02:00', '2024-01-02 10:02:00'),
(70, 'Fluido Direção Hidráulica', 'Fluido (1 Litro)', 'LT', 15.00, 35.00, 10, 40.00, '2024-01-02 10:03:00', '2024-01-02 10:03:00'),
(71, 'Bomba Direção Hidráulica', 'Bomba completa', 'UN', 200.00, 480.00, 1, 6.00, '2024-01-02 10:04:00', '2024-01-02 10:04:00'),
(72, 'Junta Homocinética Fixa', 'Junta fixa (unidade)', 'UN', 50.00, 120.00, 5, 18.00, '2024-01-02 10:05:00', '2024-01-02 10:05:00'),
(73, 'Kit Reparo de Semieixo', 'Kit coifa, graxa e abraçadeiras', 'JG', 20.00, 45.00, 10, 30.00, '2024-01-02 10:06:00', '2024-01-02 10:06:00'),
(74, 'Cruzeta do Cardan', 'Cruzeta (Modelo Universal)', 'UN', 40.00, 90.00, 5, 15.00, '2024-01-02 10:07:00', '2024-01-02 10:07:00'),
(75, 'Flange do Cardan', 'Flange (unidade)', 'UN', 30.00, 70.00, 4, 10.00, '2024-01-02 10:08:00', '2024-01-02 10:08:00'),
(76, 'Rolamento de Embreagem', 'Rolamento', 'UN', 45.00, 100.00, 5, 18.00, '2024-01-02 10:09:00', '2024-01-02 10:09:00'),
(77, 'Kit Cabo e Varinha de Embreagem', 'Kit completo (Modelo Universal)', 'JG', 60.00, 130.00, 3, 12.00, '2024-01-02 10:10:00', '2024-01-02 10:10:00'),
(78, 'Interruptor de Luz de Freio', 'Cebolinha de freio', 'UN', 15.00, 35.00, 10, 40.00, '2024-01-02 10:11:00', '2024-01-02 10:11:00'),
(79, 'Sensor de Rotação', 'Sensor (unidade)', 'UN', 50.00, 110.00, 4, 15.00, '2024-01-02 10:12:00', '2024-01-02 10:12:00'),
(80, 'Sensor de Nível de Combustível', 'Boia do tanque', 'UN', 70.00, 150.00, 3, 10.00, '2024-01-02 10:13:00', '2024-01-02 10:13:00'),
(81, 'Eletroventilador (Motor)', 'Motor da ventoinha', 'UN', 80.00, 180.00, 2, 7.00, '2024-01-02 10:14:00', '2024-01-02 10:14:00'),
(82, 'Reservatório de Partida a Frio', 'Tanquinho', 'UN', 30.00, 65.00, 5, 20.00, '2024-01-02 10:15:00', '2024-01-02 10:15:00'),
(83, 'Bobina de Ignição', 'Bobina (unidade)', 'UN', 60.00, 140.00, 3, 12.00, '2024-01-02 10:16:00', '2024-01-02 10:16:00'),
(84, 'Distribuidor de Ignição', 'Distribuidor completo', 'UN', 120.00, 280.00, 1, 5.00, '2024-01-02 10:17:00', '2024-01-02 10:17:00'),
(85, 'Filtro de Ar Motor (Papel)', 'Filtro de ar padrão', 'UN', 15.00, 35.00, 10, 50.00, '2024-01-02 10:18:00', '2024-01-02 10:18:00'),
(86, 'Filtro de Cabine (Carvão Ativado)', 'Filtro de ar condicionado premium', 'UN', 25.00, 55.00, 8, 30.00, '2024-01-02 10:19:00', '2024-01-02 10:19:00'),
(87, 'Mangueira Radiador Superior', 'Mangueira superior do radiador', 'UN', 20.00, 45.00, 5, 20.00, '2024-01-02 10:20:00', '2024-01-02 10:20:00'),
(88, 'Mangueira Radiador Inferior', 'Mangueira inferior do radiador', 'UN', 20.00, 45.00, 5, 20.00, '2024-01-02 10:21:00', '2024-01-02 10:21:00'),
(89, 'Tampa do Reservatório', 'Tampa do reservatório de expansão', 'UN', 5.00, 15.00, 15, 60.00, '2024-01-02 10:22:00', '2024-01-02 10:22:00'),
(90, 'Tampa do Radiador', 'Tampa do radiador', 'UN', 8.00, 18.00, 10, 40.00, '2024-01-02 10:23:00', '2024-01-02 10:23:00'),
(91, 'Aditivo Radiador Orgânico (1L)', 'Aditivo pronto para uso (1L)', 'LT', 12.00, 29.00, 20, 80.00, '2024-01-02 10:24:00', '2024-01-02 10:24:00'),
(92, 'Kit Limpeza de Radiador', 'Kit com dois produtos para limpeza', 'JG', 18.00, 40.00, 5, 25.00, '2024-01-02 10:25:00', '2024-01-02 10:25:00'),
(93, 'Fluido de Transmissão Automática', 'Óleo ATF (1 Litro)', 'LT', 30.00, 65.00, 10, 30.00, '2024-01-02 10:26:00', '2024-01-02 10:26:00'),
(94, 'Óleo para Câmbio Manual', 'Óleo SAE 80W90 (1 Litro)', 'LT', 15.00, 35.00, 15, 50.00, '2024-01-02 10:27:00', '2024-01-02 10:27:00'),
(95, 'Óleo Diferencial', 'Óleo SAE 90 (1 Litro)', 'LT', 20.00, 45.00, 10, 30.00, '2024-01-02 10:28:00', '2024-01-02 10:28:00'),
(96, 'Retentor de Roda', 'Retentor (unidade)', 'UN', 10.00, 25.00, 15, 50.00, '2024-01-02 10:29:00', '2024-01-02 10:29:00'),
(97, 'Retentor de Virabrequim', 'Retentor traseiro', 'UN', 25.00, 60.00, 5, 20.00, '2024-01-02 10:30:00', '2024-01-02 10:30:00'),
(98, 'Kit de Juntas do Motor (Superior)', 'Jogo de juntas do cabeçote', 'JG', 70.00, 160.00, 3, 10.00, '2024-01-02 10:31:00', '2024-01-02 10:31:00'),
(99, 'Kit de Juntas do Motor (Inferior)', 'Jogo de juntas do cárter', 'JG', 50.00, 110.00, 4, 15.00, '2024-01-02 10:32:00', '2024-01-02 10:32:00'),
(100, 'Biela de Motor', 'Biela (unidade)', 'UN', 90.00, 200.00, 2, 8.00, '2024-01-02 10:33:00', '2024-01-02 10:33:00'),
(101, 'Pistão com Anéis', 'Pistão e jogo de anéis (unidade)', 'UN', 110.00, 240.00, 2, 6.00, '2024-01-02 10:34:00', '2024-01-02 10:34:00'),
(102, 'Lona de Freio', 'Jogo de lonas de freio', 'JG', 40.00, 95.00, 5, 25.00, '2024-01-02 10:35:00', '2024-01-02 10:35:00'),
(103, 'Cabo de Acelerador', 'Cabo (unidade)', 'UN', 20.00, 45.00, 10, 30.00, '2024-01-02 10:36:00', '2024-01-02 10:36:00'),
(104, 'Cabo de Embreagem', 'Cabo (unidade)', 'UN', 25.00, 55.00, 8, 20.00, '2024-01-02 10:37:00', '2024-01-02 10:37:00'),
(105, 'Filtro de Ar Comprimido', 'Filtro de ar para caminhões/ônibus', 'UN', 50.00, 120.00, 5, 15.00, '2024-01-02 10:38:00', '2024-01-02 10:38:00'),
(106, 'Silenciador de Escapamento', 'Ponteira de escapamento', 'UN', 90.00, 210.00, 3, 10.00, '2024-01-02 10:39:00', '2024-01-02 10:39:00'),
(107, 'Kit Troca de Óleo 10W40', 'Óleo semi-sintético 10W40 (4 Litros) + Filtro de Óleo', 'JG', 90.00, 189.90, 5, 25.00, '2024-05-15 22:00:00', '2024-05-15 22:00:00'),
(108, 'Protetor de Cárter', 'Protetor (Modelo Universal)', 'UN', 55.00, 120.00, 3, 15.00, '2024-05-15 22:01:00', '2024-05-15 22:01:00'),
(109, 'Pneu Aro 15', 'Pneu 195/65 R15', 'UN', 180.00, 420.00, 4, 18.00, '2024-05-15 22:02:00', '2024-05-15 22:02:00'),
(110, 'Filtro de Cabine', 'Filtro de ar condicionado', 'UN', 10.00, 25.00, 10, 50.00, '2024-05-15 22:03:00', '2024-05-15 22:03:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Bn28kCtIvnrSmki5GqFwVJ7RtuiPa6anQDeIAgoh', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibmxIT3BJTmlWdVFuelBVUVh4WDBUVDV0Njg5d2RBY2NZTU5CM3drVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcHJvZHV0b3MiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1763567097);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rodrigo', 'teste@teste.com', NULL, '$2y$12$mr.J05bMhIokx75e/lthn.hgnBvTdPntyoHNOrpIs.2gwEkxc4G.G', NULL, '2025-10-29 19:16:40', '2025-10-29 19:16:40');

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `placa` varchar(8) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `ano` int(11) NOT NULL,
  `cor` varchar(255) NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `veiculos`
--

INSERT INTO `veiculos` (`id`, `placa`, `marca`, `modelo`, `ano`, `cor`, `cliente_id`, `created_at`, `updated_at`) VALUES
(6, 'ABC-2D77', 'FORD', 'NEW FIESTA', 2015, 'BRANCO', 5, '2025-11-19 18:17:50', '2025-11-19 18:17:50'),
(7, 'BBB-6H45', 'WOLKSVAGEM', 'GOL', 1988, 'BEGE', 6, '2025-11-19 18:43:29', '2025-11-21 16:41:06'),
(8, 'AAA-1001', 'VW', 'GOL', 2010, 'Prata', 9, '2024-01-05 13:00:00', '2024-01-05 13:00:00'),
(9, 'BBB-2002', 'GM', 'CELTA', 2012, 'Preto', 10, '2024-01-10 14:00:00', '2024-01-10 14:00:00'),
(10, 'CCC-3003', 'FIAT', 'UNO', 2005, 'Vermelho', 11, '2024-01-15 15:00:00', '2024-01-15 15:00:00'),
(11, 'DDD-4004', 'FORD', 'KA', 2018, 'Azul', 12, '2024-01-20 16:00:00', '2024-01-20 16:00:00'),
(12, 'EEE-5005', 'HYUNDAI', 'HB20', 2014, 'Branco', 13, '2024-01-25 17:00:00', '2024-01-25 17:00:00'),
(13, 'FFF-6006', 'TOYOTA', 'COROLLA', 2020, 'Preto', 14, '2024-01-30 18:00:00', '2024-01-30 18:00:00'),
(14, 'GGG-7007', 'HONDA', 'CIVIC', 2017, 'Prata', 15, '2024-02-05 19:00:00', '2024-02-05 19:00:00'),
(15, 'HHH-8008', 'CHEVROLET', 'ONIX', 2021, 'Vermelho', 16, '2024-02-10 20:00:00', '2024-02-10 20:00:00'),
(16, 'III-9009', 'NISSAN', 'VERSA', 2016, 'Cinza', 17, '2024-02-15 21:00:00', '2024-02-15 21:00:00'),
(17, 'JJJ-0101', 'RENAULT', 'KWID', 2019, 'Laranja', 18, '2024-02-20 12:00:00', '2024-02-20 12:00:00'),
(18, 'KKK-1212', 'PEUGEOT', '208', 2015, 'Branco', 19, '2024-02-25 13:00:00', '2024-02-25 13:00:00'),
(19, 'LLL-3434', 'CITROEN', 'C3', 2013, 'Preto', 20, '2024-03-01 14:00:00', '2024-03-01 14:00:00'),
(20, 'MMM-5656', 'MITSUBISHI', 'L200', 2022, 'Verde', 21, '2024-03-05 15:00:00', '2024-03-05 15:00:00'),
(52, 'MKM-7711', 'VW', 'VOYAGE', 2011, 'Prata', 52, '2024-05-01 22:00:00', '2024-05-01 22:00:00'),
(53, 'LPL-8822', 'GM', 'CORSA', 2008, 'Branco', 53, '2024-05-02 11:30:00', '2024-05-02 11:30:00'),
(54, 'PQP-9933', 'FIAT', 'PALIO', 2013, 'Azul', 54, '2024-05-02 12:00:00', '2024-05-02 12:00:00'),
(55, 'RSR-0044', 'FORD', 'ECOSPORT', 2016, 'Preto', 55, '2024-05-02 12:30:00', '2024-05-02 12:30:00'),
(56, 'TST-1155', 'HYUNDAI', 'IX35', 2018, 'Cinza', 56, '2024-05-02 13:00:00', '2024-05-02 13:00:00'),
(57, 'UVU-2266', 'TOYOTA', 'HILUX', 2023, 'Branco', 57, '2024-05-02 13:30:00', '2024-05-02 13:30:00'),
(58, 'VWV-3377', 'HONDA', 'FIT', 2015, 'Prata', 58, '2024-05-02 14:00:00', '2024-05-02 14:00:00'),
(59, 'XYX-4488', 'CHEVROLET', 'PRISMA', 2017, 'Vermelho', 59, '2024-05-02 14:30:00', '2024-05-02 14:30:00'),
(60, 'YZZ-5599', 'NISSAN', 'FRONTIER', 2020, 'Preto', 60, '2024-05-02 15:00:00', '2024-05-02 15:00:00'),
(61, 'ZAB-6600', 'RENAULT', 'SANDERO', 2014, 'Azul', 61, '2024-05-02 15:30:00', '2024-05-02 15:30:00'),
(62, 'BCA-7711', 'PEUGEOT', '308', 2016, 'Branco', 62, '2024-05-02 16:00:00', '2024-05-02 16:00:00'),
(63, 'CDB-8822', 'CITROEN', 'C4 CACTUS', 2019, 'Marrom', 63, '2024-05-02 16:30:00', '2024-05-02 16:30:00'),
(64, 'DEC-9933', 'MITSUBISHI', 'OUTLANDER', 2021, 'Cinza', 64, '2024-05-02 17:00:00', '2024-05-02 17:00:00'),
(65, 'EFE-0044', 'VW', 'UP!', 2015, 'Amarelo', 65, '2024-05-02 17:30:00', '2024-05-02 17:30:00'),
(66, 'GFG-1155', 'GM', 'CRUZE', 2017, 'Preto', 66, '2024-05-02 18:00:00', '2024-05-02 18:00:00'),
(67, 'HGH-2266', 'FIAT', 'TORO', 2020, 'Vermelho', 67, '2024-05-02 18:30:00', '2024-05-02 18:30:00'),
(68, 'IJI-3377', 'FORD', 'FOCUS', 2014, 'Branco', 68, '2024-05-02 19:00:00', '2024-05-02 19:00:00'),
(69, 'JKJ-4488', 'HYUNDAI', 'CRETA', 2018, 'Prata', 69, '2024-05-02 19:30:00', '2024-05-02 19:30:00'),
(70, 'LKL-5599', 'TOYOTA', 'ETIOS', 2016, 'Cinza', 70, '2024-05-02 20:00:00', '2024-05-02 20:00:00'),
(71, 'MLM-6600', 'HONDA', 'HR-V', 2021, 'Preto', 71, '2024-05-02 20:30:00', '2024-05-02 20:30:00'),
(72, 'NMN-7711', 'CHEVROLET', 'S10', 2023, 'Branco', 72, '2024-05-02 21:00:00', '2024-05-02 21:00:00'),
(73, 'OPO-8822', 'NISSAN', 'KICKS', 2019, 'Azul', 73, '2024-05-02 21:30:00', '2024-05-02 21:30:00'),
(74, 'PQP-9933', 'RENAULT', 'CAPTUR', 2017, 'Vermelho', 74, '2024-05-02 22:00:00', '2024-05-02 22:00:00'),
(75, 'RQR-0044', 'PEUGEOT', '2008', 2015, 'Cinza', 75, '2024-05-02 22:30:00', '2024-05-02 22:30:00'),
(76, 'SRS-1155', 'CITROEN', 'AIRCROSS', 2013, 'Branco', 76, '2024-05-02 23:00:00', '2024-05-02 23:00:00'),
(77, 'TUT-2266', 'MITSUBISHI', 'PAJERO', 2020, 'Preto', 77, '2024-05-02 23:30:00', '2024-05-02 23:30:00'),
(78, 'UVU-3377', 'VW', 'JETTA', 2018, 'Prata', 78, '2024-05-03 00:00:00', '2024-05-03 00:00:00'),
(79, 'VWV-4488', 'GM', 'VECTRA', 2010, 'Azul', 79, '2024-05-03 00:30:00', '2024-05-03 00:30:00'),
(80, 'XYX-5599', 'FIAT', 'SIENA', 2012, 'Branco', 80, '2024-05-03 01:00:00', '2024-05-03 01:00:00'),
(81, 'YZZ-6600', 'FORD', 'RANGER', 2022, 'Vermelho', 82, '2024-05-03 01:30:00', '2024-05-03 01:30:00'),
(82, 'ZAB-7711', 'HYUNDAI', 'TUCSON', 2016, 'Cinza', 83, '2024-05-03 02:00:00', '2024-05-03 02:00:00'),
(83, 'BCA-8822', 'TOYOTA', 'PRIUS', 2019, 'Branco', 84, '2024-05-03 02:30:00', '2024-05-03 02:30:00'),
(84, 'CDB-9933', 'HONDA', 'CITY', 2014, 'Preto', 85, '2024-05-03 03:00:00', '2024-05-03 03:00:00'),
(85, 'DEC-0044', 'CHEVROLET', 'TRAILBLAZER', 2021, 'Prata', 86, '2024-05-03 03:30:00', '2024-05-03 03:30:00'),
(86, 'EFE-1155', 'NISSAN', 'SENTRA', 2017, 'Azul', 87, '2024-05-03 04:00:00', '2024-05-03 04:00:00'),
(87, 'GFG-2266', 'RENAULT', 'LOGAN', 2015, 'Branco', 88, '2024-05-03 04:30:00', '2024-05-03 04:30:00'),
(88, 'HGH-3377', 'PEUGEOT', '408', 2012, 'Preto', 89, '2024-05-03 05:00:00', '2024-05-03 05:00:00'),
(89, 'IJI-4488', 'CITROEN', 'C4 LOUNGE', 2016, 'Prata', 90, '2024-05-03 05:30:00', '2024-05-03 05:30:00'),
(90, 'JKJ-5599', 'MITSUBISHI', 'ASX', 2018, 'Vermelho', 91, '2024-05-03 06:00:00', '2024-05-03 06:00:00'),
(91, 'LKL-6600', 'VW', 'T-CROSS', 2020, 'Branco', 92, '2024-05-03 06:30:00', '2024-05-03 06:30:00'),
(92, 'MLM-7711', 'GM', 'TRACKER', 2022, 'Preto', 93, '2024-05-03 07:00:00', '2024-05-03 07:00:00'),
(93, 'NMN-8822', 'FIAT', 'ARGO', 2019, 'Azul', 94, '2024-05-03 07:30:00', '2024-05-03 07:30:00'),
(94, 'OPO-9933', 'FORD', 'BRONCO', 2023, 'Verde', 95, '2024-05-03 08:00:00', '2024-05-03 08:00:00'),
(95, 'PQP-0044', 'HYUNDAI', 'VELOSTER', 2012, 'Amarelo', 96, '2024-05-03 08:30:00', '2024-05-03 08:30:00'),
(96, 'RQR-1155', 'TOYOTA', 'RAV4', 2020, 'Prata', 97, '2024-05-03 09:00:00', '2024-05-03 09:00:00'),
(97, 'SRS-2266', 'HONDA', 'WR-V', 2018, 'Branco', 98, '2024-05-03 09:30:00', '2024-05-03 09:30:00'),
(98, 'TUT-3377', 'CHEVROLET', 'EQUINOX', 2021, 'Preto', 99, '2024-05-03 10:00:00', '2024-05-03 10:00:00'),
(99, 'UVU-4488', 'NISSAN', 'MARCH', 2015, 'Vermelho', 100, '2024-05-03 10:30:00', '2024-05-03 10:30:00'),
(100, 'VWV-5599', 'RENAULT', 'DUSTER', 2019, 'Cinza', 101, '2024-05-03 11:00:00', '2024-05-03 11:00:00'),
(101, 'XYX-6600', 'PEUGEOT', '508', 2013, 'Branco', 102, '2024-05-03 11:30:00', '2024-05-03 11:30:00'),
(102, 'YZZ-7711', 'CITROEN', 'C4 PICASSO', 2017, 'Prata', 103, '2024-05-03 12:00:00', '2024-05-03 12:00:00'),
(103, 'ZAB-8822', 'MITSUBISHI', 'LANCER', 2014, 'Preto', 104, '2024-05-03 12:30:00', '2024-05-03 12:30:00'),
(104, 'BCA-9933', 'VW', 'VIRTUS', 2020, 'Azul', 105, '2024-05-03 13:00:00', '2024-05-03 13:00:00'),
(105, 'CDB-0044', 'GM', 'SPIN', 2018, 'Branco', 106, '2024-05-03 13:30:00', '2024-05-03 13:30:00'),
(106, 'DEC-1155', 'FIAT', 'CRONOS', 2019, 'Vermelho', 107, '2024-05-03 14:00:00', '2024-05-03 14:00:00'),
(107, 'EFE-2266', 'FORD', 'EDGE', 2016, 'Cinza', 108, '2024-05-03 14:30:00', '2024-05-03 14:30:00'),
(108, 'GFG-3377', 'HYUNDAI', 'HB20S', 2021, 'Prata', 109, '2024-05-03 15:00:00', '2024-05-03 15:00:00'),
(109, 'HGH-4488', 'TOYOTA', 'YARIS', 2023, 'Branco', 110, '2024-05-03 15:30:00', '2024-05-03 15:30:00'),
(110, 'IJI-5599', 'HONDA', 'CR-V', 2015, 'Preto', 111, '2024-05-03 16:00:00', '2024-05-03 16:00:00'),
(111, 'JKJ-6600', 'CHEVROLET', 'AGILE', 2013, 'Azul', 112, '2024-05-03 16:30:00', '2024-05-03 16:30:00'),
(112, 'LKL-7711', 'NISSAN', 'SENTRA', 2018, 'Prata', 113, '2024-05-03 17:00:00', '2024-05-03 17:00:00'),
(113, 'MLM-8822', 'RENAULT', 'OROCH', 2020, 'Branco', 114, '2024-05-03 17:30:00', '2024-05-03 17:30:00'),
(114, 'NMN-9933', 'PEUGEOT', '207', 2011, 'Vermelho', 115, '2024-05-03 18:00:00', '2024-05-03 18:00:00'),
(115, 'OPO-0044', 'CITROEN', 'C4 GRAND PICASSO', 2016, 'Cinza', 116, '2024-05-03 18:30:00', '2024-05-03 18:30:00'),
(116, 'PQP-1155', 'MITSUBISHI', 'TR4', 2013, 'Verde', 117, '2024-05-03 19:00:00', '2024-05-03 19:00:00'),
(117, 'RQR-2266', 'VW', 'FOX', 2017, 'Branco', 118, '2024-05-03 19:30:00', '2024-05-03 19:30:00'),
(118, 'SRS-3377', 'GM', 'KADETT', 1998, 'Vermelho', 119, '2024-05-03 20:00:00', '2024-05-03 20:00:00'),
(119, 'TUT-4488', 'FIAT', 'WEEKEND', 2015, 'Prata', 120, '2024-05-03 20:30:00', '2024-05-03 20:30:00'),
(120, 'UVU-5599', 'FORD', 'FUSION', 2018, 'Preto', 121, '2024-05-03 21:00:00', '2024-05-03 21:00:00'),
(121, 'VWV-6600', 'HYUNDAI', 'AZERA', 2014, 'Cinza', 122, '2024-05-03 21:30:00', '2024-05-03 21:30:00'),
(122, 'XYX-7711', 'TOYOTA', 'CAMRY', 2019, 'Branco', 123, '2024-05-03 22:00:00', '2024-05-03 22:00:00'),
(123, 'YZZ-8822', 'HONDA', 'ACCORD', 2016, 'Prata', 124, '2024-05-03 22:30:00', '2024-05-03 22:30:00'),
(124, 'ZAB-9933', 'CHEVROLET', 'CRUZE SPORT6', 2017, 'Vermelho', 125, '2024-05-03 23:00:00', '2024-05-03 23:00:00'),
(125, 'BCA-0044', 'NISSAN', 'LIVINA', 2012, 'Preto', 126, '2024-05-03 23:30:00', '2024-05-03 23:30:00'),
(126, 'CDB-1155', 'RENAULT', 'CLIO', 2014, 'Branco', 127, '2024-05-04 00:00:00', '2024-05-04 00:00:00'),
(127, 'DEC-2266', 'PEUGEOT', '3008', 2018, 'Cinza', 128, '2024-05-04 00:30:00', '2024-05-04 00:30:00'),
(128, 'EFE-3377', 'CITROEN', 'DS3', 2015, 'Azul', 129, '2024-05-04 01:00:00', '2024-05-04 01:00:00'),
(129, 'GFG-4488', 'MITSUBISHI', 'ECLIPSE', 2019, 'Vermelho', 130, '2024-05-04 01:30:00', '2024-05-04 01:30:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `veiculo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `data_venda` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Orcamento',
  `forma_pagamento` varchar(255) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `desconto` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_final` decimal(10,2) NOT NULL,
  `observacoes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `vendas`
--

INSERT INTO `vendas` (`id`, `cliente_id`, `veiculo_id`, `data_venda`, `status`, `forma_pagamento`, `subtotal`, `desconto`, `total_final`, `observacoes`, `created_at`, `updated_at`) VALUES
(2, 5, 6, '2025-11-19', 'Finalizada', 'Cartão de Crédito', 120.00, 0.00, 120.00, NULL, '2025-11-19 18:39:56', '2025-11-19 18:39:56'),
(3, 6, 7, '2025-11-19', 'Finalizada', 'Cartão de Débito', 370.00, 0.00, 370.00, NULL, '2025-11-19 18:44:45', '2025-11-19 18:44:45'),
(4, 9, 8, '2024-01-08', 'Finalizada', 'Pix', 178.90, 0.00, 178.90, 'Revisão básica', '2024-01-08 10:00:00', '2024-01-08 10:00:00'),
(5, 10, 9, '2024-01-15', 'Finalizada', 'Dinheiro', 99.00, 9.00, 90.00, NULL, '2024-01-15 11:30:00', '2024-01-15 11:30:00'),
(6, 11, 10, '2024-02-01', 'Orcamento', 'Cartão de Crédito', 160.00, 0.00, 160.00, 'Bomba d\'água orçada', '2024-02-01 12:00:00', '2024-02-01 12:00:00'),
(7, 13, 12, '2024-05-25', 'Finalizada', 'Pix', 204.90, 0.00, 204.90, NULL, '2024-05-25 14:30:00', '2024-05-25 14:30:00'),
(8, 8, 53, '2024-06-01', 'Finalizada', 'Cartão de Crédito', 1065.00, 50.00, 1015.00, 'Troca de pneus e fluido', '2024-06-01 12:45:00', '2024-06-01 12:45:00'),
(9, 7, 7, '2024-06-05', 'Finalizada', 'Pix', 509.90, 0.00, 509.90, NULL, '2024-06-05 09:00:00', '2024-06-05 09:00:00'),

-- Novos registros (IDs 10 a 103) para atingir 102 vendas
(10, 16, 15, '2024-06-05', 'Finalizada', 'Pix', 149.00, 0.00, 149.00, NULL, '2024-06-05 10:00:00', '2024-06-05 10:00:00'),
(11, 17, 16, '2024-06-06', 'Finalizada', 'Cartão de Débito', 238.90, 0.00, 238.90, NULL, '2024-06-06 11:00:00', '2024-06-06 11:00:00'),
(12, 18, 17, '2024-06-07', 'Orcamento', 'Dinheiro', 94.90, 0.00, 94.90, 'Item de baixo custo', '2024-06-07 12:00:00', '2024-06-07 12:00:00'),
(13, 19, 18, '2024-06-08', 'Finalizada', 'Cartão de Crédito', 315.00, 15.00, 300.00, NULL, '2024-06-08 13:00:00', '2024-06-08 13:00:00'),
(14, 20, 19, '2024-06-09', 'Finalizada', 'Pix', 150.00, 0.00, 150.00, NULL, '2024-06-09 14:00:00', '2024-06-09 14:00:00'),
(15, 21, 20, '2024-06-10', 'Orcamento', 'Boleto', 450.00, 0.00, 450.00, 'Revisão completa', '2024-06-10 15:00:00', '2024-06-10 15:00:00'),
(16, 22, 52, '2024-06-11', 'Finalizada', 'Cartão de Crédito', 180.00, 10.00, 170.00, NULL, '2024-06-11 16:00:00', '2024-06-11 16:00:00'),
(17, 23, 54, '2024-06-12', 'Finalizada', 'Pix', 379.90, 0.00, 379.90, NULL, '2024-06-12 17:00:00', '2024-06-12 17:00:00'),
(18, 24, 55, '2024-06-13', 'Finalizada', 'Dinheiro', 85.00, 5.00, 80.00, NULL, '2024-06-13 18:00:00', '2024-06-13 18:00:00'),
(19, 25, 56, '2024-06-14', 'Orcamento', 'Cartão de Débito', 230.00, 0.00, 230.00, 'Troca de molas', '2024-06-14 19:00:00', '2024-06-14 19:00:00'),
(20, 26, 57, '2024-06-15', 'Finalizada', 'Pix', 350.00, 0.00, 350.00, NULL, '2024-06-15 10:00:00', '2024-06-15 10:00:00'),
(21, 27, 58, '2024-06-16', 'Finalizada', 'Boleto', 139.90, 0.00, 139.90, NULL, '2024-06-16 11:00:00', '2024-06-16 11:00:00'),
(22, 28, 59, '2024-06-17', 'Orcamento', 'Dinheiro', 170.00, 0.00, 170.00, 'Coxim do motor e Bieleta', '2024-06-17 12:00:00', '2024-06-17 12:00:00'),
(23, 29, 60, '2024-06-18', 'Finalizada', 'Cartão de Crédito', 50.00, 0.00, 50.00, NULL, '2024-06-18 13:00:00', '2024-06-18 13:00:00'),
(24, 30, 61, '2024-06-19', 'Finalizada', 'Pix', 144.90, 0.00, 144.90, NULL, '2024-06-19 14:00:00', '2024-06-19 14:00:00'),
(25, 52, 62, '2024-06-20', 'Finalizada', 'Dinheiro', 18.00, 0.00, 18.00, NULL, '2024-06-20 15:00:00', '2024-06-20 15:00:00'),
(26, 53, 63, '2024-06-21', 'Orcamento', 'Cartão de Débito', 110.00, 0.00, 110.00, 'Sensor e Interruptor', '2024-06-21 16:00:00', '2024-06-21 16:00:00'),
(27, 54, 64, '2024-06-22', 'Finalizada', 'Pix', 120.00, 0.00, 120.00, NULL, '2024-06-22 17:00:00', '2024-06-22 17:00:00'),
(28, 55, 65, '2024-06-23', 'Finalizada', 'Cartão de Crédito', 69.90, 0.00, 69.90, NULL, '2024-06-23 18:00:00', '2024-06-23 18:00:00'),
(29, 56, 66, '2024-06-24', 'Orcamento', 'Boleto', 450.00, 50.00, 400.00, 'Subtotal: R$ 450.00', '2024-06-24 19:00:00', '2024-06-24 19:00:00'),
(30, 57, 67, '2024-06-25', 'Finalizada', 'Pix', 99.00, 0.00, 99.00, NULL, '2024-06-25 10:00:00', '2024-06-25 10:00:00'),
(31, 58, 68, '2024-06-26', 'Finalizada', 'Dinheiro', 25.00, 0.00, 25.00, NULL, '2024-06-26 11:00:00', '2024-06-26 11:00:00'),
(32, 59, 69, '2024-06-27', 'Orcamento', 'Cartão de Débito', 48.00, 0.00, 48.00, NULL, '2024-06-27 12:00:00', '2024-06-27 12:00:00'),
(33, 60, 70, '2024-06-28', 'Finalizada', 'Cartão de Crédito', 59.90, 0.00, 59.90, NULL, '2024-06-28 13:00:00', '2024-06-28 13:00:00'),
(34, 61, 71, '2024-06-29', 'Finalizada', 'Pix', 105.00, 5.00, 100.00, NULL, '2024-06-29 14:00:00', '2024-06-29 14:00:00'),
(35, 62, 72, '2024-06-30', 'Orcamento', 'Boleto', 750.00, 0.00, 750.00, 'Caixa de direção completa', '2024-06-30 15:00:00', '2024-06-30 15:00:00'),
(36, 63, 73, '2024-07-01', 'Finalizada', 'Dinheiro', 35.00, 0.00, 35.00, NULL, '2024-07-01 16:00:00', '2024-07-01 16:00:00'),
(37, 64, 74, '2024-07-02', 'Finalizada', 'Cartão de Crédito', 290.00, 10.00, 280.00, 'Freios completos', '2024-07-02 17:00:00', '2024-07-02 17:00:00'),
(38, 65, 75, '2024-07-03', 'Finalizada', 'Pix', 180.00, 0.00, 180.00, NULL, '2024-07-03 18:00:00', '2024-07-03 18:00:00'),
(39, 66, 76, '2024-07-04', 'Orcamento', 'Cartão de Débito', 95.00, 0.00, 95.00, NULL, '2024-07-04 19:00:00', '2024-07-04 19:00:00'),
(40, 67, 77, '2024-07-05', 'Finalizada', 'Dinheiro', 140.00, 0.00, 140.00, NULL, '2024-07-05 10:00:00', '2024-07-05 10:00:00'),
(41, 68, 78, '2024-07-06', 'Finalizada', 'Pix', 140.00, 0.00, 140.00, NULL, '2024-07-06 11:00:00', '2024-07-06 11:00:00'),
(42, 69, 79, '2024-07-07', 'Orcamento', 'Boleto', 150.00, 0.00, 150.00, 'Módulo de Ignição', '2024-07-07 12:00:00', '2024-07-07 12:00:00'),
(43, 70, 80, '2024-07-08', 'Finalizada', 'Cartão de Crédito', 99.90, 0.00, 99.90, NULL, '2024-07-08 13:00:00', '2024-07-08 13:00:00'),
(44, 71, 81, '2024-07-09', 'Finalizada', 'Pix', 420.00, 20.00, 400.00, 'Pneu e Bucha', '2024-07-09 14:00:00', '2024-07-09 14:00:00'),
(45, 72, 82, '2024-07-10', 'Orcamento', 'Dinheiro', 70.00, 0.00, 70.00, 'Válvula termostática', '2024-07-10 15:00:00', '2024-07-10 15:00:00'),
(46, 73, 83, '2024-07-11', 'Finalizada', 'Cartão de Débito', 210.00, 10.00, 200.00, NULL, '2024-07-11 16:00:00', '2024-07-11 16:00:00'),
(47, 74, 84, '2024-07-12', 'Finalizada', 'Pix', 180.00, 0.00, 180.00, NULL, '2024-07-12 17:00:00', '2024-07-12 17:00:00'),
(48, 75, 85, '2024-07-13', 'Orcamento', 'Dinheiro', 240.00, 0.00, 240.00, 'Pistão e anéis', '2024-07-13 18:00:00', '2024-07-13 18:00:00'),
(49, 76, 86, '2024-07-14', 'Finalizada', 'Cartão de Crédito', 50.00, 0.00, 50.00, NULL, '2024-07-14 19:00:00', '2024-07-14 19:00:00'),
(50, 77, 87, '2024-07-15', 'Finalizada', 'Pix', 15.00, 0.00, 15.00, NULL, '2024-07-15 10:00:00', '2024-07-15 10:00:00'),
(51, 78, 88, '2024-07-16', 'Finalizada', 'Boleto', 100.00, 0.00, 100.00, NULL, '2024-07-16 11:00:00', '2024-07-16 11:00:00'),
(52, 79, 89, '2024-07-17', 'Orcamento', 'Dinheiro', 60.00, 0.00, 60.00, 'Terminal de direção', '2024-07-17 12:00:00', '2024-07-17 12:00:00'),
(53, 80, 90, '2024-07-18', 'Finalizada', 'Cartão de Crédito', 45.00, 0.00, 45.00, NULL, '2024-07-18 13:00:00', '2024-07-18 13:00:00'),
(54, 82, 91, '2024-07-19', 'Finalizada', 'Pix', 39.90, 0.00, 39.90, NULL, '2024-07-19 14:00:00', '2024-07-19 14:00:00'),
(55, 83, 92, '2024-07-20', 'Orcamento', 'Dinheiro', 30.00, 0.00, 30.00, NULL, '2024-07-20 15:00:00', '2024-07-20 15:00:00'),
(56, 84, 93, '2024-07-21', 'Finalizada', 'Cartão de Débito', 95.00, 0.00, 95.00, NULL, '2024-07-21 16:00:00', '2024-07-21 16:00:00'),
(57, 85, 94, '2024-07-22', 'Finalizada', 'Pix', 25.00, 0.00, 25.00, NULL, '2024-07-22 17:00:00', '2024-07-22 17:00:00'),
(58, 86, 95, '2024-07-23', 'Finalizada', 'Dinheiro', 220.00, 20.00, 200.00, 'Kit Farol de Milha', '2024-07-23 18:00:00', '2024-07-23 18:00:00'),
(59, 87, 96, '2024-07-24', 'Orcamento', 'Cartão de Crédito', 130.00, 0.00, 130.00, 'Junta do Cabeçote', '2024-07-24 19:00:00', '2024-07-24 19:00:00'),
(60, 88, 97, '2024-07-25', 'Finalizada', 'Pix', 48.00, 0.00, 48.00, NULL, '2024-07-25 10:00:00', '2024-07-25 10:00:00'),
(61, 89, 98, '2024-07-26', 'Finalizada', 'Boleto', 45.00, 0.00, 45.00, NULL, '2024-07-26 11:00:00', '2024-07-26 11:00:00'),
(62, 90, 99, '2024-07-27', 'Orcamento', 'Dinheiro', 35.00, 0.00, 35.00, NULL, '2024-07-27 12:00:00', '2024-07-27 12:00:00'),
(63, 91, 100, '2024-07-28', 'Finalizada', 'Cartão de Crédito', 145.00, 0.00, 145.00, NULL, '2024-07-28 13:00:00', '2024-07-28 13:00:00'),
(64, 92, 101, '2024-07-29', 'Finalizada', 'Pix', 190.00, 10.00, 180.00, 'Cubo e Bieleta', '2024-07-29 14:00:00', '2024-07-29 14:00:00'),
(65, 93, 102, '2024-07-30', 'Orcamento', 'Dinheiro', 189.90, 0.00, 189.90, 'Troca de Óleo', '2024-07-30 15:00:00', '2024-07-30 15:00:00'),
(66, 94, 103, '2024-07-31', 'Finalizada', 'Cartão de Débito', 99.00, 0.00, 99.00, NULL, '2024-07-31 16:00:00', '2024-07-31 16:00:00'),
(67, 95, 104, '2024-08-01', 'Finalizada', 'Pix', 140.00, 0.00, 140.00, NULL, '2024-08-01 17:00:00', '2024-08-01 17:00:00'),
(68, 96, 105, '2024-08-02', 'Orcamento', 'Dinheiro', 75.00, 0.00, 75.00, NULL, '2024-08-02 18:00:00', '2024-08-02 18:00:00'),
(69, 97, 106, '2024-08-03', 'Finalizada', 'Cartão de Crédito', 119.90, 0.00, 119.90, NULL, '2024-08-03 19:00:00', '2024-08-03 19:00:00'),
(70, 98, 107, '2024-08-04', 'Finalizada', 'Pix', 15.00, 0.00, 15.00, NULL, '2024-08-04 10:00:00', '2024-08-04 10:00:00'),
(71, 99, 108, '2024-08-05', 'Orcamento', 'Boleto', 60.00, 0.00, 60.00, 'Reparos elétricos', '2024-08-05 11:00:00', '2024-08-05 11:00:00'),
(72, 100, 109, '2024-08-06', 'Finalizada', 'Dinheiro', 49.90, 0.00, 49.90, NULL, '2024-08-06 12:00:00', '2024-08-06 12:00:00'),
(73, 101, 110, '2024-08-07', 'Finalizada', 'Cartão de Crédito', 120.00, 0.00, 120.00, NULL, '2024-08-07 13:00:00', '2024-08-07 13:00:00'),
(74, 102, 111, '2024-08-08', 'Orcamento', 'Pix', 420.00, 0.00, 420.00, 'Radiador', '2024-08-08 14:00:00', '2024-08-08 14:00:00'),
(75, 103, 112, '2024-08-09', 'Finalizada', 'Dinheiro', 189.90, 0.00, 189.90, NULL, '2024-08-09 15:00:00', '2024-08-09 15:00:00'),
(76, 104, 113, '2024-08-10', 'Finalizada', 'Cartão de Débito', 50.00, 0.00, 50.00, NULL, '2024-08-10 16:00:00', '2024-08-10 16:00:00'),
(77, 105, 114, '2024-08-11', 'Orcamento', 'Pix', 140.00, 0.00, 140.00, 'Bobina de Ignição', '2024-08-11 17:00:00', '2024-08-11 17:00:00'),
(78, 106, 115, '2024-08-12', 'Finalizada', 'Dinheiro', 90.00, 0.00, 90.00, NULL, '2024-08-12 18:00:00', '2024-08-12 18:00:00'),
(79, 107, 116, '2024-08-13', 'Finalizada', 'Cartão de Crédito', 25.00, 0.00, 25.00, NULL, '2024-08-13 19:00:00', '2024-08-13 19:00:00'),
(80, 108, 117, '2024-08-14', 'Orcamento', 'Boleto', 35.00, 0.00, 35.00, 'Filtro de Óleo', '2024-08-14 10:00:00', '2024-08-14 10:00:00'),
(81, 109, 118, '2024-08-15', 'Finalizada', 'Pix', 95.00, 0.00, 95.00, NULL, '2024-08-15 11:00:00', '2024-08-15 11:00:00'),
(82, 110, 119, '2024-08-16', 'Finalizada', 'Dinheiro', 55.00, 0.00, 55.00, NULL, '2024-08-16 12:00:00', '2024-08-16 12:00:00'),
(83, 111, 120, '2024-08-17', 'Orcamento', 'Cartão de Débito', 450.00, 0.00, 450.00, 'Bateria 60Ah', '2024-08-17 13:00:00', '2024-08-17 13:00:00'),
(84, 112, 121, '2024-08-18', 'Finalizada', 'Cartão de Crédito', 120.00, 0.00, 120.00, NULL, '2024-08-18 14:00:00', '2024-08-18 14:00:00'),
(85, 113, 122, '2024-08-19', 'Finalizada', 'Pix', 18.00, 0.00, 18.00, NULL, '2024-08-19 15:00:00', '2024-08-19 15:00:00'),
(86, 114, 123, '2024-08-20', 'Orcamento', 'Dinheiro', 45.00, 0.00, 45.00, NULL, '2024-08-20 16:00:00', '2024-08-20 16:00:00'),
(87, 115, 124, '2024-08-21', 'Finalizada', 'Cartão de Crédito', 25.00, 0.00, 25.00, NULL, '2024-08-21 17:00:00', '2024-08-21 17:00:00'),
(88, 116, 125, '2024-08-22', 'Finalizada', 'Pix', 100.00, 0.00, 100.00, NULL, '2024-08-22 18:00:00', '2024-08-22 18:00:00'),
(89, 117, 126, '2024-08-23', 'Orcamento', 'Boleto', 350.00, 0.00, 350.00, 'Ventoinha Radiador', '2024-08-23 19:00:00', '2024-08-23 19:00:00'),
(90, 118, 127, '2024-08-24', 'Finalizada', 'Dinheiro', 220.00, 20.00, 200.00, 'Kit Farol de Milha', '2024-08-24 10:00:00', '2024-08-24 10:00:00'),
(91, 119, 128, '2024-08-25', 'Finalizada', 'Cartão de Débito', 99.00, 0.00, 99.00, NULL, '2024-08-25 11:00:00', '2024-08-25 11:00:00'),
(92, 120, 129, '2024-08-26', 'Orcamento', 'Pix', 145.00, 0.00, 145.00, 'Homocinética', '2024-08-26 12:00:00', '2024-08-26 12:00:00'),
(93, 121, 6, '2024-08-27', 'Finalizada', 'Dinheiro', 28.00, 0.00, 28.00, NULL, '2024-08-27 13:00:00', '2024-08-27 13:00:00'),
(94, 122, 7, '2024-08-28', 'Finalizada', 'Cartão de Crédito', 30.00, 0.00, 30.00, NULL, '2024-08-28 14:00:00', '2024-08-28 14:00:00'),
(95, 123, 8, '2024-08-29', 'Orcamento', 'Boleto', 160.00, 0.00, 160.00, NULL, '2024-08-29 15:00:00', '2024-08-29 15:00:00'),
(96, 124, 9, '2024-08-30', 'Finalizada', 'Pix', 29.00, 0.00, 29.00, NULL, '2024-08-30 16:00:00', '2024-08-30 16:00:00'),
(97, 125, 10, '2024-09-01', 'Finalizada', 'Dinheiro', 75.00, 0.00, 75.00, NULL, '2024-09-01 17:00:00', '2024-09-01 17:00:00'),
(98, 126, 11, '2024-09-02', 'Orcamento', 'Cartão de Débito', 95.00, 0.00, 95.00, 'Lona de Freio', '2024-09-02 18:00:00', '2024-09-02 18:00:00'),
(99, 127, 12, '2024-09-03', 'Finalizada', 'Cartão de Crédito', 50.00, 0.00, 50.00, NULL, '2024-09-03 19:00:00', '2024-09-03 19:00:00'),
(100, 128, 13, '2024-09-04', 'Finalizada', 'Pix', 60.00, 0.00, 60.00, NULL, '2024-09-04 10:00:00', '2024-09-04 10:00:00'),
(101, 129, 14, '2024-09-05', 'Orcamento', 'Boleto', 35.00, 0.00, 35.00, 'Óleo de motor 5W30', '2024-09-05 11:00:00', '2024-09-05 11:00:00'),
(102, 130, 15, '2024-09-06', 'Finalizada', 'Dinheiro', 18.00, 0.00, 18.00, NULL, '2024-09-06 12:00:00', '2024-09-06 12:00:00'),
(103, 5, 6, '2024-09-07', 'Finalizada', 'Pix', 120.00, 0.00, 120.00, NULL, '2024-09-07 13:00:00', '2024-09-07 13:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda_items`
--

CREATE TABLE `venda_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venda_id` bigint(20) UNSIGNED NOT NULL,
  `produto_id` bigint(20) UNSIGNED NOT NULL,
  `quantidade` decimal(8,2) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL,
  `total_item` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `venda_items`
--

INSERT INTO `venda_items` (`id`, `venda_id`, `produto_id`, `quantidade`, `preco_unitario`, `total`, `created_at`, `updated_at`) VALUES
(2, 2, 5, 1.00, 120.00, 120.00, '2025-11-19 18:39:56', '2025-11-19 18:39:56'),
(3, 3, 6, 1.00, 250.00, 250.00, '2025-11-19 18:44:45', '2025-11-19 18:44:45'),
(4, 3, 15, 1.00, 120.00, 120.00, '2025-11-19 18:44:45', '2025-11-19 18:44:45'),
(5, 4, 7, 1.00, 79.90, 79.90, '2024-01-08 10:00:00', '2024-01-08 10:00:00'),
(6, 4, 8, 2.00, 35.00, 70.00, '2024-01-08 10:00:00', '2024-01-08 10:00:00'),
(7, 5, 9, 1.00, 99.00, 99.00, '2024-01-15 11:30:00', '2024-01-15 11:30:00'),
(8, 6, 12, 1.00, 160.00, 160.00, '2024-02-01 12:00:00', '2024-02-01 12:00:00'),
(9, 7, 107, 1.00, 189.90, 189.90, '2024-05-25 14:30:00', '2024-05-25 14:30:00'),
(10, 7, 21, 0.75, 20.00, 15.00, '2024-05-25 14:30:00', '2024-05-25 14:30:00'),
(11, 8, 109, 2.00, 420.00, 840.00, '2024-06-01 12:45:00', '2024-06-01 12:45:00'),
(12, 8, 25, 3.00, 28.00, 84.00, '2024-06-01 12:45:00', '2024-06-01 12:45:00'),
(13, 8, 62, 1.00, 45.00, 45.00, '2024-06-01 12:45:00', '2024-06-01 12:45:00'),
(14, 9, 28, 1.00, 420.00, 420.00, '2024-06-05 09:00:00', '2024-06-05 09:00:00'),
(15, 9, 89, 1.00, 15.00, 15.00, '2024-06-05 09:00:00', '2024-06-05 09:00:00'),
(16, 9, 91, 2.00, 29.00, 58.00, '2024-06-05 09:00:00', '2024-06-05 09:00:00'),

-- Novos itens de venda (IDs 17 a 206)
(17, 10, 20, 1.00, 65.00, 65.00, '2024-06-05 10:00:00', '2024-06-05 10:00:00'),
(18, 10, 25, 3.00, 28.00, 84.00, '2024-06-05 10:00:00', '2024-06-05 10:00:00'),
(19, 11, 22, 1.00, 65.00, 65.00, '2024-06-06 11:00:00', '2024-06-06 11:00:00'),
(20, 11, 26, 7.00, 25.00, 173.90, '2024-06-06 11:00:00', '2024-06-06 11:00:00'),
(21, 12, 102, 1.00, 95.00, 94.90, '2024-06-07 12:00:00', '2024-06-07 12:00:00'),
(22, 13, 29, 3.00, 95.00, 285.00, '2024-06-08 13:00:00', '2024-06-08 13:00:00'),
(23, 13, 44, 5.00, 8.00, 30.00, '2024-06-08 13:00:00', '2024-06-08 13:00:00'),
(24, 14, 23, 5.00, 30.00, 150.00, '2024-06-09 14:00:00', '2024-06-09 14:00:00'),
(25, 15, 66, 1.00, 230.00, 230.00, '2024-06-10 15:00:00', '2024-06-10 15:00:00'),
(26, 15, 65, 1.00, 250.00, 220.00, '2024-06-10 15:00:00', '2024-06-10 15:00:00'),
(27, 16, 45, 4.00, 35.00, 140.00, '2024-06-11 16:00:00', '2024-06-11 16:00:00'),
(28, 16, 47, 1.00, 15.00, 40.00, '2024-06-11 16:00:00', '2024-06-11 16:00:00'),
(29, 17, 30, 2.00, 190.00, 380.00, '2024-06-12 17:00:00', '2024-06-12 17:00:00'),
(30, 18, 46, 1.00, 85.00, 85.00, '2024-06-13 18:00:00', '2024-06-13 18:00:00'),
(31, 19, 66, 1.00, 230.00, 230.00, '2024-06-14 19:00:00', '2024-06-14 19:00:00'),
(32, 20, 33, 1.00, 350.00, 350.00, '2024-06-15 10:00:00', '2024-06-15 10:00:00'),
(33, 21, 17, 1.00, 139.90, 139.90, '2024-06-16 11:00:00', '2024-06-16 11:00:00'),
(34, 22, 43, 1.00, 140.00, 140.00, '2024-06-17 12:00:00', '2024-06-17 12:00:00'),
(35, 22, 42, 1.00, 55.00, 30.00, '2024-06-17 12:00:00', '2024-06-17 12:00:00'),
(36, 23, 73, 1.00, 45.00, 50.00, '2024-06-18 13:00:00', '2024-06-18 13:00:00'),
(37, 24, 40, 1.00, 145.00, 144.90, '2024-06-19 14:00:00', '2024-06-19 14:00:00'),
(38, 25, 90, 1.00, 18.00, 18.00, '2024-06-20 15:00:00', '2024-06-20 15:00:00'),
(39, 26, 78, 1.00, 35.00, 35.00, '2024-06-21 16:00:00', '2024-06-21 16:00:00'),
(40, 26, 79, 1.00, 110.00, 75.00, '2024-06-21 16:00:00', '2024-06-21 16:00:00'),
(41, 27, 72, 1.00, 120.00, 120.00, '2024-06-22 17:00:00', '2024-06-22 17:00:00'),
(42, 28, 10, 1.00, 49.90, 49.90, '2024-06-23 18:00:00', '2024-06-23 18:00:00'),
(43, 28, 85, 1.00, 35.00, 20.00, '2024-06-23 18:00:00', '2024-06-23 18:00:00'),
(44, 29, 65, 1.00, 250.00, 250.00, '2024-06-24 19:00:00', '2024-06-24 19:00:00'),
(45, 30, 14, 1.00, 350.00, 99.00, '2024-06-25 10:00:00', '2024-06-25 10:00:00'),
(46, 31, 26, 1.00, 25.00, 25.00, '2024-06-26 11:00:00', '2024-06-26 11:00:00'),
(47, 32, 31, 1.00, 48.00, 48.00, '2024-06-27 12:00:00', '2024-06-27 12:00:00'),
(48, 33, 68, 1.00, 60.00, 59.90, '2024-06-28 13:00:00', '2024-06-28 13:00:00'),
(49, 34, 49, 1.00, 105.00, 105.00, '2024-06-29 14:00:00', '2024-06-29 14:00:00'),
(50, 35, 69, 1.00, 650.00, 650.00, '2024-06-30 15:00:00', '2024-06-30 15:00:00'),
(51, 35, 70, 2.00, 35.00, 100.00, '2024-06-30 15:00:00', '2024-06-30 15:00:00'),
(52, 36, 70, 1.00, 35.00, 35.00, '2024-07-01 16:00:00', '2024-07-01 16:00:00'),
(53, 37, 57, 1.00, 240.00, 240.00, '2024-07-02 17:00:00', '2024-07-02 17:00:00'),
(54, 37, 58, 1.00, 50.00, 50.00, '2024-07-02 17:00:00', '2024-07-02 17:00:00'),
(55, 38, 59, 1.00, 180.00, 180.00, '2024-07-03 18:00:00', '2024-07-03 18:00:00'),
(56, 39, 64, 1.00, 90.00, 95.00, '2024-07-04 19:00:00', '2024-07-04 19:00:00'),
(57, 40, 83, 1.00, 140.00, 140.00, '2024-07-05 10:00:00', '2024-07-05 10:00:00'),
(58, 41, 63, 1.00, 125.00, 140.00, '2024-07-06 11:00:00', '2024-07-06 11:00:00'),
(59, 42, 34, 1.00, 150.00, 150.00, '2024-07-07 12:00:00', '2024-07-07 12:00:00'),
(60, 43, 7, 1.00, 79.90, 79.90, '2024-07-08 13:00:00', '2024-07-08 13:00:00'),
(61, 43, 47, 1.00, 15.00, 20.00, '2024-07-08 13:00:00', '2024-07-08 13:00:00'),
(62, 44, 109, 1.00, 420.00, 420.00, '2024-07-09 14:00:00', '2024-07-09 14:00:00'),
(63, 45, 38, 1.00, 70.00, 70.00, '2024-07-10 15:00:00', '2024-07-10 15:00:00'),
(64, 46, 39, 1.00, 210.00, 210.00, '2024-07-11 16:00:00', '2024-07-11 16:00:00'),
(65, 47, 40, 1.00, 145.00, 180.00, '2024-07-12 17:00:00', '2024-07-12 17:00:00'),
(66, 48, 101, 1.00, 240.00, 240.00, '2024-07-13 18:00:00', '2024-07-13 18:00:00'),
(67, 49, 41, 2.00, 25.00, 50.00, '2024-07-14 19:00:00', '2024-07-14 19:00:00'),
(68, 50, 47, 1.00, 15.00, 15.00, '2024-07-15 10:00:00', '2024-07-15 10:00:00'),
(69, 51, 76, 1.00, 100.00, 100.00, '2024-07-16 11:00:00', '2024-07-16 11:00:00'),
(70, 52, 68, 1.00, 60.00, 60.00, '2024-07-17 12:00:00', '2024-07-17 12:00:00'),
(71, 53, 73, 1.00, 45.00, 45.00, '2024-07-18 13:00:00', '2024-07-18 13:00:00'),
(72, 54, 91, 1.00, 29.00, 29.00, '2024-07-19 14:00:00', '2024-07-19 14:00:00'),
(73, 54, 44, 1.00, 8.00, 10.90, '2024-07-19 14:00:00', '2024-07-19 14:00:00'),
(74, 55, 23, 1.00, 30.00, 30.00, '2024-07-20 15:00:00', '2024-07-20 15:00:00'),
(75, 56, 102, 1.00, 95.00, 95.00, '2024-07-21 16:00:00', '2024-07-21 16:00:00'),
(76, 57, 48, 1.00, 25.00, 25.00, '2024-07-22 17:00:00', '2024-07-22 17:00:00'),
(77, 58, 36, 1.00, 220.00, 220.00, '2024-07-23 18:00:00', '2024-07-23 18:00:00'),
(78, 59, 37, 1.00, 130.00, 130.00, '2024-07-24 19:00:00', '2024-07-24 19:00:00'),
(79, 60, 31, 1.00, 48.00, 48.00, '2024-07-25 10:00:00', '2024-07-25 10:00:00'),
(80, 61, 75, 1.00, 70.00, 45.00, '2024-07-26 11:00:00', '2024-07-26 11:00:00'),
(81, 62, 32, 1.00, 35.00, 35.00, '2024-07-27 12:00:00', '2024-07-27 12:00:00'),
(82, 63, 40, 1.00, 145.00, 145.00, '2024-07-28 13:00:00', '2024-07-28 13:00:00'),
(83, 64, 30, 1.00, 190.00, 190.00, '2024-07-29 14:00:00', '2024-07-29 14:00:00'),
(84, 65, 107, 1.00, 189.90, 189.90, '2024-07-30 15:00:00', '2024-07-30 15:00:00'),
(85, 66, 9, 1.00, 99.00, 99.00, '2024-07-31 16:00:00', '2024-07-31 16:00:00'),
(86, 67, 33, 1.00, 350.00, 140.00, '2024-08-01 17:00:00', '2024-08-01 17:00:00'),
(87, 68, 50, 1.00, 75.00, 75.00, '2024-08-02 18:00:00', '2024-08-02 18:00:00'),
(88, 69, 7, 1.00, 79.90, 79.90, '2024-08-03 19:00:00', '2024-08-03 19:00:00'),
(89, 69, 10, 0.80, 49.90, 40.00, '2024-08-03 19:00:00', '2024-08-03 19:00:00'),
(90, 70, 89, 3.00, 15.00, 15.00, '2024-08-04 10:00:00', '2024-08-04 10:00:00'),
(91, 71, 68, 1.00, 60.00, 60.00, '2024-08-05 11:00:00', '2024-08-05 11:00:00'),
(92, 72, 10, 1.00, 49.90, 49.90, '2024-08-06 12:00:00', '2024-08-06 12:00:00'),
(93, 73, 72, 1.00, 120.00, 120.00, '2024-08-07 13:00:00', '2024-08-07 13:00:00'),
(94, 74, 28, 1.00, 420.00, 420.00, '2024-08-08 14:00:00', '2024-08-08 14:00:00'),
(95, 75, 107, 1.00, 189.90, 189.90, '2024-08-09 15:00:00', '2024-08-09 15:00:00'),
(96, 76, 47, 3.00, 15.00, 50.00, '2024-08-10 16:00:00', '2024-08-10 16:00:00'),
(97, 77, 83, 1.00, 140.00, 140.00, '2024-08-11 17:00:00', '2024-08-11 17:00:00'),
(98, 78, 51, 3.00, 30.00, 90.00, '2024-08-12 18:00:00', '2024-08-12 18:00:00'),
(99, 79, 48, 1.00, 25.00, 25.00, '2024-08-13 19:00:00', '2024-08-13 19:00:00'),
(100, 80, 8, 1.00, 35.00, 35.00, '2024-08-14 10:00:00', '2024-08-14 10:00:00'),
(101, 81, 102, 1.00, 95.00, 95.00, '2024-08-15 11:00:00', '2024-08-15 11:00:00'),
(102, 82, 42, 1.00, 55.00, 55.00, '2024-08-16 12:00:00', '2024-08-16 12:00:00'),
(103, 83, 19, 1.00, 450.00, 450.00, '2024-08-17 13:00:00', '2024-08-17 13:00:00'),
(104, 84, 72, 1.00, 120.00, 120.00, '2024-08-18 14:00:00', '2024-08-18 14:00:00'),
(105, 85, 90, 1.00, 18.00, 18.00, '2024-08-19 15:00:00', '2024-08-19 15:00:00'),
(106, 86, 73, 1.00, 45.00, 45.00, '2024-08-20 16:00:00', '2024-08-20 16:00:00'),
(107, 87, 48, 1.00, 25.00, 25.00, '2024-08-21 17:00:00', '2024-08-21 17:00:00'),
(108, 88, 76, 1.00, 100.00, 100.00, '2024-08-22 18:00:00', '2024-08-22 18:00:00'),
(109, 89, 33, 1.00, 350.00, 350.00, '2024-08-23 19:00:00', '2024-08-23 19:00:00'),
(110, 90, 36, 1.00, 220.00, 220.00, '2024-08-24 10:00:00', '2024-08-24 10:00:00'),
(111, 91, 9, 1.00, 99.00, 99.00, '2024-08-25 11:00:00', '2024-08-25 11:00:00'),
(112, 92, 40, 1.00, 145.00, 145.00, '2024-08-26 12:00:00', '2024-08-26 12:00:00'),
(113, 93, 25, 1.00, 28.00, 28.00, '2024-08-27 13:00:00', '2024-08-27 13:00:00'),
(114, 94, 23, 1.00, 30.00, 30.00, '2024-08-28 14:00:00', '2024-08-28 14:00:00'),
(115, 95, 12, 1.00, 160.00, 160.00, '2024-08-29 15:00:00', '2024-08-29 15:00:00'),
(116, 96, 91, 1.00, 29.00, 29.00, '2024-08-30 16:00:00', '2024-08-30 16:00:00'),
(117, 97, 67, 1.00, 75.00, 75.00, '2024-09-01 17:00:00', '2024-09-01 17:00:00'),
(118, 98, 102, 1.00, 95.00, 95.00, '2024-09-02 18:00:00', '2024-09-02 18:00:00'),
(119, 99, 41, 2.00, 25.00, 50.00, '2024-09-03 19:00:00', '2024-09-03 19:00:00'),
(120, 100, 68, 1.00, 60.00, 60.00, '2024-09-04 10:00:00', '2024-09-04 10:00:00'),
(121, 101, 10, 1.00, 49.90, 35.00, '2024-09-05 11:00:00', '2024-09-05 11:00:00'),
(122, 102, 90, 1.00, 18.00, 18.00, '2024-09-06 12:00:00', '2024-09-06 12:00:00'),
(123, 103, 5, 1.00, 120.00, 120.00, '2024-09-07 13:00:00', '2024-09-07 13:00:00'),
(124, 10, 56, 1.00, 85.00, 84.00, '2024-06-05 10:00:00', '2024-06-05 10:00:00'),
(125, 11, 7, 2.00, 79.90, 158.00, '2024-06-06 11:00:00', '2024-06-06 11:00:00'),
(126, 12, 44, 1.00, 8.00, 8.00, '2024-06-07 12:00:00', '2024-06-07 12:00:00'),
(127, 13, 9, 1.00, 99.00, 30.00, '2024-06-08 13:00:00', '2024-06-08 13:00:00'),
(128, 14, 7, 1.00, 79.90, 7.00, '2024-06-09 14:00:00', '2024-06-09 14:00:00'),
(129, 15, 60, 1.00, 70.00, 220.00, '2024-06-10 15:00:00', '2024-06-10 15:00:00'),
(130, 16, 54, 1.00, 35.00, 10.00, '2024-06-11 16:00:00', '2024-06-11 16:00:00'),
(131, 17, 34, 1.00, 150.00, 150.00, '2024-06-12 17:00:00', '2024-06-12 17:00:00'),
(132, 18, 55, 1.00, 28.00, 28.00, '2024-06-13 18:00:00', '2024-06-13 18:00:00'),
(133, 19, 65, 1.00, 250.00, 250.00, '2024-06-14 19:00:00', '2024-06-14 19:00:00'),
(134, 20, 27, 1.00, 70.00, 70.00, '2024-06-15 10:00:00', '2024-06-15 10:00:00'),
(135, 21, 52, 1.00, 45.00, 45.00, '2024-06-16 11:00:00', '2024-06-16 11:00:00'),
(136, 22, 23, 1.00, 30.00, 30.00, '2024-06-17 12:00:00', '2024-06-17 12:00:00'),
(137, 23, 44, 1.00, 8.00, 8.00, '2024-06-18 13:00:00', '2024-06-18 13:00:00'),
(138, 24, 7, 1.00, 79.90, 79.90, '2024-06-19 14:00:00', '2024-06-19 14:00:00'),
(139, 25, 90, 1.00, 18.00, 18.00, '2024-06-20 15:00:00', '2024-06-20 15:00:00'),
(140, 26, 76, 1.00, 100.00, 75.00, '2024-06-21 16:00:00', '2024-06-21 16:00:00'),
(141, 27, 73, 1.00, 45.00, 45.00, '2024-06-22 17:00:00', '2024-06-22 17:00:00'),
(142, 28, 45, 1.00, 35.00, 35.00, '2024-06-23 18:00:00', '2024-06-23 18:00:00'),
(143, 29, 66, 1.00, 230.00, 230.00, '2024-06-24 19:00:00', '2024-06-24 19:00:00'),
(144, 30, 25, 1.00, 28.00, 18.00, '2024-06-25 10:00:00', '2024-06-25 10:00:00'),
(145, 31, 22, 1.00, 65.00, 65.00, '2024-06-26 11:00:00', '2024-06-26 11:00:00'),
(146, 32, 53, 1.00, 40.00, 40.00, '2024-06-27 12:00:00', '2024-06-27 12:00:00'),
(147, 33, 54, 1.00, 35.00, 35.00, '2024-06-28 13:00:00', '2024-06-28 13:00:00'),
(148, 34, 55, 1.00, 28.00, 28.00, '2024-06-29 14:00:00', '2024-06-29 14:00:00'),
(149, 35, 71, 1.00, 480.00, 350.00, '2024-06-30 15:00:00', '2024-06-30 15:00:00'),
(150, 36, 71, 1.00, 480.00, 400.00, '2024-07-01 16:00:00', '2024-07-01 16:00:00'),
(151, 37, 59, 1.00, 180.00, 180.00, '2024-07-02 17:00:00', '2024-07-02 17:00:00'),
(152, 38, 57, 1.00, 240.00, 240.00, '2024-07-03 18:00:00', '2024-07-03 18:00:00'),
(153, 39, 63, 1.00, 125.00, 125.00, '2024-07-04 19:00:00', '2024-07-04 19:00:00'),
(154, 40, 81, 1.00, 180.00, 180.00, '2024-07-05 10:00:00', '2024-07-05 10:00:00'),
(155, 41, 64, 1.00, 90.00, 90.00, '2024-07-06 11:00:00', '2024-07-06 11:00:00'),
(156, 42, 85, 1.00, 35.00, 35.00, '2024-07-07 12:00:00', '2024-07-07 12:00:00'),
(157, 43, 86, 1.00, 55.00, 55.00, '2024-07-08 13:00:00', '2024-07-08 13:00:00'),
(158, 44, 29, 1.00, 95.00, 95.00, '2024-07-09 14:00:00', '2024-07-09 14:00:00'),
(159, 45, 87, 1.00, 45.00, 45.00, '2024-07-10 15:00:00', '2024-07-10 15:00:00'),
(160, 46, 7, 1.00, 79.90, 79.90, '2024-07-11 16:00:00', '2024-07-11 16:00:00'),
(161, 47, 88, 1.00, 45.00, 45.00, '2024-07-12 17:00:00', '2024-07-12 17:00:00'),
(162, 48, 89, 1.00, 15.00, 15.00, '2024-07-13 18:00:00', '2024-07-13 18:00:00'),
(163, 49, 90, 1.00, 18.00, 18.00, '2024-07-14 19:00:00', '2024-07-14 19:00:00'),
(164, 50, 47, 1.00, 15.00, 15.00, '2024-07-15 10:00:00', '2024-07-15 10:00:00'),
(165, 51, 91, 1.00, 29.00, 29.00, '2024-07-16 11:00:00', '2024-07-16 11:00:00'),
(166, 52, 92, 1.00, 40.00, 40.00, '2024-07-17 12:00:00', '2024-07-17 12:00:00'),
(167, 53, 93, 1.00, 65.00, 45.00, '2024-07-18 13:00:00', '2024-07-18 13:00:00'),
(168, 54, 94, 1.00, 35.00, 35.00, '2024-07-19 14:00:00', '2024-07-19 14:00:00'),
(169, 55, 95, 1.00, 45.00, 45.00, '2024-07-20 15:00:00', '2024-07-20 15:00:00'),
(170, 56, 96, 1.00, 25.00, 25.00, '2024-07-21 16:00:00', '2024-07-21 16:00:00'),
(171, 57, 97, 1.00, 60.00, 25.00, '2024-07-22 17:00:00', '2024-07-22 17:00:00'),
(172, 58, 98, 1.00, 160.00, 160.00, '2024-07-23 18:00:00', '2024-07-23 18:00:00'),
(173, 59, 99, 1.00, 110.00, 110.00, '2024-07-24 19:00:00', '2024-07-24 19:00:00'),
(174, 60, 100, 1.00, 200.00, 48.00, '2024-07-25 10:00:00', '2024-07-25 10:00:00'),
(175, 61, 101, 1.00, 240.00, 240.00, '2024-07-26 11:00:00', '2024-07-26 11:00:00'),
(176, 62, 102, 1.00, 95.00, 95.00, '2024-07-27 12:00:00', '2024-07-27 12:00:00'),
(177, 63, 103, 1.00, 45.00, 45.00, '2024-07-28 13:00:00', '2024-07-28 13:00:00'),
(178, 64, 42, 1.00, 55.00, 55.00, '2024-07-29 14:00:00', '2024-07-29 14:00:00'),
(179, 65, 8, 1.00, 35.00, 35.00, '2024-07-30 15:00:00', '2024-07-30 15:00:00'),
(180, 66, 24, 1.00, 99.00, 99.00, '2024-07-31 16:00:00', '2024-07-31 16:00:00'),
(181, 67, 43, 1.00, 140.00, 140.00, '2024-08-01 17:00:00', '2024-08-01 17:00:00'),
(182, 68, 51, 1.00, 30.00, 30.00, '2024-08-02 18:00:00', '2024-08-02 18:00:00'),
(183, 69, 107, 1.00, 189.90, 189.90, '2024-08-03 19:00:00', '2024-08-03 19:00:00'),
(184, 70, 89, 1.00, 15.00, 15.00, '2024-08-04 10:00:00', '2024-08-04 10:00:00'),
(185, 71, 68, 1.00, 60.00, 60.00, '2024-08-05 11:00:00', '2024-08-05 11:00:00'),
(186, 72, 10, 1.00, 49.90, 49.90, '2024-08-06 12:00:00', '2024-08-06 12:00:00'),
(187, 73, 72, 1.00, 120.00, 120.00, '2024-08-07 13:00:00', '2024-08-07 13:00:00'),
(188, 74, 28, 1.00, 420.00, 420.00, '2024-08-08 14:00:00', '2024-08-08 14:00:00'),
(189, 75, 107, 1.00, 189.90, 189.90, '2024-08-09 15:00:00', '2024-08-09 15:00:00'),
(190, 76, 47, 1.00, 15.00, 15.00, '2024-08-10 16:00:00', '2024-08-10 16:00:00'),
(191, 77, 83, 1.00, 140.00, 140.00, '2024-08-11 17:00:00', '2024-08-11 17:00:00'),
(192, 78, 52, 1.00, 45.00, 45.00, '2024-08-12 18:00:00', '2024-08-12 18:00:00'),
(193, 79, 48, 1.00, 25.00, 25.00, '2024-08-13 19:00:00', '2024-08-13 19:00:00'),
(194, 80, 8, 1.00, 35.00, 35.00, '2024-08-14 10:00:00', '2024-08-14 10:00:00'),
(195, 81, 102, 1.00, 95.00, 95.00, '2024-08-15 11:00:00', '2024-08-15 11:00:00'),
(196, 82, 42, 1.00, 55.00, 55.00, '2024-08-16 12:00:00', '2024-08-16 12:00:00'),
(197, 83, 19, 1.00, 450.00, 450.00, '2024-08-17 13:00:00', '2024-08-17 13:00:00'),
(198, 84, 72, 1.00, 120.00, 120.00, '2024-08-18 14:00:00', '2024-08-18 14:00:00'),
(199, 85, 90, 1.00, 18.00, 18.00, '2024-08-19 15:00:00', '2024-08-19 15:00:00'),
(200, 86, 73, 1.00, 45.00, 45.00, '2024-08-20 16:00:00', '2024-08-20 16:00:00'),
(201, 87, 48, 1.00, 25.00, 25.00, '2024-08-21 17:00:00', '2024-08-21 17:00:00'),
(202, 88, 76, 1.00, 100.00, 100.00, '2024-08-22 18:00:00', '2024-08-22 18:00:00'),
(203, 89, 33, 1.00, 350.00, 350.00, '2024-08-23 19:00:00', '2024-08-23 19:00:00'),
(204, 90, 36, 1.00, 220.00, 220.00, '2024-08-24 10:00:00', '2024-08-24 10:00:00'),
(205, 91, 9, 1.00, 99.00, 99.00, '2024-08-25 11:00:00', '2024-08-25 11:00:00'),
(206, 92, 40, 1.00, 145.00, 145.00, '2024-08-26 12:00:00', '2024-08-26 12:00:00'),
(207, 93, 25, 1.00, 28.00, 28.00, '2024-08-27 13:00:00', '2024-08-27 13:00:00'),
(208, 94, 23, 1.00, 30.00, 30.00, '2024-08-28 14:00:00', '2024-08-28 14:00:00'),
(209, 95, 12, 1.00, 160.00, 160.00, '2024-08-29 15:00:00', '2024-08-29 15:00:00'),
(210, 96, 91, 1.00, 29.00, 29.00, '2024-08-30 16:00:00', '2024-08-30 16:00:00'),
(211, 97, 67, 1.00, 75.00, 75.00, '2024-09-01 17:00:00', '2024-09-01 17:00:00'),
(212, 98, 102, 1.00, 95.00, 95.00, '2024-09-02 18:00:00', '2024-09-02 18:00:00'),
(213, 99, 41, 2.00, 25.00, 50.00, '2024-09-03 19:00:00', '2024-09-03 19:00:00'),
(214, 100, 68, 1.00, 60.00, 60.00, '2024-09-04 10:00:00', '2024-09-04 10:00:00'),
(215, 101, 10, 1.00, 49.90, 35.00, '2024-09-05 11:00:00', '2024-09-05 11:00:00'),
(216, 102, 90, 1.00, 18.00, 18.00, '2024-09-06 12:00:00', '2024-09-06 12:00:00'),
(217, 103, 5, 1.00, 120.00, 120.00, '2024-09-07 13:00:00', '2024-09-07 13:00:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Índices de tabela `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clientes_cpf_cnpj_unique` (`cpf_cnpj`),
  ADD UNIQUE KEY `clientes_email_unique` (`email`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Índices de tabela `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Índices de tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `veiculos_placa_unique` (`placa`),
  ADD KEY `veiculos_cliente_id_foreign` (`cliente_id`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendas_cliente_id_foreign` (`cliente_id`),
  ADD KEY `vendas_veiculo_id_foreign` (`veiculo_id`);

--
-- Índices de tabela `venda_items`
--
ALTER TABLE `venda_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venda_items_venda_id_foreign` (`venda_id`),
  ADD KEY `venda_items_produto_id_foreign` (`produto_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `venda_items`
--
ALTER TABLE `venda_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `veiculos`
--
ALTER TABLE `veiculos`
  ADD CONSTRAINT `veiculos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vendas_veiculo_id_foreign` FOREIGN KEY (`veiculo_id`) REFERENCES `veiculos` (`id`) ON DELETE SET NULL;

--
-- Restrições para tabelas `venda_items`
--
ALTER TABLE `venda_items`
  ADD CONSTRAINT `venda_items_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `venda_items_venda_id_foreign` FOREIGN KEY (`venda_id`) REFERENCES `vendas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
