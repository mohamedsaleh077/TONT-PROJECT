<?php

namespace oop;

require_once $_SERVER['DOCUMENT_ROOT'] . "/new/oop/SessionManager.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/new/oop/Dbh.php";

use oop\SessionManager;
use PDO;
//use Dbh;

class DataValidation extends SessionManager
{
    private array $error_list;
    private string $CSRF_TOKEN;
    private PDO $pdo;

    public function __construct()
    {
        $this->error_list = [];
        parent::start_session();
        $this->CSRF_TOKEN = $_SESSION['CSRF_TOKEN'];

        $db = new Dbh();
        $this->pdo = $db->connect();
    }

    public function max255(string $input): void
    {
        if (mb_strlen($input, 'UTF-8') > 255) {
            $this->error_list['max255'] = 'تم ادخال اكثر من 250 حرف, وهو اكثر من الحد المسموح به';
        }
    }

    public function is_empty(array $input): void
    {
        foreach ($input as $value) {
            if (empty($value)) {
                $this->error_list['empty'] = 'بعض المدخلات المطلوبة لم يتم ادخالها';
            }
        }
    }

    public function valid_CSRF(string $input): void
    {
        if ($input !== $_SESSION['CSRF_TOKEN']) {
            $this->error_list['invalid_CSRF'] = 'خطأ في الجلسة, قم باعادة تحميل الصفحه';
        }
    }

    public function valid_email(string $input): void
    {
        if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $this->error_list['invalid_email'] = 'البريد الالكتروني خاطيء';
        }
    }

    public function valid_password(string $input): void
    {
        if (mb_strlen($input, 'UTF-8') < 6) {
            $this->error_list['invalid_password'] = 'كلمة المرور يجب الا تقل عن 6 احرف';
        }
    }

    public function valid_username(string $input): void
    {
        if (mb_strlen($input, 'UTF-8') < 3) {
            $this->error_list['invalid_username'] = 'لا يمكن ان يكون اسم المستخدم اقل من 3 حروف';
        }
    }

    public function valid_nation_id(string $input): void
    {
        if (mb_strlen($input, 'UTF-8') !== 14) {
            $this->error_list['invalid_nation_id'] = 'يجب ان يتكون الرقم القومي من 14 رقم';
        }
    }

    public function valid_length(string $input, int $len): bool
    {
        if (mb_strlen($input, 'UTF-8') > $len) {
            $this->error_list['invalid_length'] = 'يجب ان يكون طول المدخل ' . $len . ' حرفًا';
            return false;
        } else {
            return true;
        }
    }

    public function check_existance(string $input): bool
    {
        $query = "SELECT email FROM users WHERE email= :email;";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $input);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result === false){
            $this->error_list['invalid_username'] = 'المستخدم غير موجود';
            return false;
        } else {
            return true;
        }
    }

    public function check_password(string $input, string $hashed): bool
    {
        if (!password_verify($input, $hashed)) {
            $this->error_list['invalid_password'] = 'كلمة المرور خاطئة';
            return false;
        } else {
            return true;
        }
    }
    public function getErrors(): array
    {
        return $this->error_list;
    }

    // add error
    public function addError(string $error): void
    {
        $this->error_list[] = $error;
    }

    public function addErrors(array $errors): void
    {
        $this->error_list = array_merge($this->error_list, $errors);
    }
}