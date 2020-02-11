<?php

namespace admin\Models\User;

use src\DI\DI;
use src\Exceptions\DIContainerException;
use src\Model;

class UserRepository extends Model
{
    /**
     * @var User
     */
    protected User $userModel;

    /**
     * PageRepository constructor.
     * @param DI $di
     * @throws DIContainerException
     */
    public function __construct(DI $di)
    {
        parent::__construct($di);
        $this->userModel = new User($di);
    }

    /**
     * @return array|null
     */
    public function getUsers(): ?array
    {
        $query = $this->queryBuilder->select()
            ->from($this->userModel->getTable())
            ->orderBy('id', 'DESC')
            ->sql();

        return $this->db->querySql($query);
    }
}