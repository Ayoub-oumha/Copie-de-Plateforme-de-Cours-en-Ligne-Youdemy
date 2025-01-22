<?php
require_once '../Config/config.php';

class StatisticsManagement {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getTotalUsers() {
        $query = "SELECT COUNT(*) as total FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getTotalCourses() {
        $query = "SELECT COUNT(*) as total FROM courses";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getTotalTeachers() {
        $query = "SELECT COUNT(*) as total FROM users WHERE role = 'enseignant'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getTotalTags() {
        $query = "SELECT COUNT(*) as total FROM tags";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
} 