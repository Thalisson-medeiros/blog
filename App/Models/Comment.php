<?php

namespace App\Models;
use MF\Model\Model;
use PDOException;

class Comment extends Model
{
    public function createNewComment(string $name, string $id_user, string $id_post, string $comment): void
    {
        try{
            $sql = 'insert into tb_comments (comment, id_user, id_post, name) values (?,?,?,?)';
            $stmt = $this->database->prepare($sql);
            $stmt->bindValue(1, $comment);
            $stmt->bindValue(2, $id_user);
            $stmt->bindValue(3, $id_post);
            $stmt->bindValue(4, $name);
            $stmt->execute();

        } catch(PDOException $error){
            echo '<p>' . $error->getMessage() . '/<p>';
        }
    }

    // criar método para buscar a quantidade de comentarios em um post 

    public function getQuantityComment(string $id): array
    {
        try{
            $sql = 'select COUNT(id_post) As qtd_comments from tb_comments where id_post =  ?';
            $stmt = $this->database->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);

        } catch(PDOException $error){
            echo '<p>' . $error->getMessage() . '/<p>';
        }
    }

    // usar o distinct para que não retornem nomes repetidos
    public function getUsernameComments(int $id_post): array
    {
        try{
            $sql = 'select distinct name, comment from tb_comments where id_post = ?';
            $stmt = $this->database->prepare($sql);
            $stmt->bindValue(1, $id_post);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch(PDOException $error){
            echo '<p>' . $error->getMessage() . '/<p>';
        }
    }
}