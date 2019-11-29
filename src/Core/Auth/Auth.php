<?php

namespace src\Core\Auth;

use src\Helpers\Cookie;

class Auth implements AuthInterface
{
    /**
     * @var bool
     */
    protected $isAuthorized = false;

    protected $user;

    /**
     * @return bool
     */
    public function isAuthorized()
    {
        return $this->isAuthorized;
    }

    public function user()
    {
        return $this->user;
    }

    /**
     * @param $user
     * @return bool
     */
    public function authorize($user): bool
    {
        if (is_null($user)) {
            Cookie::set('auth.user', null);

            return false;
        }

        Cookie::set('auth.isAuthorized', true);
        Cookie::set('auth.user', $user);
        $this->isAuthorized = true;
        $this->user = $user;

        return true;
    }

    /**
     * @return void
     */
    public function unauthorize(): void
    {
        Cookie::unset('auth.isAuthorized');
        Cookie::unset('auth.user');
        $this->isAuthorized = false;
        $this->user = null;
    }

    /**
     * @param string $password
     * @return string
     */
    public static function encryptPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}