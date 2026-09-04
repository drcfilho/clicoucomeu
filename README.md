# 🍕 Clicou Comeu — Plataforma Multi-Tenant de Cardápio Digital & Delivery

O **Clicou Comeu** é um sistema completo, rápido e intuitivo de **Cardápio Digital e Gestão de Delivery Multi-Tenant**. Desenvolvido em PHP moderno com arquitetura MVC desacoplada, ele permite gerenciar múltiplos restaurantes/estabelecimentos na mesma instalação com total isolamento de dados, URLs exclusivas (`/{slug}`), painel administrativo completo e integração direta de pedidos via **WhatsApp** e **Webhooks**.

---

## 🚀 Principais Funcionalidades

- **Multi-Tenant Nativo:** URLs próprias por restaurante (`/{slug}`) com isolamento total de dados e configurações.
- **Cardápio Digital Interativo:**
  - Categorias, variações de tamanhos e preços.
  - Grupos de adicionais e opcionais (opcionais simples, múltiplos ou sabores divididos).
  - Busca instantânea e design responsivo otimizado para celulares.
  - Formatação e validação rigorosa de WhatsApp com máscara `(88) 99999-9999`.
- **Checkout Eficiente:**
  - Taxa de entrega calculada dinamicamente via dropdown de Bairros cadastrados.
  - Formas de pagamento customizáveis (PIX com botão de copiar chave, Cartões, Dinheiro com cálculo automático de troco).
  - Aplicação de Cupons de Desconto com limite de uso.
- **Painel Administrativo (`/{slug}/painel`):**
  - Monitoramento de pedidos em tempo real com **alerta sonoro** ativado por padrão.
  - Métricas de faturamento, ticket médio e produtos mais vendidos.
  - Gestão de produtos, fotos, categorias, cupons, bairros e horários de funcionamento.
  - Botão de atalho para abrir ou copiar o link do cardápio diretamente no menu lateral.
- **Painel de Cozinha (KDS) (`/{slug}/cozinha`):**
  - Interface simplificada e focada na produção. Exibe apenas o número do pedido, itens, adicionais, observações e tipo de entrega, ocultando valores e dados pessoais do cliente.
  - Atualização automática via polling dinâmico.

---

## 💳 Matriz de Planos & Recursos

O sistema possui controle nativo de permissões e travas com base nos planos de assinatura:

| Funcionalidade / Benefício | ⏳ MVP / Degustação | 🚀 Starter | ⚡ Pro | 🏢 Enterprise |
| :--- | :---: | :---: | :---: | :---: |
| **Valor** | Grátis (7 dias) | R$ 49/mês | R$ 99/mês | Sob Consulta |
| **Limite de Produtos** | Até 20 produtos | Ilimitado | Ilimitado | Ilimitado |
| **Cardápio Digital & QR Code** | ✅ | ✅ | ✅ | ✅ |
| **Pedidos via WhatsApp** | ✅ | ✅ | ✅ | ✅ |
| **Alerta Sonoro no Painel** | ✅ | ✅ | ✅ | ✅ |
| **Cupons de Desconto** | ✅ | ✅ | ✅ | ✅ |
| **Cozinha KDS (`/cozinha`)** | ❌ | ❌ | ✅ | ✅ |
| **Relatórios de Desempenho** | ❌ | ❌ | ✅ | ✅ |
| **Multi-Filiais / Suporte Dedicado** | ❌ | ❌ | ❌ | ✅ |

---

## 🛠️ Requisitos do Servidor

- **PHP:** >= 8.1 (extensões `pdo`, `pdo_mysql`, `mbstring`, `json`, `session`).
- **Banco de Dados:** MySQL >= 5.7 ou MariaDB.
- **Servidor Web:** Apache (com `mod_rewrite`) ou Nginx.

---

## 📦 Como Instalar na Hostinger (Hospedagem de Sites / Cloud)

Siga este passo a passo detalhado para instalar a aplicação no seu painel da **Hostinger**:

### Passo 1: Enviar os arquivos para o servidor
1. Acesse o **hPanel da Hostinger** > **Gerenciador de Arquivos** (File Manager).
2. Navegue até a pasta raiz do seu domínio (geralmente `public_html`).
3. Faça o upload do código-fonte da aplicação (ou clone via Git no terminal SSH da Hostinger).
4. No menu da Hostinger, altere a **Pasta Raiz (Document Root)** da sua hospedagem para apontar para a pasta `public_html/public`.
   *(Se a sua hospedagem não permitir alterar o Document Root, mova o conteúdo da pasta `public` para a raiz `public_html` e ajuste o caminho do `index.php`).*

### Passo 2: Criar o Banco de Dados MySQL
1. No hPanel da Hostinger, vá em **Bancos de Dados MySQL**.
2. Crie um novo banco de dados (ex: `u123456_clicoucomeu`), usuário e senha.
3. Acesse o **phpMyAdmin** do banco criado.
4. Clique em **Importar** e selecione o arquivo SQL localizado em `scripts/install.sql` no repositório.

### Passo 3: Configurar as Variáveis de Ambiente (`.env`)
1. Na raiz do projeto, renomeie/copie o arquivo `.env.example` para `.env`.
2. Edite o arquivo `.env` preenchendo as credenciais da Hostinger:

```env
APP_NAME="Clicou Comeu"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://seudominio.com.br
APP_KEY=sua-chave-secreta-aleatoria-aqui
APP_TIMEZONE=America/Sao_Paulo

DB_HOST=localhost
DB_PORT=3306
DB_NAME=u123456_clicoucomeu
DB_USER=u123456_usuario
DB_PASS=sua_senha_mysql_segura
DB_CHARSET=utf8mb4

SESSION_NAME=clicoucomeu_session
SESSION_LIFETIME=120
SESSION_SECURE=true
SESSION_SAMESITE=Lax
```

### Passo 4: Permissões de Pastas
Certifique-se de que as pastas `storage` e `public/uploads` possuem permissão de escrita (permissão `755` ou `775`).

---

## 🔄 Como Atualizar a Aplicação na Hostinger

Quando houver novas atualizações ou melhorias lançadas no repositório:

### Método A: Via SSH (Recomendado)
Acesse o terminal SSH da sua conta Hostinger e execute:

```bash
cd public_html
git pull origin master
```

### Método B: Via Gerenciador de Arquivos (Manual)
1. Baixe o ZIP com a nova versão do repositório no GitHub.
2. No Gerenciador de Arquivos da Hostinger, suba o ZIP para a raiz.
3. Descompacte sobrescrevendo os arquivos existentes (sua base de dados MySQL e o arquivo `.env` não serão afetados).

---

## 📝 Licença

Desenvolvido para alta performance e escalabilidade em entregas e restaurantes. Todos os direitos reservados.
