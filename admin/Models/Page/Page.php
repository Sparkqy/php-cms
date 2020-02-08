<?php

namespace admin\Models\Page;

use src\Core\Database\ActiveRecord;

class Page extends ActiveRecord
{
    /**
     * @var string
     */
    protected $table = 'pages';

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $content;

    /**
     * @var string
     */
    public $created_at;
}