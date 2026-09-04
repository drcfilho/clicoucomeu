-- Backup Clicou Comeu
-- Gerado em: 2026-09-04 19:51:22

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `adicionais`;
CREATE TABLE `adicionais` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `grupo_id` bigint unsigned NOT NULL,
  `nome` varchar(120) NOT NULL,
  `preco` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ordem` int NOT NULL DEFAULT '0',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_adicionais_tenant` (`tenant_id`),
  KEY `fk_adicionais_grupo` (`grupo_id`),
  CONSTRAINT `fk_adicionais_grupo` FOREIGN KEY (`grupo_id`) REFERENCES `grupos_adicionais` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_adicionais_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('147', '5', '12', 'Pequena', '0.00', '1', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('148', '5', '12', 'Média', '5.00', '2', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('149', '5', '12', 'Grande', '10.00', '3', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('150', '5', '13', 'Sim', '0.00', '1', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('151', '5', '13', 'Não', '0.00', '2', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('152', '5', '14', 'Sem Borda', '0.00', '1', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('153', '5', '14', 'Catupiry', '0.00', '2', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('154', '5', '14', 'Cheddar', '5.00', '3', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('155', '5', '14', 'Cream Cheese', '7.00', '4', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('156', '5', '14', 'Chocolate', '6.00', '5', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('157', '5', '14', 'Doce de leite', '6.00', '6', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('158', '5', '15', 'Azeitona', '3.00', '1', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('159', '5', '15', 'Bacon', '3.00', '2', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('160', '5', '15', 'Carne Moída', '4.00', '3', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('161', '5', '15', 'Carne Seca', '5.00', '4', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('162', '5', '15', 'Catupiry', '2.00', '5', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('163', '5', '15', 'Cebola', '2.00', '6', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('164', '5', '15', 'Cream Cheease', '4.00', '7', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('165', '5', '15', 'Frango', '5.00', '8', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('166', '5', '15', 'Lombo', '6.00', '9', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('167', '5', '15', 'Milho', '2.00', '10', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('168', '5', '15', 'Ovo', '1.00', '11', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('169', '5', '15', 'Pimentão', '1.00', '12', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('170', '5', '15', 'Presunto', '3.00', '13', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('171', '5', '15', 'Queijo', '4.00', '14', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('172', '5', '15', 'Tomate', '2.00', '15', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('173', '5', '15', 'Filé Mignon', '5.00', '16', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('174', '5', '12', '350ml (Lata)', '5.50', '1', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('175', '5', '12', '600ml', '7.00', '2', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('176', '5', '12', '1 L', '8.00', '3', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('177', '5', '12', '1.5 L', '12.00', '4', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('178', '5', '12', '2 L', '15.00', '5', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('179', '5', '16', 'Coca', '0.00', '1', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('180', '5', '16', 'Guaraná', '0.00', '2', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('181', '5', '16', 'Pepsi (somente em litro)', '0.00', '3', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('182', '5', '17', 'Mussarela', '31.00', '1', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('183', '5', '17', 'Calabresa', '32.00', '2', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('184', '5', '17', 'Mista', '33.00', '3', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('185', '5', '17', 'Bauru', '33.00', '4', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('186', '5', '17', 'Caipira', '34.00', '5', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('187', '5', '17', 'Frango com Catupiry', '34.00', '6', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('188', '5', '17', 'Portuguesa', '34.00', '7', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('189', '5', '17', 'Baiana', '35.00', '8', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('190', '5', '17', '3 Queijos', '35.00', '9', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('191', '5', '17', 'Carne Seca', '36.00', '10', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('192', '5', '17', 'Lasanha', '36.00', '11', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('193', '5', '17', 'Tradicional', '35.00', '12', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('194', '5', '17', 'Camarão', '40.00', '13', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('195', '5', '17', 'Bacon', '33.00', '14', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('196', '5', '17', 'Moda do Chef', '40.00', '15', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('197', '5', '17', 'Bruta de Frango', '41.00', '16', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('198', '5', '17', 'Calabresa Cremosa', '37.00', '17', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('199', '5', '17', 'Camarão especial', '42.00', '18', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('200', '5', '17', 'Cearense', '41.00', '19', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('201', '5', '17', 'Cruzense', '42.00', '20', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('202', '5', '17', 'Nordestina', '42.00', '21', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('203', '5', '17', 'Portuguesa Especial', '42.00', '22', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('204', '5', '17', 'File Mignon', '42.00', '23', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('205', '5', '17', 'Pizza Cum Cum', '41.00', '24', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('206', '5', '17', 'Monte sua pizza', '41.00', '25', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('207', '5', '15', 'Cheddar', '4.00', '1', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('208', '5', '15', 'Cream Cheese', '4.00', '2', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('209', '5', '15', 'Pimenta cereja', '4.00', '3', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('210', '5', '15', 'Carne Moida', '4.00', '1', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('211', '5', '18', 'Milho', '0.00', '1', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('212', '5', '18', 'Queijo', '0.00', '2', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('213', '5', '18', 'Carne Seca', '0.00', '3', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('214', '5', '18', 'Carne Moida', '0.00', '4', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('215', '5', '18', 'Ovo', '0.00', '5', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('216', '5', '18', 'Bacon', '0.00', '6', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('217', '5', '18', 'Lombo', '0.00', '7', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('218', '5', '18', 'Presunto', '0.00', '8', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('219', '5', '18', 'Frango', '0.00', '9', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('220', '5', '18', 'Cream Cheease', '0.00', '10', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('221', '5', '18', 'Catupiry', '0.00', '11', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('222', '5', '18', 'Azeitona', '0.00', '12', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('223', '5', '18', 'Cebola', '0.00', '13', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('224', '5', '18', 'Tomate', '0.00', '14', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('225', '5', '18', 'Pimentão', '0.00', '15', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('226', '5', '18', 'Filé Mignon', '0.00', '16', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('227', '5', '19', 'Normal', '0.00', '1', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('228', '5', '19', 'Zero', '0.00', '2', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('229', '5', '12', 'Lata 350', '5.50', '1', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('230', '5', '12', '600 ml', '7.00', '2', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('231', '5', '12', '1 litro e meio', '12.00', '3', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('232', '5', '12', '2 litros', '15.00', '4', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');

DROP TABLE IF EXISTS `bairros`;
CREATE TABLE `bairros` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `nome` varchar(120) NOT NULL,
  `taxa_entrega` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pedido_minimo` decimal(10,2) DEFAULT NULL,
  `tempo_estimado_min` int DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `ordem` int NOT NULL DEFAULT '0',
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_bairros_tenant` (`tenant_id`),
  CONSTRAINT `fk_bairros_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('49', '5', 'Centro', '0.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('50', '5', 'Aningas', '2.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('51', '5', 'Canema', '2.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('52', '5', 'Conjunto São Raimundo', '2.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('53', '5', 'Malvinas', '2.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('54', '5', 'Conjunto São Miguel', '3.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('55', '5', 'Massaranduba', '5.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('56', '5', 'Belém', '6.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('57', '5', 'Correguinho dos Muniz', '6.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('58', '5', 'Jenipapeiro', '6.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('59', '5', 'Lagoa Salgada', '6.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('60', '5', 'Lagoa Velha', '7.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('61', '5', 'Espinhos', '7.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('62', '5', 'Guarda', '7.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('63', '5', 'Correguinho dos Silva', '8.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('64', '5', 'Lagoa velha (depois do Concreto)', '8.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('65', '5', 'Pitombeiras', '8.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('66', '5', 'Tucuns', '3.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('67', '5', 'Conjunto São Francisco', '2.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('68', '5', 'Conjunto Nova Cruz', '6.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('69', '5', 'Vila Olimpica (Proximidade)', '4.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('70', '5', 'Imbé', '11.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('71', '5', 'Poços', '3.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('72', '5', 'Brasilia', '2.00', NULL, NULL, '1', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `nome` varchar(120) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `ordem` int NOT NULL DEFAULT '0',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_categorias_tenant_ordem` (`tenant_id`,`ordem`),
  CONSTRAINT `fk_categorias_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `categorias` (`id`, `tenant_id`, `nome`, `descricao`, `imagem`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('22', '5', '🍕Pizzas Tradicionais', 'A tradição em sabores de pizzas', NULL, '1', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `categorias` (`id`, `tenant_id`, `nome`, `descricao`, `imagem`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('23', '5', '🍕Pizzas Doces', 'Quem resiste a uma pizza doce', NULL, '3', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `categorias` (`id`, `tenant_id`, `nome`, `descricao`, `imagem`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('24', '5', '🍕Pizzas Premium', 'Aquelas pizza premium', NULL, '2', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `categorias` (`id`, `tenant_id`, `nome`, `descricao`, `imagem`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('25', '5', '🌮Esfirras', 'Esfirras com os melhores ingredientes', NULL, '5', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `categorias` (`id`, `tenant_id`, `nome`, `descricao`, `imagem`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('26', '5', '🌮Esfirras Doces', 'Esfirras + doce, o que poderia dá errado?', NULL, '6', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `categorias` (`id`, `tenant_id`, `nome`, `descricao`, `imagem`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('27', '5', '🧋Bebidas', 'Opções de bebidas sempre geladas', NULL, '7', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `categorias` (`id`, `tenant_id`, `nome`, `descricao`, `imagem`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('28', '5', '🍕Pizzas dois sabores', 'E porque não dois Sabores?', NULL, '4', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `nome` varchar(150) NOT NULL,
  `whatsapp` varchar(30) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_clientes_tenant_whatsapp` (`tenant_id`,`whatsapp`),
  CONSTRAINT `fk_clientes_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `clientes` (`id`, `tenant_id`, `nome`, `whatsapp`, `email`, `criado_em`, `atualizado_em`) VALUES ('1', '1', 'Daniel', '88999999999', NULL, '2026-09-03 14:43:31', '2026-09-03 14:43:31');
INSERT INTO `clientes` (`id`, `tenant_id`, `nome`, `whatsapp`, `email`, `criado_em`, `atualizado_em`) VALUES ('2', '1', 'Teste Bypass', '88988887777', NULL, '2026-09-03 14:46:16', '2026-09-03 14:46:16');
INSERT INTO `clientes` (`id`, `tenant_id`, `nome`, `whatsapp`, `email`, `criado_em`, `atualizado_em`) VALUES ('3', '1', 'Daniel', '88997114302', NULL, '2026-09-04 10:27:16', '2026-09-04 12:06:43');

DROP TABLE IF EXISTS `configuracoes`;
CREATE TABLE `configuracoes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `chave` varchar(120) NOT NULL,
  `valor` text,
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_config_tenant_chave` (`tenant_id`,`chave`),
  CONSTRAINT `fk_config_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('135', '5', 'nome_empresa', 'Pizzaria Piemonte', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('136', '5', 'slogan', 'A melhor pizza caseira de Cruz', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('137', '5', 'logo_url', 'https://clicoucomeu.com.br/cardapios/piemonte/logo.jpeg', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('138', '5', 'favicon_url', 'https://clicoucomeu.com.br/cardapios/piemonte/pizzaicon.webp', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('139', '5', 'cor_primaria', '#b47e11', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('140', '5', 'cor_secundaria', '#935711', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('141', '5', 'cor_terciaria', '#d0a43b', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('142', '5', 'cor_fundo', '#f7e8a7', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('143', '5', 'cor_texto', '#56624c', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('144', '5', 'cor_texto_secundario', '#56624c', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('145', '5', 'cor_primaria_escura', '#99865f', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('146', '5', 'cor_secundaria_escura', '#6f765e', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('147', '5', 'cor_terciaria_escura', '#505d4a', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('148', '5', 'endereco_completo', 'Av 14 de janeiro, 40 - Centro, Cruz - CE', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('149', '5', 'telefone', '(88) 9 9653-1718', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('150', '5', 'whatsapp', '558896531718', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('151', '5', 'email', 'daviizinho23@gmail.com', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('152', '5', 'instagram_url', '#-sua-url-do-instagram', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('153', '5', 'facebook_url', '#-sua-url-do-facebook', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('154', '5', 'google_negocio_url', '#-sua-url-do-google', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('155', '5', 'titulo_pagina', 'Cardápio Online – Pizzaria Piemonte', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('156', '5', 'descricao_seo', 'Pizzaria especializada e com os melhores ingredientes', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('157', '5', 'palavras_chave', 'cruz, Pizzaria, Esfirras', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('158', '5', 'step2_opc1', 'Não / Consumo no Local/ Seu pedido será entregue à mesa', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('159', '5', 'step2_opc2', 'Sim / Retirada no Local / Retire seu pedido no balcão', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('160', '5', 'step2_opc3', 'Sim / Delivery / Entregamos em seu endereço', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('161', '5', 'step2_opc4', 'Não / Entrega Padrão / Consulte formas de entrega com o vendedor', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('162', '5', 'step2_taxa_delivery', 'Pergunte ao Atendente via WhatsApp', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('163', '5', 'step3_show_formas_pag', 'Sim', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('164', '5', 'step3_formas_pag', 'Pix, Dinheiro, Cartão de Crédito, Cartão de Débito', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('165', '5', 'step3_chave_pix', '61465122000148', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('166', '5', 'step3_mesa_comanda', 'Sim', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('167', '5', 'step1_itens_obs', 'Sim', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('168', '5', 'orders_all_time', 'Sim', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('169', '5', 'valor_pedido_minimo', '20', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('170', '5', 'only_bairro_mode', 'Sim', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('171', '5', 'checkout_mode', 'Sim', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('172', '5', 'checkout_currency', 'BRL', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('173', '5', 'whatsapp_web', 'Sim', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('174', '5', 'webhook_url', '', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('175', '5', 'autor_name', 'Daniel Filho', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('176', '5', 'autor_link', 'www.clicoucomeu.com.br', '2026-09-04 15:39:17', '2026-09-04 15:39:17');

DROP TABLE IF EXISTS `cupons`;
CREATE TABLE `cupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `tipo` enum('percentual','valor','frete_gratis') NOT NULL,
  `valor` decimal(10,2) NOT NULL DEFAULT '0.00',
  `valor_minimo` decimal(10,2) DEFAULT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `data_fim` datetime DEFAULT NULL,
  `limite_usos` int DEFAULT NULL,
  `usos` int NOT NULL DEFAULT '0',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_cupom_tenant_codigo` (`tenant_id`,`codigo`),
  CONSTRAINT `fk_cupons_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `cupons` (`id`, `tenant_id`, `codigo`, `tipo`, `valor`, `valor_minimo`, `data_inicio`, `data_fim`, `limite_usos`, `usos`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('9', '5', 'PIEMONTE10', '', '10.00', NULL, NULL, NULL, NULL, '0', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `cupons` (`id`, `tenant_id`, `codigo`, `tipo`, `valor`, `valor_minimo`, `data_inicio`, `data_fim`, `limite_usos`, `usos`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('10', '5', 'TOTAL5', '', '5.00', NULL, NULL, NULL, NULL, '0', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `cupons` (`id`, `tenant_id`, `codigo`, `tipo`, `valor`, `valor_minimo`, `data_inicio`, `data_fim`, `limite_usos`, `usos`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('11', '5', 'FRETEGRATIS', '', '100.00', NULL, NULL, NULL, NULL, '0', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `cupons` (`id`, `tenant_id`, `codigo`, `tipo`, `valor`, `valor_minimo`, `data_inicio`, `data_fim`, `limite_usos`, `usos`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('12', '5', 'OFERTA20', '', '20.00', NULL, NULL, NULL, NULL, '0', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `cupons` (`id`, `tenant_id`, `codigo`, `tipo`, `valor`, `valor_minimo`, `data_inicio`, `data_fim`, `limite_usos`, `usos`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('13', '5', 'ENTREGA50', '', '50.00', NULL, NULL, NULL, NULL, '0', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `cupons` (`id`, `tenant_id`, `codigo`, `tipo`, `valor`, `valor_minimo`, `data_inicio`, `data_fim`, `limite_usos`, `usos`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('14', '5', 'OFERTA30R', '', '30.00', NULL, NULL, NULL, NULL, '0', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `cupons` (`id`, `tenant_id`, `codigo`, `tipo`, `valor`, `valor_minimo`, `data_inicio`, `data_fim`, `limite_usos`, `usos`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('15', '5', 'PIZZA10', '', '10.00', NULL, NULL, NULL, NULL, '0', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `cupons` (`id`, `tenant_id`, `codigo`, `tipo`, `valor`, `valor_minimo`, `data_inicio`, `data_fim`, `limite_usos`, `usos`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('16', '5', '10SAVIA', '', '10.00', NULL, NULL, NULL, NULL, '0', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');

DROP TABLE IF EXISTS `enderecos`;
CREATE TABLE `enderecos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `cliente_id` bigint unsigned NOT NULL,
  `bairro_id` bigint unsigned DEFAULT NULL,
  `logradouro` varchar(180) NOT NULL,
  `numero` varchar(30) DEFAULT NULL,
  `complemento` varchar(120) DEFAULT NULL,
  `referencia` varchar(180) DEFAULT NULL,
  `cep` varchar(12) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_enderecos_tenant` (`tenant_id`),
  KEY `fk_enderecos_cliente` (`cliente_id`),
  KEY `fk_enderecos_bairro` (`bairro_id`),
  CONSTRAINT `fk_enderecos_bairro` FOREIGN KEY (`bairro_id`) REFERENCES `bairros` (`id`),
  CONSTRAINT `fk_enderecos_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_enderecos_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `formas_pagamento`;
CREATE TABLE `formas_pagamento` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tipo` enum('dinheiro','pix','credito','debito','outro') NOT NULL,
  `pedir_troco` tinyint(1) NOT NULL DEFAULT '0',
  `dados_pix` text,
  `ordem` int NOT NULL DEFAULT '0',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_pagamentos_tenant` (`tenant_id`),
  CONSTRAINT `fk_pagamentos_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `formas_pagamento` (`id`, `tenant_id`, `nome`, `tipo`, `pedir_troco`, `dados_pix`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('1', '1', 'Pix', 'pix', '0', '56945124304', '1', '1', '2026-09-03 13:58:21', '2026-09-04 11:48:58');
INSERT INTO `formas_pagamento` (`id`, `tenant_id`, `nome`, `tipo`, `pedir_troco`, `dados_pix`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('2', '1', 'Dinheiro', 'dinheiro', '1', NULL, '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `formas_pagamento` (`id`, `tenant_id`, `nome`, `tipo`, `pedir_troco`, `dados_pix`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('3', '1', 'Cartão de Crédito', 'outro', '0', NULL, '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `formas_pagamento` (`id`, `tenant_id`, `nome`, `tipo`, `pedir_troco`, `dados_pix`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('4', '1', 'Cartão de Débito', 'outro', '0', NULL, '4', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');

DROP TABLE IF EXISTS `grupos_adicionais`;
CREATE TABLE `grupos_adicionais` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `nome` varchar(120) NOT NULL,
  `minimo` int NOT NULL DEFAULT '0',
  `maximo` int NOT NULL DEFAULT '1',
  `obrigatorio` tinyint(1) NOT NULL DEFAULT '0',
  `ordem` int NOT NULL DEFAULT '0',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_grupos_tenant` (`tenant_id`),
  CONSTRAINT `fk_grupos_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `grupos_adicionais` (`id`, `tenant_id`, `nome`, `minimo`, `maximo`, `obrigatorio`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('12', '5', 'Tamanho', '1', '1', '1', '1', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `grupos_adicionais` (`id`, `tenant_id`, `nome`, `minimo`, `maximo`, `obrigatorio`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('13', '5', 'Azeitona', '0', '1', '0', '2', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `grupos_adicionais` (`id`, `tenant_id`, `nome`, `minimo`, `maximo`, `obrigatorio`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('14', '5', 'Borda', '0', '1', '0', '3', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `grupos_adicionais` (`id`, `tenant_id`, `nome`, `minimo`, `maximo`, `obrigatorio`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('15', '5', 'Adicionais', '0', '5', '0', '4', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `grupos_adicionais` (`id`, `tenant_id`, `nome`, `minimo`, `maximo`, `obrigatorio`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('16', '5', 'Sabor', '0', '1', '0', '5', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `grupos_adicionais` (`id`, `tenant_id`, `nome`, `minimo`, `maximo`, `obrigatorio`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('17', '5', 'Escolha os Sabores', '1', '2', '1', '6', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `grupos_adicionais` (`id`, `tenant_id`, `nome`, `minimo`, `maximo`, `obrigatorio`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('18', '5', 'Ingredientes', '0', '4', '0', '7', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `grupos_adicionais` (`id`, `tenant_id`, `nome`, `minimo`, `maximo`, `obrigatorio`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('19', '5', 'Tipo', '0', '1', '0', '8', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');

DROP TABLE IF EXISTS `horarios_funcionamento`;
CREATE TABLE `horarios_funcionamento` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `dia_semana` tinyint NOT NULL,
  `abertura` time DEFAULT NULL,
  `fechamento` time DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_horarios_tenant_dia` (`tenant_id`,`dia_semana`),
  CONSTRAINT `fk_horarios_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `horarios_funcionamento` (`id`, `tenant_id`, `dia_semana`, `abertura`, `fechamento`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('15', '5', '1', '18:00:00', '22:00:00', '0', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `horarios_funcionamento` (`id`, `tenant_id`, `dia_semana`, `abertura`, `fechamento`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('16', '5', '2', '18:00:00', '22:00:00', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `horarios_funcionamento` (`id`, `tenant_id`, `dia_semana`, `abertura`, `fechamento`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('17', '5', '3', '18:00:00', '22:00:00', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `horarios_funcionamento` (`id`, `tenant_id`, `dia_semana`, `abertura`, `fechamento`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('18', '5', '4', '18:00:00', '22:00:00', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `horarios_funcionamento` (`id`, `tenant_id`, `dia_semana`, `abertura`, `fechamento`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('19', '5', '5', '18:00:00', '22:00:00', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `horarios_funcionamento` (`id`, `tenant_id`, `dia_semana`, `abertura`, `fechamento`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('20', '5', '6', '18:00:00', '22:00:00', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `horarios_funcionamento` (`id`, `tenant_id`, `dia_semana`, `abertura`, `fechamento`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('21', '5', '0', '18:00:00', '22:00:00', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');

DROP TABLE IF EXISTS `pedido_historico_status`;
CREATE TABLE `pedido_historico_status` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `pedido_id` bigint unsigned NOT NULL,
  `usuario_id` bigint unsigned DEFAULT NULL,
  `status_anterior` varchar(40) DEFAULT NULL,
  `status_novo` varchar(40) NOT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_hist_tenant` (`tenant_id`),
  KEY `fk_hist_pedido` (`pedido_id`),
  KEY `fk_hist_usuario` (`usuario_id`),
  CONSTRAINT `fk_hist_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_hist_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`),
  CONSTRAINT `fk_hist_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('10', '1', '5', NULL, NULL, 'novo', 'Pedido criado pelo cliente no cardapio publico', '2026-09-04 10:45:54');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('11', '1', '5', '2', NULL, 'aceito', 'Status alterado via painel para aceito', '2026-09-04 10:47:08');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('12', '1', '5', '2', NULL, 'preparando', 'Status alterado via painel para preparando', '2026-09-04 10:47:16');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('14', '1', '5', '2', NULL, 'pronto', 'Status alterado via painel para pronto', '2026-09-04 10:50:28');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('15', '1', '6', NULL, NULL, 'novo', 'Pedido criado pelo cliente no cardapio publico', '2026-09-04 10:55:21');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('16', '1', '6', '2', NULL, 'preparando', 'Status alterado via painel para preparando', '2026-09-04 10:55:44');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('17', '1', '6', '2', NULL, 'pronto', 'Status alterado via painel para pronto', '2026-09-04 10:56:19');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('18', '1', '5', '2', NULL, 'finalizado', 'Status alterado via painel para finalizado', '2026-09-04 10:56:38');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('19', '1', '6', '2', NULL, 'finalizado', 'Status alterado via painel para finalizado', '2026-09-04 11:01:15');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('20', '1', '7', NULL, NULL, 'novo', 'Pedido criado pelo cliente no cardapio publico', '2026-09-04 11:04:38');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('21', '1', '7', '2', NULL, 'preparando', 'Status alterado via painel para preparando', '2026-09-04 11:05:46');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('22', '1', '7', '2', NULL, 'pronto', 'Status alterado via painel para pronto', '2026-09-04 11:06:43');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('23', '1', '8', NULL, NULL, 'novo', 'Pedido criado pelo cliente no cardapio publico', '2026-09-04 11:10:51');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('24', '1', '8', '2', NULL, 'preparando', 'Status alterado via painel para preparando', '2026-09-04 11:15:22');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('25', '1', '9', NULL, NULL, 'novo', 'Pedido criado pelo cliente no cardapio publico', '2026-09-04 11:15:47');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('26', '1', '9', '2', NULL, 'preparando', 'Status alterado via painel para preparando', '2026-09-04 11:23:36');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('27', '1', '9', '2', NULL, 'pronto', 'Status alterado via painel para pronto', '2026-09-04 11:23:47');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('28', '1', '8', '2', NULL, 'pronto', 'Status alterado via painel para pronto', '2026-09-04 11:23:49');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('29', '1', '10', NULL, NULL, 'novo', 'Pedido criado pelo cliente no cardapio publico', '2026-09-04 11:25:10');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('30', '1', '10', '2', NULL, 'preparando', 'Status alterado via painel para preparando', '2026-09-04 11:27:16');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('31', '1', '10', '2', NULL, 'pronto', 'Status alterado via painel para pronto', '2026-09-04 11:29:20');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('32', '1', '10', '2', NULL, 'finalizado', 'Status alterado via painel para finalizado', '2026-09-04 11:29:31');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('33', '1', '8', '2', NULL, 'finalizado', 'Status alterado via painel para finalizado', '2026-09-04 11:29:34');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('34', '1', '7', '2', NULL, 'finalizado', 'Status alterado via painel para finalizado', '2026-09-04 11:29:38');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('35', '1', '9', '2', NULL, 'finalizado', 'Status alterado via painel para finalizado', '2026-09-04 11:29:41');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('36', '1', '11', NULL, NULL, 'novo', 'Pedido criado pelo cliente no cardapio publico', '2026-09-04 11:37:12');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('37', '1', '11', '2', NULL, 'preparando', 'Status alterado via painel para preparando', '2026-09-04 11:38:16');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('38', '1', '11', '2', NULL, 'pronto', 'Status alterado via painel para pronto', '2026-09-04 11:49:26');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('39', '1', '12', NULL, NULL, 'novo', 'Pedido criado pelo cliente no cardapio publico', '2026-09-04 12:00:03');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('40', '1', '12', '2', NULL, 'preparando', 'Status alterado via painel para preparando', '2026-09-04 12:00:40');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('41', '1', '13', NULL, NULL, 'novo', 'Pedido criado pelo cliente no cardapio publico', '2026-09-04 12:02:23');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('42', '1', '12', '2', NULL, 'pronto', 'Status alterado via painel para pronto', '2026-09-04 12:04:08');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('43', '1', '13', '2', NULL, 'preparando', 'Status alterado via painel para preparando', '2026-09-04 12:04:34');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('44', '1', '13', '2', NULL, 'pronto', 'Status alterado via painel para pronto', '2026-09-04 12:04:51');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('45', '1', '14', NULL, NULL, 'novo', 'Pedido criado pelo cliente no cardapio publico', '2026-09-04 12:06:43');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('46', '1', '14', '2', NULL, 'preparando', 'Status alterado via painel para preparando', '2026-09-04 12:06:57');
INSERT INTO `pedido_historico_status` (`id`, `tenant_id`, `pedido_id`, `usuario_id`, `status_anterior`, `status_novo`, `observacao`, `criado_em`) VALUES ('47', '1', '14', '2', NULL, 'pronto', 'Status alterado via painel para pronto', '2026-09-04 12:07:16');

DROP TABLE IF EXISTS `pedido_item_adicionais`;
CREATE TABLE `pedido_item_adicionais` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `pedido_item_id` bigint unsigned NOT NULL,
  `adicional_id` bigint unsigned DEFAULT NULL,
  `nome` varchar(120) NOT NULL,
  `quantidade` int NOT NULL DEFAULT '1',
  `valor_unitario` decimal(10,2) NOT NULL DEFAULT '0.00',
  `valor_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_pia_tenant` (`tenant_id`),
  KEY `fk_pia_item` (`pedido_item_id`),
  KEY `fk_pia_adicional` (`adicional_id`),
  CONSTRAINT `fk_pia_adicional` FOREIGN KEY (`adicional_id`) REFERENCES `adicionais` (`id`),
  CONSTRAINT `fk_pia_item` FOREIGN KEY (`pedido_item_id`) REFERENCES `pedido_itens` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pia_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('12', '1', '5', '2', 'Não', '1', '0.00', '0.00', '2026-09-04 10:45:54', '2026-09-04 10:45:54');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('13', '1', '5', '5', 'Cheddar', '1', '5.00', '5.00', '2026-09-04 10:45:54', '2026-09-04 10:45:54');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('14', '1', '5', '12', 'Carne Seca', '1', '5.00', '5.00', '2026-09-04 10:45:54', '2026-09-04 10:45:54');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('15', '1', '5', '15', 'Cream Cheease', '1', '4.00', '4.00', '2026-09-04 10:45:54', '2026-09-04 10:45:54');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('16', '1', '5', '19', 'Ovo', '1', '1.00', '1.00', '2026-09-04 10:45:54', '2026-09-04 10:45:54');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('17', '1', '6', '1', 'Sim', '1', '0.00', '0.00', '2026-09-04 10:55:21', '2026-09-04 10:55:21');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('18', '1', '6', '5', 'Cheddar', '1', '5.00', '5.00', '2026-09-04 10:55:21', '2026-09-04 10:55:21');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('19', '1', '6', '70', 'Carne Moída', '1', '4.00', '4.00', '2026-09-04 10:55:21', '2026-09-04 10:55:21');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('20', '1', '6', '72', 'Catupiry', '1', '2.00', '2.00', '2026-09-04 10:55:21', '2026-09-04 10:55:21');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('21', '1', '6', '75', 'Frango', '1', '5.00', '5.00', '2026-09-04 10:55:21', '2026-09-04 10:55:21');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('22', '1', '6', '78', 'Ovo', '1', '1.00', '1.00', '2026-09-04 10:55:21', '2026-09-04 10:55:21');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('23', '1', '6', '80', 'Presunto', '1', '3.00', '3.00', '2026-09-04 10:55:21', '2026-09-04 10:55:21');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('24', '1', '7', '1', 'Sim', '1', '0.00', '0.00', '2026-09-04 11:04:38', '2026-09-04 11:04:38');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('25', '1', '7', '5', 'Cheddar', '1', '5.00', '5.00', '2026-09-04 11:04:38', '2026-09-04 11:04:38');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('26', '1', '7', '12', 'Carne Seca', '1', '5.00', '5.00', '2026-09-04 11:04:38', '2026-09-04 11:04:38');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('27', '1', '8', '120', 'Normal', '1', '0.00', '0.00', '2026-09-04 11:04:38', '2026-09-04 11:04:38');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('28', '1', '9', '2', 'Não', '1', '0.00', '0.00', '2026-09-04 11:10:51', '2026-09-04 11:10:51');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('29', '1', '9', '5', 'Cheddar', '1', '5.00', '5.00', '2026-09-04 11:10:51', '2026-09-04 11:10:51');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('30', '1', '9', '10', 'Bacon', '1', '3.00', '3.00', '2026-09-04 11:10:51', '2026-09-04 11:10:51');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('31', '1', '10', '1', 'Sim', '1', '0.00', '0.00', '2026-09-04 11:15:47', '2026-09-04 11:15:47');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('32', '1', '10', '5', 'Cheddar', '1', '5.00', '5.00', '2026-09-04 11:15:47', '2026-09-04 11:15:47');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('33', '1', '10', '12', 'Carne Seca', '1', '5.00', '5.00', '2026-09-04 11:15:47', '2026-09-04 11:15:47');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('34', '1', '10', '17', 'Lombo', '1', '6.00', '6.00', '2026-09-04 11:15:47', '2026-09-04 11:15:47');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('35', '1', '10', '20', 'Pimentão', '1', '1.00', '1.00', '2026-09-04 11:15:47', '2026-09-04 11:15:47');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('36', '1', '11', '1', 'Sim', '1', '0.00', '0.00', '2026-09-04 11:25:10', '2026-09-04 11:25:10');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('37', '1', '11', '4', 'Catupiry', '1', '0.00', '0.00', '2026-09-04 11:25:10', '2026-09-04 11:25:10');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('38', '1', '13', '1', 'Sim', '1', '0.00', '0.00', '2026-09-04 11:37:12', '2026-09-04 11:37:12');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('39', '1', '13', '4', 'Catupiry', '1', '0.00', '0.00', '2026-09-04 11:37:12', '2026-09-04 11:37:12');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('40', '1', '13', '10', 'Bacon', '1', '3.00', '3.00', '2026-09-04 11:37:12', '2026-09-04 11:37:12');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('41', '1', '13', '13', 'Catupiry', '1', '2.00', '2.00', '2026-09-04 11:37:12', '2026-09-04 11:37:12');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('42', '1', '14', '6', 'Cream Cheese', '1', '7.00', '7.00', '2026-09-04 12:00:03', '2026-09-04 12:00:03');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('43', '1', '15', '2', 'Não', '1', '0.00', '0.00', '2026-09-04 12:02:23', '2026-09-04 12:02:23');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('44', '1', '15', '6', 'Cream Cheese', '1', '7.00', '7.00', '2026-09-04 12:02:23', '2026-09-04 12:02:23');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('45', '1', '15', '10', 'Bacon', '1', '3.00', '3.00', '2026-09-04 12:02:23', '2026-09-04 12:02:23');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('46', '1', '15', '13', 'Catupiry', '1', '2.00', '2.00', '2026-09-04 12:02:23', '2026-09-04 12:02:23');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('47', '1', '15', '16', 'Frango', '1', '5.00', '5.00', '2026-09-04 12:02:23', '2026-09-04 12:02:23');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('48', '1', '15', '19', 'Ovo', '1', '1.00', '1.00', '2026-09-04 12:02:23', '2026-09-04 12:02:23');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('49', '1', '15', '24', 'Filé Mignon', '1', '5.00', '5.00', '2026-09-04 12:02:23', '2026-09-04 12:02:23');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('50', '1', '16', '1', 'Azeitona: Sim', '1', '0.00', '0.00', '2026-09-04 12:06:43', '2026-09-04 12:06:43');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('51', '1', '16', '5', 'Borda: Cheddar', '1', '5.00', '5.00', '2026-09-04 12:06:43', '2026-09-04 12:06:43');
INSERT INTO `pedido_item_adicionais` (`id`, `tenant_id`, `pedido_item_id`, `adicional_id`, `nome`, `quantidade`, `valor_unitario`, `valor_total`, `criado_em`, `atualizado_em`) VALUES ('52', '1', '16', '12', 'Adicionais: Carne Seca', '1', '5.00', '5.00', '2026-09-04 12:06:43', '2026-09-04 12:06:43');

DROP TABLE IF EXISTS `pedido_itens`;
CREATE TABLE `pedido_itens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `pedido_id` bigint unsigned NOT NULL,
  `produto_id` bigint unsigned DEFAULT NULL,
  `variacao_id` bigint unsigned DEFAULT NULL,
  `produto_nome` varchar(160) NOT NULL,
  `variacao_nome` varchar(100) DEFAULT NULL,
  `quantidade` decimal(10,3) NOT NULL DEFAULT '1.000',
  `valor_unitario` decimal(10,2) NOT NULL,
  `valor_adicionais` decimal(10,2) NOT NULL DEFAULT '0.00',
  `valor_total` decimal(10,2) NOT NULL,
  `observacao` text,
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_itens_tenant` (`tenant_id`),
  KEY `fk_itens_pedido` (`pedido_id`),
  KEY `fk_itens_produto` (`produto_id`),
  KEY `fk_itens_variacao` (`variacao_id`),
  CONSTRAINT `fk_itens_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_itens_produto` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`),
  CONSTRAINT `fk_itens_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`),
  CONSTRAINT `fk_itens_variacao` FOREIGN KEY (`variacao_id`) REFERENCES `produto_variacoes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `pedido_itens` (`id`, `tenant_id`, `pedido_id`, `produto_id`, `variacao_id`, `produto_nome`, `variacao_nome`, `quantidade`, `valor_unitario`, `valor_adicionais`, `valor_total`, `observacao`, `criado_em`, `atualizado_em`) VALUES ('5', '1', '5', '1', '3', 'Mussarela', 'Grande', '1.000', '31.00', '15.00', '46.00', 'sem cebola', '2026-09-04 10:45:54', '2026-09-04 10:45:54');
INSERT INTO `pedido_itens` (`id`, `tenant_id`, `pedido_id`, `produto_id`, `variacao_id`, `produto_nome`, `variacao_nome`, `quantidade`, `valor_unitario`, `valor_adicionais`, `valor_total`, `observacao`, `criado_em`, `atualizado_em`) VALUES ('6', '1', '6', '41', '66', 'Bruta de Frango', 'Grande', '1.000', '41.00', '20.00', '61.00', 'cortar em 8 pedaços', '2026-09-04 10:55:21', '2026-09-04 10:55:21');
INSERT INTO `pedido_itens` (`id`, `tenant_id`, `pedido_id`, `produto_id`, `variacao_id`, `produto_nome`, `variacao_nome`, `quantidade`, `valor_unitario`, `valor_adicionais`, `valor_total`, `observacao`, `criado_em`, `atualizado_em`) VALUES ('7', '1', '7', '2', '6', 'Calabresa', 'Grande', '1.000', '32.00', '10.00', '42.00', NULL, '2026-09-04 11:04:38', '2026-09-04 11:04:38');
INSERT INTO `pedido_itens` (`id`, `tenant_id`, `pedido_id`, `produto_id`, `variacao_id`, `produto_nome`, `variacao_nome`, `quantidade`, `valor_unitario`, `valor_adicionais`, `valor_total`, `observacao`, `criado_em`, `atualizado_em`) VALUES ('8', '1', '7', '52', '100', 'Guaraná', '2 litros', '1.000', '15.00', '0.00', '15.00', NULL, '2026-09-04 11:04:38', '2026-09-04 11:04:38');
INSERT INTO `pedido_itens` (`id`, `tenant_id`, `pedido_id`, `produto_id`, `variacao_id`, `produto_nome`, `variacao_nome`, `quantidade`, `valor_unitario`, `valor_adicionais`, `valor_total`, `observacao`, `criado_em`, `atualizado_em`) VALUES ('9', '1', '8', '1', '2', 'Mussarela', 'Média', '1.000', '26.00', '8.00', '34.00', NULL, '2026-09-04 11:10:51', '2026-09-04 11:10:51');
INSERT INTO `pedido_itens` (`id`, `tenant_id`, `pedido_id`, `produto_id`, `variacao_id`, `produto_nome`, `variacao_nome`, `quantidade`, `valor_unitario`, `valor_adicionais`, `valor_total`, `observacao`, `criado_em`, `atualizado_em`) VALUES ('10', '1', '9', '3', '8', 'Mista', 'Média', '1.000', '27.00', '17.00', '44.00', NULL, '2026-09-04 11:15:47', '2026-09-04 11:15:47');
INSERT INTO `pedido_itens` (`id`, `tenant_id`, `pedido_id`, `produto_id`, `variacao_id`, `produto_nome`, `variacao_nome`, `quantidade`, `valor_unitario`, `valor_adicionais`, `valor_total`, `observacao`, `criado_em`, `atualizado_em`) VALUES ('11', '1', '10', '1', '3', 'Mussarela', 'Grande', '1.000', '31.00', '0.00', '31.00', NULL, '2026-09-04 11:25:10', '2026-09-04 11:25:10');
INSERT INTO `pedido_itens` (`id`, `tenant_id`, `pedido_id`, `produto_id`, `variacao_id`, `produto_nome`, `variacao_nome`, `quantidade`, `valor_unitario`, `valor_adicionais`, `valor_total`, `observacao`, `criado_em`, `atualizado_em`) VALUES ('12', '1', '10', '17', '51', 'Doce de Leite', 'Grande', '1.000', '40.00', '0.00', '40.00', NULL, '2026-09-04 11:25:10', '2026-09-04 11:25:10');
INSERT INTO `pedido_itens` (`id`, `tenant_id`, `pedido_id`, `produto_id`, `variacao_id`, `produto_nome`, `variacao_nome`, `quantidade`, `valor_unitario`, `valor_adicionais`, `valor_total`, `observacao`, `criado_em`, `atualizado_em`) VALUES ('13', '1', '11', '1', '2', 'Mussarela', 'Média', '1.000', '26.00', '5.00', '31.00', NULL, '2026-09-04 11:37:12', '2026-09-04 11:37:12');
INSERT INTO `pedido_itens` (`id`, `tenant_id`, `pedido_id`, `produto_id`, `variacao_id`, `produto_nome`, `variacao_nome`, `quantidade`, `valor_unitario`, `valor_adicionais`, `valor_total`, `observacao`, `criado_em`, `atualizado_em`) VALUES ('14', '1', '12', '34', NULL, 'Brigadeiro', NULL, '1.000', '6.00', '7.00', '13.00', NULL, '2026-09-04 12:00:03', '2026-09-04 12:00:03');
INSERT INTO `pedido_itens` (`id`, `tenant_id`, `pedido_id`, `produto_id`, `variacao_id`, `produto_nome`, `variacao_nome`, `quantidade`, `valor_unitario`, `valor_adicionais`, `valor_total`, `observacao`, `criado_em`, `atualizado_em`) VALUES ('15', '1', '13', '1', '3', 'Mussarela', 'Grande', '1.000', '31.00', '23.00', '54.00', NULL, '2026-09-04 12:02:23', '2026-09-04 12:02:23');
INSERT INTO `pedido_itens` (`id`, `tenant_id`, `pedido_id`, `produto_id`, `variacao_id`, `produto_nome`, `variacao_nome`, `quantidade`, `valor_unitario`, `valor_adicionais`, `valor_total`, `observacao`, `criado_em`, `atualizado_em`) VALUES ('16', '1', '14', '1', '2', 'Mussarela', 'Média', '1.000', '26.00', '10.00', '36.00', NULL, '2026-09-04 12:06:43', '2026-09-04 12:06:43');

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `cliente_id` bigint unsigned DEFAULT NULL,
  `bairro_id` bigint unsigned DEFAULT NULL,
  `forma_pagamento_id` bigint unsigned DEFAULT NULL,
  `cupom_id` bigint unsigned DEFAULT NULL,
  `numero` int NOT NULL,
  `token` varchar(64) NOT NULL,
  `cliente_nome` varchar(150) NOT NULL,
  `cliente_whatsapp` varchar(30) NOT NULL,
  `tipo_recebimento` enum('delivery','retirada') NOT NULL,
  `endereco` varchar(180) DEFAULT NULL,
  `numero_endereco` varchar(30) DEFAULT NULL,
  `complemento` varchar(120) DEFAULT NULL,
  `referencia` varchar(180) DEFAULT NULL,
  `bairro_nome` varchar(120) DEFAULT NULL,
  `forma_pagamento_nome` varchar(100) DEFAULT NULL,
  `troco_para` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `taxa_entrega` decimal(10,2) NOT NULL DEFAULT '0.00',
  `desconto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL,
  `observacao` text,
  `status` enum('novo','aceito','preparando','pronto','saiu_para_entrega','finalizado','retirado','cancelado') NOT NULL DEFAULT 'novo',
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aceito_em` datetime DEFAULT NULL,
  `preparo_em` datetime DEFAULT NULL,
  `pronto_em` datetime DEFAULT NULL,
  `saiu_entrega_em` datetime DEFAULT NULL,
  `finalizado_em` datetime DEFAULT NULL,
  `cancelado_em` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  UNIQUE KEY `uk_pedido_numero_tenant` (`tenant_id`,`numero`),
  KEY `idx_pedidos_tenant_status` (`tenant_id`,`status`,`criado_em`),
  KEY `fk_pedidos_cliente` (`cliente_id`),
  KEY `fk_pedidos_bairro` (`bairro_id`),
  KEY `fk_pedidos_pagamento` (`forma_pagamento_id`),
  KEY `fk_pedidos_cupom` (`cupom_id`),
  CONSTRAINT `fk_pedidos_bairro` FOREIGN KEY (`bairro_id`) REFERENCES `bairros` (`id`),
  CONSTRAINT `fk_pedidos_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `fk_pedidos_cupom` FOREIGN KEY (`cupom_id`) REFERENCES `cupons` (`id`),
  CONSTRAINT `fk_pedidos_pagamento` FOREIGN KEY (`forma_pagamento_id`) REFERENCES `formas_pagamento` (`id`),
  CONSTRAINT `fk_pedidos_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `pedidos` (`id`, `tenant_id`, `cliente_id`, `bairro_id`, `forma_pagamento_id`, `cupom_id`, `numero`, `token`, `cliente_nome`, `cliente_whatsapp`, `tipo_recebimento`, `endereco`, `numero_endereco`, `complemento`, `referencia`, `bairro_nome`, `forma_pagamento_nome`, `troco_para`, `subtotal`, `taxa_entrega`, `desconto`, `total`, `observacao`, `status`, `criado_em`, `aceito_em`, `preparo_em`, `pronto_em`, `saiu_entrega_em`, `finalizado_em`, `cancelado_em`) VALUES ('5', '1', '3', NULL, '1', NULL, '5', 'ee179cd580aaf415e65ab6fd7922b5e0', 'Daniel', '88997114302', 'retirada', NULL, NULL, NULL, NULL, NULL, 'Pix', NULL, '46.00', '0.00', '0.00', '46.00', NULL, 'finalizado', '2026-09-04 10:45:54', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `pedidos` (`id`, `tenant_id`, `cliente_id`, `bairro_id`, `forma_pagamento_id`, `cupom_id`, `numero`, `token`, `cliente_nome`, `cliente_whatsapp`, `tipo_recebimento`, `endereco`, `numero_endereco`, `complemento`, `referencia`, `bairro_nome`, `forma_pagamento_nome`, `troco_para`, `subtotal`, `taxa_entrega`, `desconto`, `total`, `observacao`, `status`, `criado_em`, `aceito_em`, `preparo_em`, `pronto_em`, `saiu_entrega_em`, `finalizado_em`, `cancelado_em`) VALUES ('6', '1', '3', NULL, '2', NULL, '6', '25a765373ef16c910a910fada1624d4b', 'Daniel', '88997114302', 'retirada', NULL, NULL, NULL, NULL, NULL, 'Dinheiro', '70.00', '61.00', '0.00', '0.00', '61.00', NULL, 'finalizado', '2026-09-04 10:55:21', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `pedidos` (`id`, `tenant_id`, `cliente_id`, `bairro_id`, `forma_pagamento_id`, `cupom_id`, `numero`, `token`, `cliente_nome`, `cliente_whatsapp`, `tipo_recebimento`, `endereco`, `numero_endereco`, `complemento`, `referencia`, `bairro_nome`, `forma_pagamento_nome`, `troco_para`, `subtotal`, `taxa_entrega`, `desconto`, `total`, `observacao`, `status`, `criado_em`, `aceito_em`, `preparo_em`, `pronto_em`, `saiu_entrega_em`, `finalizado_em`, `cancelado_em`) VALUES ('7', '1', '3', NULL, '3', NULL, '7', '30414342e546f287a0e8cfa3f55db987', 'Daniel', '88997114302', 'retirada', NULL, NULL, NULL, NULL, NULL, 'Cartão de Crédito', NULL, '57.00', '0.00', '0.00', '57.00', NULL, 'finalizado', '2026-09-04 11:04:38', NULL, NULL, NULL, NULL, '2026-09-04 11:29:38', NULL);
INSERT INTO `pedidos` (`id`, `tenant_id`, `cliente_id`, `bairro_id`, `forma_pagamento_id`, `cupom_id`, `numero`, `token`, `cliente_nome`, `cliente_whatsapp`, `tipo_recebimento`, `endereco`, `numero_endereco`, `complemento`, `referencia`, `bairro_nome`, `forma_pagamento_nome`, `troco_para`, `subtotal`, `taxa_entrega`, `desconto`, `total`, `observacao`, `status`, `criado_em`, `aceito_em`, `preparo_em`, `pronto_em`, `saiu_entrega_em`, `finalizado_em`, `cancelado_em`) VALUES ('8', '1', '3', NULL, '2', NULL, '8', '7c631042d4dc4a4c2fee6411896fde91', 'Daniel', '88997114302', 'retirada', NULL, NULL, NULL, NULL, NULL, 'Dinheiro', NULL, '34.00', '0.00', '0.00', '34.00', NULL, 'finalizado', '2026-09-04 11:10:51', NULL, NULL, NULL, NULL, '2026-09-04 11:29:34', NULL);
INSERT INTO `pedidos` (`id`, `tenant_id`, `cliente_id`, `bairro_id`, `forma_pagamento_id`, `cupom_id`, `numero`, `token`, `cliente_nome`, `cliente_whatsapp`, `tipo_recebimento`, `endereco`, `numero_endereco`, `complemento`, `referencia`, `bairro_nome`, `forma_pagamento_nome`, `troco_para`, `subtotal`, `taxa_entrega`, `desconto`, `total`, `observacao`, `status`, `criado_em`, `aceito_em`, `preparo_em`, `pronto_em`, `saiu_entrega_em`, `finalizado_em`, `cancelado_em`) VALUES ('9', '1', '3', NULL, '1', NULL, '9', '5e95b201dbe1b2cc8f8e3d7d5c21b2f8', 'Daniel', '88997114302', 'retirada', NULL, NULL, NULL, NULL, NULL, 'Pix', NULL, '44.00', '0.00', '0.00', '44.00', NULL, 'finalizado', '2026-09-04 11:15:47', NULL, NULL, NULL, NULL, '2026-09-04 11:29:41', NULL);
INSERT INTO `pedidos` (`id`, `tenant_id`, `cliente_id`, `bairro_id`, `forma_pagamento_id`, `cupom_id`, `numero`, `token`, `cliente_nome`, `cliente_whatsapp`, `tipo_recebimento`, `endereco`, `numero_endereco`, `complemento`, `referencia`, `bairro_nome`, `forma_pagamento_nome`, `troco_para`, `subtotal`, `taxa_entrega`, `desconto`, `total`, `observacao`, `status`, `criado_em`, `aceito_em`, `preparo_em`, `pronto_em`, `saiu_entrega_em`, `finalizado_em`, `cancelado_em`) VALUES ('10', '1', '3', NULL, '1', NULL, '10', '519581b5c1b54dd17b86251e4a9aec64', 'Daniel', '88997114302', 'retirada', NULL, NULL, NULL, NULL, NULL, 'Pix', NULL, '71.00', '0.00', '0.00', '71.00', NULL, 'finalizado', '2026-09-04 11:25:10', NULL, NULL, NULL, NULL, '2026-09-04 11:29:31', NULL);
INSERT INTO `pedidos` (`id`, `tenant_id`, `cliente_id`, `bairro_id`, `forma_pagamento_id`, `cupom_id`, `numero`, `token`, `cliente_nome`, `cliente_whatsapp`, `tipo_recebimento`, `endereco`, `numero_endereco`, `complemento`, `referencia`, `bairro_nome`, `forma_pagamento_nome`, `troco_para`, `subtotal`, `taxa_entrega`, `desconto`, `total`, `observacao`, `status`, `criado_em`, `aceito_em`, `preparo_em`, `pronto_em`, `saiu_entrega_em`, `finalizado_em`, `cancelado_em`) VALUES ('11', '1', '3', NULL, '1', NULL, '11', 'f4a224583e15c9abc122e43d3117a01f', 'Daniel', '88997114302', 'retirada', NULL, NULL, NULL, NULL, NULL, 'Pix', NULL, '31.00', '0.00', '0.00', '31.00', NULL, 'pronto', '2026-09-04 11:37:12', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `pedidos` (`id`, `tenant_id`, `cliente_id`, `bairro_id`, `forma_pagamento_id`, `cupom_id`, `numero`, `token`, `cliente_nome`, `cliente_whatsapp`, `tipo_recebimento`, `endereco`, `numero_endereco`, `complemento`, `referencia`, `bairro_nome`, `forma_pagamento_nome`, `troco_para`, `subtotal`, `taxa_entrega`, `desconto`, `total`, `observacao`, `status`, `criado_em`, `aceito_em`, `preparo_em`, `pronto_em`, `saiu_entrega_em`, `finalizado_em`, `cancelado_em`) VALUES ('12', '1', '3', NULL, '1', NULL, '12', '99ac81b427fdab1d4a58f6592f2dca5f', 'daniel', '88997114302', 'retirada', NULL, NULL, NULL, NULL, NULL, 'Pix', NULL, '13.00', '0.00', '0.00', '13.00', NULL, 'pronto', '2026-09-04 12:00:03', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `pedidos` (`id`, `tenant_id`, `cliente_id`, `bairro_id`, `forma_pagamento_id`, `cupom_id`, `numero`, `token`, `cliente_nome`, `cliente_whatsapp`, `tipo_recebimento`, `endereco`, `numero_endereco`, `complemento`, `referencia`, `bairro_nome`, `forma_pagamento_nome`, `troco_para`, `subtotal`, `taxa_entrega`, `desconto`, `total`, `observacao`, `status`, `criado_em`, `aceito_em`, `preparo_em`, `pronto_em`, `saiu_entrega_em`, `finalizado_em`, `cancelado_em`) VALUES ('13', '1', '3', NULL, '1', NULL, '13', 'fa4c8933269e9dfadfcf89f3b0126a70', 'Daniel', '88997114302', 'retirada', NULL, NULL, NULL, NULL, NULL, 'Pix', NULL, '54.00', '0.00', '0.00', '54.00', NULL, 'pronto', '2026-09-04 12:02:23', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `pedidos` (`id`, `tenant_id`, `cliente_id`, `bairro_id`, `forma_pagamento_id`, `cupom_id`, `numero`, `token`, `cliente_nome`, `cliente_whatsapp`, `tipo_recebimento`, `endereco`, `numero_endereco`, `complemento`, `referencia`, `bairro_nome`, `forma_pagamento_nome`, `troco_para`, `subtotal`, `taxa_entrega`, `desconto`, `total`, `observacao`, `status`, `criado_em`, `aceito_em`, `preparo_em`, `pronto_em`, `saiu_entrega_em`, `finalizado_em`, `cancelado_em`) VALUES ('14', '1', '3', NULL, '1', NULL, '14', '27ae70427e99ddbed53c2b493f948468', 'Daniel', '88997114302', 'retirada', NULL, NULL, NULL, NULL, NULL, 'Pix', NULL, '36.00', '0.00', '0.00', '36.00', NULL, 'pronto', '2026-09-04 12:06:43', NULL, NULL, NULL, NULL, NULL, NULL);

DROP TABLE IF EXISTS `produto_grupos_adicionais`;
CREATE TABLE `produto_grupos_adicionais` (
  `produto_id` bigint unsigned NOT NULL,
  `grupo_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`produto_id`,`grupo_id`),
  KEY `fk_pga_grupo` (`grupo_id`),
  CONSTRAINT `fk_pga_grupo` FOREIGN KEY (`grupo_id`) REFERENCES `grupos_adicionais` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pga_produto` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('55', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('56', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('57', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('58', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('59', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('60', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('61', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('62', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('63', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('64', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('65', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('66', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('67', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('68', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('69', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('70', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('71', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('72', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('73', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('74', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('75', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('94', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('96', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('97', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('98', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('99', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('100', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('101', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('102', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('103', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('104', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('105', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('106', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('107', '12');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('55', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('56', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('57', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('58', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('59', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('60', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('61', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('62', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('63', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('64', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('65', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('66', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('67', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('68', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('69', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('95', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('96', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('97', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('98', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('99', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('100', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('101', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('102', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('103', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('104', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('105', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('109', '13');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('55', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('56', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('57', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('58', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('59', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('60', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('61', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('62', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('63', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('64', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('65', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('66', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('67', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('68', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('69', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('88', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('89', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('90', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('91', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('92', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('93', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('95', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('96', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('97', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('98', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('99', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('100', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('101', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('102', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('103', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('104', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('105', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('109', '14');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('55', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('56', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('57', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('58', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('59', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('60', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('61', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('62', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('63', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('64', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('65', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('66', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('67', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('68', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('69', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('95', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('96', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('97', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('98', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('99', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('100', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('101', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('102', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('103', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('105', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('109', '15');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('94', '16');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('95', '17');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('109', '17');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('104', '18');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('106', '19');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('107', '19');

DROP TABLE IF EXISTS `produto_variacoes`;
CREATE TABLE `produto_variacoes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `produto_id` bigint unsigned NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `ordem` int NOT NULL DEFAULT '0',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_variacoes_tenant` (`tenant_id`),
  KEY `fk_variacoes_produto` (`produto_id`),
  CONSTRAINT `fk_variacoes_produto` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_variacoes_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('1', '1', '1', 'Pequena', '21.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('2', '1', '1', 'Média', '26.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('3', '1', '1', 'Grande', '31.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('4', '1', '2', 'Pequena', '22.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('5', '1', '2', 'Média', '27.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('6', '1', '2', 'Grande', '32.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('7', '1', '3', 'Pequena', '22.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('8', '1', '3', 'Média', '27.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('9', '1', '3', 'Grande', '33.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('10', '1', '4', 'Pequena', '23.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('11', '1', '4', 'Média', '28.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('12', '1', '4', 'Grande', '33.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('13', '1', '5', 'Pequena', '24.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('14', '1', '5', 'Média', '29.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('15', '1', '5', 'Grande', '34.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('16', '1', '6', 'Pequena', '24.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('17', '1', '6', 'Média', '29.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('18', '1', '6', 'Grande', '34.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('19', '1', '7', 'Pequena', '24.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('20', '1', '7', 'Média', '29.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('21', '1', '7', 'Grande', '34.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('22', '1', '8', 'Pequena', '25.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('23', '1', '8', 'Média', '30.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('24', '1', '8', 'Grande', '35.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('25', '1', '9', 'Pequena', '25.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('26', '1', '9', 'Média', '30.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('27', '1', '9', 'Grande', '35.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('28', '1', '10', 'Pequena', '26.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('29', '1', '10', 'Média', '31.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('30', '1', '10', 'Grande', '36.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('31', '1', '11', 'Pequena', '26.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('32', '1', '11', 'Média', '31.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('33', '1', '11', 'Grande', '36.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('34', '1', '12', 'Pequena', '25.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('35', '1', '12', 'Média', '30.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('36', '1', '12', 'Grande', '35.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('37', '1', '13', 'Pequena', '27.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('38', '1', '13', 'Média', '34.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('39', '1', '13', 'Grande', '40.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('40', '1', '14', 'Pequena', '23.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('41', '1', '14', 'Média', '28.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('42', '1', '14', 'Grande', '33.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('43', '1', '15', 'Pequena', '28.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('44', '1', '15', 'Média', '34.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('45', '1', '15', 'Grande', '40.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('46', '1', '16', 'Pequena', '22.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('47', '1', '16', 'Média', '27.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('48', '1', '16', 'Grande', '32.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('49', '1', '17', 'Pequena', '30.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('50', '1', '17', 'Média', '35.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('51', '1', '17', 'Grande', '40.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('52', '1', '18', 'Pequena', '26.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('53', '1', '18', 'Média', '32.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('54', '1', '18', 'Grande', '36.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('55', '1', '19', 'Pequena', '25.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('56', '1', '19', 'Média', '30.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('57', '1', '19', 'Grande', '35.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('58', '1', '20', 'Pequena', '20.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('59', '1', '20', 'Média', '25.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('60', '1', '20', 'Grande', '30.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('61', '1', '21', 'Pequena', '26.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('62', '1', '21', 'Média', '33.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('63', '1', '21', 'Grande', '40.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('64', '1', '41', 'Pequena', '28.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('65', '1', '41', 'Média', '35.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('66', '1', '41', 'Grande', '41.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('67', '1', '42', 'Pequena', '26.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('68', '1', '42', 'Média', '32.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('69', '1', '42', 'Grande', '37.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('70', '1', '43', 'Pequena', '30.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('71', '1', '43', 'Média', '37.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('72', '1', '43', 'Grande', '42.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('73', '1', '44', 'Pequena', '29.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('74', '1', '44', 'Média', '35.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('75', '1', '44', 'Grande', '41.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('76', '1', '45', 'Pequena', '28.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('77', '1', '45', 'Média', '35.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('78', '1', '45', 'Grande', '42.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('79', '1', '46', 'Pequena', '30.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('80', '1', '46', 'Média', '37.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('81', '1', '46', 'Grande', '42.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('82', '1', '47', 'Pequena', '32.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('83', '1', '47', 'Média', '37.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('84', '1', '47', 'Grande', '42.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('85', '1', '48', 'Pequena', '32.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('86', '1', '48', 'Média', '37.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('87', '1', '48', 'Grande', '42.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('88', '1', '49', 'Pequena', '31.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('89', '1', '49', 'Média', '36.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('90', '1', '49', 'Grande', '41.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('91', '1', '50', 'Pequena', '29.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('92', '1', '50', 'Média', '35.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('93', '1', '50', 'Grande', '41.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('94', '1', '51', 'Lata 350', '5.50', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('95', '1', '51', '600 ml', '7.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('96', '1', '51', '1 litro e meio', '12.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('97', '1', '51', '2 litros', '15.00', '4', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('98', '1', '52', 'Lata 350', '5.50', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('99', '1', '52', '1 litro e meio', '12.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produto_variacoes` (`id`, `tenant_id`, `produto_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('100', '1', '52', '2 litros', '15.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `categoria_id` bigint unsigned NOT NULL,
  `nome` varchar(160) NOT NULL,
  `slug` varchar(180) DEFAULT NULL,
  `descricao` text,
  `preco` decimal(10,2) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `destaque` tinyint(1) NOT NULL DEFAULT '0',
  `disponivel` tinyint(1) NOT NULL DEFAULT '1',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `ordem` int NOT NULL DEFAULT '0',
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_produtos_tenant_categoria` (`tenant_id`,`categoria_id`),
  KEY `idx_produtos_disponivel` (`tenant_id`,`disponivel`,`ativo`),
  KEY `fk_produtos_categoria` (`categoria_id`),
  CONSTRAINT `fk_produtos_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  CONSTRAINT `fk_produtos_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('55', '5', '22', 'Mussarela', 'mussarela', 'Mussarela, tomate e orégano', '21.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '1', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('56', '5', '22', 'Calabresa', 'calabresa', 'Calabresa, cebola e mussarela', '22.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '2', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('57', '5', '22', 'Mista', 'mista', 'Queijo e presunto', '22.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '3', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('58', '5', '22', 'Bauru', 'bauru', 'Presunto, tomate e queijo', '23.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '4', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('59', '5', '22', 'Caipira', 'caipira', 'Frango, catupiry e milho', '24.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '5', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('60', '5', '22', 'Frango com Catupiry', 'frango-com-catupiry', 'Frango e catupiry', '24.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '6', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('61', '5', '22', 'Portuguesa', 'portuguesa', 'Presunto, cebola, ovo, ervilha e mussarela', '24.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '7', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('62', '5', '22', 'Baiana', 'baiana', 'Calabresa moída, cebola, ovo, pimenta e mussarela', '25.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '8', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('63', '5', '22', '3 Queijos', '3-queijos', 'Catupiry, cheddar e mussarela', '25.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '9', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('64', '5', '22', 'Carne Seca', 'carne-seca', 'Carne seca, cebola, tomate e mussarela', '26.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '10', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('65', '5', '22', 'Lasanha', 'lasanha', 'Presunto, mussarela, carne moída, tomate e molho de tomate', '26.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '11', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('66', '5', '22', 'Tradicional', 'tradicional', 'Queijo, presunto, tomate, azeitona, ovo e manjericão', '25.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '12', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('67', '5', '22', 'Camarão', 'camar-o', 'Camarão, cebola e mussarela', '27.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '13', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('68', '5', '22', 'Bacon', 'bacon', 'Mussarela, bacon e cebola', '23.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '14', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('69', '5', '22', 'Moda do Chef', 'moda-do-chef', 'Calabresa, cebola, mussarela e bacon', '28.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '15', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('70', '5', '23', 'Brigadeiro', 'brigadeiro', 'Chocolate cremoso coberto com granulado', '22.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '16', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('71', '5', '23', 'Doce de Leite', 'doce-de-leite', 'Doce de leite, Mussarela e açucar de confeiteiro', '30.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '17', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('72', '5', '23', 'Nutella', 'nutella', 'Nuttela Original e morango', '26.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '18', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('73', '5', '23', 'Preto e Branco', 'preto-e-branco', 'Chocolate preto, chocolate branco e granulado', '25.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '19', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('74', '5', '23', 'Romeu e Juulieta', 'romeu-e-juulieta', 'Goiabada e mussarela', '20.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '20', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('75', '5', '23', 'Sensação', 'sensa-o', 'Chocolate avelã, Chocolate Branco e Morango', '26.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '21', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('76', '5', '25', 'Baiana', 'baiana', NULL, '6.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '22', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('77', '5', '25', 'Calabresa', 'calabresa', NULL, '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '23', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('78', '5', '25', 'Calabresa com Catupiry', 'calabresa-com-catupiry', NULL, '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '24', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('79', '5', '25', 'Camarão', 'camar-o', NULL, '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '25', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('80', '5', '25', 'Carne Moida', 'carne-moida', NULL, '6.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '26', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('81', '5', '25', 'Carne Moida com Catupiry', 'carne-moida-com-catupiry', NULL, '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '27', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('82', '5', '25', 'Carne Seca com Caturiry', 'carne-seca-com-caturiry', NULL, '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '28', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('83', '5', '25', 'Carne Seca', 'carne-seca', NULL, '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '29', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('84', '5', '25', 'Frango', 'frango', NULL, '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '30', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('85', '5', '25', 'Frango com Catupiry', 'frango-com-catupiry', NULL, '6.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '31', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('86', '5', '25', 'Mista', 'mista', NULL, '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '32', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('87', '5', '25', 'Queijo', 'queijo', NULL, '6.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '33', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('88', '5', '26', 'Brigadeiro', 'brigadeiro', NULL, '6.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '34', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('89', '5', '26', 'Doce de Leite', 'doce-de-leite', NULL, '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '35', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('90', '5', '26', 'Nutella', 'nutella', NULL, '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '36', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('91', '5', '26', 'Prestigio', 'prestigio', NULL, '6.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '37', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('92', '5', '26', 'Romeu e Juulieta', 'romeu-e-juulieta', NULL, '6.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '38', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('93', '5', '26', 'Sensação', 'sensa-o', NULL, '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '39', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('94', '5', '27', 'Refigerante', 'refigerante', NULL, '0.00', NULL, '0', '1', '1', '40', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('95', '5', '28', 'Pizza dois sabores G', 'pizza-dois-sabores-g', 'Escolha dois sabores da pizza G', '0.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '41', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('96', '5', '24', 'Bruta de Frango', 'bruta-de-frango', 'Frango temperado, bacon em cubos, cheddar e oregano', '28.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '42', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('97', '5', '24', 'Calabresa Cremosa', 'calabresa-cremosa', 'Calabresa fatiada, cebola, catupiry, azeitona e oregano', '26.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '43', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('98', '5', '24', 'Camarão especial', 'camar-o-especial', 'Camarão, presunto, ovo, calabresa, musssarela, oregano', '30.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '44', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('99', '5', '24', 'Cearense', 'cearense', 'Camarão, presunto, ovo,  musssarela, oregano', '29.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '45', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('100', '5', '24', 'Cruzense', 'cruzense', 'Presunto, cebola, mussarela, catupiry, bacon e oregano', '28.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '46', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('101', '5', '24', 'Nordestina', 'nordestina', 'Carne de sol, catupury, cebola roxa e oregano', '30.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '47', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('102', '5', '24', 'Portuguesa Especial', 'portuguesa-especial', 'Presunto, mussarela, carne moida, ovo, cebola, pimentão e oregano', '32.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '48', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('103', '5', '24', 'File Mignon', 'file-mignon', 'File mignon, mussarela , alho frito, catupiry, cebola e oregano', '32.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '49', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('104', '5', '24', 'Monte sua pizza', 'monte-sua-pizza', '4 ingredientes da sua escolha', '31.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '50', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('105', '5', '24', 'Pizza Cum Cum', 'pizza-cum-cum', 'Mussarela, carne seca, ovo calabresa, cebola, tomate e orégano', '29.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '51', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('106', '5', '27', 'Coca-cola', 'coca-cola', NULL, '0.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/coca.jpg', '0', '1', '1', '52', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('107', '5', '27', 'Guaraná', 'guaran-', NULL, '0.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/guarana.png', '0', '1', '1', '53', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('108', '5', '27', 'Pepsi 1 l', 'pepsi-1-l', 'Pepsi de 1 litro', '8.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pepsi.png', '0', '1', '1', '54', '2026-09-04 15:39:17', '2026-09-04 15:39:17');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('109', '5', '28', 'Pizza dois sabores M', 'pizza-dois-sabores-m', 'Escolha dois sabores da pizza M', '0.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '55', '2026-09-04 15:39:17', '2026-09-04 15:39:17');

DROP TABLE IF EXISTS `sequencias_pedido`;
CREATE TABLE `sequencias_pedido` (
  `tenant_id` bigint unsigned NOT NULL,
  `ultimo_numero` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`tenant_id`),
  CONSTRAINT `fk_seq_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `sequencias_pedido` (`tenant_id`, `ultimo_numero`) VALUES ('1', '14');

DROP TABLE IF EXISTS `tenants`;
CREATE TABLE `tenants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `razao_social` varchar(180) DEFAULT NULL,
  `documento` varchar(30) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `whatsapp` varchar(30) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `cor_primaria` varchar(20) DEFAULT NULL,
  `cor_secundaria` varchar(20) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  `timezone` varchar(80) NOT NULL DEFAULT 'America/Sao_Paulo',
  `status` enum('ativo','bloqueado','cancelado') NOT NULL DEFAULT 'ativo',
  `plano` varchar(50) DEFAULT NULL,
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tenants` (`id`, `nome`, `slug`, `razao_social`, `documento`, `telefone`, `whatsapp`, `email`, `logo`, `cor_primaria`, `cor_secundaria`, `endereco`, `cidade`, `uf`, `timezone`, `status`, `plano`, `criado_em`, `atualizado_em`) VALUES ('5', 'Pizzaria Piemonte', 'piemonte', NULL, NULL, '(88) 9 9653-1718', '558896531718', 'daviizinho23@gmail.com', 'https://clicoucomeu.com.br/cardapios/piemonte/logo.jpeg', '#b47e11', '#935711', 'Av 14 de janeiro, 40 - Centro, Cruz - CE', 'Cruz', 'CE', 'America/Sao_Paulo', 'ativo', 'pro', '2026-09-04 15:39:17', '2026-09-04 15:39:17');

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned DEFAULT NULL,
  `nome` varchar(120) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `usuario` varchar(80) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `perfil` enum('superadmin','admin','operador','cozinha') NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `ultimo_login` datetime DEFAULT NULL,
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_usuario_tenant` (`tenant_id`,`usuario`),
  CONSTRAINT `fk_usuarios_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `usuarios` (`id`, `tenant_id`, `nome`, `email`, `usuario`, `senha_hash`, `perfil`, `ativo`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('1', NULL, 'Super Admin', NULL, 'superadmin', '$2y$10$zTXkLExt1x9GwhIXQP3BvuKSxmbu.AzOqt9tZRsmclvDCs8mbbs8K', 'superadmin', '1', '2026-09-04 19:48:07', '2026-09-03 16:03:07', '2026-09-04 16:48:07');
INSERT INTO `usuarios` (`id`, `tenant_id`, `nome`, `email`, `usuario`, `senha_hash`, `perfil`, `ativo`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('5', '5', 'Admin Piemonte', NULL, 'piemonte', '$2y$10$zTXkLExt1x9GwhIXQP3BvuKSxmbu.AzOqt9tZRsmclvDCs8mbbs8K', 'admin', '1', NULL, '2026-09-04 15:39:17', '2026-09-04 15:39:17');

SET FOREIGN_KEY_CHECKS=1;
