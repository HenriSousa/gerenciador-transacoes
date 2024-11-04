# Gerenciador de Transações

## Descrição
O Gerenciador de Transações é um programa que permite gerenciar transações financeiras. Com ele, é possível listar todas as transações, filtrar por tipo (Receita ou Despesa), além de realizar o cadastro, edição e exclusão de transações.

## Instalação

Para configurar o projeto localmente, siga os passos abaixo:

### Backend (Laravel)

1. **Clone o repositório:**
   git clone [Clique aqui para Clonar](https://github.com/HenriSousa/gerenciador-transacoes.git)

2. **Navegue até o diretório do backend:**
   ```
   cd ../gerenciador-transacoes/backend/laravel
   ```

3. **Instale as dependências do Composer:**
   ```bash
   composer install
   ```

4. **Crie um arquivo `.env`:**
   ```bash
   cp .env.example .env
   ```

5. **Configure as variáveis de ambiente no arquivo `.env`** com suas credenciais do banco de dados.


6. **Execute as migrações do banco de dados:**
   ```bash
   php artisan migrate
   ```

7. **Inicie o servidor:**
   ```bash
   php artisan serve
   ```

### Frontend (Angular)

1. **Navegue até o diretório do frontend:**
   ```bash
   cd ../gerenciador-transacoes/frontend/gerenciador-transacoes
   ```

2. **Instale as dependências do Angular:**
   ```bash
   npm install
   ```

3. **Inicie a aplicação:**
   ```bash
   ng serve
   ```

## Uso

### API

As seguintes rotas estão disponíveis na API:

- `GET /api/transacoes`: Lista todas as transações.
- `GET /api/transacoes?tipo=receita`: Opção de filtrar por tipo (Receita ou Despesa).
- `GET /api/transacoes/{id}`: Exibe uma transação específica pelo ID.
- `POST /api/transacoes`: Cria uma nova transação.
- `PUT /api/transacoes/{id}`: Atualiza uma transação existente.
- `DELETE /api/transacoes/{id}`: Exclui uma transação.

### Exemplos de Requisições

#### Listar Transações
```bash
curl -X GET http://localhost:8000/api/transacoes
```

#### Criar uma Nova Transação
```bash
curl -X POST http://localhost:8000/api/transacoes \
-H "Content-Type: application/json" \
-d '{
  "descricao": "Venda de produto",
  "valor": 150.00,
  "tipo": "receita",
  "categoria": "Vendas"
}'
```

## Tecnologias Usadas

- **Backend:**
  - PHP 8.1
  - Laravel 10.48
  - DarkaoOnline - Swagger 8.6

- **Frontend:**
  - Angular 18.2

- **Banco de Dados:**
  - MySQL Workbench

## Contribuição

Sinta-se à vontade para contribuir! Se você tiver sugestões ou melhorias, faça um fork do repositório e envie um pull request.
