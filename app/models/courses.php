 <?php
require_once(__DIR__ . '/../config/db.php');
class Courses extends Db
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getAllcourses()
    {


        // get all courses
        $query = $this->conn->prepare("SELECT * FROM  courses  ;");
        $query->execute();
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    // add courses 
    public function createCourse($courseData) {
        $query = "INSERT INTO courses (title, description, photo_cover ,  content , category_id, teacher_id) 
                 VALUES (? , ? , ? , ? , ? , ?)";
        
        $res = $this->conn-> prepare($query);
        
      

        if ($res->execute([$courseData])) {
            // return $this->conn->lastInsertId();
            echo "good" ;
        }
        return false;
    }
}
