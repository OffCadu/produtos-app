# Produtos App

Aplicação web construída em Laravel com autenticação Breeze e um CRUD completo de Produtos, cobrindo:

- Login e sessão
- Rotas protegidas por auth
- Listagem com busca, ordenação por preço e estoque
- Testes automatizados garantindo o comportamento principal
- Ambiente totalmente containerizado com Docker

---

## Stacks utilizadas

- PHP 8.4 e Laravel
- Laravel Breeze para autenticação
- PostgreSQL
- Livewire (para listagem dinâmica)
- PHPUnit (`php artisan test`)
- Docker

---

## Decisões de projeto

Inicialmente, o desenvolvimento foi feito fora do Docker, utilizando PostgreSQL local, com o objetivo de:

- Focar nas regras de negócio e fluxo do CRUD
- Facilitar debug e iteração rápida

Após o CRUD e os testes estarem estáveis, o projeto foi containerizado com Docker, simulando um cenário mais próximo do real.

---

## Auth com Breeze

Laravel Breeze foi escolhido por ser:

- Simples e direto para testes técnicos
- Padrão do ecossistema Laravel
- Fácil manutenção
- Já incluir login, logout, reset de senha e views base

---

## Arquitetura Controller → Service → Model

Estrutura com princípios SOLID:

- Controller: request e response
- Service: regras de negócio
- Model: acesso a dados e relações

Essa separação facilita:
- Testes
- Evolução do código
- Leitura por terceiros

---

## Requisitos para rodar o projeto

- Docker
- Docker Compose

---

## Como rodar o projeto com Docker

## 1) Clonar o repositório

No terminal:

git clone https://github.com/OffCadu/produtos-app.git
cd produtos-app

## 2) Criar o arquivo .env
cp .env.example .env

## 3) Subir os containers
docker compose up -d --build

Isso irá:

Criar o container da aplicação Laravel
Criar o container do PostgreSQL
Mapear a aplicação para http://localhost:8000

## 4) Instalar dependências dentro do container
docker compose exec app composer install

## 5) Gerar a key da aplicação
docker compose exec app php artisan key:generate

## 6) Rodar migrations e seeders
docker compose exec app php artisan migrate --seed

Esse comando criará:

- Todas as tabelas

Um usuário administrador

Criar 13 produtos aleatórios no banco

## 7) Acessar a aplicação

Abra no navegador:

http://localhost:8000

## Usuário de teste (Administrador)

Após rodar o seed:

Email: admin@empresa.com

Senha: 123456

## Testes automatizados

Para rodar todos os testes:

docker compose exec app php artisan test