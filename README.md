### Instalando o projeto

`composer update`

`php -m | grep pdo_mysql`

`sudo apt-get install php-pdo php-mysql`

`composer require laravel/ui`

`php artisan ui vue --auth`

### Configurando o banco de dados

`cp env.example .env`

`php artisan migrate`

### Iniciando o servidor

`npm install`

`php artisan serve`

- o servidor estará rodando em http://localhost:8000

`npm run dev`

## Endpoints

### GET /api/endereco/

Retorna todos os endereços cadastrados no banco de dados.

### GET /api/endereco/{id}

Retorna o endereço com o id informado.

### POST /api/endereco/

Cria um novo endereço no banco de dados.

### PATCH /api/endereco/{id}

Atualiza o endereço com o id informado.

### DELETE /api/endereco/{id}

Deleta o endereço com o id informado.
