<?php


namespace App;


use PDO;

class PDO_Model
{
    private $pdo_connection;

    function __construct()
    {
        try {

            $this->pdo_connection = new PDO('postgresql:host=localhost;dbname=WEB', 'kren66', 'kren66', array(
                PDO::ATTR_PERSISTENT => true,
                PDO::FETCH_ASSOC => true,
                PDO::ERRMODE_EXCEPTION => true
            ));
        }catch (\Exception $ex){
            echo $ex;
        }
    }

    public function getArticles() : array
    {
        $answer = $this->pdo_connection->query('SELECT * FROM articles');

        $articles = array();
        while($row = $answer->fetch()){
            array_push($articles, ['id'=>$row['Id'], 'title'=>$row['title'], 'image'=>$row['image'], 'content'=>$row['content']]);
        }
        return $articles;
    }

    function getOneArticle($id)
    {
        $stmt = $this->pdo_connection->prepare("SELECT * FROM REGISTRY where name = ?");
        $stmt->execute($id);
        foreach ($stmt as $row) {
            $this->view->showOnearticle($row);
        }
    }
}