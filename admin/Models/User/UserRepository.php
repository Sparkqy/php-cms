<?php

namespace admin\Models\User;

use src\Model;

class UserRepository extends Model
{
    /**
     * @return array|null
     */
    public function getUsers(): ?array
    {
        $query = $this->queryBuilder
            ->select()
            ->from('users')
            ->orderBy('id', 'DESC')
            ->sql();

        return $this->db->querySql($query);
    }
}