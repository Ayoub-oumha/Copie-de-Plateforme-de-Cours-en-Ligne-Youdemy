<?php
include_once  "course.class.php" ;
class Document extends CourseManagementt {
    private $content ;
    private $type ;
    public function __construct($content, $type ,$title, $description, $teacher_id, $category_id, $tags, $thumbnail)
    {
        $this->content = $content;
        $this->type = $type;
        parent::__construct($title, $description, $teacher_id, $category_id, $tags, $thumbnail) ;
    }
    public function addCourse()
    {
        $this->db->beginTransaction();
        try {
           
            $photoCoverData = null;
            if ($this->thumbnail['error'] == UPLOAD_ERR_OK) {
                $photoCoverData = file_get_contents($this->thumbnail["tmp_name"]);
            }

    

            $query = "INSERT INTO courses (title, description, photo_cover, content, content_type , category_id, teacher_id, created_at) 
                      VALUES (:title, :description, :photo_cover, :content, :content_type , :category_id, :teacher_id, NOW())";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':photo_cover', $photoCoverData, PDO::PARAM_LOB);
            $stmt->bindParam(':content', $this->content );
            $stmt->bindParam(':content_type', $this->type );
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':teacher_id', $this->teacher_id);
            $stmt->execute();
    
 
            $courseId = $this->db->lastInsertId();
    

            foreach ($this->tags as $tagId) {
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
    
}
