<?php

namespace App\Models;
use MF\Model\Model;

class Posts extends Model
{
    public function getPosts(): array
    {
        try {
            $sql = '
                select id_post, title_post, date_post,author,category,image_post,description from tb_posts
            ';
            $stmt = $this->database->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch(\PDOException $error) {
            return null;
        }
    }

    public function getFavoritePosts(): array
    {
        try {
            $sql = '
                select id_post, title_post, date_post,author,category,image_post,description from tb_posts
                order by category limit 3
            ';
            $stmt = $this->database->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch(\PDOException $error) {
            return null;
        }
    }
}