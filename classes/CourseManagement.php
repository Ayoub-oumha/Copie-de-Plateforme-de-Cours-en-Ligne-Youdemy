<?php

require_once  __DIR__ . '/../Config/config.php';

class CourseManagement {
    private $db;

    public function __construct() { 
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAllCourses() {
        $query = "SELECT c.*, u.name as teacher_name, cat.name as category_name 
                  FROM courses c 
                  LEFT JOIN users u ON c.teacher_id = u.id 
                  LEFT JOIN categories cat ON c.category_id = cat.id 
                  ORDER BY c.created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function deleteCourse($id) {
        $query = "DELETE FROM courses WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getCoursesByTeacher($teacherId) {
        $query = "SELECT * FROM courses WHERE teacher_id = :teacher_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':teacher_id', $teacherId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEnrolledCourses($studentId) {
        $query = "SELECT c.* 
                  FROM courses c 
                  JOIN enrollments ec ON c.id = ec.course_id 
                  WHERE ec.student_id = :student_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo "test";
    }

    public function getCourseProgress($courseId, $studentId) {
        $query = "SELECT progress FROM enrollments 
                  WHERE course_id = :course_id 
                  AND student_id = :student_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':course_id', $courseId);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['progress'] : 0;
    }

    public function updateCourseProgress($courseId, $studentId, $progress) {
        $query = "UPDATE enrollments 
                  SET progress = :progress 
                  WHERE course_id = :course_id 
                  AND student_id = :student_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':progress', $progress);
        $stmt->bindParam(':course_id', $courseId);
        $stmt->bindParam(':student_id', $studentId);
        return $stmt->execute();
    }

    public function enrollStudent($studentId, $courseId) {
      
        $query = "SELECT * FROM enrollments WHERE student_id = :student_id AND course_id = :course_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->bindParam(':course_id', $courseId);
        $stmt->execute();


        error_log("Nombre d'inscriptions trouvées: " . $stmt->rowCount());

        if ($stmt->rowCount() > 0) {
            return false; 
        }
        
        try {
            $query = "INSERT INTO enrollments (
                        student_id, 
                        course_id, 
                        enrolled_at,
                        progress
                    ) VALUES (
                        :student_id, 
                        :course_id, 
                        NOW(),
                        0
                    )";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':student_id', $studentId);
            $stmt->bindParam(':course_id', $courseId);
            return $stmt->execute();
        } catch (PDOException $e) {
            
            error_log("Erreur lors de l'inscription: " . $e->getMessage());
            return false;
        }
    }

    // Add method to update last accessed time
    public function updateLastAccessed($studentId, $courseId) {
        $query = "UPDATE enrollments 
                  SET last_accessed = NOW() 
                  WHERE student_id = :student_id 
                  AND course_id = :course_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->bindParam(':course_id', $courseId);
        return $stmt->execute();
    }


  
    public function issueCertificate($studentId, $courseId) {
        $query = "UPDATE enrollments 
                  SET certificate_issued = TRUE 
                  WHERE student_id = :student_id 
                  AND course_id = :course_id 
                  AND status = 'completed'";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->bindParam(':course_id', $courseId);
        return $stmt->execute();
    }

    public function getCourseTags($courseId) {
        $query = "SELECT t.* 
                  FROM tags t 
                  JOIN course_tags ct ON t.id = ct.tag_id 
                  WHERE ct.course_id = :course_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':course_id', $courseId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchCourses($searchTerm = '', $categoryId = null) {
        try {
            $params = array();
            $query = "SELECT c.*, u.name as teacher_name, cat.name as category_name 
                      FROM courses c 
                      LEFT JOIN users u ON c.teacher_id = u.id 
                      LEFT JOIN categories cat ON c.category_id = cat.id 
                      WHERE 1=1";
            
            if (!empty($searchTerm)) {
                $query .= " AND (c.title LIKE :search 
                          OR c.description LIKE :search 
                          OR u.name LIKE :search)";
                $searchPattern = "%{$searchTerm}%";
                $params[':search'] = $searchPattern;
            }
            
            if (!empty($categoryId)) {
                $query .= " AND c.category_id = :category_id";
                $params[':category_id'] = $categoryId;
            }
            
            $query .= " ORDER BY c.created_at DESC";
            
            $stmt = $this->db->prepare($query);
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("Erreur de recherche : " . $e->getMessage());
            return array(); 
        }
    }

    public function getCourseDetails($courseId) {
        $query = "SELECT c.*, u.name as teacher_name, u.email as teacher_email, 
                  cat.name as category_name 
                  FROM courses c 
                  LEFT JOIN users u ON c.teacher_id = u.id 
                  LEFT JOIN categories cat ON c.category_id = cat.id 
                  WHERE c.id = :course_id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':course_id', $courseId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCourse($courseId, $title, $description, $categoryId, $tags, $thumbnail, $content) {
       
        $this->db->beginTransaction();
        try {
         
            $photoCoverData = null;
            if ($thumbnail['error'] == UPLOAD_ERR_OK) {
                $photoCoverData = file_get_contents($thumbnail["tmp_name"]);
            }

            $contentPath = null;
            if ($content['error'] == UPLOAD_ERR_OK) {
                $targetDir = "../uploads/content/";
                $contentPath = $targetDir . basename($content["name"]);
                move_uploaded_file($content["tmp_name"], $contentPath);
            }

        
            $query = "UPDATE courses SET 
                        title = :title, 
                        description = :description, 
                        category_id = :category_id, 
                        photo_cover = :photo_cover, 
                        content = :content 
                      WHERE id = :course_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':category_id', $categoryId);
            $stmt->bindParam(':photo_cover', $photoCoverData, PDO::PARAM_LOB);
            $stmt->bindParam(':content', $contentPath);
            $stmt->bindParam(':course_id', $courseId);
            $stmt->execute();

          
            $query = "DELETE FROM course_tags WHERE course_id = :course_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':course_id', $courseId);
            $stmt->execute();

      
            foreach ($tags as $tagId) {
                $query = "INSERT INTO course_tags (course_id, tag_id) VALUES (:course_id, :tag_id)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':course_id', $courseId);
                $stmt->bindParam(':tag_id', $tagId);
                $stmt->execute();
            }

       
            $this->db->commit();
            return true;
        } catch (Exception $e) {
         
            $this->db->rollBack();
            return false;
        }
    }

    public function getCourseById($courseId) {
        $query = "SELECT c.*, u.name as teacher_name, cat.name as category_name 
                  FROM courses c 
                  LEFT JOIN users u ON c.teacher_id = u.id 
                  LEFT JOIN categories cat ON c.category_id = cat.id 
                  WHERE c.id = :course_id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':course_id', $courseId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalCourses() {
        $query = "SELECT COUNT(*) as total FROM courses";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getTotalStudents() {
        $query = "SELECT COUNT(DISTINCT student_id) as total FROM enrollments";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getTotalEnrollments() {
        $query = "SELECT COUNT(*) as total FROM enrollments";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
} 