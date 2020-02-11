<?php

namespace admin\Models\Page;

use src\Core\Database\ActiveRecord;

class Page extends ActiveRecord
{
    /**
     * @var string
     */
    protected string $table = 'pages';

    /**
     * @var int
     */
    public int $id;

    /**
     * @var string
     */
    public string $title;

    /**
     * @var string
     */
    public string $content;

    /**
     * @var string
     */
    public string $created_at;
}