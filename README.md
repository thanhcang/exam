# guest book project 

# General Information
- php version : 7.1.3 or high
- Os: ubuntu 18
- Web service : Apache 2.4
- Database : mysql

# Apply virtual host 
## example ( my configurations)
```
<VirtualHost *:80>
        ServerAdmin vtcanglt@gmail.com
        ServerName  exam.project.local
        ServerAlias exam.project.local
        DocumentRoot /var/www/html/example/public

        <Directory /var/www/html/example/public/>
                Options Indexes FollowSymLinks MultiViews
                AllowOverride All
                Order deny,allow
                Allow from all
        </Directory>

        ErrorLog /var/www/html/example/apche_error.log
        CustomLog /var/www/html/example/access.log combined
</VirtualHost>
```
# Change Project environment
## check environment in file configs/project.ini and change to your configuration
```
DB_HOST = 127.0.0.1
DB_PORT = 3306
DB_DATABASE = exam
DB_USERNAME = root
DB_PASSWORD = 1
APP_URL = http://exam.project.local
DEBUG = true
```
#Database
- please import file schema.sql in folder database to your database
- create user admin
- you could use my account (vtcanglt@gmail.com/123456) to login to system.

#make password
with user admin, I use password_hash for generate a password.
I suggest generate in [link text itself]: https://php-password-hash-online-tool.herokuapp.com/password_hash


