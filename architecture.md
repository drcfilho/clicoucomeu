# Clicou Comeu — Arquitetura

## 1. Stack

### Backend

- PHP 8.2+
- PDO
- MySQL 8+

### Frontend

- HTML5
- CSS3
- Bootstrap 5
- JavaScript ES6+
- Fetch API

### Infraestrutura

- Apache ou Nginx.
- HTTPS obrigatório.
- Hospedagem compartilhada ou VPS.

## 2. Estilo Arquitetural

Aplicação monolítica modular multi-tenant.

Não será um framework completo, mas seguirá separação clara entre:

- Controllers.
- Services.
- Repositories.
- Views.
- Middlewares.
- Helpers.

## 3. Estrutura de Diretórios

```text
/
├── public/
│   ├── index.php
│   ├── .htaccess
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   └── img/
│   └── uploads/
│       └── produtos/
│
├── app/
│   ├── Config/
│   │   ├── app.php
│   │   └── database.php
│   ├── Controllers/
│   │   ├── Public/
│   │   ├── Painel/
│   │   ├── Cozinha/
│   │   └── Admin/
│   ├── Services/
│   ├── Repositories/
│   ├── Middleware/
│   ├── Helpers/
│   ├── Validation/
│   └── Views/
│       ├── public/
│       ├── painel/
│       ├── cozinha/
│       └── admin/
│
├── routes/
│   ├── web.php
│   └── api.php
│
├── storage/
│   ├── logs/
│   └── cache/
│
└── scripts/
    ├── install.sql
    └── seed.php
```

## 4. Fluxo de Requisição Pública

```text
Request
  ↓
Router
  ↓
TenantResolver pelo slug
  ↓
Controller
  ↓
Service
  ↓
Repository
  ↓
MySQL
  ↓
View / JSON
```

## 5. Fluxo Administrativo

```text
Request /painel/*
  ↓
AuthMiddleware
  ↓
TenantMiddleware
  ↓
PermissionMiddleware
  ↓
Controller
  ↓
Service
  ↓
Repository
  ↓
MySQL
```

## 6. Resolução Multi-Tenant

### Público

Tenant obtido pelo slug da URL.

Exemplo:

`/piemonte/`

Resolve:

```sql
SELECT * FROM tenants WHERE slug = 'piemonte' AND status = 'ativo';
```

### Painel

Tenant obtido exclusivamente da sessão:

```php
$_SESSION['tenant_id'];
```

Nunca aceitar `tenant_id` arbitrário via POST ou GET para operações administrativas.

## 7. Autenticação

### Sessão

```php
$_SESSION['usuario_id'];
$_SESSION['tenant_id'];
$_SESSION['perfil'];
$_SESSION['nome'];
```

### Requisitos

- `session_regenerate_id(true)` após login.
- Cookie `HttpOnly`.
- Cookie `Secure` em HTTPS.
- `SameSite=Lax` ou `Strict`.
- Timeout de sessão configurável.

## 8. Autorização

Perfis:

- superadmin
- admin
- operador
- cozinha

Permissões verificadas antes de cada ação.

## 9. Camadas

### Controller

Recebe request e devolve response.

Não deve conter SQL.

### Service

Contém regras de negócio.

Exemplos:

- cálculo do pedido.
- validação de horário.
- aplicação de cupom.
- transição de status.

### Repository

Acesso ao banco via PDO.

### View

HTML e componentes visuais.

## 10. Pedidos

### Criação

O frontend envia apenas referências e escolhas do cliente.

O servidor deve:

1. Resolver tenant.
2. Verificar se loja está aberta.
3. Validar produtos.
4. Validar variações.
5. Validar adicionais.
6. Buscar preços reais no banco.
7. Calcular subtotal.
8. Validar taxa de entrega.
9. Validar cupom.
10. Calcular total.
11. Criar cliente ou localizar existente.
12. Criar pedido.
13. Criar itens.
14. Criar adicionais.
15. Registrar histórico.
16. Commit.

Tudo dentro de transação.

## 11. Atualização de Pedidos

No MVP, a tela de pedidos usará polling.

Exemplo:

```javascript
setInterval(atualizarPedidos, 5000);
```

A API retorna apenas pedidos alterados desde um timestamp quando possível.

## 12. Som de Novo Pedido

O navegador mantém o último ID conhecido.

Quando a API retornar um pedido novo:

- destacar visualmente.
- tocar som.
- atualizar contador.

O usuário deve interagir ao menos uma vez com a página para liberar áudio em navegadores modernos.

## 13. Impressão

### MVP

Página HTML específica de impressão.

```text
/print/pedido/{id}
```

CSS:

- 58 mm.
- 80 mm.
- A4.

A impressão é disparada pelo operador.

### Futuro

Criar módulo opcional para impressão silenciosa/local.

## 14. Upload de Imagens

Diretório:

```text
/public/uploads/produtos/{tenant_id}/
```

Regras:

- Validar MIME real.
- Aceitar JPEG, PNG e WebP.
- Limitar tamanho.
- Gerar nome aleatório.
- Evitar confiar na extensão original.
- Redimensionar imagens grandes.

## 15. URLs

Sugestão com reescrita:

```text
/{tenant}/
/{tenant}/produto/{slug}
/{tenant}/checkout
/pedido/{token}
/painel/
/painel/pedidos
/painel/produtos
/cozinha/
/admin/
```

## 16. Segurança

### Banco

- PDO prepared statements.
- Usuário MySQL exclusivo da aplicação.
- Privilégios mínimos.

### CSRF

Todos os POSTs administrativos devem possuir token CSRF.

### XSS

Toda saída deve ser escapada por padrão.

### Rate limiting

Aplicar limites simples em:

- Login.
- Criação de pedido.
- Consulta pública de pedido.

### Logs

Registrar:

- Falhas de login.
- Erros críticos.
- Mudanças de status.
- Falhas na criação de pedidos.

Nunca registrar senhas.

## 17. Cache

O MVP pode utilizar cache simples em arquivo para:

- Configurações do tenant.
- Categorias.
- Cardápio público.

Invalidar cache quando o admin alterar dados.

## 18. Performance

- Índices por tenant.
- Paginação de pedidos históricos.
- Imagens otimizadas.
- Lazy loading no cardápio.
- Minificação opcional de assets.
- Evitar consultas N+1.

## 19. Backups

- Backup diário do MySQL.
- Backup periódico das imagens.
- Retenção mínima sugerida de 7 dias.

## 20. Implantação

### Requisitos mínimos

- PHP 8.2.
- MySQL 8.
- Extensões PDO e mbstring.
- HTTPS.
- mod_rewrite caso Apache.

### Configuração

Arquivo `.env` ou arquivo PHP fora da pasta pública contendo:

- DB_HOST
- DB_NAME
- DB_USER
- DB_PASS
- APP_URL
- APP_ENV
- APP_KEY
