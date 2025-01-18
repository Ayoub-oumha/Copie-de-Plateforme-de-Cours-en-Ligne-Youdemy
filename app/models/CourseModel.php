<?php

class CourseModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getCoursesByTeacher($teacherId) {
        $query = "SELECT * FROM courses WHERE teacher_id = :teacher_id";
        $this->db->query($query);
        $this->db->bind(':teacher_id', $teacherId);
        return $this->db->resultSet();
    }

    public function createCourse($courseData) {
        $query = "INSERT INTO courses (title, description, category_id, thumbnail, content, price, teacher_id) 
                 VALUES (:title, :description, :category_id, :thumbnail, :content, :price, :teacher_id)";
        
        $this->db->query($query);
        $this->db->bind(':title', $courseData['title']);
        $this->db->bind(':description', $courseData['description']);
        $this->db->bind(':category_id', $courseData['category_id']);
        $this->db->bind(':thumbnail', $courseData['thumbnail']);
        $this->db->bind(':content', $courseData['content']);
        $this->db->bind(':price', $courseData['price']);
        $this->db->bind(':teacher_id', $courseData['teacher_id']);

        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function attachTags($courseId, $tags) {
        foreach ($tags as $tagId) {
            $query = "INSERT INTO course_tags (course_id, tag_id) VALUES (:course_id, :tag_id)";
            $this->db->query($query);
            $this->db->bind(':course_id', $courseId);
            $this->db->bind(':tag_id', $tagId);
            $this->db->execute();
        }
    }

    public function getTotalCoursesByTeacher($teacherId) {
        $query = "SELECT COUNT(*) as total FROM courses WHERE teacher_id = :teacher_id";
        $this->db->query($query);
        $this->db->bind(':teacher_id', $teacherId);
        return $this->db->single()->total;
    }

    public function getPopularCoursesByTeacher($teacherId) {
        $query = "SELECT 
                    courses.id,
                    courses.title,
                    COUNT(DISTINCT enrollments.user_id) as students_count,
                    SUM(courses.price) as revenue,
                    AVG(COALESCE(course_ratings.rating, 0)) as average_rating
                 FROM courses 
                 LEFT JOIN enrollments ON courses.id = enrollments.course_id
                 LEFT JOIN course_ratings ON courses.id = course_ratings.course_id
                 WHERE courses.teacher_id = :teacher_id
                 GROUP BY courses.id
                 ORDER BY students_count DESC
                 LIMIT 5";
        
        $this->db->query($query);
        $this->db->bind(':teacher_id', $teacherId);
        return $this->db->resultSet();
    }
} 