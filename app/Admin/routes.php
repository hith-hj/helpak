<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    
    $router->get('/posts', 'HomeController@posts')->name('admin.posts');
    $router->get('/postShow/{id}', 'HomeController@postShow')->name('admin.posts.postShow');
    $router->get('/postCreate', 'HomeController@postCreate')->name('admin.posts.postCreate');
    $router->post('/postStore', 'HomeController@postStore')->name('admin.posts.postStore');
    $router->get('/postDelete/{id}', 'HomeController@postDelete')->name('admin.posts.postDelete');

    $router->get('/donate', 'HomeController@donate')->name('admin.posts.donate');

    $router->get('/users', 'HomeController@users')->name('admin.users');
    $router->get('/userShow/{id}', 'HomeController@userShow')->name('admin.userShow');
    $router->get('/chats', 'HomeController@chats')->name('admin.chats');
    $router->get('/messages', 'HomeController@messages')->name('admin.messages');
    $router->get('/asks', 'HomeController@asks')->name('admin.asks');
    $router->get('/reports', 'HomeController@reports')->name('admin.reports');
    $router->get('/HelpakChat', 'HomeController@helpakMsgs')->name('admin.helpakChat');

});
