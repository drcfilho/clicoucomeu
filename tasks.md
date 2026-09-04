# Clicou Comeu - Tasks de Implementacao

## Convencoes

- [ ] Nao iniciado
- [x] Concluido

## Status em 2026-09-03

- Itens concluidos: 73 de 290
- Base tecnica pronta: estrutura do projeto, schema SQL, bootstrap PHP, roteamento, login base e importacao inicial do tenant Piemonte
- Principais pendencias: CRUDs reais do painel, cardapio publico conectado ao banco, checkout, pedidos e seguranca operacional

## Feito

- Fase 0 quase concluida, faltando apenas a pagina 404
- Fase 1 concluida no schema e seeds iniciais
- Fase 2 concluida
- Fase 3 concluida
- Fase 13 iniciada com rota publica por slug
- Fase 27 iniciada com criacao do superadmin, tenant Piemonte e migracao inicial do Sheets para o banco

## Parcial

- Superadmin: existem rotas e stubs, mas nao ha CRUD funcional de tenants
- Painel: existe apenas estrutura inicial, sem listagens e formularios reais
- Cardapio publico: existe a rota base, mas ainda nao consome categorias e produtos do MySQL
- Cupons: dados foram importados, mas as regras de aplicacao ainda nao existem no backend

## Proximo Sprint

- Fase 4: concluir Superadmin com listagem e CRUD de tenants e usuarios administradores
- Fase 6: listar, criar, editar, ativar e ordenar categorias
- Fase 7: listar, criar, editar e controlar disponibilidade de produtos
- Fase 10: listar e editar bairros e taxas de entrega
- Fase 11: listar e editar formas de pagamento
- Fase 12: listar e editar horarios de funcionamento
- Fase 13: ligar cardapio publico ao banco e exibir categorias e produtos reais
- Fase 24: endurecimento operacional do login, pedidos e sessoes

---

# Fase 0 - Preparacao

- [x] Criar repositorio Git.
- [x] Definir PHP minimo.
- [x] Definir MySQL minimo.
- [x] Criar `.env.example`.
- [x] Configurar `.gitignore`.
- [x] Criar estrutura de diretorios.
- [x] Configurar roteamento.
- [x] Configurar conexao PDO.
- [x] Criar pagina de erro 404.
- [x] Criar tratamento de erro global.

# Fase 1 - Banco de Dados

- [x] Criar migration/install.sql.
- [x] Criar tabela tenants.
- [x] Criar tabela usuarios.
- [x] Criar tabela categorias.
- [x] Criar tabela produtos.
- [x] Criar tabela produto_variacoes.
- [x] Criar tabela grupos_adicionais.
- [x] Criar tabela adicionais.
- [x] Criar tabela produto_grupos_adicionais.
- [x] Criar tabela formas_pagamento.
- [x] Criar tabela bairros.
- [x] Criar tabela horarios_funcionamento.
- [x] Criar tabela configuracoes.
- [x] Criar tabela clientes.
- [x] Criar tabela enderecos.
- [x] Criar tabela cupons.
- [x] Criar tabela pedidos.
- [x] Criar tabela pedido_itens.
- [x] Criar tabela pedido_item_adicionais.
- [x] Criar tabela pedido_historico_status.
- [x] Criar tabela sequencias_pedido.
- [x] Criar indices.
- [x] Criar seed do superadmin.
- [x] Criar seed de tenant de teste.

# Fase 2 - Infraestrutura PHP

- [x] Criar Router.
- [x] Criar Request helper.
- [x] Criar Response JSON helper.
- [x] Criar View renderer.
- [x] Criar Session helper.
- [x] Criar CSRF helper.
- [x] Criar Auth middleware.
- [x] Criar Tenant middleware.
- [x] Criar Permission middleware.
- [x] Criar TenantResolver publico.
- [x] Criar logger.
- [x] Criar Validator.

# Fase 3 - Login e Usuarios

