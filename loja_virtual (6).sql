-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Jul-2018 às 23:35
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loja_virtual`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja_adm`
--

CREATE TABLE `loja_adm` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `sobrenome` varchar(200) NOT NULL,
  `email_log` varchar(200) NOT NULL,
  `senha_log` varchar(200) NOT NULL,
  `data_log` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `loja_adm`
--

INSERT INTO `loja_adm` (`id`, `nome`, `sobrenome`, `email_log`, `senha_log`, `data_log`) VALUES
(1, 'Thiago', 'Gonçalves', 'tgs.silva500@gmail.com', 'tgsilva3541', '2018-07-10 16:00:42');

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja_banner`
--

CREATE TABLE `loja_banner` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `imagem` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja_categorias`
--

CREATE TABLE `loja_categorias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `loja_categorias`
--

INSERT INTO `loja_categorias` (`id`, `titulo`, `slug`, `views`) VALUES
(1, 'Smartphones', 'smartphones', 19),
(2, 'Notebooks', 'notebooks', 49),
(3, 'Acessorios', 'acessorios', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja_clientes`
--

CREATE TABLE `loja_clientes` (
  `id_cliente` int(11) NOT NULL,
  `imagem` varchar(150) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `sobrenome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `rua` varchar(200) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(150) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cep` varchar(30) NOT NULL,
  `email_log` varchar(200) NOT NULL,
  `senha_log` varchar(50) NOT NULL,
  `data_log` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `loja_clientes`
--

INSERT INTO `loja_clientes` (`id_cliente`, `imagem`, `nome`, `sobrenome`, `email`, `telefone`, `cpf`, `rua`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `cep`, `email_log`, `senha_log`, `data_log`) VALUES
(1, 'imagem.jpg', 'Thiago', 'Gonçalves', 'tgs.silva500@gmail.com', '(15)3232-3232', '11111111111', 'teste', 123, 'teste', 'teste', 'teste', 'SP', '18117000', 'tgs.silva500@gmail.com', 'thiagogonc20', '2018-07-10 16:00:09'),
(2, 'teste.jpg', 'João', 'Camargo', 'joao@gmail.com', '153333333', '11111111111', 'aaaa', 444, 'aaa', 'aaa', 'aa', 'sp', '18117352', 'joao@gmail.com', 'joao', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja_configs`
--

CREATE TABLE `loja_configs` (
  `manutencao` int(11) NOT NULL,
  `visitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `loja_configs`
--

INSERT INTO `loja_configs` (`manutencao`, `visitas`) VALUES
(0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja_cores`
--

CREATE TABLE `loja_cores` (
  `id` int(11) NOT NULL,
  `cor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja_imgprod`
--

CREATE TABLE `loja_imgprod` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `loja_imgprod`
--

INSERT INTO `loja_imgprod` (`id`, `id_produto`, `img`) VALUES
(1, 1, 'imagem-big.jpg'),
(2, 1, 'imagem-big.jpg'),
(3, 1, 'imagem-big.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja_pedidos`
--

CREATE TABLE `loja_pedidos` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `valor_total` decimal(10,5) NOT NULL,
  `status` int(11) NOT NULL,
  `criado` datetime NOT NULL,
  `modificado` datetime NOT NULL,
  `tipo_frete` varchar(20) NOT NULL,
  `valor_frete` decimal(10,5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `loja_pedidos`
--

INSERT INTO `loja_pedidos` (`id`, `id_cliente`, `valor_total`, `status`, `criado`, `modificado`, `tipo_frete`, `valor_frete`) VALUES
(54, 1, '500.00000', 1, '2018-06-23 00:00:00', '2018-04-15 00:00:00', 'sedex', '20.30000'),
(55, 1, '502.00000', 2, '2018-05-23 00:00:00', '2018-03-15 00:00:00', 'pac', '15.40000'),
(56, 1, '502.00000', 1, '2018-04-23 00:00:00', '2017-12-01 19:55:06', 'sedex', '15.40000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja_produtos`
--

CREATE TABLE `loja_produtos` (
  `id` int(11) NOT NULL,
  `img_padrao` varchar(200) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `subcategoria` varchar(50) NOT NULL,
  `valor_anterior` decimal(10,5) NOT NULL,
  `valor_atual` decimal(10,5) NOT NULL,
  `descricao` text NOT NULL,
  `peso` varchar(50) NOT NULL,
  `estoque` int(11) NOT NULL,
  `qtdVendidos` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `loja_produtos`
--

INSERT INTO `loja_produtos` (`id`, `img_padrao`, `titulo`, `slug`, `categoria`, `subcategoria`, `valor_anterior`, `valor_atual`, `descricao`, `peso`, `estoque`, `qtdVendidos`, `data`) VALUES
(1, 'smartphones/s8.jpg', 'Smartphone Samsung Galaxy S8', 'smartphone Samsung Galaxy S8', 'Smartphones', 'Samsung', '1999.00000', '1599.00000', 'teste', '0.20', 58, 42, '0000-00-00 00:00:00'),
(2, 'notebooks/asus.jpg', 'Notebook Asus', 'notebook asus', 'Notebooks', 'Asus', '10.00000', '1.00000', 'teste', '0,200', 91, 9, '0000-00-00 00:00:00'),
(4, 'smartphones/iphone8.jpg', 'Iphone 8', 'iphone 8', 'Smartphones', 'Apple', '3999.00000', '3599.00000', '', '', -2, 2, '0000-00-00 00:00:00'),
(5, 'smartphones/s8.jpg', 'smartphone', '', '1', '2', '1559.00000', '899.00000', '', '', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja_produtos_pedidos`
--

CREATE TABLE `loja_produtos_pedidos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `tamanho` varchar(50) NOT NULL,
  `cor` varchar(50) NOT NULL,
  `qtd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `loja_produtos_pedidos`
--

INSERT INTO `loja_produtos_pedidos` (`id`, `id_pedido`, `id_produto`, `tamanho`, `cor`, `qtd`) VALUES
(24, 17, 1, '', '', 1),
(25, 18, 1, '', '', 1),
(26, 19, 1, '', '', 1),
(27, 20, 1, '', '', 1),
(28, 21, 1, '', '', 1),
(29, 22, 2, '', '', 1),
(30, 23, 2, '', '', 1),
(31, 24, 1, '', '', 1),
(32, 25, 1, '', '', 1),
(33, 26, 1, '', '', 1),
(34, 27, 1, '', '', 1),
(35, 28, 1, '', '', 1),
(36, 29, 1, '', '', 1),
(37, 30, 1, '', '', 2),
(38, 31, 1, '', '', 1),
(39, 32, 1, '', '', 2),
(40, 33, 1, '', '', 6),
(41, 34, 1, '', '', 5),
(42, 35, 1, '', '', 3),
(43, 36, 1, '', '', 1),
(44, 37, 1, '', '', 2),
(45, 38, 1, '', '', 1),
(46, 39, 1, '', '', 2),
(47, 40, 1, '', '', 1),
(48, 41, 1, '', '', 1),
(49, 42, 4, '', '', 1),
(50, 42, 0, '', '', 1),
(51, 43, 4, '', '', 1),
(52, 43, 0, '', '', 1),
(53, 44, 1, '', '', 1),
(54, 45, 2, '', '', 2),
(55, 46, 2, '', '', 1),
(56, 47, 2, '', '', 1),
(57, 51, 1, '', '', 1),
(58, 52, 2, '', '', 1),
(59, 53, 2, '', '', 1),
(60, 53, 0, '', '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja_produtos_tamanhos`
--

CREATE TABLE `loja_produtos_tamanhos` (
  `id_produto` int(11) NOT NULL,
  `id_tamanho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja_produto_cores`
--

CREATE TABLE `loja_produto_cores` (
  `id_produto` int(11) NOT NULL,
  `id_cor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja_subcategorias`
--

CREATE TABLE `loja_subcategorias` (
  `id` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `loja_subcategorias`
--

INSERT INTO `loja_subcategorias` (`id`, `id_cat`, `titulo`, `slug`, `views`) VALUES
(1, 1, 'Samsung', 'samsung', 20),
(2, 3, 'Mouse Gamer', 'mouse gamer', 30),
(3, 0, 'Apple', 'apple', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja_tamanhos`
--

CREATE TABLE `loja_tamanhos` (
  `id` int(11) NOT NULL,
  `tamanho` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja_ticketresposta`
--

CREATE TABLE `loja_ticketresposta` (
  `id` int(11) NOT NULL,
  `id_ticket` int(11) NOT NULL,
  `resposta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja_tickets`
--

CREATE TABLE `loja_tickets` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `pergunta` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `modificado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loja_adm`
--
ALTER TABLE `loja_adm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loja_banner`
--
ALTER TABLE `loja_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loja_categorias`
--
ALTER TABLE `loja_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loja_clientes`
--
ALTER TABLE `loja_clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `loja_cores`
--
ALTER TABLE `loja_cores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loja_imgprod`
--
ALTER TABLE `loja_imgprod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loja_pedidos`
--
ALTER TABLE `loja_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loja_produtos`
--
ALTER TABLE `loja_produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loja_produtos_pedidos`
--
ALTER TABLE `loja_produtos_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loja_subcategorias`
--
ALTER TABLE `loja_subcategorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loja_tamanhos`
--
ALTER TABLE `loja_tamanhos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loja_ticketresposta`
--
ALTER TABLE `loja_ticketresposta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loja_tickets`
--
ALTER TABLE `loja_tickets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loja_adm`
--
ALTER TABLE `loja_adm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `loja_banner`
--
ALTER TABLE `loja_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loja_categorias`
--
ALTER TABLE `loja_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `loja_clientes`
--
ALTER TABLE `loja_clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `loja_cores`
--
ALTER TABLE `loja_cores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loja_imgprod`
--
ALTER TABLE `loja_imgprod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `loja_pedidos`
--
ALTER TABLE `loja_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `loja_produtos`
--
ALTER TABLE `loja_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `loja_produtos_pedidos`
--
ALTER TABLE `loja_produtos_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `loja_subcategorias`
--
ALTER TABLE `loja_subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `loja_tamanhos`
--
ALTER TABLE `loja_tamanhos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loja_ticketresposta`
--
ALTER TABLE `loja_ticketresposta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loja_tickets`
--
ALTER TABLE `loja_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
