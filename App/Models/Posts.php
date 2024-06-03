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

    public function getOnePost(int $id)
    {
        try {
            $sql = '
                select id_post, title_post, date_post,author,category,image_post,description from tb_posts where id_post = ?
            ';
            $stmt = $this->database->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $post = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            // Formatar a data
            if (isset($post['date_post'])) {
                $date = new \DateTime($post['date_post']);
                $post['date_post'] = $date->format('d/m/Y');
            }

            return $post;

        } catch(\PDOException $error) {
            return null;
        }
    }   
}