- [x] Criar tela de login.
- [x] Implementar `password_hash()`.
- [x] Implementar `password_verify()`.
- [x] Criar login.
- [x] Criar logout.
- [x] Regenerar ID de sessao.
- [x] Implementar timeout de sessao.
- [x] Criar protecao contra brute force simples.
- [x] Criar controle por perfil.

# Fase 4 - Superadmin

- [x] Criar `/admin/`.
- [x] Listar tenants.
- [x] Criar tenant.
- [x] Editar tenant.
- [x] Ativar tenant.
- [x] Bloquear tenant.
- [x] Criar admin do tenant.
- [x] Definir plano.
- [x] Visualizar status do tenant.

# Fase 5 - Painel Base

- [x] Criar layout mobile-first.
- [x] Criar sidebar desktop.
- [x] Criar navegacao mobile.
- [x] Criar header.
- [x] Criar flash messages.
- [x] Criar componentes de modal.
- [x] Criar componente de confirmacao.
- [x] Criar componente de loading.

# Fase 6 - Categorias

- [x] Listar categorias.
- [x] Criar categoria.
- [x] Editar categoria.
- [x] Ativar/desativar.
- [x] Excluir categoria.
- [x] Reordenar categorias.

# Fase 7 - Produtos

- [x] Listar produtos.
- [x] Filtrar por categoria.
- [x] Buscar produto.
- [x] Criar produto.
- [x] Editar produto.
- [x] Duplicar produto.
- [x] Ativar/desativar.
- [x] Marcar disponivel/esgotado.
- [x] Upload de imagem.
- [x] Validar MIME.
- [x] Limitar tamanho.
- [x] Redimensionar imagem.
- [x] Excluir produto logicamente.

# Fase 8 - Variacoes

- [x] Criar variacao.
- [x] Editar variacao.
- [x] Excluir variacao.
- [x] Reordenar variacoes.
- [x] Validar preco.

# Fase 9 - Grupos e Adicionais

- [x] Listar grupos.
- [x] Criar grupo.
- [x] Editar grupo.
- [x] Definir minimo.
- [x] Definir maximo.
- [x] Definir obrigatorio.
- [x] Criar adicional.
- [x] Editar adicional.
- [x] Excluir adicional.
- [x] Associar grupos a produtos.

# Fase 10 - Bairros e Entrega

- [x] Listar bairros.
- [x] Criar bairro.
- [x] Editar taxa.
- [x] Definir pedido minimo.
- [x] Definir tempo estimado.
- [x] Ativar/desativar bairro.

# Fase 11 - Pagamentos

- [x] Listar formas.
- [x] Criar forma.
- [x] Configurar dinheiro.
- [x] Configurar troco.
- [x] Configurar Pix.
- [x] Configurar credito.
- [x] Configurar debito.
- [x] Ativar/desativar.

# Fase 12 - Horarios

- [x] Criar tela semanal.
- [x] Editar abertura.
- [x] Editar fechamento.
- [x] Marcar dia fechado.
- [x] Criar servico de calculo aberto/fechado.
- [x] Implementar fechamento manual.
- [x] Implementar fechamento temporario.

# Fase 13 - Cardapio Publico

- [x] Criar rota por slug.
- [x] Exibir logo e tema.
- [x] Exibir status aberto/fechado.
- [x] Listar categorias.
- [x] Listar produtos.
- [x] Implementar busca.
- [x] Implementar destaques.
- [x] Criar tela/modal de produto.
- [x] Exibir variacoes.
- [x] Exibir adicionais.
- [x] Validar selecao minima/maxima.
- [x] Campo de observacao.

# Fase 14 - Carrinho

- [x] Criar estado do carrinho.
- [x] Adicionar item.
- [x] Editar item.
- [x] Remover item.
- [x] Alterar quantidade.
- [x] Calcular subtotal no frontend apenas para UX.
- [x] Persistir carrinho em localStorage.

