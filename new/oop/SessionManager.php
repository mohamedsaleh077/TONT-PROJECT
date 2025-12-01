<?php

namespace oop;

use Random\RandomException;

class SessionManager
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            $config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/configs.ini', true);
            ini_set('session.use_only_cookies', 1);
            ini_set('session.use_strict_mode', 1);

            session_set_cookie_params([
                'lifetime' => $config['host']['lifetime'],
                'domain' => $config['host']['host'],
                'path' => '/',
                'secure' => $config['host']['secure'],
                'httponly' => true
            ]);
        }
    }

    public function start_session(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['last_regeneration'])) {
            $this->regenerateId();
        } else {
            $interval = 60 * 30;
            if (time() - $_SESSION['last_regeneration'] >= $interval) {
                $this->regenerateId();
            }
        }
    }

    private function regenerateId(): void
    {
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
        try {
            $_SESSION["CSRF_TOKEN"] = bin2hex(random_bytes(32));
        } catch (RandomException $e) {
            error_log("Failed to generate CSRF token: " . $e->getMessage());
        }
    }

    public static function getCsrfToken(): string
    {
        return $_SESSION['CSRF_TOKEN'] ?? '';
    }

    public static function destroy(): void
    {
        session_unset();
        session_destroy();

        header("Location: /index.php");
        die();
    }

    public function print_saved_errors(): void
    {
        foreach ($_SESSION['errors'] as $error) {
            echo "<p>$error</p>";
        }
        unset($_SESSION['errors']);
    }

}
