-- Backup Clicou Comeu
-- Gerado em: 2026-09-04 18:18:41

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
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('1', '1', '1', 'Sim', '0.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('2', '1', '1', 'Não', '0.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('3', '1', '2', 'Sem Borda', '0.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('4', '1', '2', 'Catupiry', '0.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('5', '1', '2', 'Cheddar', '5.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('6', '1', '2', 'Cream Cheese', '7.00', '4', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('7', '1', '2', 'Chocolate', '6.00', '5', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('8', '1', '2', 'Doce de leite', '6.00', '6', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('9', '1', '3', 'Azeitona', '3.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('10', '1', '3', 'Bacon', '3.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('11', '1', '3', 'Carne Moída', '4.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('12', '1', '3', 'Carne Seca', '5.00', '4', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('13', '1', '3', 'Catupiry', '2.00', '5', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('14', '1', '3', 'Cebola', '2.00', '6', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('15', '1', '3', 'Cream Cheease', '4.00', '7', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('16', '1', '3', 'Frango', '5.00', '8', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('17', '1', '3', 'Lombo', '6.00', '9', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('18', '1', '3', 'Milho', '2.00', '10', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('19', '1', '3', 'Ovo', '1.00', '11', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('20', '1', '3', 'Pimentão', '1.00', '12', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('21', '1', '3', 'Presunto', '3.00', '13', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('22', '1', '3', 'Queijo', '4.00', '14', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('23', '1', '3', 'Tomate', '2.00', '15', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('24', '1', '3', 'Filé Mignon', '5.00', '16', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('25', '1', '4', 'Mussarela', '31.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('26', '1', '4', 'Calabresa', '32.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('27', '1', '4', 'Mista', '33.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('28', '1', '4', 'Bauru', '33.00', '4', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('29', '1', '4', 'Caipira', '34.00', '5', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('30', '1', '4', 'Frango com Catupiry', '34.00', '6', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('31', '1', '4', 'Portuguesa', '34.00', '7', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('32', '1', '4', 'Baiana', '35.00', '8', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('33', '1', '4', '3 Queijos', '35.00', '9', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('34', '1', '4', 'Carne Seca', '36.00', '10', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('35', '1', '4', 'Lasanha', '36.00', '11', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('36', '1', '4', 'Tradicional', '35.00', '12', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('37', '1', '4', 'Camarão', '40.00', '13', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('38', '1', '4', 'Bacon', '33.00', '14', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('39', '1', '4', 'Moda do Chef', '40.00', '15', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('40', '1', '4', 'Bruta de Frango', '41.00', '16', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('41', '1', '4', 'Calabresa Cremosa', '37.00', '17', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('42', '1', '4', 'Camarão especial', '42.00', '18', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('43', '1', '4', 'Cearense', '41.00', '19', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('44', '1', '4', 'Cruzense', '42.00', '20', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('45', '1', '4', 'Nordestina', '42.00', '21', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('46', '1', '4', 'Portuguesa Especial', '42.00', '22', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('47', '1', '4', 'File Mignon', '42.00', '23', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('48', '1', '4', 'Pizza Cum Cum', '41.00', '24', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('49', '1', '4', 'Monte sua pizza', '41.00', '25', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('68', '1', '3', 'Azeitona', '3.00', '1', '0', '2026-09-03 13:58:21', '2026-09-04 15:13:03');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('69', '1', '3', 'Bacon', '3.00', '2', '0', '2026-09-03 13:58:21', '2026-09-04 15:13:09');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('70', '1', '3', 'Carne Moída', '4.00', '3', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('71', '1', '3', 'Carne Seca', '5.00', '4', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('72', '1', '3', 'Catupiry', '2.00', '5', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('73', '1', '3', 'Cebola', '2.00', '6', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('74', '1', '3', 'Cream Cheease', '4.00', '7', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('75', '1', '3', 'Frango', '5.00', '8', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('76', '1', '3', 'Lombo', '6.00', '9', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('77', '1', '3', 'Milho', '2.00', '10', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('78', '1', '3', 'Ovo', '1.00', '11', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('79', '1', '3', 'Pimentão', '1.00', '12', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('80', '1', '3', 'Presunto', '3.00', '13', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('81', '1', '3', 'Queijo', '4.00', '14', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('82', '1', '3', 'Tomate', '2.00', '15', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('83', '1', '2', 'Catupiry', '0.00', '1', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('84', '1', '2', 'Cheddar', '5.00', '2', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('85', '1', '2', 'Cream Cheese', '7.00', '3', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('86', '1', '2', 'Chocolate', '6.00', '4', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('87', '1', '2', 'Doce de leite', '6.00', '5', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('88', '1', '3', 'Milho', '2.00', '1', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('89', '1', '3', 'Queijo', '4.00', '2', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('90', '1', '3', 'Carne Seca', '5.00', '3', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('91', '1', '3', 'Carne Moida', '4.00', '4', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('92', '1', '3', 'Ovo', '1.00', '5', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('93', '1', '3', 'Bacon', '3.00', '6', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('94', '1', '3', 'Lombo', '6.00', '7', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('95', '1', '3', 'Presunto', '3.00', '8', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('96', '1', '3', 'Frango', '5.00', '9', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('97', '1', '3', 'Cream Cheease', '4.00', '10', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('98', '1', '3', 'Catupiry', '2.00', '11', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('99', '1', '3', 'Azeitona', '3.00', '12', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('100', '1', '3', 'Cebola', '2.00', '13', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('101', '1', '3', 'Tomate', '2.00', '14', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('102', '1', '3', 'Pimentão', '1.00', '15', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('103', '1', '3', 'Filé Mignon', '5.00', '16', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('104', '1', '9', 'Milho', '0.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('105', '1', '9', 'Queijo', '0.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('106', '1', '9', 'Carne Seca', '0.00', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('107', '1', '9', 'Carne Moida', '0.00', '4', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('108', '1', '9', 'Ovo', '0.00', '5', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('109', '1', '9', 'Bacon', '0.00', '6', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('110', '1', '9', 'Lombo', '0.00', '7', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('111', '1', '9', 'Presunto', '0.00', '8', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('112', '1', '9', 'Frango', '0.00', '9', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('113', '1', '9', 'Cream Cheease', '0.00', '10', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('114', '1', '9', 'Catupiry', '0.00', '11', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('115', '1', '9', 'Azeitona', '0.00', '12', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('116', '1', '9', 'Cebola', '0.00', '13', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('117', '1', '9', 'Tomate', '0.00', '14', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('118', '1', '9', 'Pimentão', '0.00', '15', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('119', '1', '9', 'Filé Mignon', '0.00', '16', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('120', '1', '10', 'Normal', '0.00', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('121', '1', '10', 'Zero', '0.00', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('122', '1', '4', 'Mussarela', '26.00', '1', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('123', '1', '4', 'Calabresa', '27.00', '2', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('124', '1', '4', 'Mista', '27.00', '3', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('125', '1', '4', 'Bauru', '28.00', '4', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('126', '1', '4', 'Caipira', '29.00', '5', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('127', '1', '4', 'Frango com Catupiry', '29.00', '6', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('128', '1', '4', 'Portuguesa', '27.00', '7', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('129', '1', '4', 'Baiana', '30.00', '8', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('130', '1', '4', '3 Queijos', '30.00', '9', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('131', '1', '4', 'Carne Seca', '31.00', '10', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('132', '1', '4', 'Lasanha', '31.00', '11', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('133', '1', '4', 'Tradicional', '30.00', '12', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('134', '1', '4', 'Camarão', '34.00', '13', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('135', '1', '4', 'Bacon', '28.00', '14', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('136', '1', '4', 'Moda do Chef', '34.00', '15', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('137', '1', '4', 'Bruta de Frango', '35.00', '16', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('138', '1', '4', 'Calabresa Cremosa', '32.00', '17', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('139', '1', '4', 'Camarão especial', '37.00', '18', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('140', '1', '4', 'Cearense', '35.00', '19', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('141', '1', '4', 'Cruzense', '35.00', '20', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('142', '1', '4', 'Nordestina', '37.00', '21', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('143', '1', '4', 'Portuguesa Especial', '37.00', '22', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('144', '1', '4', 'File Mignon', '37.00', '23', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('145', '1', '4', 'Pizza Cum Cum', '35.00', '24', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `adicionais` (`id`, `tenant_id`, `grupo_id`, `nome`, `preco`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('146', '1', '4', 'Monte sua pizza', '36.00', '25', '1', '2026-09-03 13:58:21', '2026-09-04 15:04:07');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('1', '1', 'Centro', '0.00', NULL, NULL, '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('2', '1', 'Aningas', '2.00', NULL, NULL, '1', '2', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('3', '1', 'Canema', '2.00', NULL, NULL, '1', '3', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('4', '1', 'Conjunto São Raimundo', '2.00', NULL, NULL, '1', '4', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('5', '1', 'Malvinas', '2.00', NULL, NULL, '1', '5', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('6', '1', 'Conjunto São Miguel', '3.00', NULL, NULL, '1', '6', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('7', '1', 'Massaranduba', '5.00', NULL, NULL, '1', '7', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('8', '1', 'Belém', '6.00', NULL, NULL, '1', '8', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('9', '1', 'Correguinho dos Muniz', '6.00', NULL, NULL, '1', '9', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('10', '1', 'Jenipapeiro', '6.00', NULL, NULL, '1', '10', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('11', '1', 'Lagoa Salgada', '6.00', NULL, NULL, '1', '11', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('12', '1', 'Lagoa Velha', '7.00', NULL, NULL, '1', '12', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('13', '1', 'Espinhos', '7.00', NULL, NULL, '1', '13', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('14', '1', 'Guarda', '7.00', NULL, NULL, '1', '14', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('15', '1', 'Correguinho dos Silva', '8.00', NULL, NULL, '1', '15', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('16', '1', 'Lagoa velha (depois do Concreto)', '8.00', NULL, NULL, '1', '16', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('17', '1', 'Pitombeiras', '8.00', NULL, NULL, '1', '17', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('18', '1', 'Tucuns', '3.00', NULL, NULL, '1', '18', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('19', '1', 'Conjunto São Francisco', '2.00', NULL, NULL, '1', '19', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('20', '1', 'Conjunto Nova Cruz', '6.00', NULL, NULL, '1', '20', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('21', '1', 'Vila Olimpica (Proximidade)', '4.00', NULL, NULL, '1', '21', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('22', '1', 'Imbé', '11.00', NULL, NULL, '1', '22', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('23', '1', 'Poços', '3.00', NULL, NULL, '1', '23', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `bairros` (`id`, `tenant_id`, `nome`, `taxa_entrega`, `pedido_minimo`, `tempo_estimado_min`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('24', '1', 'Brasilia', '2.00', NULL, NULL, '1', '24', '2026-09-03 13:58:21', '2026-09-03 13:58:21');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `categorias` (`id`, `tenant_id`, `nome`, `descricao`, `imagem`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('1', '1', 'Pizzas Tradicionais', 'A tradição em sabores de pizzas', NULL, '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `categorias` (`id`, `tenant_id`, `nome`, `descricao`, `imagem`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('2', '1', 'Pizzas Doces', 'Quem resiste a uma pizza doce', NULL, '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `categorias` (`id`, `tenant_id`, `nome`, `descricao`, `imagem`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('3', '1', 'Pizzas Premium', 'Aquelas pizza premium', NULL, '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `categorias` (`id`, `tenant_id`, `nome`, `descricao`, `imagem`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('4', '1', 'Esfirras', 'Esfirras com os melhores ingredientes', NULL, '5', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `categorias` (`id`, `tenant_id`, `nome`, `descricao`, `imagem`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('5', '1', 'Esfirras Doces', 'Esfirras + doce, o que poderia dá errado?', NULL, '6', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `categorias` (`id`, `tenant_id`, `nome`, `descricao`, `imagem`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('6', '1', 'Bebidas', 'Opções de bebidas sempre geladas', NULL, '7', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `categorias` (`id`, `tenant_id`, `nome`, `descricao`, `imagem`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('7', '1', 'Pizzas dois sabores', 'E porque não dois Sabores?', NULL, '4', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');

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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('1', '1', 'identidade_visual.nome_empresa', 'Pizzaria Piemonte', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('2', '1', 'identidade_visual.slogan', 'A melhor pizza caseira de Cruz', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('3', '1', 'identidade_visual.logo_url', 'https://clicoucomeu.com.br/cardapios/piemonte/logo.jpeg', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('4', '1', 'identidade_visual.favicon_url', 'https://clicoucomeu.com.br/cardapios/piemonte/pizzaicon.webp', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('5', '1', 'cores.cor_primaria', '#b47e11', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('6', '1', 'cores.cor_secundaria', '#935711', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('7', '1', 'cores.cor_terciaria', '#d0a43b', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('8', '1', 'cores.cor_fundo', '#f7e8a7', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('9', '1', 'cores.cor_texto', '#56624c', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('10', '1', 'cores.cor_texto_secundario', '#56624c', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('11', '1', 'cores.cor_primaria_escura', '#99865f', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('12', '1', 'cores.cor_secundaria_escura', '#6f765e', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('13', '1', 'cores.cor_terciaria_escura', '#505d4a', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('14', '1', 'contato.endereco_completo', 'Av 14 de janeiro, 40 - Centro, Cruz - CE', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('15', '1', 'contato.telefone', '(88) 9 9653-1718', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('16', '1', 'contato.whatsapp', '558896531718', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('17', '1', 'contato.email', 'daviizinho23@gmail.com', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('18', '1', 'redes_sociais.instagram_url', '#-sua-url-do-instagram', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('19', '1', 'redes_sociais.facebook_url', '#-sua-url-do-facebook', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('20', '1', 'redes_sociais.google_negocio_url', '#-sua-url-do-google', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('21', '1', 'seo.titulo_pagina', 'Cardápio Online – Pizzaria Piemonte', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('22', '1', 'seo.descricao_seo', 'Pizzaria especializada e com os melhores ingredientes', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('23', '1', 'seo.palavras_chave', 'cruz, Pizzaria, Esfirras', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('24', '1', 'checkout.step2_opc1', 'Não / Consumo no Local/ Seu pedido será entregue à mesa', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('25', '1', 'checkout.step2_opc2', 'Sim / Retirada no Local / Retire seu pedido no balcão', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('26', '1', 'checkout.step2_opc3', 'Sim / Delivery / Entregamos em seu endereço', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('27', '1', 'checkout.step2_opc4', 'Não / Entrega Padrão / Consulte formas de entrega com o vendedor', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('28', '1', 'checkout.step2_taxa_delivery', 'Pergunte ao Atendente via WhatsApp', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('29', '1', 'checkout.step3_show_formas_pag', 'Sim', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('30', '1', 'checkout.step3_formas_pag', 'Pix, Dinheiro, Cartão de Crédito, Cartão de Débito', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('31', '1', 'checkout.step3_chave_pix', '61465122000148', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('32', '1', 'checkout.step3_mesa_comanda', 'Sim', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('33', '1', 'checkout.step1_itens_obs', 'Sim', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('34', '1', 'checkout.orders_all_time', 'Sim', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('35', '1', 'checkout.valor_pedido_minimo', '20', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('36', '1', 'checkout.only_bairro_mode', 'Sim', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('37', '1', 'checkout.checkout_mode', 'Sim', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('38', '1', 'checkout.checkout_currency', 'BRL', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('39', '1', 'envio.whatsapp_web', 'Sim', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('40', '1', 'envio.webhook_url', '', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('41', '1', 'setup.autor_name', 'Daniel Filho', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('42', '1', 'setup.autor_link', 'www.clicoucomeu.com.br', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('43', '1', 'coupon_meta.PIEMONTE10', '{\"codigo_cupom\":\"PIEMONTE10\",\"tipo_desconto\":\"produtos\",\"valor_desconto\":\"10%\",\"data_inicio\":\"01/01/2020\",\"data_fim\":\"31/12/2020\",\"dias_semana\":\"\",\"categorias\":\"\"}', '2026-09-03 13:58:22', '2026-09-03 13:58:22');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('44', '1', 'coupon_meta.TOTAL5', '{\"codigo_cupom\":\"TOTAL5\",\"tipo_desconto\":\"total\",\"valor_desconto\":\"5\",\"data_inicio\":\"01/01/2021\",\"data_fim\":\"31/12/2021\",\"dias_semana\":\"\",\"categorias\":\"\"}', '2026-09-03 13:58:22', '2026-09-03 13:58:22');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('45', '1', 'coupon_meta.FRETEGRATIS', '{\"codigo_cupom\":\"FRETEGRATIS\",\"tipo_desconto\":\"frete\",\"valor_desconto\":\"100%\",\"data_inicio\":\"01/01/2022\",\"data_fim\":\"31/12/2022\",\"dias_semana\":\"quarta\",\"categorias\":\"\"}', '2026-09-03 13:58:22', '2026-09-03 13:58:22');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('46', '1', 'coupon_meta.OFERTA20', '{\"codigo_cupom\":\"OFERTA20\",\"tipo_desconto\":\"produtos\",\"valor_desconto\":\"20%\",\"data_inicio\":\"01/01/2023\",\"data_fim\":\"31/12/2023\",\"dias_semana\":\"\",\"categorias\":\"\"}', '2026-09-03 13:58:22', '2026-09-03 13:58:22');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('47', '1', 'coupon_meta.ENTREGA50', '{\"codigo_cupom\":\"ENTREGA50\",\"tipo_desconto\":\"frete\",\"valor_desconto\":\"50%\",\"data_inicio\":\"01/01/2024\",\"data_fim\":\"31/12/2024\",\"dias_semana\":\"\",\"categorias\":\"\"}', '2026-09-03 13:58:22', '2026-09-03 13:58:22');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('48', '1', 'coupon_meta.OFERTA30R', '{\"codigo_cupom\":\"OFERTA30R\",\"tipo_desconto\":\"total\",\"valor_desconto\":\"30\",\"data_inicio\":\"01/01/2025\",\"data_fim\":\"31/12/2025\",\"dias_semana\":\"\",\"categorias\":\"\"}', '2026-09-03 13:58:22', '2026-09-03 13:58:22');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('49', '1', 'coupon_meta.PIZZA10', '{\"codigo_cupom\":\"PIZZA10\",\"tipo_desconto\":\"produtos\",\"valor_desconto\":\"10%\",\"data_inicio\":\"01/01/2026\",\"data_fim\":\"31/12/2026\",\"dias_semana\":\"quinta\",\"categorias\":\"tradicionais,premium\"}', '2026-09-03 13:58:22', '2026-09-03 13:58:22');
INSERT INTO `configuracoes` (`id`, `tenant_id`, `chave`, `valor`, `criado_em`, `atualizado_em`) VALUES ('50', '1', 'coupon_meta.10SAVIA', '{\"codigo_cupom\":\"10SAVIA\",\"tipo_desconto\":\"produtos\",\"valor_desconto\":\"10%\",\"data_inicio\":\"01/01/2026\",\"data_fim\":\"31/12/2026\",\"dias_semana\":\"quinta\",\"categorias\":\"tradicionais,premium\"}', '2026-09-03 13:58:22', '2026-09-03 13:58:22');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `cupons` (`id`, `tenant_id`, `codigo`, `tipo`, `valor`, `valor_minimo`, `data_inicio`, `data_fim`, `limite_usos`, `usos`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('1', '1', 'PIEMONTE10', 'percentual', '10.00', NULL, '2020-01-01 00:00:00', '2020-12-31 00:00:00', NULL, '0', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `cupons` (`id`, `tenant_id`, `codigo`, `tipo`, `valor`, `valor_minimo`, `data_inicio`, `data_fim`, `limite_usos`, `usos`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('2', '1', 'TOTAL5', 'valor', '5.00', NULL, '2021-01-01 00:00:00', '2021-12-31 00:00:00', NULL, '0', '1', '2026-09-03 13:58:22', '2026-09-03 13:58:22');
INSERT INTO `cupons` (`id`, `tenant_id`, `codigo`, `tipo`, `valor`, `valor_minimo`, `data_inicio`, `data_fim`, `limite_usos`, `usos`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('3', '1', 'FRETEGRATIS', 'percentual', '100.00', NULL, '2022-01-01 00:00:00', '2022-12-31 00:00:00', NULL, '0', '1', '2026-09-03 13:58:22', '2026-09-03 13:58:22');
INSERT INTO `cupons` (`id`, `tenant_id`, `codigo`, `tipo`, `valor`, `valor_minimo`, `data_inicio`, `data_fim`, `limite_usos`, `usos`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('4', '1', 'OFERTA20', 'percentual', '20.00', NULL, '2023-01-01 00:00:00', '2023-12-31 00:00:00', NULL, '0', '1', '2026-09-03 13:58:22', '2026-09-03 13:58:22');
INSERT INTO `cupons` (`id`, `tenant_id`, `codigo`, `tipo`, `valor`, `valor_minimo`, `data_inicio`, `data_fim`, `limite_usos`, `usos`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('5', '1', 'ENTREGA50', 'percentual', '50.00', NULL, '2024-01-01 00:00:00', '2024-12-31 00:00:00', NULL, '0', '1', '2026-09-03 13:58:22', '2026-09-03 13:58:22');
INSERT INTO `cupons` (`id`, `tenant_id`, `codigo`, `tipo`, `valor`, `valor_minimo`, `data_inicio`, `data_fim`, `limite_usos`, `usos`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('6', '1', 'OFERTA30R', 'valor', '30.00', NULL, '2025-01-01 00:00:00', '2025-12-31 00:00:00', NULL, '0', '1', '2026-09-03 13:58:22', '2026-09-03 13:58:22');
INSERT INTO `cupons` (`id`, `tenant_id`, `codigo`, `tipo`, `valor`, `valor_minimo`, `data_inicio`, `data_fim`, `limite_usos`, `usos`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('7', '1', 'PIZZA10', 'percentual', '10.00', NULL, '2026-01-01 00:00:00', '2026-12-31 00:00:00', NULL, '0', '1', '2026-09-03 13:58:22', '2026-09-03 13:58:22');
INSERT INTO `cupons` (`id`, `tenant_id`, `codigo`, `tipo`, `valor`, `valor_minimo`, `data_inicio`, `data_fim`, `limite_usos`, `usos`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('8', '1', '10SAVIA', 'percentual', '10.00', NULL, '2026-01-01 00:00:00', '2026-12-31 00:00:00', NULL, '0', '1', '2026-09-03 13:58:22', '2026-09-03 13:58:22');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `grupos_adicionais` (`id`, `tenant_id`, `nome`, `minimo`, `maximo`, `obrigatorio`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('1', '1', 'Azeitona', '1', '1', '1', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `grupos_adicionais` (`id`, `tenant_id`, `nome`, `minimo`, `maximo`, `obrigatorio`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('2', '1', 'Borda', '0', '1', '0', '2', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `grupos_adicionais` (`id`, `tenant_id`, `nome`, `minimo`, `maximo`, `obrigatorio`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('3', '1', 'Adicionais', '0', '5', '0', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `grupos_adicionais` (`id`, `tenant_id`, `nome`, `minimo`, `maximo`, `obrigatorio`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('4', '1', 'Escolha os Sabores', '1', '2', '1', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `grupos_adicionais` (`id`, `tenant_id`, `nome`, `minimo`, `maximo`, `obrigatorio`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('6', '1', 'Adicionais', '0', '5', '0', '3', '0', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `grupos_adicionais` (`id`, `tenant_id`, `nome`, `minimo`, `maximo`, `obrigatorio`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('7', '1', 'Borda', '1', '1', '1', '2', '0', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `grupos_adicionais` (`id`, `tenant_id`, `nome`, `minimo`, `maximo`, `obrigatorio`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('8', '1', 'Adicionais', '0', '5', '0', '3', '0', '2026-09-03 13:58:21', '2026-09-04 15:04:07');
INSERT INTO `grupos_adicionais` (`id`, `tenant_id`, `nome`, `minimo`, `maximo`, `obrigatorio`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('9', '1', 'Ingredientes', '0', '4', '0', '3', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `grupos_adicionais` (`id`, `tenant_id`, `nome`, `minimo`, `maximo`, `obrigatorio`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('10', '1', 'Tipo', '1', '1', '1', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `grupos_adicionais` (`id`, `tenant_id`, `nome`, `minimo`, `maximo`, `obrigatorio`, `ordem`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('11', '1', 'Escolha os Sabores', '1', '2', '1', '1', '0', '2026-09-03 13:58:21', '2026-09-04 15:04:07');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `horarios_funcionamento` (`id`, `tenant_id`, `dia_semana`, `abertura`, `fechamento`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('1', '1', '2', '18:00:00', '22:00:00', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `horarios_funcionamento` (`id`, `tenant_id`, `dia_semana`, `abertura`, `fechamento`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('2', '1', '3', '18:00:00', '22:00:00', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `horarios_funcionamento` (`id`, `tenant_id`, `dia_semana`, `abertura`, `fechamento`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('3', '1', '4', '18:00:00', '22:00:00', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `horarios_funcionamento` (`id`, `tenant_id`, `dia_semana`, `abertura`, `fechamento`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('4', '1', '5', '18:00:00', '22:00:00', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `horarios_funcionamento` (`id`, `tenant_id`, `dia_semana`, `abertura`, `fechamento`, `ativo`, `criado_em`, `atualizado_em`) VALUES ('5', '1', '0', '18:00:00', '22:00:00', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');

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

INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('1', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('4', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('5', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('7', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('9', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('11', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('12', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('14', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('15', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('40', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('41', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('42', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('43', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('44', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('45', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('46', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('47', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('48', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('49', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('50', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('54', '1');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('1', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('4', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('5', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('7', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('9', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('11', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('12', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('14', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('15', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('16', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('17', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('18', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('20', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('21', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('34', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('35', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('36', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('37', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('38', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('39', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('40', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('41', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('42', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('43', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('44', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('45', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('46', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('47', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('48', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('49', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('50', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('54', '2');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('1', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('4', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('5', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('7', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('9', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('11', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('12', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('14', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('15', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('40', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('41', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('42', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('43', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('44', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('45', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('46', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('47', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('48', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('50', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('54', '3');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('40', '4');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('54', '4');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('49', '9');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('51', '10');
INSERT INTO `produto_grupos_adicionais` (`produto_id`, `grupo_id`) VALUES ('52', '10');

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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('1', '1', '1', 'Mussarela', '0001-mussarela', 'Mussarela, tomate e orégano', '21.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '1', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('2', '1', '1', 'Calabresa', '0002-calabresa', 'Calabresa, cebola e mussarela', '22.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '2', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('3', '1', '1', 'Mista', '0003-mista', 'Queijo e presunto', '22.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '3', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('4', '1', '1', 'Bauru', '0004-bauru', 'Presunto, tomate e queijo', '23.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '4', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('5', '1', '1', 'Caipira', '0005-caipira', 'Frango, catupiry e milho', '24.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '5', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('6', '1', '1', 'Frango com Catupiry', '0006-frango-com-catupiry', 'Frango e catupiry', '24.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '6', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('7', '1', '1', 'Portuguesa', '0007-portuguesa', 'Presunto, cebola, ovo, ervilha e mussarela', '24.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '7', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('8', '1', '1', 'Baiana', '0008-baiana', 'Calabresa moída, cebola, ovo, pimenta e mussarela', '25.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '8', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('9', '1', '1', '3 Queijos', '0009-3-queijos', 'Catupiry, cheddar e mussarela', '25.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '9', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('10', '1', '1', 'Carne Seca', '0010-carne-seca', 'Carne seca, cebola, tomate e mussarela', '26.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '10', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('11', '1', '1', 'Lasanha', '0011-lasanha', 'Presunto, mussarela, carne moída, tomate e molho de tomate', '26.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '11', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('12', '1', '1', 'Tradicional', '0012-tradicional', 'Queijo, presunto, tomate, azeitona, ovo e manjericão', '25.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '12', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('13', '1', '1', 'Camarão', '0013-camar-ao', 'Camarão, cebola e mussarela', '27.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '13', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('14', '1', '1', 'Bacon', '0014-bacon', 'Mussarela, bacon e cebola', '23.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '14', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('15', '1', '1', 'Moda do Chef', '0015-moda-do-chef', 'Calabresa, cebola, mussarela e bacon', '28.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '15', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('16', '1', '2', 'Brigadeiro', '0016-brigadeiro', 'Chocolate cremoso coberto com granulado', '22.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '16', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('17', '1', '2', 'Doce de Leite', '0017-doce-de-leite', 'Doce de leite, Mussarela e açucar de confeiteiro', '30.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '17', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('18', '1', '2', 'Nutella', '0018-nutella', 'Nuttela Original e morango', '26.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '18', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('19', '1', '2', 'Preto e Branco', '0019-preto-e-branco', 'Chocolate preto, chocolate branco e granulado', '25.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '19', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('20', '1', '2', 'Romeu e Juulieta', '0020-romeu-e-juulieta', 'Goiabada e mussarela', '20.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '20', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('21', '1', '2', 'Sensação', '0021-sensac-ao', 'Chocolate avelã, Chocolate Branco e Morango', '26.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '21', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('22', '1', '4', 'Baiana', '0022-baiana', '', '6.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '22', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('23', '1', '4', 'Calabresa', '0023-calabresa', '', '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '23', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('24', '1', '4', 'Calabresa com Catupiry', '0024-calabresa-com-catupiry', '', '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '24', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('25', '1', '4', 'Camarão', '0025-camar-ao', '', '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '25', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('26', '1', '4', 'Carne Moida', '0026-carne-moida', '', '6.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '26', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('27', '1', '4', 'Carne Moida com Catupiry', '0027-carne-moida-com-catupiry', '', '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '27', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('28', '1', '4', 'Carne Seca com Caturiry', '0028-carne-seca-com-caturiry', '', '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '28', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('29', '1', '4', 'Carne Seca', '0029-carne-seca', '', '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '29', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('30', '1', '4', 'Frango', '0030-frango', '', '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '30', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('31', '1', '4', 'Frango com Catupiry', '0031-frango-com-catupiry', '', '6.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '31', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('32', '1', '4', 'Mista', '0032-mista', '', '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '32', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('33', '1', '4', 'Queijo', '0033-queijo', '', '6.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '33', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('34', '1', '5', 'Brigadeiro', '0034-brigadeiro', '', '6.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '34', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('35', '1', '5', 'Doce de Leite', '0035-doce-de-leite', '', '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '35', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('36', '1', '5', 'Nutella', '0036-nutella', '', '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '36', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('37', '1', '5', 'Prestigio', '0037-prestigio', '', '6.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '37', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('38', '1', '5', 'Romeu e Juulieta', '0038-romeu-e-juulieta', '', '6.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '38', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('39', '1', '5', 'Sensação', '0039-sensac-ao', '', '7.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/esfihas.png', '0', '1', '1', '39', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('40', '1', '7', 'Pizza dois sabores G', '0041-pizza-dois-sabores-g', 'Escolha dois sabores da pizza G', '0.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '40', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('41', '1', '3', 'Bruta de Frango', '0042-bruta-de-frango', 'Frango temperado, bacon em cubos, cheddar e oregano', '28.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '41', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('42', '1', '3', 'Calabresa Cremosa', '0043-calabresa-cremosa', 'Calabresa fatiada, cebola, catupiry, azeitona e oregano', '26.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '42', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('43', '1', '3', 'Camarão especial', '0044-camar-ao-especial', 'Camarão, presunto, ovo, calabresa, musssarela, oregano', '30.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '43', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('44', '1', '3', 'Cearense', '0045-cearense', 'Camarão, presunto, ovo,  musssarela, oregano', '29.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '44', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('45', '1', '3', 'Cruzense', '0046-cruzense', 'Presunto, cebola, mussarela, catupiry, bacon e oregano', '28.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '45', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('46', '1', '3', 'Nordestina', '0047-nordestina', 'Carne de sol, catupury, cebola roxa e oregano', '30.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '46', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('47', '1', '3', 'Portuguesa Especial', '0048-portuguesa-especial', 'Presunto, mussarela, carne moida, ovo, cebola, pimentão e oregano', '32.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '47', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('48', '1', '3', 'File Mignon', '0049-file-mignon', 'File mignon, mussarela , alho frito, catupiry, cebola e oregano', '32.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '48', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('49', '1', '3', 'Monte sua pizza', '0050-monte-sua-pizza', '4 ingredientes da sua escolha', '31.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '49', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('50', '1', '3', 'Pizza Cum Cum', '0051-pizza-cum-cum', 'Mussarela, carne seca, ovo calabresa, cebola, tomate e orégano', '29.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '50', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('51', '1', '6', 'Coca-cola', '0052-coca-cola', '', '0.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/coca.jpg', '0', '1', '1', '51', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('52', '1', '6', 'Guaraná', '0053-guaran-a', '', '0.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/guarana.png', '0', '1', '1', '52', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('53', '1', '6', 'Pepsi 1 l', '0054-pepsi-1-l', 'Pepsi de 1 litro', '8.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pepsi.png', '0', '1', '1', '53', '2026-09-03 13:58:21', '2026-09-03 13:58:21');
INSERT INTO `produtos` (`id`, `tenant_id`, `categoria_id`, `nome`, `slug`, `descricao`, `preco`, `imagem`, `destaque`, `disponivel`, `ativo`, `ordem`, `criado_em`, `atualizado_em`) VALUES ('54', '1', '7', 'Pizza dois sabores M', '0055-pizza-dois-sabores-m', 'Escolha dois sabores da pizza M', '0.00', 'https://clicoucomeu.com.br/cardapios/piemonte/images/pizza.png', '0', '1', '1', '54', '2026-09-03 13:58:21', '2026-09-03 13:58:21');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tenants` (`id`, `nome`, `slug`, `razao_social`, `documento`, `telefone`, `whatsapp`, `email`, `logo`, `cor_primaria`, `cor_secundaria`, `endereco`, `cidade`, `uf`, `timezone`, `status`, `plano`, `criado_em`, `atualizado_em`) VALUES ('1', 'Piemonte', 'piemonte', NULL, NULL, '(88) 9 9653-1718', '558896531718', 'daviizinho23@gmail.com', 'https://clicoucomeu.com.br/cardapios/piemonte/logo.jpeg', '#b47e11', '#935711', 'Av 14 de janeiro, 40 - Centro, Cruz - CE', 'Cruz', 'CE', 'America/Sao_Paulo', 'ativo', 'pro', '2026-09-03 13:58:21', '2026-09-04 14:41:22');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `usuarios` (`id`, `tenant_id`, `nome`, `email`, `usuario`, `senha_hash`, `perfil`, `ativo`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('1', NULL, 'Super Admin', NULL, 'superadmin', '$2y$10$zTXkLExt1x9GwhIXQP3BvuKSxmbu.AzOqt9tZRsmclvDCs8mbbs8K', 'superadmin', '1', '2026-09-04 18:15:51', '2026-09-03 16:03:07', '2026-09-04 15:15:51');
INSERT INTO `usuarios` (`id`, `tenant_id`, `nome`, `email`, `usuario`, `senha_hash`, `perfil`, `ativo`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('2', '1', 'Admin Piemonte', NULL, 'piemonte', '$2y$10$zTXkLExt1x9GwhIXQP3BvuKSxmbu.AzOqt9tZRsmclvDCs8mbbs8K', 'admin', '1', '2026-09-04 18:16:48', '2026-09-03 16:03:07', '2026-09-04 15:16:48');

SET FOREIGN_KEY_CHECKS=1;
