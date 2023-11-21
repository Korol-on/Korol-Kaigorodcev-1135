<?php


namespace App;
use App\View;
use App\Model;
use App\Helper as h;

class AdminController
{
    private \App\Model $model;
    private \App\View $view;
    private \App\Helper $h;
    private \App\PDO_Model $pdo_model;
    public  function  __construct()
    {
        $this->model = new \App\Model();
        $this->view = new \App\View();
        $this->h = new Helper();
        $this->pdo_model = new PDO_Model();
    }

    public function loginPage(){
        if($this->login()){
            $this->h->goUrl('login');
        }
        $this->view->adminLoginPage();
    }
    public function adminPage(){
        $this->view->adminShowAllArticles($this->pdo_model->getArticles());
    }

    public function login() : bool
    {
        $login = "admin";
        $password = "12345";

        if (isset($_POST['btn_admin']) && $_POST['login'] == $login && $_POST['password'] == $password){
            session_start();

            $_SESSION['user']='admin';
            $_REQUEST['action'] = 'open';

            return true;
        }
        return false;
    }

    public function logout()
    {
        $this->h->goUrl("/admin");
    }

    public function getAllArticles(){

    }

    public function update(){
        if(isset($_POST['id']) && $_POST['id'] != 0){
            $this->editArticle ();
        }
        else{
            $this->addNewArticle();
        }
        $this->h->goUrl('//normalproject.test/login');
    }
    public function editArticle (){
        $articles = $this->model->getArticles();
        foreach ($articles as $ar) {
            if ($ar['id'] == $_REQUEST['id']) {
                $ar['title'] = $_REQUEST['title'];
                $ar['content'] = $_REQUEST['content'];

                $replace = array(intval($ar['id']) => $ar);
                $articles = array_replace_recursive($articles, $replace);
            }
        }
        $fd = fopen('dataBase/articles.json', 'w');
        fwrite($fd, json_encode($articles));
        fclose($fd);
    }
    public function addNewArticle(){

        $articles = $this->model->getArticles();

        $newArticle['id'] = end($articles)['id'] + 1;
        $newArticle['title'] = $_REQUEST['title'];
        $newArticle['content'] = $_REQUEST['content'];
        array_push($articles, $newArticle);

        $fd = fopen('dataBase/articles.json', 'w');
        fwrite($fd, json_encode($articles));
        fclose($fd);
    }
    public function delete($id){
        if($id != 0){
            $articles = $this->model->getArticles();

            foreach ($articles as $ar){
                if($ar['id'] == $id)
                    unset($articles[$id]);
            }

            $fd = fopen('dataBase/articles.json', 'w');
            fwrite($fd, json_encode($articles));
            fclose($fd);
        }


        $this->h->goUrl('//normalproject.test/login');
    }
    public function edit($id){
        $article = $this->model->getArticleById($id);
        $this->view->editPage($article);
    }
    public function addView(){
        $article = ['id'=>0];
        $this->view->editPage($article);
    }

}