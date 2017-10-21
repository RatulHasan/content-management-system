# content-management-system

Content management system for laravel developers'. It's easy to install and run. 

### Server Requirements

The Laravel framework has a few system requirements. Of course, all of these requirements are satisfied by the Laravel Homestead virtual machine, so it's highly recommended that you use Homestead as your local Laravel development environment.

However, if you are not using Homestead, you will need to make sure your server meets the following requirements:

```
PHP >= 7.0.0
OpenSSL PHP Extension
PDO PHP Extension
Mbstring PHP Extension
Tokenizer PHP Extension
XML PHP Extension
```

### Installing

Run create-project command with composer to install this project.

Here is the full installation command -

```
composer create-project ratulhasan/laravel-cms
```


Now Change this options bellow within your .env,

```
DB_DATABASE=homestead // your database name 
DB_USERNAME=homestead // your database user name 
DB_PASSWORD=secret // your database password 
```
### For user registration and reset password mailing system

```
MAIL_DRIVER=smtp // change it as your desire MAIL DRIVER
MAIL_HOST=smtp.mailtrap.io // change it as your desire MAIL HOST
MAIL_PORT=2525 // change it as your desire MAIL PORT
MAIL_USERNAME=null // change it as your desire MAIL USERNAME
MAIL_PASSWORD=null // change it as your desire MAIL PASSWORD
```

Now run 

```
php artisan migrate
```

```
php artisan db:seed
```

run project.

### For Linux user 
The stream or file "/var/www/html/laravel-cms/storage/logs/laravel.log" could not be opened: failed to open stream: Permission denied

if see this kind of error 

just run this command from outside your project root directory to permit read and write

```
sudo chmod -R 777 [directory_name]
```
### For enable .htaccess

```
sudo gedit /etc/apache2/apache2.conf
```
Then find the line where there is

<Directory /var/www/>

     Options Indexes FollowSymLinks
     
     AllowOverride None
     
     Require all granted
     
</Directory>

replace "None" with "All"

AllowOverride All

### Admin panel

Admin url: ``` project/root/admin/login ```

Email: ```admin@example.com```

Password: ```123456```

### Happy coding

## Author

**<a href='https://besofty.com' target='_blank'>Ratul Hasan</a>** | **<a href='mailto:ratuljh@gmail.com'>Email</a>**

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE) file for details
