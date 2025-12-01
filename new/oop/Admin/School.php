<?php

namespace oop\Admin;
require_once $_SERVER['DOCUMENT_ROOT'] . "/new/oop/Dbh.php";

use oop\Dbh;
use PDO;

class School extends Dbh
{
    private PDO $pdo;

    public function __construct()
    {
        parent::__construct();
        $this->pdo = parent::connect();
    }

    // get total states
    public function get_total($keyword): int
    {
        $query = "SELECT COUNT(*) as total FROM schools WHERE school_name LIKE :keyword;";
        $stmt = $this->pdo->prepare($query);
        $str = "%$keyword%";
        $stmt->bindParam(":keyword", $str, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result[0]['total'];
    }

    public function get_schools($startat, $keyword, $state_id): array
    {
        if($state_id == 0){
            $query = "SELECT 
                            schools.id,
                            schools.school_name AS name,
                            states.name AS state_name,
                            schools.created_at,
                            schools.updated_at
                        FROM schools 
                        JOIN states ON states.id = schools.states_id 
                        WHERE school_name LIKE :keyword 
                        LIMIT :startat, 5";
        }else {
            $query = "SELECT 
                        schools.id,
                        schools.school_name AS name,
                        states.name AS state_name,
                        schools.created_at,
                        schools.updated_at
                    FROM schools 
                    JOIN states ON states.id = schools.states_id
                    WHERE school_name LIKE :keyword AND states.id = :state_id
                    LIMIT :startat, 5";
            }
        $stmt = $this->pdo->prepare($query);
        $str = "%$keyword%";
        $stmt->bindParam(":keyword", $str, PDO::PARAM_STR);
        $stmt->bindParam(":startat", $startat, PDO::PARAM_INT);
        if($state_id != 0) {
            $stmt->bindParam(":state_id", $state_id, PDO::PARAM_INT);
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }

// create status
    public
    function create_school(string $data, $state_id): bool
    {
        $query = "INSERT INTO schools (school_name, states_id) VALUES (:school_name, :states_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":school_name", $data);
        $stmt->bindParam(":states_id", $state_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

// check if status exists
    public
    function school_exists(string $school_name, $state_id): bool
    {
        $query = "SELECT 1 FROM schools WHERE school_name = :school_name AND states_id = :states_id LIMIT 1";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":school_name", $school_name);
        $stmt->bindParam(":states_id", $state_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result !== false;
    }

    public function delete($id): bool
    {
        $query = "DELETE FROM schools WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete_all(): bool
    {
        $query = "DELETE FROM schools";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute();
    }

    public function edit($id, $data): bool
    {
        $query = "UPDATE schools SET school_name = :school_name WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":school_name", $data);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

//    public function get_school_by_state($state_id, $page, $keyword): array
//    {
//        $query = "SELECT * FROM schools WHERE id = :id";
//        $stmt = $this->pdo->prepare($query);
//    }
}