<?php 
require_once (__DIR__.'/../models/courses.php');
class CoursController extends BaseController {
 
    private $coursModel ;
   public function __construct(){

      $this->coursModel = new Courses();

      
   } 
   public function getAllCourses(){
    $allcourses = $this->coursModel->getAllcourses();
     $this->renderviews("home" ,["allcourses"=> $allcourses ]) ; ;
   
   }

}?>