<?php

declare(strict_types=1);
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db.inc.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/input_validation.inc.php";
require_once "get_account.inc.model.php";

function echo_all_info($pdo) {
    $nation_id = $_SESSION['nation_id'];
    $role = $_SESSION['role'];

    $query_results = get_user_details_by_nation_id($pdo, $nation_id, $role);
    
    if ($role === 'student') {
        echo '<div class="form-group">
                <p class="form-label">
                    الإسم بالكامل
                </p>
                <div class="input-icon">
                    <i class="fa-solid fa-user"></i>
                </div>
                    <p class="form-input">
                    ' . safe($query_results['fullname']) . '
                    </p>
            </div>';

        echo '<div class="form-group">
                <p class="form-label">
                    الرقم القومي
                </p>
                <div class="input-icon">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <p class="form-input">
                    ' . safe($query_results['student_nation_id']) . '
                </p>
            </div>';

        echo '<div class="form-group">
                <p class="form-label">
                    الكود
                </p>
                <div class="input-icon">
                    <i class="fa-solid fa-qrcode"></i>
                </div>
                <p class="form-input">
                    ' . safe($query_results['ref_id']) . '
                </p>
            </div>';

        echo '<div class="form-group">
                <p class="form-label">
                    الدور
                </p>
                <div class="input-icon">
                    <i class="fa-solid fa-briefcase"></i>
                </div>
                <p class="form-input">
                    ' . $role . '
                </p>
            </div>';

        echo '<div class="form-group">
                    <p class="form-label">
                        المدرسة
                    </p>
                    <div class="input-icon">
                        <i class="fa-solid fa-school"></i>
                    </div>
                    <p class="form-input">
                       ' . safe($query_results['school_name']) . '
                    </p>
                </div>';

        echo '<div class="form-group">
                <p class="form-label">
                    المرحلة الدراسية
                </p>
                <div class="input-icon">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <p class="form-input"> grade
                    ' . safe($query_results['grade']) . '
                </p>
            </div>';
    } else if ($role === 'parent') {
        echo '<div class="form-group">
                <p class="form-label">
                    الإسم بالكامل
                </p>
                <div class="input-icon">
                    <i class="fa-solid fa-user"></i>
                </div>
                    <p class="form-input">
                    ' . safe($query_results['fullname']) . '
                    </p>
            </div>';

        echo '<div class="form-group">
                <p class="form-label">
                    الرقم القومي
                </p>
                <div class="input-icon">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <p class="form-input">
                    ' . safe($query_results['nation_id']) . '
                </p>
            </div>';
    } else if ($role === 'teacher') {
        echo '<div class="form-group">
                <p class="form-label">
                    الإسم بالكامل
                </p>
                <div class="input-icon">
                    <i class="fa-solid fa-user"></i>
                </div>
                    <p class="form-input">
                    ' . safe($query_results['fullname']) . '
                    </p>
            </div>';

        echo '<div class="form-group">
                <p class="form-label">
                    الرقم القومي
                </p>
                <div class="input-icon">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <p class="form-input">
                    ' . safe($query_results['nation_id']) . '
                </p>
            </div>';

        echo '<div class="form-group">
                <p class="form-label">
                    الدور
                </p>
                <div class="input-icon">
                    <i class="fa-solid fa-briefcase"></i>
                </div>
                <p class="form-input">
                    ' . $role . '
                </p>
            </div>';

        echo '<div class="form-group">
                    <p class="form-label">
                        المدرسة
                    </p>
                    <div class="input-icon">
                        <i class="fa-solid fa-school"></i>
                    </div>
                    <p class="form-input">
                       ' . safe($query_results['school_name']) . '
                    </p>
                </div>';

        echo '<div class="form-group">
                    <p class="form-label">
                        المادة الدراسية
                    </p>
                    <div class="input-icon">
                        <i class="fa-solid fa-square-root-variable"></i>
                    </div>
                    <p class="form-input">
                        ' . safe($query_results['subject']) . '
                    </p>
                </div>
                    ';
    }
}
