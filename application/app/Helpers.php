<?php

function isAdmin(): bool {
    return hasRole(ROLE_ADMIN);
}

function isStaff(): bool {
    return hasRole(ROLE_STAFF);
}

function hasRole(string $requiredRole): bool {
    return auth()->check()
        && in_array($requiredRole, auth()->user()->roles, true);
}
