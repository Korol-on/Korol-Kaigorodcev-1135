<?php


namespace App;

use App\View;
use App\Model;
use App\Helper as h;

class ArticlesController
{
    private  $model;
    private \App\View $view;
    private \App\Helper $h;

    public function __construct()
    {
        $this->model = new \App\Models\ArticleModel();
        $this->model->setTable('articles');
        $this->view = new \App\View();
        $this->h = new Helper();
    }

    function getAllArticles()
    {
        $allArticles = $this->model->getAll();

        //$allArticles = $this->model->getArticles();
        $this->view->showAllArticles($allArticles);
    }
    function getOneArticle($id)
    {
        $oneArticle = $this->model->getById($id);
        $this->view->showOnearticle($oneArticle);
    }

}