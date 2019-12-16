<?php

namespace src\Core\Auth;

use src\Helpers\Cookie;

class Auth implements AuthInterface
{
    /**
     * @var bool
     */
    protected $isAuthorized = false;

    /**
     * @var null|string
     */
    protected $user_hash;

    /**
     * @return bool
     */
    public function isAuthorized(): bool
    {
        return $this->isAuthorized;
    }

    /**
     * @return string|null
     */
    public function userHash(): ?string
    {
        return Cookie::get('auth_userHash');
    }

    /**
     * @param string $hash
     * @return bool
     */
    public function authorize(string $hash): bool
    {
        if (is_null($hash)) {
            Cookie::set('auth_userHash', null);

            return false;
        }

        Cookie::set('auth_isAuthorized', true);
        Cookie::set('auth_userHash', $hash);

        return true;
    }

    /**
     * @return void
     */
    public function unauthorize(): void
    {
        Cookie::unset('auth_isAuthorized');
        Cookie::unset('auth_userHash');
    }

    /**
     * @param string $password
     * @return string
     */
    public static function encryptPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}