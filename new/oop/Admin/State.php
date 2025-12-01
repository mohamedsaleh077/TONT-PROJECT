<?php

namespace oop\Admin;
require_once $_SERVER['DOCUMENT_ROOT'] . "/new/oop/Dbh.php";

use oop\Dbh;
use PDO;

class State extends Dbh
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
        $query = "SELECT COUNT(*) as total FROM states WHERE name LIKE :keyword;";
        $stmt = $this->pdo->prepare($query);
        $str = "%$keyword%";
        $stmt->bindParam(":keyword", $str, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result[0]['total'];;
    }

    public function get_state($startat, $keyword): array
    {
        $query = "SELECT * FROM states WHERE name LIKE :keyword LIMIT :startat, 5";
        $stmt = $this->pdo->prepare($query);
        $str = "%$keyword%";
        $stmt->bindParam(":keyword", $str, PDO::PARAM_STR);
        $stmt->bindParam(":startat", $startat, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }

// create status
    public
    function create_state(string $data): bool
    {
        $query = "INSERT INTO states (name) VALUES (:statues_name)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":statues_name", $data);
        return $stmt->execute();
    }

// check if status exists
    public
    function state_exists(string $statues_name): bool
    {
        $query = "SELECT 1 FROM states WHERE name = :statues_name LIMIT 1";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":statues_name", $statues_name);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result !== false;
    }

    public function delete($id): bool
    {
        $query = "DELETE FROM states WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function edit($id, $data): bool
    {
        $query = "UPDATE states SET name = :statues_name WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":statues_name", $data);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // delete all table content
    public function delete_all(): bool
    {
        $query = 'DELETE FROM states';
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute();
    }

    // get all states
    public function get_all(): array
    {
        $query = 'SELECT * FROM states';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }

    // check if state exists
    public function state_exists_by_id($id): bool
    {
        $query = 'SELECT 1 FROM states WHERE id = :id LIMIT 1';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result !== false;
    }
}