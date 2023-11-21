<?php


namespace App;


class Model
{
    public function getArticles() : array
    {
        return json_decode(file_get_contents('dataBase/articles.json'), true);
    }

    public function getArticleById($id) : array
    {
        $array = $this->getArticles();

        foreach ($array as $ar)
        {
            if($ar['id'] == $id)
            {
                return $ar;
            }
        }
    }
}