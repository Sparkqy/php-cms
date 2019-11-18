<?php

namespace cms\Controllers;

class NewsController extends CmsController
{
    public function show($id)
    {
        echo 'NewsController@show{' . $id . '} is up!';
    }
}