# Clicou Comeu — Modelo de Banco de Dados MySQL

## 1. Diretrizes

- MySQL 8+.
- Engine InnoDB.
- Charset `utf8mb4`.
- Chaves primárias `BIGINT UNSIGNED` onde necessário.
- Datas em UTC no banco, convertidas para timezone do tenant na aplicação.
- Exclusão lógica quando fizer sentido.
- Todas as tabelas operacionais devem possuir `tenant_id` quando aplicável.

## 2. tenants

```sql
CREATE TABLE tenants (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    slug VARCHAR(120) NOT NULL UNIQUE,
    razao_social VARCHAR(180) NULL,
    documento VARCHAR(30) NULL,
    telefone VARCHAR(30) NULL,
    whatsapp VARCHAR(30) NULL,
    email VARCHAR(150) NULL,
    logo VARCHAR(255) NULL,
    cor_primaria VARCHAR(20) NULL,
    cor_secundaria VARCHAR(20) NULL,
    endereco VARCHAR(255) NULL,
    cidade VARCHAR(100) NULL,
    uf CHAR(2) NULL,
    timezone VARCHAR(80) NOT NULL DEFAULT 'America/Fortaleza',
    status ENUM('ativo','bloqueado','cancelado') NOT NULL DEFAULT 'ativo',
    plano VARCHAR(50) NULL,
    criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 3. usuarios

```sql
CREATE TABLE usuarios (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenant_id BIGINT UNSIGNED NULL,
    nome VARCHAR(120) NOT NULL,
    email VARCHAR(150) NULL,
    usuario VARCHAR(80) NOT NULL,
    senha_hash VARCHAR(255) NOT NULL,
    perfil ENUM('superadmin','admin','operador','cozinha') NOT NULL,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    ultimo_login DATETIME NULL,
    criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uk_usuario_tenant (tenant_id, usuario),
    CONSTRAINT fk_usuarios_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 4. categorias

```sql
CREATE TABLE categorias (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenant_id BIGINT UNSIGNED NOT NULL,
    nome VARCHAR(120) NOT NULL,
    descricao VARCHAR(255) NULL,
    imagem VARCHAR(255) NULL,
    ordem INT NOT NULL DEFAULT 0,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_categorias_tenant_ordem (tenant_id, ordem),
    CONSTRAINT fk_categorias_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 5. produtos

```sql
CREATE TABLE produtos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenant_id BIGINT UNSIGNED NOT NULL,
    categoria_id BIGINT UNSIGNED NOT NULL,
    nome VARCHAR(160) NOT NULL,
    slug VARCHAR(180) NULL,
    descricao TEXT NULL,
    preco DECIMAL(10,2) NULL,
    imagem VARCHAR(255) NULL,
    destaque TINYINT(1) NOT NULL DEFAULT 0,
    disponivel TINYINT(1) NOT NULL DEFAULT 1,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    ordem INT NOT NULL DEFAULT 0,
    criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_produtos_tenant_categoria (tenant_id, categoria_id),
    INDEX idx_produtos_disponivel (tenant_id, disponivel, ativo),
    CONSTRAINT fk_produtos_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id),
    CONSTRAINT fk_produtos_categoria FOREIGN KEY (categoria_id) REFERENCES categorias(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 6. produto_variacoes

```sql
CREATE TABLE produto_variacoes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenant_id BIGINT UNSIGNED NOT NULL,
    produto_id BIGINT UNSIGNED NOT NULL,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    ordem INT NOT NULL DEFAULT 0,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_variacoes_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id),
    CONSTRAINT fk_variacoes_produto FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 7. grupos_adicionais

```sql
CREATE TABLE grupos_adicionais (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenant_id BIGINT UNSIGNED NOT NULL,
    nome VARCHAR(120) NOT NULL,
    minimo INT NOT NULL DEFAULT 0,
    maximo INT NOT NULL DEFAULT 1,
    obrigatorio TINYINT(1) NOT NULL DEFAULT 0,
    ordem INT NOT NULL DEFAULT 0,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_grupos_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 8. adicionais

```sql
CREATE TABLE adicionais (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenant_id BIGINT UNSIGNED NOT NULL,
    grupo_id BIGINT UNSIGNED NOT NULL,
    nome VARCHAR(120) NOT NULL,
    preco DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    ordem INT NOT NULL DEFAULT 0,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_adicionais_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id),
    CONSTRAINT fk_adicionais_grupo FOREIGN KEY (grupo_id) REFERENCES grupos_adicionais(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 9. produto_grupos_adicionais

```sql
CREATE TABLE produto_grupos_adicionais (
    produto_id BIGINT UNSIGNED NOT NULL,
    grupo_id BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (produto_id, grupo_id),
    CONSTRAINT fk_pga_produto FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE,
    CONSTRAINT fk_pga_grupo FOREIGN KEY (grupo_id) REFERENCES grupos_adicionais(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 10. formas_pagamento

```sql
CREATE TABLE formas_pagamento (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenant_id BIGINT UNSIGNED NOT NULL,
    nome VARCHAR(100) NOT NULL,
    tipo ENUM('dinheiro','pix','credito','debito','outro') NOT NULL,
    pedir_troco TINYINT(1) NOT NULL DEFAULT 0,
    dados_pix TEXT NULL,
    ordem INT NOT NULL DEFAULT 0,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    CONSTRAINT fk_pagamentos_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 11. bairros

```sql
CREATE TABLE bairros (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenant_id BIGINT UNSIGNED NOT NULL,
    nome VARCHAR(120) NOT NULL,
    taxa_entrega DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    pedido_minimo DECIMAL(10,2) NULL,
    tempo_estimado_min INT NULL,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    ordem INT NOT NULL DEFAULT 0,
    CONSTRAINT fk_bairros_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 12. horarios_funcionamento

```sql
CREATE TABLE horarios_funcionamento (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenant_id BIGINT UNSIGNED NOT NULL,
    dia_semana TINYINT NOT NULL,
    abertura TIME NULL,
    fechamento TIME NULL,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    CONSTRAINT fk_horarios_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id),
    INDEX idx_horarios_tenant_dia (tenant_id, dia_semana)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 13. configuracoes

```sql
CREATE TABLE configuracoes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenant_id BIGINT UNSIGNED NOT NULL,
    chave VARCHAR(120) NOT NULL,
    valor TEXT NULL,
    UNIQUE KEY uk_config_tenant_chave (tenant_id, chave),
    CONSTRAINT fk_config_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

Chaves sugeridas:

- `loja_aberta_manual`
- `mensagem_fechado`
- `pedido_minimo_geral`
- `tempo_estimado_padrao`
- `tipo_impressao`
- `whatsapp_confirmacao`
- `aceite_automatico`

## 14. clientes

```sql
CREATE TABLE clientes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenant_id BIGINT UNSIGNED NOT NULL,
    nome VARCHAR(150) NOT NULL,
    whatsapp VARCHAR(30) NOT NULL,
    email VARCHAR(150) NULL,
    criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_clientes_tenant_whatsapp (tenant_id, whatsapp),
    CONSTRAINT fk_clientes_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 15. enderecos

```sql
CREATE TABLE enderecos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenant_id BIGINT UNSIGNED NOT NULL,
    cliente_id BIGINT UNSIGNED NOT NULL,
    bairro_id BIGINT UNSIGNED NULL,
    logradouro VARCHAR(180) NOT NULL,
    numero VARCHAR(30) NULL,
    complemento VARCHAR(120) NULL,
    referencia VARCHAR(180) NULL,
    cep VARCHAR(12) NULL,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    CONSTRAINT fk_enderecos_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id),
    CONSTRAINT fk_enderecos_cliente FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
    CONSTRAINT fk_enderecos_bairro FOREIGN KEY (bairro_id) REFERENCES bairros(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 16. cupons

```sql
CREATE TABLE cupons (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenant_id BIGINT UNSIGNED NOT NULL,
    codigo VARCHAR(50) NOT NULL,
    tipo ENUM('percentual','valor','frete_gratis') NOT NULL,
    valor DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    valor_minimo DECIMAL(10,2) NULL,
    data_inicio DATETIME NULL,
    data_fim DATETIME NULL,
    limite_usos INT NULL,
    usos INT NOT NULL DEFAULT 0,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    UNIQUE KEY uk_cupom_tenant_codigo (tenant_id, codigo),
    CONSTRAINT fk_cupons_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 17. pedidos

```sql
CREATE TABLE pedidos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenant_id BIGINT UNSIGNED NOT NULL,
    cliente_id BIGINT UNSIGNED NULL,
    bairro_id BIGINT UNSIGNED NULL,
    forma_pagamento_id BIGINT UNSIGNED NULL,
    cupom_id BIGINT UNSIGNED NULL,
    numero INT NOT NULL,
    token VARCHAR(64) NOT NULL UNIQUE,
    cliente_nome VARCHAR(150) NOT NULL,
    cliente_whatsapp VARCHAR(30) NOT NULL,
    tipo_recebimento ENUM('delivery','retirada') NOT NULL,
    endereco VARCHAR(180) NULL,
    numero_endereco VARCHAR(30) NULL,
    complemento VARCHAR(120) NULL,
    referencia VARCHAR(180) NULL,
    bairro_nome VARCHAR(120) NULL,
    forma_pagamento_nome VARCHAR(100) NULL,
    troco_para DECIMAL(10,2) NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    taxa_entrega DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    desconto DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    total DECIMAL(10,2) NOT NULL,
    observacao TEXT NULL,
    status ENUM('novo','aceito','preparando','pronto','saiu_para_entrega','finalizado','retirado','cancelado') NOT NULL DEFAULT 'novo',
    criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    aceito_em DATETIME NULL,
    preparo_em DATETIME NULL,
    pronto_em DATETIME NULL,
    saiu_entrega_em DATETIME NULL,
    finalizado_em DATETIME NULL,
    cancelado_em DATETIME NULL,
    INDEX idx_pedidos_tenant_status (tenant_id, status, criado_em),
    UNIQUE KEY uk_pedido_numero_tenant (tenant_id, numero),
    CONSTRAINT fk_pedidos_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id),
    CONSTRAINT fk_pedidos_cliente FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    CONSTRAINT fk_pedidos_bairro FOREIGN KEY (bairro_id) REFERENCES bairros(id),
    CONSTRAINT fk_pedidos_pagamento FOREIGN KEY (forma_pagamento_id) REFERENCES formas_pagamento(id),
    CONSTRAINT fk_pedidos_cupom FOREIGN KEY (cupom_id) REFERENCES cupons(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 18. pedido_itens

```sql
CREATE TABLE pedido_itens (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenant_id BIGINT UNSIGNED NOT NULL,
    pedido_id BIGINT UNSIGNED NOT NULL,
    produto_id BIGINT UNSIGNED NULL,
    variacao_id BIGINT UNSIGNED NULL,
    produto_nome VARCHAR(160) NOT NULL,
    variacao_nome VARCHAR(100) NULL,
    quantidade DECIMAL(10,3) NOT NULL DEFAULT 1,
    valor_unitario DECIMAL(10,2) NOT NULL,
    valor_adicionais DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    valor_total DECIMAL(10,2) NOT NULL,
    observacao TEXT NULL,
    CONSTRAINT fk_itens_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id),
    CONSTRAINT fk_itens_pedido FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    CONSTRAINT fk_itens_produto FOREIGN KEY (produto_id) REFERENCES produtos(id),
    CONSTRAINT fk_itens_variacao FOREIGN KEY (variacao_id) REFERENCES produto_variacoes(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 19. pedido_item_adicionais

```sql
CREATE TABLE pedido_item_adicionais (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenant_id BIGINT UNSIGNED NOT NULL,
    pedido_item_id BIGINT UNSIGNED NOT NULL,
    adicional_id BIGINT UNSIGNED NULL,
    nome VARCHAR(120) NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,
    valor_unitario DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    valor_total DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    CONSTRAINT fk_pia_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id),
    CONSTRAINT fk_pia_item FOREIGN KEY (pedido_item_id) REFERENCES pedido_itens(id) ON DELETE CASCADE,
    CONSTRAINT fk_pia_adicional FOREIGN KEY (adicional_id) REFERENCES adicionais(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 20. pedido_historico_status

```sql
CREATE TABLE pedido_historico_status (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenant_id BIGINT UNSIGNED NOT NULL,
    pedido_id BIGINT UNSIGNED NOT NULL,
    usuario_id BIGINT UNSIGNED NULL,
    status_anterior VARCHAR(40) NULL,
    status_novo VARCHAR(40) NOT NULL,
    observacao VARCHAR(255) NULL,
    criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_hist_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id),
    CONSTRAINT fk_hist_pedido FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    CONSTRAINT fk_hist_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 21. sequencias_pedido

```sql
CREATE TABLE sequencias_pedido (
    tenant_id BIGINT UNSIGNED PRIMARY KEY,
    ultimo_numero INT NOT NULL DEFAULT 0,
    CONSTRAINT fk_seq_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

A criação do número deve ocorrer dentro da mesma transação do pedido.

## 22. auditoria

Opcional para segunda fase:

```sql
CREATE TABLE auditoria (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tenant_id BIGINT UNSIGNED NULL,
    usuario_id BIGINT UNSIGNED NULL,
    entidade VARCHAR(80) NOT NULL,
    entidade_id BIGINT UNSIGNED NULL,
    acao VARCHAR(40) NOT NULL,
    dados JSON NULL,
    ip VARCHAR(45) NULL,
    criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 23. Regras de Integridade

- Nunca aceitar `tenant_id` enviado pelo navegador como autoridade.
- Tenant administrativo deve vir da sessão autenticada.
- Tenant público deve ser resolvido pelo slug da URL.
- Valores do pedido devem ser recalculados no servidor.
- Produto, variação e adicional devem ser validados contra o tenant.
- O preço enviado pelo browser nunca deve ser considerado definitivo.
- Inserção de pedido e itens deve usar transação.
