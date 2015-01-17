HMS
===

##Installing
First clone the repository.
Then use `composer install` to install the required libraries.
Because of the .gitignore, the installed libraries will not be synced.

Also, you will need to run `php artisan db:create` (a custom command) to create all of the needed databases.

In addition, `php artisan migrate:refresh --seed` will also need to be run in order to populate the databases with the needed tables and sample data. This command can also be used to refresh the databases when you've changed the migration or seeding files.
