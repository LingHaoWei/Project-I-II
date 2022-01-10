Login Account
Email: admin@gmail.com
Password: Password123
(After migrating the admin table)

If cannot login into admin system, please add an account by yourself with these following command. 

Add admin account to database, (type these commands in your Visual Studio Code Terminal):

php artisan tinker

$model = new App\Models\Admin

$model -> name = 'Admin';

$model -> email = 'Admin@gmail.com';

$model -> password = Hash::make('Admin123');

$model -> save();



