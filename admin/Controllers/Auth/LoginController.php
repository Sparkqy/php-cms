<?php

namespace admin\Controllers\Auth;

use src\Core\Auth\Auth;
use src\Controller;
use src\Core\Database\QueryBuilder;
use src\DI\DI;
use src\Exceptions\DIContainerException;
use src\Helpers\Url;

class LoginController extends Controller
{
    /**
     * @var Auth
     */
    protected Auth $auth;

    /**
     * LoginController constructor.
     * @param DI $di
     * @throws DIContainerException
     */
    public function __construct(DI $di)
    {
        parent::__construct($di);
        $this->auth = new Auth();

        if (!is_null($this->auth->userHash())) {
            Url::redirect('/admin/');
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
        $sql = $queryBuilder->select()
            ->from('users')
            ->where('email', $data['email'])
            ->limit(1)
            ->sql();

        $result = $this->db->querySql($sql, $queryBuilder->getValues('where'));

        if ($result === null || !password_verify($data['password'], $result[0]['password']) || $result[0]['role'] !== 'admin') {
            $_SESSION['error'] = [
                'message' => 'User with this email or password does not exist. Please provide valid data',
                'type' => 'alert-danger',
            ];
            Url::redirect('/admin/login');
        }

        $user = $result[0];
        $hash = password_hash($user['id'] . $user['email'] . $user['password'], 1);
        $sql = $queryBuilder->update('users')
            ->set(['hash' => $hash])
            ->where('id', $user['id'])
            ->sql();

        $this->db->querySql($sql, $queryBuilder->getValuesMerged(), false);
        $this->auth->authorize($hash);

        Url::redirect('/admin/');
    }
}