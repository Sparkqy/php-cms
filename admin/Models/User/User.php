<?php

namespace admin\Models\User;

use src\Core\Database\ActiveRecord;

class User extends ActiveRecord
{
    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $hash;

    /**
     * @var string
     */
    public $role;

    /**
     * @var string
     */
    public $created_at;
}