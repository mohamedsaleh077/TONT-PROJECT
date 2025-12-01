<?php

function isInputEmpty(string $email, string $pwd) {
    if (
            empty($email) ||
            empty($pwd)
    ) {
        return true;
    } else {
        return false;
    }
}

function is_email_invalid(string $email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_eamil_taken(object $pdo, string $email) {
    if (get_email($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}

function is_email_len_invalid(string $email) {
    if ((strlen($email) > 250)) {
        return true;
    } else {
        return false;
    }
}

function is_password_length_invalid(string $pwd) {
    if ((strlen($pwd) < 6) && (strlen($pwd) > 250)) {
        return true;
    } else {
        return false;
    }
}
