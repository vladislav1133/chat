# Chat
Realtime chat
## Getting Started

Clone the project

After cloning, run:

```bash
composer install
```
Duplicate `.env.example` and rename it `.env`

Setup database in `.env`

```txt
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

### Database Migrations

Create and feel your tables


```bash
php artisan migrate
```
Open your server
