<?php

/** @var \src\Cms $this */
$this->router->add('dashboard', '/admin/', 'DashboardController@index');
$this->router->add('login', '/admin/login', 'Auth\LoginController@index');