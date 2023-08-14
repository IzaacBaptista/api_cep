### Instalando o projeto

`composer update`

`php -m | grep pdo_mysql`

`sudo apt-get install php-pdo php-mysql`

`composer require laravel/ui`

### Configurando o banco de dados

`touch .env`

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

<img src="app/../resources/img/Screenshot%20from%202023-08-14%2009-41-21.png" width="500" height="300">

### GET /api/endereco/{id}

Retorna o endereço com o id informado.

<img src="app/../resources/img/Screenshot%20from%202023-08-14%2009-43-45.png" width="500" height="300">

### POST /api/endereco/

Cria um novo endereço no banco de dados.

<img src="app/../resources/img/Screenshot%20from%202023-08-14%2009-42-22.png" width="500" height="300">

### PATCH /api/endereco/{id}

Atualiza o endereço com o id informado.

<img src="app/../resources/img/Screenshot%20from%202023-08-14%2009-43-13.png" width="500" height="300">

### DELETE /api/endereco/{id}

Deleta o endereço com o id informado.

<img src="app/../resources/img/Screenshot from 2023-08-14 09-52-36.png" width="500" height="300">
