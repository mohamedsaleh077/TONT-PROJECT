<?php

namespace oop\admin;

require_once $_SERVER['DOCUMENT_ROOT'] . "/new/oop/Dbh.php";

use AllowDynamicProperties;
use oop\Dbh;
use PDO;
use PDOStatement;
use oop\DataValidation;
use oop\SessionManager;

#[AllowDynamicProperties]
class login extends Dbh
{
    private string $username;
    private string $password;
    private PDO $pdo;
    private ?PDOStatement $stmt = null;
    private string $query;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
        parent::__construct();
        $this->pdo = parent::connect();

        if ($this->username === 'sudo' && !$this->sudo_exists()) {
            $this->set_pwd_sudo();
        }
    }

    private function sudo_exists(): bool
    {
        $this->query = "SELECT 1 FROM users WHERE role_id = 1 LIMIT 1;";

        $this->stmt = $this->pdo->prepare($this->query);
        $this->stmt->execute();

        $result = $this->stmt->fetch(PDO::FETCH_ASSOC);

        $this->stmt->closeCursor();
        $this->stmt = null;

        return ($result !== false);
    }

//    speciall function
    private function set_pwd_sudo(): void
    {
        $options = [
            'cost' => 12
        ];
        $hashedPwd = password_hash($this->password, PASSWORD_DEFAULT, $options);

        $this->query = "INSERT INTO users (email, pwd, role_id, ref_id) VALUES ('sudo', :hashed_pwd, '1', '1');";;

        $this->stmt = $this->pdo->prepare($this->query);

        $this->stmt->bindParam(':hashed_pwd', $hashedPwd);

        $this->stmt->execute();
    }

    public function get_user(): array
    {
        $this->query = "SELECT
                            users.id,
                            users.ref_id,
                            users.role_id,
                            users.email,
                            users.pwd,
                            roles.name AS role_name,
                            admins.name AS admin_name
                        FROM
                            users
                        RIGHT JOIN roles on roles.id = users.role_id
                        LEFT JOIN admins on admins.id = users.ref_id
                        WHERE
                            email = :email ;";

        $this->stmt = $this->pdo->prepare($this->query);

        $this->stmt->bindParam(':email', $this->username);

        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setup_session(array $result): bool
    {
        $this->session = new SessionManager();
        $this->session->start_session();
        $_SESSION['id'] = $result['id'];
        $_SESSION['ref_id'] = $result['ref_id'];
        $_SESSION['role_id'] = $result['role_id'];
        $_SESSION['role_name'] = $result['role_name'];
        $_SESSION['admin_name'] = $result['admin_name'];
        $_SESSION['login_time'] = date('Y-m-d H:i:s');

        return true;
    }
}