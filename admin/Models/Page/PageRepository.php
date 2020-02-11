<?php

namespace admin\Models\Page;

use ReflectionException;
use src\DI\DI;
use src\Exceptions\DIContainerException;
use src\Model;

class PageRepository extends Model
{
    /**
     * @var Page
     */
    protected Page $pageModel;

    /**
     * PageRepository constructor.
     * @param DI $di
     * @throws DIContainerException
     */
    public function __construct(DI $di)
    {
        parent::__construct($di);
        $this->pageModel = new Page($di);
    }

    /**
     * @return array|null
     */
    public function getPages(): ?array
    {
        $query = $this->queryBuilder->select()
            ->from($this->pageModel->getTable())
            ->orderBy('id', 'DESC')
            ->sql();

        return $this->db->querySql($query);
    }

    /**
     * @param array $data
     * @return string
     * @throws ReflectionException
     */
    public function createPage(array $data): string
    {
        $this->pageModel->title = $data['title'];
        $this->pageModel->content = $data['content'];
        return $this->pageModel->save();
    }

    /**
     * @param int $id
     * @return array|bool|null
     */
    public function getById(int $id): ?array
    {
        $this->pageModel->setId($id);

        return $this->pageModel->findOne();
    }

    /**
     * @param int $id
     * @param array $data
     * @return string
     * @throws ReflectionException
     */
    public function updatePage(int $id, array $data)
    {
        $this->pageModel->setId($id);
        $this->pageModel->title = $data['title'];
        $this->pageModel->content = $data['content'];
        return $this->pageModel->save();
    }
}