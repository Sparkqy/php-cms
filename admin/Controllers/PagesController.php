<?php

namespace admin\Controllers;

use src\DI\DI;
use src\Exceptions\DIContainerException;
use src\Helpers\Url;
use stdClass;

class PagesController extends AdminController
{
    /**
     * @var stdClass
     */
    protected stdClass $pageEntity;

    /**
     * PagesController constructor.
     * @param DI $di
     * @throws DIContainerException
     */
    public function __construct(DI $di)
    {
        parent::__construct($di);
        $this->pageEntity = $this->loader->model('page');
    }

    public function index(): void
    {
        $pages = $this->pageEntity->repository->getPages();

        $this->view->render('pages/index', [
            'pages' => $pages,
        ]);
    }

    public function create(): void
    {
        $this->view->render('pages/create');
    }

    public function store(): void
    {
        $request = $this->request->post;
        $this->pageEntity->repository->createPage($request);

        Url::redirectWithFlash('success', [
            'message' => 'New page was successfully created',
            'alert-class' => 'alert-success'
        ], '/admin/pages/create');
    }
}