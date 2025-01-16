<?php 
require_once (__DIR__.'/../models/courses.php');
class CoursController extends BaseController {
 
    private $coursModel ;
   public function __construct(){

      $this->coursModel = new Courses();

      
   } 
   public function getAllCourses(){
    $allcourses = $this->coursModel->getAllcourses();
     $this->renderviews("Home" ,["users"=> $allcourses ]) ; ;
   
   }
//    public function handleUsers(){
  
//     // Get filter and search values from GET
//     $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all'; // Default to 'all' if no filter is selected
//     $userToSearch = isset($_GET['userToSearch']) ? $_GET['userToSearch'] : ''; // Default to empty if no search term is provided
//     // var_dump($userToSearch);die();

//     // Call showUsers with both filter and search term
//     $users = $this->UserModel->getAllUsers($filter, $userToSearch);
//     $this->renderDashboard('admin/users',["users"=> $users]);
//    }

   
}?>