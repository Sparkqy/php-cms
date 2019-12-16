<?php

namespace admin\Controllers\Auth;

use src\Core\Auth\Auth;
use src\Controller;
use src\Core\Database\QueryBuilder;
use src\DI\DI;

class LoginController extends Controller
{
    /**
     * @var Auth
     */
    protected $auth;

    /**
     * LoginController constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        parent::__construct($di);

        $this->auth = new Auth();

        if (!is_null($this->auth->userHash())) {
            header('Location: /admin');
            exit();
        }
    }

    public function index()
    {
        $this->view->render('auth/login');
    }

    public function authAdmin()
    {
        $data = $this->request->post;
        $queryBuilder = new QueryBuilder();
        $sql = $queryBuilder
            ->select()
            ->from('users')
            ->where('email', $data['email'])
            ->limit(1)
            ->sql();

        $result = $this->db->querySql($sql, $queryBuilder->getWhereValues());

        if (is_null($result) || !password_verify($data['password'], $result[0]['password'])) {
            $_SESSION['error'] = [
                'message' => 'User with this email or password does not exist. Please provide valid data',
                'type' => 'alert-danger',
            ];
            header('Location: /admin/login');
            exit();
        }

        $user = $result[0];

        if (!$user['role'] === 'admin') {
            $_SESSION['error'] = [
                'message' => 'Only admin user can login to the system',
                'type' => 'alert-danger',
            ];
            header('Location: /admin/login');
            exit();
        }

        $hash = password_hash($user['id'] . $user['email'] . $user['password'], 1);
        $hashSql = 'UPDATE `users` SET `hash` = :hash WHERE `id` = :id';
        $hashParams = ['hash' => $hash, 'id' => $user['id']];

        $this->db->querySql($hashSql, $hashParams);
        $this->auth->authorize($hash);

        header('Location: /admin');
        exit();
    }
}