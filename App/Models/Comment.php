<?php

namespace App\Models;
use MF\Model\Model;
use PDOException;

class Comment extends Model
{
    public function createNewComment(string $id_user, string $id_post, string $comment): void
    {
        try{
            $sql = 'insert into tb_comments (comment, id_user, id_post) values (?,?,?)';

            $stmt = $this->database->prepare($sql);
            $stmt->bindValue(1, $comment);
            $stmt->bindValue(2, $id_user);
            $stmt->bindValue(3, $id_post);
            $stmt->execute();

        } catch(PDOException $error){
            echo '<p>' . $error->getMessage() . '/<p>';
        }
    }
}