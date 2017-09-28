<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## About complex blog
Hello there. I have created this project for those who want to learn how Laravel framework works. I tried to use almost all functionality that the framework gives. What you'll find here:

* CMS system (admin zone)
    * Multi language
    * Authentication, Authorization (admins)
    * Admin users CRUD
    * Site users CRUD
    * Roles, Permissions for admin users
    * Blog posts CRUD with different relationships
    * Categories CRUD (many to many)
    * Comments managing (polymorphic relationships with User and Admin table)
* Frontend (web site)
    * Multi language
    * Authentication, Authorization (users)
    * Posts (blog, detail view)
    * Categories
    * Comments with Broadcasting
    * About us and contacts pages

**The list of what I've used is below:**

* Service Providers, Facades, Helpers
* Routing
* Middleware
* CSRF Protection
* Controllers, Models, Views
* Requests
* URL Generation
* Session
* Validation
* Blade Templates
* Localization
* Compiling Assets
* Multi Auth, Authentication, Authorization, Password Reset
* Broadcasting, Laravel Echo
* Events, Listeners
* File Storage
* Helpers
* Mail
* Notifications
* Query Builder
* Pagination
* Migrations, Seeding
* Eloquent ORM Relationships, Mutators

**What I've used for expanding possibilities:**

* santigarcor/laratrust (roles and permissions for admin users)
* Faker/Factory (to generate content for seeding)
* Kaishiyoku/laravel-menu (to generate powerful menu with active items)
* mewebstudio/Purifier (to protect HTML entrings)
* intervention/image (powerful module for modifying your images)
* dimsav/laravel-translatable (to make translatable ORM engine)
* Pusher (Driver for broadcasting)
* Font awesome (icons)
* Select2 (awesome select inputs)


## Instalation
1. You need LAMP environment, Composer, Node.js and NPM installed on your computer. You can find how to do it in the documentation of each.
2. Create your project folder
3. Clone the project into your new project folder
4. Configure your .env file
    1. Insert your database access data
    2. Configure your mail driver (for example mailtrap.io for testing)
    3. Configure your Pusher access data (first register your account on pusher)
5. Initialize Composer in your project folder (composer install)
6. Initialize NPM in your project folder (npm install, npm run dev)
7. Start migration (php artisan migrate)
8. Start seeding (php artisan db:seed)

That's all. Check out your new fresh project :)

You can go to admin zone with link /admin. Superadmin account have this accesses: email: superadmin@app.com, pass: 123456

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
