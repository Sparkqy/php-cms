<?php

$this->router->add('home', '/', 'HomeController@index');
$this->router->add('news', '/news/(id:int)', 'NewsController@show');
$this->router->add('404', '/404', 'ErrorsController@show404');