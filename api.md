# Clicou Comeu — API Interna

## 1. Objetivo

A API interna atenderá o frontend público, o painel administrativo e a tela da cozinha.

No MVP, será implementada em PHP e retornará JSON.

Prefixo sugerido:

```text
/api/v1/
```

## 2. Padrão de Resposta

### Sucesso

```json
{
  "success": true,
  "data": {}
}
```

### Erro

```json
{
  "success": false,
  "error": {
    "code": "VALIDATION_ERROR",
    "message": "Dados inválidos",
    "fields": {}
  }
}
```

## 3. Autenticação

### Painel

Sessão PHP.

### Público

Sem login.

Tenant resolvido pelo slug.

## 4. Cardápio

### GET `/api/v1/public/{tenant}/menu`

Retorna:

- Tenant.
- Categorias.
- Produtos.
- Variações.
- Grupos de adicionais.
- Formas de pagamento.
- Bairros.
- Status da loja.

### GET `/api/v1/public/{tenant}/product/{id}`

Retorna detalhes completos de um produto.

## 5. Pedidos Públicos

### POST `/api/v1/public/{tenant}/orders`

Cria pedido.

Exemplo:

```json
{
  "customer": {
    "name": "Daniel",
    "whatsapp": "88999999999"
  },
  "fulfillment": {
    "type": "delivery",
    "bairro_id": 2,
    "address": "Rua Exemplo",
    "number": "100",
    "complement": "Casa azul",
    "reference": "Próximo à praça"
  },
  "payment": {
    "payment_method_id": 1,
    "change_for": 100
  },
  "coupon": "PROMO10",
  "items": [
    {
      "product_id": 15,
      "variation_id": 40,
      "quantity": 1,
      "notes": "Sem cebola",
      "addons": [
        {
          "addon_id": 90,
          "quantity": 1
        }
      ]
    }
  ],
  "notes": "Tocar campainha"
}
```

Importante: o servidor recalcula todos os valores.

Resposta:

```json
{
  "success": true,
  "data": {
    "order_number": 152,
    "token": "a81f0ef621...",
    "status": "novo",
    "total": 69.00
  }
}
```

### GET `/api/v1/public/orders/{token}`

Retorna status público do pedido.

## 6. Autenticação

### POST `/api/v1/auth/login`

```json
{
  "usuario": "admin",
  "senha": "***"
}
```

### POST `/api/v1/auth/logout`

Encerra sessão.

### GET `/api/v1/auth/me`

Retorna usuário autenticado.

## 7. Pedidos do Painel

### GET `/api/v1/panel/orders`

Parâmetros:

- `status`
- `date`
- `page`
- `updated_after`

### GET `/api/v1/panel/orders/{id}`

Retorna pedido completo.

### PATCH `/api/v1/panel/orders/{id}/status`

```json
{
  "status": "preparando"
}
```

Validar transições permitidas.

### POST `/api/v1/panel/orders/{id}/cancel`

```json
{
  "reason": "Produto indisponível"
}
```

## 8. Produtos

### GET `/api/v1/panel/products`

### POST `/api/v1/panel/products`

### GET `/api/v1/panel/products/{id}`

### PUT `/api/v1/panel/products/{id}`

### DELETE `/api/v1/panel/products/{id}`

Preferir exclusão lógica quando produto já estiver em pedido histórico.

### PATCH `/api/v1/panel/products/{id}/availability`

```json
{
  "available": false
}
```

### POST `/api/v1/panel/products/{id}/duplicate`

## 9. Categorias

### GET `/api/v1/panel/categories`

### POST `/api/v1/panel/categories`

### PUT `/api/v1/panel/categories/{id}`

### DELETE `/api/v1/panel/categories/{id}`

### PATCH `/api/v1/panel/categories/reorder`

```json
{
  "ids": [4, 2, 8, 10]
}
```

## 10. Variações

### POST `/api/v1/panel/products/{product_id}/variations`

### PUT `/api/v1/panel/variations/{id}`

### DELETE `/api/v1/panel/variations/{id}`

## 11. Grupos de Adicionais

### GET `/api/v1/panel/addon-groups`

### POST `/api/v1/panel/addon-groups`

### PUT `/api/v1/panel/addon-groups/{id}`

### DELETE `/api/v1/panel/addon-groups/{id}`

### POST `/api/v1/panel/products/{id}/addon-groups`

Associa grupos a produto.

## 12. Adicionais

### POST `/api/v1/panel/addons`

### PUT `/api/v1/panel/addons/{id}`

### DELETE `/api/v1/panel/addons/{id}`

## 13. Bairros e Entrega

### GET `/api/v1/panel/neighborhoods`

### POST `/api/v1/panel/neighborhoods`

### PUT `/api/v1/panel/neighborhoods/{id}`

### DELETE `/api/v1/panel/neighborhoods/{id}`

## 14. Pagamentos

### GET `/api/v1/panel/payment-methods`

### POST `/api/v1/panel/payment-methods`

### PUT `/api/v1/panel/payment-methods/{id}`

### DELETE `/api/v1/panel/payment-methods/{id}`

## 15. Horários

### GET `/api/v1/panel/opening-hours`

### PUT `/api/v1/panel/opening-hours`

### POST `/api/v1/panel/store/close-temporarily`

```json
{
  "minutes": 60
}
```

### POST `/api/v1/panel/store/open`

### POST `/api/v1/panel/store/close`

## 16. Cupons

### GET `/api/v1/panel/coupons`

### POST `/api/v1/panel/coupons`

### PUT `/api/v1/panel/coupons/{id}`

### DELETE `/api/v1/panel/coupons/{id}`

## 17. Configurações

### GET `/api/v1/panel/settings`

### PUT `/api/v1/panel/settings`

## 18. Upload

### POST `/api/v1/panel/uploads/product-image`

Multipart form data.

Retorna caminho público da imagem.

## 19. Dashboard

### GET `/api/v1/panel/dashboard`

Retorna:

```json
{
  "success": true,
  "data": {
    "orders_today": 42,
    "revenue_today": 2840.50,
    "average_ticket": 67.63,
    "open_orders": 6
  }
}
```

## 20. Cozinha

### GET `/api/v1/kitchen/orders`

Retorna apenas pedidos relevantes.

### PATCH `/api/v1/kitchen/orders/{id}/ready`

Marca pedido como pronto.

## 21. Superadmin

### GET `/api/v1/admin/tenants`

### POST `/api/v1/admin/tenants`

### GET `/api/v1/admin/tenants/{id}`

### PUT `/api/v1/admin/tenants/{id}`

### PATCH `/api/v1/admin/tenants/{id}/status`

### POST `/api/v1/admin/tenants/{id}/users`

## 22. Códigos HTTP

- 200 — sucesso.
- 201 — criado.
- 204 — sem conteúdo.
- 400 — requisição inválida.
- 401 — não autenticado.
- 403 — não autorizado.
- 404 — não encontrado.
- 409 — conflito.
- 422 — erro de validação.
- 429 — limite excedido.
- 500 — erro interno.

## 23. Segurança da API

- CSRF para rotas administrativas baseadas em sessão.
- Validação de origem onde aplicável.
- Rate limit no login e pedidos públicos.
- Nunca retornar stack trace em produção.
- Nunca confiar em preços enviados pelo cliente.
- Nunca aceitar tenant de outro contexto administrativo.
