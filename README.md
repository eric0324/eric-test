## Installation

1. Put your firebase private key in the project root directory. (The file name is `firebase.json`)
2. Copy .env.example . Type `cp .env.example .env` in CLI.
3. Edit .env . Modify the database environment parameters: `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`. Modify RabbitMQ environment parameters: `RABBITMQ_HOST`, `RABBITMQ_PORT`, `RABBITMQ_LOGIN`, `RABBITMQ_PASSWORD`.
4. Execute `composer install` to install dependent packages.
5. Execute `php artisan migrate` to generate the data table required by the project.
6. Execute `php artisan receive` to start processing queue jobs
