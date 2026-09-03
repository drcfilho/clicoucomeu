# Clicou Comeu — Plano Geral do Sistema

## 1. Visão do Produto

O Clicou Comeu será uma plataforma SaaS multi-tenant para restaurantes, pizzarias, lanchonetes, hamburguerias, padarias, cafeterias e outros negócios de alimentação que desejam disponibilizar um cardápio digital próprio, receber pedidos diretamente pelo sistema, acompanhar o fluxo de produção, imprimir pedidos para cozinha e administrar produtos, preços, adicionais, horários, formas de pagamento e taxas de entrega sem depender de Google Sheets ou ferramentas externas.

O sistema será construído inicialmente com PHP, MySQL, HTML, CSS, JavaScript e Bootstrap, visando hospedagem simples, baixo custo operacional, fácil manutenção e boa compatibilidade com ambientes de hospedagem compartilhada.

## 2. Objetivos

- Eliminar dependência do Google Sheets.
- Centralizar cardápio, pedidos e administração em banco MySQL.
- Permitir edição completa do cardápio pelo próprio estabelecimento.
- Manter o fluxo de pedidos simples e amigável em dispositivos móveis.
- Permitir operação por múltiplos estabelecimentos em uma única instalação.
- Criar painel administrativo protegido por usuário e senha.
- Criar tela específica para pedidos e cozinha.
- Permitir impressão térmica dos pedidos.
- Manter integração opcional com WhatsApp apenas como canal complementar.
- Preparar base para futura cobrança por planos e recursos premium.

## 3. Público-Alvo

- Restaurantes.
- Pizzarias.
- Hamburguerias.
- Lanchonetes.
- Padarias.
- Cafeterias.
- Food trucks.
- Marmitarias.
- Docerias.
- Pequenos negócios de alimentação.

## 4. Princípios do Produto

### 4.1 Mobile-first

O painel deve ser utilizável pelo dono do estabelecimento diretamente pelo celular.

### 4.2 Simplicidade operacional

As ações mais frequentes devem exigir poucos toques.

### 4.3 Multi-tenant desde o início

Todo dado operacional deve estar vinculado a um tenant.

### 4.4 Segurança por padrão

- Senhas com `password_hash()`.
- Sessões PHP.
- Queries parametrizadas com PDO.
- Proteção CSRF em formulários administrativos.
- Validação de uploads.
- Escapamento de saída HTML.
- Controle de acesso por perfil.

### 4.5 Compatibilidade com hospedagem comum

A primeira versão não dependerá de WebSocket, Redis, workers ou serviços externos.

## 5. Perfis de Usuário

### 5.1 Superadministrador

Responsável pela gestão global do Clicou Comeu.

Pode:

- Criar estabelecimentos.
- Editar estabelecimentos.
- Bloquear ou ativar tenants.
- Criar usuários administradores.
- Definir plano.
- Acessar informações técnicas e de uso.

### 5.2 Administrador do estabelecimento

Pode:

- Gerenciar cardápio.
- Gerenciar categorias.
- Gerenciar variações.
- Gerenciar adicionais.
- Gerenciar pedidos.
- Gerenciar horários.
- Gerenciar taxas de entrega.
- Gerenciar formas de pagamento.
- Gerenciar cupons.
- Ver relatórios.
- Alterar configurações visuais.

### 5.3 Operador

Pode:

- Visualizar pedidos.
- Aceitar pedidos.
- Alterar status.
- Imprimir pedidos.

### 5.4 Cozinha

Pode:

- Ver pedidos em preparo.
- Visualizar observações.
- Marcar pedido como pronto.

### 5.5 Cliente

Não precisa de conta.

Pode:

- Visualizar cardápio.
- Montar pedido.
- Informar dados de entrega.
- Escolher pagamento.
- Acompanhar pedido por token.

## 6. Estrutura Funcional

### 6.1 Cardápio público

- Identificação do estabelecimento por slug.
- Logo, nome, cores e informações do tenant.
- Categorias.
- Produtos.
- Busca.
- Destaques.
- Variações.
- Adicionais.
- Observações por item.
- Carrinho.
- Cupom.
- Delivery ou retirada.
- Endereço.
- Forma de pagamento.
- Troco.
- Observação geral.
- Finalização do pedido.

### 6.2 Administração de produtos

- Criar.
- Editar.
- Duplicar.
- Ativar/desativar.
- Marcar como esgotado.
- Alterar ordem.
- Upload de imagem.
- Associar categoria.
- Associar variações.
- Associar grupos de adicionais.

