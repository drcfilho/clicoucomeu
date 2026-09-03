# Clicou Comeu — Design e UX

## 1. Direção Visual

O sistema deve transmitir rapidez, simplicidade e confiança.

O foco principal é operação em celular e tablet.

Características:

- Interface limpa.
- Botões grandes.
- Tipografia legível.
- Poucos níveis de navegação.
- Alto contraste.
- Estados visuais claros.
- Uso reduzido de texto desnecessário.

## 2. Design System

### Tipografia

Sugestão:

- Inter.
- system-ui como fallback.

### Escala

- H1: 28px.
- H2: 22px.
- H3: 18px.
- Corpo: 16px.
- Secundário: 14px.

### Espaçamento

Base de 4px:

- 4
- 8
- 12
- 16
- 24
- 32

### Bordas

- Cards: 12px.
- Inputs: 10px.
- Botões: 10px.

## 3. Cores

Cada tenant pode definir:

- Cor primária.
- Cor secundária.

Estados funcionais devem manter padrões independentes:

- Sucesso.
- Atenção.
- Erro.
- Informação.

## 4. Navegação do Painel

### Mobile

Bottom navigation ou menu lateral recolhível.

Sugestão de itens principais:

- Pedidos.
- Cardápio.
- Entrega.
- Configurações.

### Desktop

Sidebar fixa.

## 5. Login

Tela simples e centralizada.

Campos:

- Usuário.
- Senha.

Ações:

- Entrar.

Opcional futuro:

- Recuperar senha.

## 6. Dashboard

Cards:

- Pedidos hoje.
- Faturamento hoje.
- Ticket médio.
- Pedidos abertos.

Ação principal:

- Ver pedidos.

## 7. Tela de Pedidos

### Cabeçalho

- Nome do estabelecimento.
- Indicador aberto/fechado.
- Indicador de som.

### Abas

- Novos.
- Preparando.
- Prontos.
- Todos.

### Card de pedido

Exibir:

- Número.
- Horário.
- Tempo decorrido.
- Nome do cliente.
- Delivery/retirada.
- Total.
- Forma de pagamento.

Ações rápidas:

- Abrir.
- Aceitar.
- Imprimir.

## 8. Tela de Detalhes do Pedido

Ordem visual:

1. Número e status.
2. Cliente.
3. Tipo de recebimento.
4. Itens.
5. Observações.
6. Pagamento.
7. Totais.
8. Ações.

Observações importantes devem receber destaque visual.

## 9. Tela da Cozinha

Modo de alto contraste.

Cada pedido como card grande.

Exibir:

- Número.
- Tempo.
- Quantidades.
- Produto.
- Variação.
- Adicionais.
- Observação.

Evitar mostrar:

- Endereço completo.
- Informações irrelevantes para preparo.

Botão principal:

- Pronto.

## 10. Produtos

### Lista

Cada produto exibe:

- Imagem.
- Nome.
- Categoria.
- Preço inicial.
- Status.

Ações:

- Disponível/esgotado.
- Editar.
- Duplicar.
- Excluir.

### Mobile

Botão de disponibilidade deve ser acessível sem entrar na edição.

## 11. Formulário de Produto

Seções:

### Informações básicas

- Nome.
- Descrição.
- Categoria.
- Imagem.

### Preço

- Preço base.

### Variações

Lista dinâmica.

### Adicionais

Selecionar grupos.

### Disponibilidade

- Ativo.
- Disponível.
- Destaque.

## 12. Categorias

Lista ordenável.

Cada item:

- Nome.
- Ativo/inativo.
- Editar.

## 13. Grupos de Adicionais

Exibir:

- Nome.
- Mínimo.
- Máximo.
- Obrigatório.
- Quantidade de adicionais.

Tela de edição deve permitir incluir vários adicionais sem sair da página.

## 14. Entrega

Tabela mobile-friendly:

- Bairro.
- Taxa.
- Pedido mínimo.
- Tempo estimado.
- Ativo.

## 15. Horários

Uma linha por dia.

Exemplo:

```text
Segunda    18:00 — 23:00   Ativo
Terça      18:00 — 23:00   Ativo
```

Permitir adicionar dois períodos no futuro.

## 16. Loja Aberta/Fechada

Controle destacado no dashboard.

Estados:

- Aberta automaticamente pelo horário.
- Fechada automaticamente.
- Fechada manualmente.

Fechamento temporário:

- 30 min.
- 1 hora.
- Até amanhã.

## 17. Cardápio Público

### Cabeçalho

- Logo.
- Nome.
- Status aberto/fechado.
- Tempo estimado.
- Busca.

### Categorias

Barra horizontal rolável.

### Produto

Card com:

- Imagem.
- Nome.
- Descrição curta.
- Preço.

### Modal/Página do produto

- Imagem.
- Descrição.
- Variação.
- Grupos de adicionais.
- Quantidade.
- Observação.
- Botão adicionar.

## 18. Carrinho

Sticky button no rodapé:

```text
Ver carrinho • 3 itens • R$ 68,00
```

Tela do carrinho:

- Itens.
- Editar.
- Excluir.
- Subtotal.
- Próximo.

## 19. Checkout

Fluxo em etapas:

1. Recebimento.
2. Cliente.
3. Endereço.
4. Pagamento.
5. Revisão.

Deve ser possível voltar sem perder o carrinho.

## 20. Confirmação

Após concluir:

- Número do pedido.
- Total.
- Status inicial.
- Botão acompanhar pedido.
- Botão opcional WhatsApp.

## 21. Acompanhamento

Linha de progresso:

- Recebido.
- Confirmado.
- Preparando.
- Pronto.
- Entrega/finalizado.

Atualização automática por polling.

## 22. Impressão

Layout sem elementos administrativos.

Conteúdo:

- Nome do estabelecimento.
- Número.
- Data/hora.
- Tipo.
- Cliente.
- Itens.
- Observações.
- Endereço quando necessário.
- Totais.
- Pagamento.

## 23. Responsividade

Breakpoints prioritários:

- 360px.
- 390px.
- 430px.
- 768px.
- 1024px+.

## 24. Acessibilidade

- Contraste adequado.
- Botões mínimos de 44px.
- Labels explícitos.
- Navegação por teclado no desktop.
- Não depender exclusivamente de cor.

## 25. Feedback Visual

Toda ação deve indicar estado:

- Salvando.
- Salvo.
- Erro.
- Pedido recebido.
- Pedido atualizado.

Evitar ações silenciosas.
