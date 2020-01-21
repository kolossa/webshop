Big Fish webshop próbafeladat
=====================
# 1. Mysql
CREATE DATABASE webshop;

#2.  Clone project
git clone https://github.com/kolossa/webshop.git

#3. migration: 
php artisan migrate

#4. install test data:
php artisan books:install
php artisan discounts:install