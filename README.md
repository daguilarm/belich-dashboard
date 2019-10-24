# belich dashboard

Example of using the package for Laravel https://github.com/daguilarm/belich

All the documents in https://github.com/daguilarm/belich-documents

# Testing 

Create a sqlite db for testing (mac os):

    touch database/database.sqlite

Go to the confing file `config/database.php`:

    <?php
    // config/database.php
    'dusk' => [
        'driver' => 'sqlite',
        'database' => env('DB_DATABASE', database_path('database.sqlite')),
        'prefix' => '',
        'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
    ],

