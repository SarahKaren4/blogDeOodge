<?php

Route::namespace('Site')->group(function () {
    Auth::routes();

    Route::get('/', ['as' => 'site.home', 'uses' => 'SiteController@index']);
    Route::get('/post/{slug}', ['as' => 'site.post.show', 'uses' => 'SiteController@showPost']);
    Route::get('/category/{slug}', ['as' => 'site.category.show', 'uses' => 'SiteController@showCategory']);

    Route::get('/contacts', ['as' => 'site.contacts', 'uses' => 'SiteController@showContacts']);
    Route::get('/about_us', ['as' => 'site.aboutus', 'uses' => 'SiteController@showAboutUs']);
});

Route::namespace('Admin')->group(function () {
    Route::prefix('admin')->group(function () {

        // Authentication for admin users
        Route::get('/login', ['as' => 'admin.login', 'uses' => 'Auth\LoginController@showLoginForm']);
        Route::post('/login', ['as' => 'admin.login.submit', 'uses' => 'Auth\LoginController@login']);
        Route::post('/logout', ['as' => 'admin.logout', 'uses' => 'Auth\LoginController@logout']);
        Route::post('/password/email', ['as' => 'admin.password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
        Route::get('/password/reset', ['as' => 'admin.password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
        Route::post('/password/reset', ['as' => 'admin.password.reset.request', 'uses' => 'Auth\ResetPasswordController@reset']);
        Route::get('/password/reset/{token}', ['as' => 'admin.password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);

        // Main admin page
        Route::get('/', ['as' => 'admin.home', 'uses' => 'AdminController@index']);

        // API clients page
        Route::get('/api', ['as' => 'admin.api', 'uses' => 'AdminController@api']);

        // Permissions CRUD
        Route::resource('permissions', 'PermissionController', [
            'names' => [
                'index' => 'admin.permissions',
                'create' => 'admin.permission.create',
                'store' => 'admin.permission.store',
                'edit' => 'admin.permission.edit',
                'update' => 'admin.permission.update',
                'destroy' => 'admin.permission.destroy',
            ],
            'except' => ['show'],
        ]);
        Route::get('/permissions/delete/{id}', ['as' => 'admin.permission.delete', 'uses' => 'PermissionController@delete']);

        //Roles CRUD
        Route::resource('roles', 'RoleController', [
            'names' => [
                'index' => 'admin.roles',
                'show' => 'admin.role.show',
                'create' => 'admin.role.create',
                'store' => 'admin.role.store',
                'edit' => 'admin.role.edit',
                'update' => 'admin.role.update',
                'destroy' => 'admin.role.destroy',
            ],
        ]);
        Route::get('/roles/delete/{id}', ['as' => 'admin.role.delete', 'uses' => 'RoleController@delete']);

        // Admin users CRUD
        Route::resource('admins', 'AdminUserController', [
            'names' => [
                'index' => 'admin.admins',
                'show' => 'admin.admin.show',
                'create' => 'admin.admin.create',
                'store' => 'admin.admin.store',
                'edit' => 'admin.admin.edit',
                'update' => 'admin.admin.update',
                'destroy' => 'admin.admin.destroy',
            ],
        ]);
        Route::get('/admins/delete/{id}', ['as' => 'admin.admin.delete', 'uses' => 'AdminUserController@delete']);

        // Site users CRUD
        Route::resource('users', 'SiteUserController', [
            'names' => [
                'index' => 'admin.users',
                'show' => 'admin.user.show',
                'create' => 'admin.user.create',
                'store' => 'admin.user.store',
                'edit' => 'admin.user.edit',
                'update' => 'admin.user.update',
                'destroy' => 'admin.user.destroy',
            ],
        ]);
        Route::get('/users/delete/{id}', ['as' => 'admin.user.delete', 'uses' => 'SiteUserController@delete']);

        // Posts CRUD
        Route::resource('posts', 'PostController', [
            'names' => [
                'index' => 'admin.posts',
                'show' => 'admin.post.show',
                'create' => 'admin.post.create',
                'store' => 'admin.post.store',
                'edit' => 'admin.post.edit',
                'update' => 'admin.post.update',
                'destroy' => 'admin.post.destroy',
            ],
        ]);
        Route::get('/posts/delete/{id}', ['as' => 'admin.post.delete', 'uses' => 'PostController@delete']);

        // Categories CRUD
        Route::resource('categories', 'CategoryController', [
            'names' => [
                'index' => 'admin.categories',
                'show' => 'admin.category.show',
                'create' => 'admin.category.create',
                'store' => 'admin.category.store',
                'edit' => 'admin.category.edit',
                'update' => 'admin.category.update',
                'destroy' => 'admin.category.destroy',
            ],
        ]);
        Route::get('/categories/delete/{id}', ['as' => 'admin.category.delete', 'uses' => 'CategoryController@delete']);

        // Comments CRUD
        Route::resource('comments', 'CommentController', [
            'names' => [
                'index' => 'admin.comments',
                'create' => 'admin.comment.create',
                'store' => 'admin.comment.store',
                'edit' => 'admin.comment.edit',
                'update' => 'admin.comment.update',
                'destroy' => 'admin.comment.destroy',
            ],
            'except' => ['show', 'create', 'store'],
        ]);
        Route::get('/comments/delete/{id}', ['as' => 'admin.comment.delete', 'uses' => 'CommentController@delete']);
    });
});
