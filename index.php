<?php
require_once 'vendor/autoload.php';

use Tracy\Debugger;
use NoahBuscher\Macaw\Macaw;

Debugger::enable();

Macaw::get('/', 'App\ArticlesController@getAllArticles');
Macaw::get('/article/(:num)', 'App\ArticlesController@getOneArticle');

Macaw::get('admin', 'App\AdminController@loginpage');
Macaw::post('admin', 'App\AdminController@loginpage');
Macaw::get('login', 'App\AdminController@adminpage');
Macaw::get('logout', 'App\AdminController@logout');

Macaw::post('update', 'App\AdminController@update');
Macaw::get('edit/(:num)', 'App\AdminController@edit');
Macaw::get('delete/(:num)', 'App\AdminController@delete');
Macaw::get('add', 'App\AdminController@addView');

Macaw::error('App\View@errorView');

Macaw::dispatch();