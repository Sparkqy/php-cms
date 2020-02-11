<?php

namespace admin\Models\User;

use src\Core\Database\ActiveRecord;

class User extends ActiveRecord
{
    /**
     * @var string
     */
    protected string $table = 'users';

    /**
     * @var int
     */
    public int $id;

    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public string $password;

    /**
     * @var string
     */
    public string $hash;

    /**
     * @var string
     */
    public string $role;

    /**
     * @var string
     */
    public string $created_at;
}