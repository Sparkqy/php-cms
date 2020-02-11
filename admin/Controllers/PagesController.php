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

    /**
     * @param int $id
     * @throws DIContainerException
     */
    public function edit(int $id)
    {
        $this->data['page'] = $this->pageEntity->repository->getById($id);

        if ($this->data['page'] === null) {
            $errorsController = new ErrorsController($this->di);
            return $errorsController->show404();
        }

        $this->view->render('pages/edit', $this->data);
    }

    /**
     * @param int $id
     * @throws DIContainerException
     */
    public function update(int $id)
    {
        if ($this->pageEntity->repository->getById($id) === null) {
            $errorsController = new ErrorsController($this->di);
            return $errorsController->show404();
        }

        $this->pageEntity->repository->updatePage($id, $this->request->post);

        Url::redirectWithFlash('success', [
            'message' => 'Page was successfully updated',
            'alert-class' => 'alert-success'
        ], '/admin/pages/edit/' . $id);
    }
}