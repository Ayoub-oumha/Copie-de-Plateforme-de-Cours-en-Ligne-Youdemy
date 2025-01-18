<?php 
require_once (__DIR__.'/../models/User.php');
require_once (__DIR__.'/../models/CategoryModel.php');
require_once (__DIR__.'/../models/CourseModel.php');
require_once (__DIR__.'/../models/TagModel.php') ;


      $this->UserModel = new User();
    private $UserModel;
    private $categoryModel;
    private $courseModel;
    private $tagModel;

    public function __construct(){
        // $this->UserModel = new User();
        $this->categoryModel = new CategoryModel();
        // $this->courseModel = new CourseModel();
        $this->tagModel = new TagModel();
    }

    public function getAllCategroury(){
        $allCate = $this->categoryModel->getAllCategories();
        $allTags = $this->tagModel->getAllTags();
         $this->renderDashboard("teacher/create-course" ,["allCategorys"=> $allCate , "allTags" => $allTags]) ; ;
        
    //    var_dump($allCate) ;
       }
 

    // Method to display create course form with categories
    public function createCourse() {
        
      
        // after go to page of getAllCategroury() ;
        $this->getAllCategroury() ; 
        
    }    // Method to store a new course
    // public function storeCourse() {
    //     if (!isset($_SESSION['user_loged_in_id'])) {
    //         header('Location: /login');
    //         exit();
    //     }
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $teacherId = $_SESSION['user_loged_in_id'];
            
    //         // Handle file uploads
    //         $thumbnailPath = $this->handleFileUpload('thumbnail', 'images/courses');
    //         $contentPath = $this->handleFileUpload('content', 'content/courses');

    //         $courseData = [
    //             'title' => $_POST['title'],
    //             'description' => $_POST['description'],
    //             'category_id' => $_POST['category_id'],
    //             'thumbnail' => $thumbnailPath,
    //             'content' => $contentPath,
    //             'price' => $_POST['price'] ?? 0,
    //             'teacher_id' => $teacherId
    //         ];

    //         $courseId = $this->courseModel->createCourse($courseData);

    //         if ($courseId) {
    //             if (isset($_POST['tags']) && is_array($_POST['tags'])) {
    //                 $this->courseModel->attachTags($courseId, $_POST['tags']);
    //             }
    //             header('Location: /teachers/courses');
    //             exit();
    //         }
    //     }
    // }

    // Helper method for file uploads
    // private function handleFileUpload($inputName, $targetDirectory) {
    //     if (!isset($_FILES[$inputName]) || $_FILES[$inputName]['error'] !== UPLOAD_ERR_OK) {
    //         return null;
    //     }

    //     $targetDir = "public/uploads/" . $targetDirectory . "/";
    //     if (!file_exists($targetDir)) {
    //         mkdir($targetDir, 0777, true);
    //     }

    //     $fileName = uniqid() . '_' . basename($_FILES[$inputName]["name"]);
    //     $targetPath = $targetDir . $fileName;

    //     if (move_uploaded_file($_FILES[$inputName]["tmp_name"], $targetPath)) {
    //         return $targetDirectory . "/" . $fileName;
    //     }

    //     return null;
    // }

    // Method to display dashboard with course statistics
    // public function dashboard() {
    //     if (!isset($_SESSION['user_loged_in_id'])) {
    //         header('Location: /login');
    //         exit();
    //     }

    //     $teacherId = $_SESSION['user_loged_in_id'];
        
    //     $data = [
    //         'totalCourses' => $this->courseModel->getTotalCoursesByTeacher($teacherId),
    //         'recentCourses' => $this->courseModel->getCoursesByTeacher($teacherId)
    //     ];

    //     require_once '../app/views/dashboard/teacher/index.php';
    // }

    // Method to display all courses by category
    public function coursesByCategory($categoryId = null) {
       
    }