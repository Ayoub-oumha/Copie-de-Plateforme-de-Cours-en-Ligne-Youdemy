<?php


require_once  __DIR__ . '/../Config/config.php';

abstract class CourseManagementt {
    protected $db;
    protected $title;
    protected $description;
    protected $teacher_id;
    protected $category_id;
    protected $tags;
    protected $thumbnail;


    public function __construct($title, $description, $teacher_id, $category_id, $tags, $thumbnail ) {
        $database = new Database();
        $this->db = $database->getConnection();

        $this->title = $title;
        $this->description = $description;
        $this->teacher_id = $teacher_id;
        $this->category_id = $category_id;
        $this->tags = $tags;
        $this->thumbnail = $thumbnail;
   
    }

    abstract protected function addCourse();
     
    


    
    
}


