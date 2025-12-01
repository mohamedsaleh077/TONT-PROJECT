<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get input
    $nation_id = $_POST["nation_id"];
    $role = $_POST["role"];
    $token = $_POST['token'];
    
    try {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db.inc.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/input_validation.inc.php";
        
        require_once "get_account.inc.model.php"; 
        require_once "get_account.inc.contlr.php"; 

        $errors = [];
        // Error Handlers
        
        if (is_CSRF_invalid($token)){
            $errors[] = "حدث خطأ في رمز الحماية، يرجى إعادة تحميل الصفحة.";
        }
        
        if (all_empty ( [$nation_id, $role] )) {
           $errors[] = "يجب ملىء جميع البيانات (الرقم القومي والدور).";
        }

        if (nation_id_invalid($nation_id)) {
            $errors[] = "الرقم القومي المدخل غير صحيح أو غير كامل.";
        }

        if (not_in_array([$role], ROLES)) {
            $errors["account_role"] = "تم ارسال بيانات غير صالحة في خانة الدور.";
        }
        
        // 1. التحقق من وجود حساب مُفعل مسبقًا
        if (empty($errors) && account_created($pdo, $nation_id)) {
            $errors["nationid_have_account"] = "تم إنشاء حساب على هذا الرقم القومي بالفعل! يرجى الذهاب لصفحة تسجيل الدخول.";
        }
        
        if (empty($errors) && nation_id_not_for_role($pdo, $nation_id, $role)) {
            $errors["nation_id_role_mismatch"] = "الرقم القومي ($nation_id) غير مسجل كـ **" . strtoupper($role) . "** في قاعدة البيانات.";
        }
        
        if ($errors) {
            $_SESSION["err"] = $errors;
            header("Location: ../index.php?err=yes");
            var_dump($errors);
//            var_dump();
            $pdo = null;
            exit();
            
        } else {
            $_SESSION['nation_id'] = $nation_id;
            $_SESSION['role'] = $role;
            header("Location: ../create.php");
            exit();
        }
    } catch (PDOException $e) {
        die(); 
    }
} else {
    header("Location: /index.php");
    exit();
}