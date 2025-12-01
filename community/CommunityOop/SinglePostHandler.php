<?php

namespace CommunityOop;
//require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php";;
require_once $_SERVER['DOCUMENT_ROOT'] . "/new/oop/Dbh.php";

use oop\Dbh;
use PDO;
use PDOException;

class SinglePostHandler extends Dbh
{
    private $pdo;
    private $stmt;
    private $post_id;

    public function __construct($post_id)
    {
        parent::__construct();
        $this->pdo = $this->connect();
        $this->post_id = $post_id;
        $this->stmt = null;
    }

    public function get_post_details(): array
    {
        $query = "SELECT
                        p.id, p.post_subject, p.post_body ,p.media, p.created_at,
                        t.fullname AS name, s.school_name AS school_name,
                        u.profile_picture AS pfp, t.grade , u.id AS user_id, 
                        (SELECT COUNT(*) FROM comments c2 WHERE c2.post_id = p.id) AS comment_count
                    FROM posts AS p
                    JOIN users AS u ON u.id = p.user_id
                    JOIN schools AS s ON s.id = p.school_id 
                    JOIN students AS t ON t.id = u.ref_id
                    LEFT JOIN comments AS C ON C.post_id = p.id
                    WHERE 
                        p.id = :id
                    GROUP BY p.id
                    ";
        $this->stmt = $this->pdo->prepare($query);
        $this->stmt->bindParam(":id", $this->post_id);
        $this->stmt->execute();
        $posts = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }


    public function create_comment($user_id, $body, $media): bool
    {
        $query = "INSERT INTO comments 
                    (user_id, post_id, comment_text, media) VALUES
                    (:user_id, :post_id, :body, :filename)";
        $this->stmt = $this->pdo->prepare($query);
        $this->stmt->bindParam(":user_id", $user_id);
        $this->stmt->bindParam(":post_id", $this->post_id);
        $this->stmt->bindParam(":body", $body);
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

    public function get_comments(): array
    {
        $query = "SELECT 
                    c.post_id, c.comment_text, c.media, c.created_at,
                    u.profile_picture,
                    t.fullname, t.subject
                FROM comments AS c 
                JOIN users AS u ON c.user_id = u.id
                JOIN teachers AS t ON t.id = u.ref_id
                WHERE post_id = :post_id";
        $this->stmt = $this->pdo->prepare($query);
        $this->stmt->bindParam(":post_id", $this->post_id);
        $this->stmt->execute();
        $comments = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
    }

}