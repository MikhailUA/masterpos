MasterPOS API Development (test assignment)

API Documentation:
https://app.swaggerhub.com/apis/mp_api_doc/mp_test/1.0.0

Application Setup:
1. clone the repository
   - git clone https://github.com/MikhailUA/masterpos.git
2. run
    - composer install
    - composer dump-autoload
3. create new MySql database
4. rename .env.example to .env and put database settings to .env file
5. create database tables
    - php artisan migrate
6. seed database with data
    - php artisan db:seed   
7. start a php server
    - php -S localhost:8000 -t public
6. test api
    - create tunnel to localhost
       - ./ngrok http 8000
    - in swagger doc, lines 132 133:
        - host: from ngrok
        - basePath: (remove this line)
        example:
        host: 112737ae.ngrok.io
    - pick one of user email from database, password 12345 for all users
    - login
    - test endpoints
    
