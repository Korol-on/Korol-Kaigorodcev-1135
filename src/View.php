<?php


namespace App;


class View
{

    private $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $this->twig = new \Twig\Environment($loader, []);
    }

    public function showAllArticles($articles)
    {
        echo $this->twig->render('articlesView.twig', ['articles'=>$articles]);
    }

    public function showOneArticle($article){
        echo $this->twig->render('oneArticleView.twig', ['article'=>$article]);
    }

    public function adminLoginPage(){
        echo $this->twig->render('login.twig', []);
    }

    public function adminShowAllArticles($articles){
        echo $this->twig->render('adminArticles.twig', ['articles'=>$articles]);
    }

    public function editPage($article){
        echo $this->twig->render('editArticle.twig', ['article' => $article]);
    }



    public function errorView(){
        echo $this->twig->render('pageError404.html', []);
    }
}