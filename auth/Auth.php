<?php
session_start();
require_once 'UserManagement.php';

class Auth {
    private $userManagement;

    public function __construct() {
        $this->userManagement = new UserManagement();
    }

    public function register($username, $email, $password, $role) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $this->userManagement->addUser($username, $email, $hashedPassword, $role);
    }

    public function login($email, $password) {
        $user = $this->userManagement->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; 

           
            switch ($user['role']) {
                case 'administrateur':
                    header("Location: ../admin/admin_dashboard.php");
                    break;
                case 'enseignant':
                    header("Location: ../teacher/teacher_dashboard.php");
                    break;
                case 'etudiant':
                    header("Location: ../student/studentpage.php");
                    break;
                default:
                    header("Location: login.php"); 
                    break;
            }
            exit();
        }
        return false;
    }

    public function logout() {
        session_destroy();
        header("Location: /login.php");
        exit();
    }

    public function isAuthenticated() {
        return isset($_SESSION['user_id']);
    }

    public function isAdmin() {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'administrateur';
    }
} 