# Fase 15 - Checkout

- [x] Escolher delivery/retirada.
- [x] Informar nome.
- [x] Informar WhatsApp.
- [x] Informar bairro.
- [x] Informar endereco.
- [x] Informar complemento.
- [x] Informar referencia.
- [x] Escolher pagamento.
- [x] Informar troco.
- [x] Aplicar cupom.
- [x] Revisar pedido.
- [x] Enviar pedido.

# Fase 16 - Servico de Pedidos

- [x] Validar loja aberta.
- [x] Validar tenant.
- [x] Validar produtos.
- [x] Validar variacoes.
- [x] Validar adicionais.
- [x] Buscar precos reais.
- [x] Recalcular subtotal.
- [x] Calcular taxa de entrega.
- [x] Aplicar cupom.
- [x] Gerar token publico.
- [x] Gerar numero sequencial.
- [x] Criar cliente ou localizar existente.
- [x] Criar pedido em transacao.
- [x] Criar itens.
- [x] Criar adicionais.
- [x] Registrar historico de status.

# Fase 17 - Painel de Pedidos

- [x] Listar novos.
- [x] Listar preparando.
- [x] Listar prontos.
- [x] Listar finalizados.
- [x] Criar polling.
- [x] Destacar novos.
- [x] Tocar som.
- [x] Criar contador por status.
- [x] Abrir detalhes.
- [x] Aceitar pedido.
- [x] Iniciar preparo.
- [x] Marcar pronto.
- [x] Marcar saiu para entrega.
- [x] Finalizar.
- [x] Marcar retirado.
- [x] Cancelar.
- [ ] Registrar historico.

# Fase 18 - Tela da Cozinha

- [x] Criar rota `/cozinha/`.
- [x] Criar autenticacao cozinha.
- [x] Exibir apenas pedidos relevantes.
- [x] Criar layout de alto contraste.
- [x] Mostrar tempo decorrido.
- [x] Mostrar observacoes em destaque.
- [x] Criar polling.
- [x] Marcar pronto.

# Fase 19 - Impressao

- [x] Criar layout 58 mm.
- [x] Criar layout 80 mm.
- [x] Criar layout A4.
- [x] Criar botao imprimir.
- [x] Ocultar controles no print.
- [x] Permitir configuracao de formato padrao.
- [x] Testar Chrome.
- [x] Testar Edge.

# Fase 20 - Acompanhamento do Cliente

- [x] Criar pagina por token.
- [x] Exibir numero.
- [x] Exibir status.
- [x] Exibir linha de progresso.
- [x] Criar polling.
- [x] Encerrar polling em status final.

# Fase 21 - Cupons

- [x] Criar cupom percentual.
- [x] Criar cupom valor fixo.
- [x] Criar frete gratis.
- [x] Validar periodo.
- [x] Validar limite de usos.
- [x] Validar valor minimo.
- [x] Registrar uso.

# Fase 22 - Dashboard

- [x] Pedidos hoje.
- [x] Faturamento hoje.
- [x] Ticket medio.
- [x] Pedidos abertos.
- [x] Filtro por periodo.
- [x] Produtos mais vendidos.
- [x] Formas de pagamento.
- [x] Bairros mais frequentes.

# Fase 23 - Configuracoes do Tenant

- [x] Editar nome.
- [x] Editar logo.
- [x] Editar WhatsApp.
- [x] Editar cores.
- [x] Editar endereco.
- [x] Definir timezone.
- [x] Definir tipo de impressao.
- [x] Definir mensagem de loja fechada.

# Fase 24 - Seguranca

- [x] CSRF em POSTs.
- [x] Escape HTML.
- [x] Queries parametrizadas.
- [x] Rate limit no login.
- [x] Rate limit em pedidos publicos.
- [x] Sessao segura.
- [x] Validar tenant em todas as queries.
- [x] Sanitizar uploads.
- [x] Desativar erros detalhados em producao.
- [x] Criar logs.

