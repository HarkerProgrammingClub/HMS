HMS
===

##Installing
First clone the repository.
Then use `composer install` to install the required libraries.
Because of the .gitignore, the installed libraries will not be synced.

Also, you will need to run `CREATE SCHEMA HMS` and `CREATE SCHEMA HMSinfo` in the MySQL shell to create the databases. You should be able to access the mysql shell by typing `mysql --user=root --password=root` into your terminal. If you are using Windows, you will need to add C:\Program Files\MySQL\MySQL Server 5.6\bin to your path if you are using MySQL version 5.6.

In addition, `php artisan migrate:refresh --seed` will also need to be run in order to populate the databases with the needed tables and sample data. This command can also be used to refresh the databases when you've changed the migration or seeding files.
