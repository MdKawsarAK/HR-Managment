

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

sit.txt
Download latest Composer and setup

Step1: open command prompt and apply the following command:
composer global require laravel/installer

Step2: Set environment variable to System PATH
%USERPROFILE%\AppData\Roaming\Composer\vendor\bin

Step3: apply the following commnad at command prompt

laravel new app1
or
composer create-project laravel/laravel app1


 cd app1
➜ composer run dev
php artisan serve
http://127.0.0.1:8000


Commands:
php artisan make:controller ArticleController
php artisan make:model Product
php artisan make:controller PhotoController --resource
php artisan make:controller PhotoController --resource --model=Photo
php artisan install:api
php artisan make:controller Api/PhotoController --api
php artisan make:resource PhotoResource --api

php artisan make:component Forms/Input
php artisan make:component forms.input --view

Route:
Route::get('/home', function () {
    echo "home";
   // return view('welcome');
});

Route::get('/home',[HomeController::class, 'index']);
Route::resource('posts', PostController::class);

Route::resources([
    'photos' => PhotoController::class,
    'posts' => PostController::class,
]);

Route::apiResources([
    'photos' => PhotoController::class,
    'posts' => PostController::class,
]);

Route::get('/user/{id}', function (string $id) {
    return 'User '.$id;
});


Verb          Path                        Action  Route Name
GET           /users                      index   users.index
GET           /users/create               create  users.create
POST          /users                      store   users.store
GET           /users/{user}               show    users.show
GET           /users/{user}/edit          edit    users.edit
PUT|PATCH     /users/{user}               update  users.update
DELETE        /users/{user}               destroy users.destroy



https://medium.com/@hossamsoliuman/route-resources-in-laravel-6e1f9336528c

<input name="_token" type="hidden" value="{{ csrf_token() }}"/>


Clear all caches in Laravel
===========================
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan event:clear
php artisan route:clear
php artisan schedule:clear-cache
php artisan view:clear
php artisan make:controller Api/ProductController --api


to disable cache set to ENV
================
CACHE_DRIVER=null



Create your own library:helpers
-------------------------------

Create you own library or helpers at the app folder and load it up with composer:

"autoload": {
    "classmap": [
        ...
    ],
    "psr-4": {
        "App\\": "app/"
    },
   "files":[
            "app/Helpers/html_helper.php",
            "app/Helpers/form_helper.php",
            "app/Helpers/seo_helper.php",
            "app/Helpers/file_helper.php",
            "app/Helpers/db_helper.php",
            "app/Helpers/page_helper.php",
            "app/Libraries/File.class.php",
            "app/Libraries/Form.class.php",
            "app/Libraries/Html.class.php",
            "app/Libraries/Db.class.php",
            "app/Libraries/Page.class.php",
            "app/Libraries/Table.class.php"
            //composer dump-autoload
        ]
},
After adding that to your composer.json file, run the following command:

composer dump-autoload


Article:
https://jurin.medium.com/make-laravel-api-even-more-flexible-with-artisan-resource-3f2a0aa322f


Authentication:
------------------------
composer require laravel/breeze --dev
php artisan breeze:install
php artisan migrate


note:  
php artisan make:command GenerateCrud --command=make:crud
php artisan generate:crud employees
php artisan generate:crud employees --force# HR
php artisan generate:crud salaries 
php artisan make:controller Payroll_invoicesController --api



table check :   php artisan tinker
App\Models\Employee::query()->toSql();
