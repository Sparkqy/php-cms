<?php

/** @var \src\Cms $this */
$this->router->add('dashboard', '/admin/', 'DashboardController@index');
$this->router->add('login', '/admin/login', 'Auth\LoginController@index');
$this->router->add('logout', '/admin/logout', 'Auth\LogoutController@logout');
$this->router->add('auth-admin', '/admin/auth', 'Auth\LoginController@authAdmin', 'post');