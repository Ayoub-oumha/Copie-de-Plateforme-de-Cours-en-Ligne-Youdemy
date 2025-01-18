<?php 

class EnseignantController extends BaseController {
    private $courseModel;
    private $categoryModel;
    private $tagModel;
    private $enrollmentModel;
    private $ratingModel;

    public function __construct() {
        parent::__construct();
        $this->courseModel = new CourseModel();
        $this->categoryModel = new CategoryModel();
        $this->tagModel = new TagModel();
        $this->enrollmentModel = new EnrollmentModel();
        $this->ratingModel = new RatingModel();
    }

    public function dashboard() {
        $this->checkTeacherAuth();
        $teacherId = $_SESSION['user_loged_in_id'];
        require_once '../app/views/dashboard/teacher/index.php';
    }

    public function courses() {
        $this->checkTeacherAuth();
        $teacherId = $_SESSION['user_loged_in_id'];
        
        $data['courses'] = $this->courseModel->getCoursesByTeacher($teacherId);
        require_once '../app/views/dashboard/teacher/courses.php';
    }

    public function createCourse() {
        $this->checkTeacherAuth();

        $data = [
            'categories' => $this->categoryModel->getAllCategories(),
            'tags' => $this->tagModel->getAllTags()
        ];

        require_once '../app/views/dashboard/teacher/create-course.php';
    }

    public function storeCourse() {
        $this->checkTeacherAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $teacherId = $_SESSION['user_loged_in_id'];
            $title =  $_POST['title'] ;
            
            $courseData = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'category_id' => $_POST['category_id'],
                'price' => $_POST['price'],
                'teacher_id' => $teacherId,
                'thumbnail' => $this->uploadFile('thumbnail', 'images/courses'),
                'content' => $this->uploadFile('content', 'content/courses')
            ];

            $courseId = $this->courseModel->createCourse($courseData);

            if ($courseId) {
                if (isset($_POST['tags']) && is_array($_POST['tags'])) {
                    $this->courseModel->attachTags($courseId, $_POST['tags']);
                }
                header('Location: /teachers/courses');
            }
        }
    }

    public function statistics() {
        $this->checkTeacherAuth();
        $teacherId = $_SESSION['user_loged_in_id'];

        $data = [
            'totalCourses' => $this->courseModel->getTotalCoursesByTeacher($teacherId),
            'totalStudents' => $this->enrollmentModel->getTotalStudentsByTeacher($teacherId),
            'totalRevenue' => $this->enrollmentModel->getTotalRevenueByTeacher($teacherId),
            'averageRating' => $this->ratingModel->getAverageRatingByTeacher($teacherId),
            'monthLabels' => $this->getLastSixMonths(),
            'monthlyEnrollments' => $this->enrollmentModel->getMonthlyEnrollments($teacherId),
            'monthlyRevenue' => $this->enrollmentModel->getMonthlyRevenue($teacherId),
            'popularCourses' => $this->courseModel->getPopularCoursesByTeacher($teacherId)
        ];

        require_once '../app/views/dashboard/teacher/statistics.php';
    }

    private function checkTeacherAuth() {
        if (!isset($_SESSION['user_loged_in_id'])) {
            header('Location: /login');
            exit();
        }
        // Vérifier si l'utilisateur est un enseignant
        // À implémenter selon votre logique d'authentification
    }

    private function getLastSixMonths() {
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $months[] = date('M', strtotime("-$i months"));
        }
        return $months;
    }

    private function uploadFile($inputName, $targetDirectory) {
        if (!isset($_FILES[$inputName]) || $_FILES[$inputName]['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $targetDir = "public/uploads/" . $targetDirectory . "/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = uniqid() . '_' . basename($_FILES[$inputName]["name"]);
        $targetPath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES[$inputName]["tmp_name"], $targetPath)) {
            return $targetDirectory . "/" . $fileName;
        }

        return null;
    }
}
?>