### 6.3 Categorias

- Nome.
- Descrição opcional.
- Ordem.
- Ativo/inativo.

### 6.4 Variações

Exemplos:

- Pequena.
- Média.
- Grande.
- Família.

Cada variação pode possuir preço próprio.

### 6.5 Adicionais

Usar grupos reutilizáveis.

Exemplo:

**Grupo: Borda**

- Sem borda.
- Catupiry.
- Cheddar.

**Grupo: Extras**

- Bacon.
- Queijo.
- Ovo.

Cada grupo pode possuir:

- Quantidade mínima.
- Quantidade máxima.
- Obrigatório ou opcional.

### 6.6 Pedidos

Status sugeridos:

- novo
- aceito
- preparando
- pronto
- saiu_para_entrega
- finalizado
- retirado
- cancelado

### 6.7 Painel de pedidos

Filtros rápidos:

- Novos.
- Preparando.
- Prontos.
- Finalizados.

Cada pedido deve apresentar:

- Número.
- Hora.
- Cliente.
- Tipo.
- Total.
- Pagamento.
- Status.

### 6.8 Cozinha

Tela simplificada e de alto contraste com:

- Número do pedido.
- Tempo desde entrada.
- Itens.
- Quantidades.
- Adicionais.
- Observações.
- Botão “Pronto”.

### 6.9 Impressão

Formatos iniciais:

- 58 mm.
- 80 mm.
- A4.

O MVP utilizará `window.print()`.

### 6.10 Entrega

- Cadastro de bairros.
- Taxa por bairro.
- Pedido mínimo opcional.
- Prazo estimado opcional.

### 6.11 Horários

Configuração por dia da semana:

- Abertura.
- Fechamento.
- Intervalos.
- Loja fechada.

Permitir fechamento temporário.

### 6.12 Formas de pagamento

- Dinheiro.
- Pix.
- Crédito.
- Débito.
- Outros configuráveis.

### 6.13 Cupons

Tipos:

- Percentual.
- Valor fixo.
- Frete grátis.

Regras:

- Período.
- Valor mínimo.
- Limite de usos.
- Ativo/inativo.

### 6.14 Acompanhamento de pedido

URL por token aleatório:

`/pedido/{token}`

Cliente vê o progresso sem autenticação.

## 7. Estrutura de URLs

Exemplo amigável:

- `/piemonte/`
- `/piemonte/produto/123`
- `/piemonte/checkout`
- `/pedido/ABC123XYZ`
- `/painel/`
- `/painel/pedidos/`
- `/painel/produtos/`
- `/painel/categorias/`
- `/painel/adicionais/`
- `/painel/configuracoes/`
- `/cozinha/`
- `/admin/`

## 8. MVP

### Fase 1 — Fundação

- Estrutura multi-tenant.
- Banco MySQL.
- Login.
- Perfis.
- CRUD de estabelecimento.
- CRUD de categorias.
- CRUD de produtos.

### Fase 2 — Cardápio

- Cardápio público.
- Variações.
- Adicionais.
- Carrinho.
- Checkout.

### Fase 3 — Pedidos

- Criação do pedido.
- Tela de pedidos.
- Alteração de status.
- Som de novo pedido.
- Tela da cozinha.
- Impressão.

### Fase 4 — Operação

- Bairros.
- Taxas.
- Horários.
- Formas de pagamento.
- Cupons.
- Fechamento temporário.

### Fase 5 — SaaS

- Superadmin.
- Planos.
- Limites.
- Bloqueio/ativação.
- Relatórios.

## 9. Evoluções Futuras

- Impressão silenciosa.
- Pix automático.
- QR Code para mesas.
- Comanda de mesa.
- Motoboy.
- Controle de caixa.
- Estoque simplificado.
- Programa de fidelidade.
- NPS pós-venda.
- Relatórios financeiros.
- API pública.
- PWA.
- Integrações com impressoras e PDVs.

## 10. Critérios de Sucesso

- Cardápio carrega rapidamente em celular.
- Pedido é concluído sem WhatsApp obrigatório.
- Restaurante recebe pedido em poucos segundos.
- Operador consegue alterar status com um toque.
- Produto pode ser marcado como indisponível instantaneamente.
- Alterações no cardápio aparecem sem editar arquivos manualmente.
- Um único código atende vários estabelecimentos.
- Nenhum tenant acessa dados de outro tenant.
