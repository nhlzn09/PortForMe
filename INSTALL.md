# PortForMe (Laravel) setup
1. composer create-project laravel/laravel portforme
2. Copy everything in this folder (app, database, public, resources, routes) into portforme/, overwriting when asked.
3. Create the database:  mysql -u root -p -e "CREATE DATABASE portforme CHARACTER SET utf8mb4"
4. In portforme/.env set: DB_CONNECTION=mysql DB_HOST=127.0.0.1 DB_PORT=3306 DB_DATABASE=portforme DB_USERNAME=root DB_PASSWORD=your_password
5. php artisan migrate
6. php artisan serve   ->  http://127.0.0.1:8000
