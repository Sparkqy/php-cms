<?php

/** @var \src\Cms $this */
$this->router->add('dashboard.index', '/admin/', 'DashboardController@index');
$this->router->add('login', '/admin/login', 'Auth\LoginController@index');
$this->router->add('logout', '/admin/logout', 'Auth\LogoutController@logout');
$this->router->add('auth-admin', '/admin/auth', 'Auth\LoginController@authAdmin', 'post');

$this->router->add('pages.index', '/admin/pages', 'PagesController@index');
$this->router->add('pages.create', '/admin/pages/create', 'PagesController@create');
$this->router->add('pages.store', '/admin/pages/store', 'PagesController@store', 'post');