# Fase 25 - Performance

- [ ] Criar indices.
- [ ] Revisar consultas N+1.
- [ ] Lazy loading de imagens.
- [ ] Compressao WebP.
- [ ] Cache do cardapio.
- [ ] Invalidar cache apos edicao.
- [ ] Paginar historico de pedidos.

# Fase 26 - Testes

- [ ] Testar isolamento multi-tenant.
- [ ] Testar criacao concorrente de pedidos.
- [ ] Testar precos adulterados no frontend.
- [ ] Testar cupom expirado.
- [ ] Testar produto indisponivel.
- [ ] Testar loja fechada.
- [ ] Testar taxa de bairro.
- [ ] Testar status invalido.
- [ ] Testar impressao.
- [ ] Testar mobile 360px.
- [ ] Testar mobile 390px.
- [ ] Testar tablet.
- [ ] Testar desktop.

# Fase 27 - Implantacao

- [ ] Configurar HTTPS.
- [ ] Configurar banco de producao.
- [x] Criar superadmin.
- [x] Criar tenant Piemonte.
- [x] Migrar categorias do Sheets.
- [x] Migrar produtos do Sheets.
- [x] Migrar adicionais.
- [x] Migrar precos.
- [x] Migrar bairros.
- [ ] Validar cardapio novo.
- [ ] Ativar dominio/rotas.
- [ ] Fazer backup inicial.

# Fase 28 - Pos-MVP

- [ ] Impressao silenciosa.
- [ ] PWA.
- [ ] QR Code por mesa.
- [ ] Comanda.
- [ ] Caixa.
- [ ] Motoboy.
- [ ] Pix automatico.
- [ ] Programa de fidelidade.
- [ ] NPS.
- [ ] Relatorios avancados.

# Fase 29 - Onboarding & Auto-Cadastro de Estabelecimento

- [ ] **29.1 Cadastro Inicial (Cadastro Grátis na Landing Page)**
  - [ ] Criar formulário público de auto-cadastro na landing page (`/cadastro` ou modal).
  - [ ] Coletar Dados Essenciais: Nome do Estabelecimento, Nome do Responsável, WhatsApp, E-mail e Senha.
  - [ ] Gerar Slug Automático único a partir do Nome (ex: "Pizzaria Brasil" -> `pizzaria-brasil`).
  - [ ] Criar Tenant no banco (`tenants`), usuário Administrador (`usuarios`) e configurações padrão de horário/identidade.
  - [ ] Autenticar o novo usuário automaticamente e redirecioná-lo para a primeira etapa do Assistente de Onboarding.

- [ ] **29.2 Assistente Passo-a-Passo de Configuração (Wizard de 4 Etapas)**
  - [ ] **Etapa 1: Dados do Restaurante & Identidade Visual**
    - Configurar Logotipo, Slogan, Cor Primária/Secundária e Endereço da loja.
  - [ ] **Etapa 2: Bairros & Entrega**
    - Cadastro rápido das regiões atendidas e taxas de entrega (ou opção de Retirada Grátis).
  - [ ] **Etapa 3: Formas de Pagamento & PIX**
    - Habilitar métodos aceitos (Dinheiro, Cartão, PIX com chave para recebimento).
  - [ ] **Etapa 4: Primeiras Categorias & Produtos**
    - Cadastro prático do primeiro produto/categoria com foto, preço e opções ou carregamento de Modelo/Template pré-definido por segmento (Pizzaria, Hamburgueria, Marmitaria, Açaí).

- [ ] **29.3 Dashboard Guia / Checklist Inicial**
  - [ ] Exibir Barra de Progresso do Onboarding na topo do Painel (`0% a 100% Concluído`).
  - [ ] Exibir Botão "Ver Meu Cardápio no Ar" assim que os passos mínimos forem finalizados.
  - [ ] Opção de Pular/Concluir Onboarding a qualquer momento.
