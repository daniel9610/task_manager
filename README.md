<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Task Manager
## Requirements
- php version >= 8.1
- Composer
- Mysql
- Apache or Nginx
- npm

## Installation steps
- Clone the repository with the following command in a terminal:
git clone https://github.com/daniel9610/task_manager.git

- Create a .env file, copy and paste the .end.example and config the database env variables

- Run the following command to install the dependencies:
composer install

- Generate the system key with the command:
php artisan key:generate

- Install npm and start the server:
npm i && npm run dev

- run the server with: 
php artisan serve

- view the project in the following path: localhost:8000
 