# belich dashboard

Example of using the package for Laravel https://github.com/daguilarm/belich

All the documents in https://github.com/daguilarm/belich-documents

# Testing 

Create a sqlite db for testing (mac os):

```shell
touch database/database.sqlite
```

Go to the confing file `config/database.php`:

```php
// config/database.php
'dusk' => [
    'driver' => 'sqlite',
    'database' => dirname(__DIR__).'/database/database.sqlite',
    'prefix' => '',
    'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
],
```

Create a sql db for testing (mac os):

```php
'testing_mysql' => [
    'driver' => 'mysql',
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE_TESTING', 'testing'),
    'username' => env('DB_USERNAME_TESTING', 'root'),
    'password' => env('DB_PASSWORD_TESTING', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'prefix_indexes' => true,
    'strict' => true,
    'engine' => null,
],
```
