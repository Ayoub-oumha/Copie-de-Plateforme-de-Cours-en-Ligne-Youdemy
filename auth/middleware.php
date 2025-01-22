<?php
require_once 'Auth.php';

function requireAuth() {
    $auth = new Auth();
    if (!$auth->isAuthenticated()) {
        header("Location: ../auth/login.php"); 
        exit();
    }
}

function requireAdmin() {
    $auth = new Auth();
    if (!$auth->isAdmin()) {
        header("Location: /403.php");
        exit();
    }
}

function requireAdminAuth() {
    $auth = new Auth();
    if (!$auth->isAuthenticated() || !$auth->isAdmin()) {
        header("Location: ../auth/login.php"); 
        exit();
    }
} 