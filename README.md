# hm-mvc
Projeto implementando padrão MVC simples com PHP.

hm-mvc -> config -> config.php

Para funcionar corretamente deve ser configurado as variáveis globais de acordo com o seu ambiente.

Banco de dados

--
-- Banco de dados: `hotmilhas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `contas`
--

CREATE TABLE `contas` (
  `id` int(10) UNSIGNED NOT NULL,
  `banco` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `transacoes`
--

CREATE TABLE `transacoes` (
  `id` int(10) UNSIGNED NOT NULL,
  `conta_id` int(10) UNSIGNED NOT NULL,
  `data_prevista` date NOT NULL,
  `valor` double NOT NULL,
  `status` int(11) NOT NULL,
  `data_realizada` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarioConta`
--

CREATE TABLE `usuarioConta` (
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `conta_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `CPF` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices de tabela `contas`
--
ALTER TABLE `contas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `transacoes`
--
ALTER TABLE `transacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conta_id` (`conta_id`);

--
-- Índices de tabela `usuarioConta`
--
ALTER TABLE `usuarioConta`
  ADD KEY `usuario_id_fk` (`usuario_id`),
  ADD KEY `conta_id_fk` (`conta_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabela `contas`
--
ALTER TABLE `contas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `transacoes`
--
ALTER TABLE `transacoes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas `transacoes`
--
ALTER TABLE `transacoes`
  ADD CONSTRAINT `conta_id` FOREIGN KEY (`conta_id`) REFERENCES `contas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Restrições para tabelas `usuarioConta`
--
ALTER TABLE `usuarioConta`
  ADD CONSTRAINT `conta_id_fk` FOREIGN KEY (`conta_id`) REFERENCES `contas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_id_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
