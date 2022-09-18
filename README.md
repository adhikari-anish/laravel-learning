# Laravel

## Creating new project using composer

```
composer create-project laravel/laravel="8.4.*" laravel
```

Let's explain this command step by step:

1. composer calls the Composer executable

2. create-project is the Composer command that creates a new project

3. laravel/laravel - PHP project might use a skeleton, in our case that is the Laravel Framework. The Composer uses the package repository called Packagist - https://packagist.org/packages/laravel/laravel. Every package added there (which Laravel Framework is) has its unique name. Laravel framework's unique name is laravel/laravel.

4. You want to specify the framework version to use ="8.4.\*" is like saying please use version 8.4.* where * can be 0, 1, 2. So you want to use version 8.4.0, 8.4.1, or 8.4.2 but NOT 8.5.0 or 9.0.0. Of course, normally you might want to use the newer version. But I ask you to use this specific one, as that is the version used in the course. For the best experience, please use this one. Later on, when you get the basic concepts, you can start your projects using any version you like (at the time I'm writing this, 8.4.1 is the most recent Laravel version).

5. laravel is the directory in which your project will be created, relative to where you are in your Terminal application right now.

---

## Laravel Folder structure

1. app: 

    It contains all the business logic of your application whether it is handling our request or interacting with the database.

2. config:

    As the name suggests you will configure your application here.

3. database:

    This folder is for modifying and working with your database schema.

4. public:

    It is entry point to your application i.e. index.php file and additionally files like images, scripts, styles.

5. resources:

    It contains files like styles, scripts, translations and also views. 
    We have MVC separation. Model live in the app folder, Controllers live in Http Controller folder and Views live in the resources folder.

6. routes:

    Here you configure routes to your application.

7. vendor:

    Contains all the third party libraries including laravel.

8. .env:

    Contains environment specific settings for your apps.

9. composer.json

    It is for managing third party dependencies for PHP.

10. package.json

    It is for managing javascript dependencies.

11. artisan

    It is a php script that will run your application on command line.

    Some commands:  

    - `php artisan tinker`: This starts separate shell and allows us to interact with our laravel application throught command line.

    - `php artisan serve`: This will start our php development server with our project and we will be able to visit it in the browser. Using this command is the easiet way to develop laravel application without setting up complicated servers like apache or nginx locally.

---

## Routing

visits page -> router -> controller -> response