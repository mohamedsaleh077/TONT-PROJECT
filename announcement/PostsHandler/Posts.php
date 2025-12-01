<?php

namespace PostsHandler;
//require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php";;
require_once $_SERVER['DOCUMENT_ROOT'] . "/new/oop/Dbh.php";

use oop\Dbh;
use PDO;
use PDOException;

class Posts extends Dbh
{
    private $pdo;
    private $stmt;
    private $school_id;

    public function __construct($school_id)
    {
        parent::__construct();
        $this->pdo = $this->connect();
        $this->school_id = $school_id;
        $this->stmt = null;
    }

    public function get_posts($page, $keyword): array
    {
        $query = "SELECT
                        p.id, p.post_subject, p.post_body ,p.media, p.created_at,
                        t.fullname AS teacher_name, s.school_name AS school_name
                    FROM posts AS p
                    JOIN users AS u ON u.id = p.user_id
                    JOIN schools AS s ON s.id = p.school_id 
                    JOIN teachers AS t ON t.id = u.ref_id
                    WHERE 
                        p.school_id = :school_id AND 
                        p.post_type = 'school' AND 
                        p.post_body LIKE :keyword
                    ORDER BY created_at DESC LIMIT :startpage, 10
                    ";
        $this->stmt = $this->pdo->prepare($query);
        $this->stmt->bindParam(":school_id", $this->school_id);
        $str = "%$keyword%";
        $this->stmt->bindParam(":keyword", $str);
        $this->stmt->bindParam(":startpage", $page);
        $this->stmt->execute();
        $posts = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }


    public function creat_post($user_id, $school_id, $post_subject, $post_body, $media): bool
    {
        $query = "INSERT INTO posts 
                    (user_id, school_id, post_type, post_subject, post_body, media) VALUES 
                    (:user_id, :school_id, 'school', :subject, :body, :filename)";
        $this->stmt = $this->pdo->prepare($query);
        $this->stmt->bindParam(":user_id", $user_id);
        $this->stmt->bindParam(":school_id", $school_id);
        $this->stmt->bindParam(":subject", $post_subject);
        $this->stmt->bindParam(":body", $post_body);
        $this->stmt->bindParam(":filename", $media);
        try {
            $this->stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
        $this->stmt = null;
        return true;
    }

}