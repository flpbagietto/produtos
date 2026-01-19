# Sistema de Busca de Produtos

Sistema de busca de produtos desenvolvido com **Laravel** e **Livewire**, utilizando filtros combinados, ambiente Dockerizado e testes automatizados.

## Descrição

Este projeto implementa um sistema completo de busca de produtos com as seguintes funcionalidades:

- Busca por nome do produto (busca parcial com LIKE)
- Filtro por uma ou mais categorias (seleção múltipla)
- Filtro por uma ou mais marcas (seleção múltipla)
- Filtros combinados usando lógica AND
- Persistência de filtros via query string
- Recuperação automática de filtros ao atualizar a página
- Interface moderna e responsiva
- Testes automatizados completos

## Tecnologias Utilizadas

- **Laravel 10.x** - Framework PHP
- **Livewire 2.x** - Componentes reativos sem JavaScript
- **MySQL 8.0** - Banco de dados relacional
- **Docker** - Containerização da aplicação
- **PHPUnit** - Framework de testes
- **Nginx** - Servidor web
- **PHP 8.2** - Linguagem de programação

## Requisitos

- Docker e Docker Compose instalados
- Git (opcional)

## Passo a Passo para Execução

### Pré-requisitos

- Docker instalado (versão 20.10 ou superior)
- Docker Compose instalado (versão 2.0 ou superior)
- **Não é necessário ter MySQL instalado localmente** - tudo roda em containers

### Execução Rápida

O projeto está configurado para inicializar automaticamente. Basta executar:

```bash
# Subir o ambiente (tudo será configurado automaticamente)
docker-compose up -d --build
```

**Importante:** Use sempre `docker-compose up -d --build` para garantir que a imagem seja reconstruída com as últimas alterações. Se você já tiver containers rodando anteriormente, pode ser necessário limpar containers e imagens antigas primeiro (veja seção Troubleshooting).

O script de inicialização irá automaticamente:
- Aguardar o MySQL estar pronto
- Instalar dependências do Composer
- Criar arquivo `.env` se não existir
- Gerar chave da aplicação
- Executar migrations
- Popular banco de dados com seeders
- Limpar caches

**Aguarde aproximadamente 1-2 minutos** para a inicialização completa.

### Acessar a aplicação

Após a inicialização, abra seu navegador e acesse:

```
http://localhost:8080
```

### Verificar se está funcionando

```bash
# Ver logs do container
docker-compose logs -f app

# Verificar se os containers estão rodando
docker-compose ps
```

### Dados Iniciais

O banco de dados será populado automaticamente com:
- 5 categorias
- 5 marcas
- 15 produtos (3 por categoria, 1 marca por produto)

## Executando os Testes Automatizados

Para executar todos os testes:

```bash
docker-compose exec app php artisan test
```

Ou usando PHPUnit diretamente:

```bash
docker-compose exec app vendor/bin/phpunit
```

### Cobertura de Testes

Os testes cobrem os seguintes cenários:

- Busca por nome do produto
- Busca por categoria
- Busca por marca
- Busca combinada (nome + categoria + marca)
- Busca por múltiplas categorias
- Busca por múltiplas marcas
- Limpeza dos filtros
- Persistência dos filtros após refresh
- Busca case-insensitive
- Busca parcial por nome
- Tratamento de resultados vazios

## Estrutura do Projeto

```
estoque/
├── app/
│   ├── Livewire/
│   │   └── BuscaProdutos.php          # Componente Livewire principal
│   └── Models/
│       ├── Produto.php                 # Model de Produto
│       ├── Categoria.php               # Model de Categoria
│       └── Marca.php                   # Model de Marca
├── database/
│   ├── factories/
│   │   ├── ProdutoFactory.php
│   │   ├── CategoriaFactory.php
│   │   └── MarcaFactory.php
│   ├── migrations/
│   │   ├── create_categorias_table.php
│   │   ├── create_marcas_table.php
│   │   └── create_produtos_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       └── livewire/
│           └── busca-produtos.blade.php # View do componente
├── routes/
│   └── web.php                          # Rotas da aplicação
├── tests/
│   └── Feature/
│       └── BuscaProdutosTest.php        # Testes automatizados
├── docker/
│   └── nginx/
│       └── default.conf                 # Configuração do Nginx
├── docker-compose.yml                   # Configuração Docker
├── Dockerfile                           # Imagem PHP
└── README.md                            # Este arquivo
```

