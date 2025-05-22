<?php

function isAuthenticated(): bool
{
    return isset($_SESSION['user']); // or any session variable you use
}

function isLoggedIn(): bool
{
    return isset($_SESSION['user']);
}
// noticed 
function isAdmin(): bool
{
    return isset($_SESSION['user']) && !empty($_SESSION['user']) &&
        isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin';
}
