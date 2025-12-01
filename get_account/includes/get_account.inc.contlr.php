<?php

declare(strict_types=1);

function account_created($pdo, string $nation_id) {
    $result = get_account_created($pdo, $nation_id);
    return (bool)$result;
}

function nation_id_not_exists($pdo, string $nation_id) {
    $resulte = check_nation_id($pdo, $nation_id);
    return (bool)!$resulte;
}

function nation_id_not_for_role($pdo, $nation_id, $role) {
    return (bool)!check_role_nation_id_exists($pdo, $nation_id, $role);
}
