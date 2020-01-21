Big Fish webshop próbafeladat
=====================

# 1. Mysql

	CREATE DATABASE webshop;

# 2.  Clone project

	git clone https://github.com/kolossa/webshop.git

# 3. run composer

	composer install

# 4. migration: 

	php artisan migrate

# 5. install test data:

	php artisan books:install
	php artisan discounts:install
	
# 6. run key generator: 

    php artisan key:generate
    
# 7. set the .env file

    Create your .env file.
    Use the .env.example and set your database.
    
# 8. open your browser

    your/path/list-books
