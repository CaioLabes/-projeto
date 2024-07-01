-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Tempo de geração: 01/07/2024 às 15:06
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto_php`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `receitas`
--

CREATE TABLE `receitas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(225) NOT NULL,
  `descricao` text NOT NULL,
  `categoria` varchar(16) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `receitas`
--

INSERT INTO `receitas` (`id`, `titulo`, `descricao`, `categoria`, `usuario_id`) VALUES
(1, 'Molho', '1 colher (chá) de gengibre\r\n1 dente de alho\r\n1/4 xícara (chá) de vinagre de arroz\r\n3 colheres (sopa) de mel\r\n2 colheres (sopa) de óleo de gergelim\r\n3 colheres (sopa) de shoyu\r\n1 limão\r\n1 colher (chá) de pimenta calabresa\r\n1 colher (sopa) de gergelim\r\n1/4 xícara (chá) de azeite\r\n', 'Salgada', 5),
(2, 'Molho', '1 colher (chá) de gengibre\r\n1 dente de alho\r\n1/4 xícara (chá) de vinagre de arroz\r\n3 colheres (sopa) de mel\r\n2 colheres (sopa) de óleo de gergelim\r\n3 colheres (sopa) de shoyu\r\n1 limão\r\n1 colher (chá) de pimenta calabresa\r\n1 colher (sopa) de gergelim\r\n1/4 xícara (chá) de azeite\r\n', 'Salgada', 5),
(12, 'Bolo de Cenoura', 'Receita de Bolo de Cenoura\r\n\r\nMassa:\r\nEm um liquidificador, adicione a cenoura, os ovos e o óleo, depois misture.\r\n\r\nAcrescente o açúcar e bata novamente por 5 minutos.\r\n\r\nEm uma tigela ou na batedeira, adicione a farinha de trigo e depois misture novamente.\r\n\r\nAcrescente o fermento e misture lentamente com uma colher.\r\n\r\nAsse em um forno preaquecido a 180°C por aproximadamente 40 minutos.\r\n\r\nCobertura:\r\nDespeje em uma tigela a manteiga, o chocolate em pó, o açúcar e o leite, depois misture.\r\n\r\nLeve a mistura ao fogo e continue misturando até obter uma consistência cremosa, depois despeje a calda por cima do bolo.', 'Doce', 6),
(13, 'fg', 'hg', 'Doce', 6),
(14, 'Molho', 'g', 'Doce', 6),
(15, 'Receita milenar da Laurita', 'Torta de Churros', 'Doce', 8),
(16, 'Molho', 'Torta de Churros Salgado', 'Salgada', 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `cod` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`cod`, `usuario`, `nome`, `senha`) VALUES
(5, '123', 'po', '$2y$10$Yn76JTAZ0V59/AdrN4guDOiqV180flWPtWWNXTLNRywtORhbcCCfO'),
(6, 'victor', 'victor', '$2y$10$eoVrJr3jPl6I8IX1GguQZOVGoz4sQXDXOMIRly.E5Uzhpj6C8kpgu'),
(7, 'Lu', 'Luana', '$2y$10$WNSVfhBtwTA4239haKhyeeNCww55ab7VFLnrgRHV18imn.VBTW5xS'),
(8, 'jorge', 'Jorge Jesus', '$2y$10$3BPyQbtLEYo5qhA7YRrZpudlOGXEdLDQk3vGHIPvJM0jYil11HGo2');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `receitas`
--
ALTER TABLE `receitas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cod`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `receitas`
--
ALTER TABLE `receitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
