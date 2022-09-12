<?php

use Illuminate\Http\RedirectResponse;

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

function validRoles(): array {
    return [
        ROLE_ADMIN,
        ROLE_STAFF,
    ];
}

function redirectBackWithError(string $errorContext, Throwable $exception): RedirectResponse {
    return redirect()
        ->back()
        ->withInput()
        ->with('error', sprintf(
            '%s - %s',
            $errorContext,
            $exception->getMessage(),
        ));
}
