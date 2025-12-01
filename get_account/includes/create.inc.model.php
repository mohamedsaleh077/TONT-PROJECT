<?php

declare(strict_types=1);

function get_email(object $pdo, string $email) {
    $query = "SELECT email FROM users WHERE email = :email;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $resulte = $stmt->fetch(PDO::FETCH_ASSOC);

    $pdo = null;
    $stmt = null;
    return $resulte;
}

/**
 * إنشاء سجل جديد في جدول 'users' مع إضافة حقول تسجيل الدخول وتشفير كلمة المرور.
 * * @param object $pdo كائن اتصال PDO بقاعدة البيانات.
 * @param int $ref_id الـ ID المقابل في الجداول الثابتة (students.id, parents.id, teachers.id).
 * @param string $fullname الاسم الكامل للمستخدم.
 * @param string $nation_id الرقم القومي (يجب أن يكون فريدًا).
 * @param string $user_role دور المستخدم (مثل 'parent', 'student', 'teacher').
 * @param string $email البريد الإلكتروني للحساب.
 * @param string $pwd كلمة المرور قبل التشفير.
 * @param int|null $school_id مفتاح المدرسة (null لولي الأمر).
 * @param string|null $subject المادة (null لغير المعلمين).
 * @return bool true عند النجاح.
 */
function create_user_account(
    object $pdo, 
    int $ref_id, // <--- الباراميتر الجديد
    string $fullname, 
    string $nation_id, 
    string $user_role, 
    string $email,      
    string $pwd,        
    ?int $school_id = null, 
    ?string $subject = null,
    ?string $grade = null
): bool {
    try {
        
        // 1. تشفير كلمة المرور (Hashing)
        $options = [
            'cost' => 12 // تكلفة التشفير لزيادة الأمان
        ];
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT, $options);
        
        // 2. الاستعلام لعملية الإدراج
        $query = "
            INSERT INTO users 
                (email, pwd, ref_id, nation_id, role) 
            VALUES 
                (:email, :hashed_pwd, :ref_id, :nation_id, :user_role);
        ";
        $stmt = $pdo->prepare($query);
        
        // 3. ربط الباراميترز (bindParam)
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":hashed_pwd", $hashedPwd); // استخدام القيمة المشفرة
        $stmt->bindParam(":ref_id", $ref_id, PDO::PARAM_INT); // <--- ربط الـ ref_id
        $stmt->bindParam(":nation_id", $nation_id);
        $stmt->bindParam(":user_role", $user_role);


        return $stmt->execute();
        
    } catch (PDOException $e) {
        echo "User Account Creation Failed: " . $e->getMessage();
        die();
        return false;
    }
}