## Modelo de Dados

### Tabelas

- **produtos**: Armazena informações dos produtos
  - `id` (PK)
  - `nome`
  - `descricao`
  - `categoria_id` (FK)
  - `marca_id` (FK)
  - `created_at`
  - `updated_at`

- **categorias**: Armazena as categorias disponíveis
  - `id` (PK)
  - `nome`
  - `created_at`
  - `updated_at`

- **marcas**: Armazena as marcas disponíveis
  - `id` (PK)
  - `nome`
  - `created_at`
  - `updated_at`

### Relacionamentos

- **Produto** pertence a uma **Categoria** (One-to-Many)
- **Produto** pertence a uma **Marca** (One-to-Many)
- **Categoria** possui muitos **Produtos** (One-to-Many)
- **Marca** possui muitos **Produtos** (One-to-Many)

## Funcionalidades do Componente Livewire

### Métodos Principais

- `buscarProdutos()`: Realiza a busca de produtos aplicando todos os filtros
- `aplicarFiltros($query)`: Aplica os filtros combinados na query
- `limparFiltros()`: Limpa todos os filtros
- `atualizarFiltros()`: Atualiza os resultados quando os filtros mudam

### Filtros Disponíveis

1. **Nome do Produto**: Busca parcial usando LIKE (case-insensitive)
2. **Categorias**: Seleção múltipla usando `whereIn`
3. **Marcas**: Seleção múltipla usando `whereIn`

### Persistência de Filtros

Os filtros são persistidos na URL através de query strings, permitindo:
- Compartilhamento de links com filtros aplicados
- Recuperação automática ao atualizar a página
- Navegação com histórico do navegador

## Comandos Úteis

### Docker

```bash
# Subir containers
docker-compose up -d

# Parar containers
docker-compose down

# Ver logs
docker-compose logs -f app

# Acessar shell do container
docker-compose exec app bash
```

### Laravel

```bash
# Limpar cache
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan view:clear

# Executar migrations
docker-compose exec app php artisan migrate

# Executar seeders
docker-compose exec app php artisan db:seed

# Recriar banco de dados (apaga tudo e recria)
docker-compose exec app php artisan migrate:fresh --seed

# Criar novo componente Livewire
docker-compose exec app php artisan make:livewire NomeComponente
```

## Padrões de Código

Este projeto segue rigorosamente:

- **Nomenclatura em Português Brasileiro** para métodos, variáveis, campos e tabelas
- **Código limpo** e autoexplicativo
- **Métodos pequenos** com responsabilidade única
- **Reutilização de código** e componentes
- **Testes automatizados** com boa cobertura
- **Commits semânticos** em português

## Troubleshooting

### Limpeza de containers e imagens antigas

Se você já rodou o projeto anteriormente e está encontrando problemas, é recomendado fazer uma limpeza completa antes de subir novamente:

```bash
# Parar e remover todos os containers, volumes e redes
docker-compose down -v

# Remover imagens órfãs e containers antigos
docker image prune -f
docker container prune -f

# Reconstruir e subir do zero
docker-compose up -d --build
```

Isso garante que não haja conflitos com configurações antigas ou containers com nomes diferentes.

### Erro 'ContainerConfig' ou conflito de containers

Se você receber o erro `KeyError: 'ContainerConfig'` ao tentar subir os containers, significa que há conflito com containers ou imagens antigas. Execute a limpeza acima e tente novamente.

### Erro de conexão com banco de dados

Verifique se o container MySQL está rodando:

```bash
docker-compose ps
```

Se não estiver, inicie novamente:

```bash
docker-compose up -d mysql
```

### Erro de permissões

O script de inicialização já ajusta as permissões automaticamente. Se ainda assim encontrar problemas, execute:

```bash
docker-compose exec app chmod -R 775 storage bootstrap/cache
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
```

## Licença

Este projeto é open source e está disponível sob a licença MIT.

## Desenvolvido com

- Laravel Framework
- Livewire
- Docker
- PHPUnit
- Boas práticas de engenharia de software

---

**Desenvolvido seguindo rigorosamente boas práticas de código limpo, organização e testes automatizados.**

