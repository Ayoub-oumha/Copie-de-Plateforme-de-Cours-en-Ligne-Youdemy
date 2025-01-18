<?php 
require_once (__DIR__.'/../models/User.php');
class AuthController extends BaseController {
 
    private $UserModel ;
   public function __construct(){

      $this->UserModel = new User();
  
   }
  
   public function showRegisterAdmin(){
    // $this->render('auth/sayhello');
    $this->render('auth/registeradmin');
    // echo "hello" ;
   }
   public function showRegister() {
      
    $this->render('auth/register');
   }
   public function showleLogin() {
      
    $this->render('auth/login');
   }
   public function registerbyadmin(){
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['signupAdmin'])) {
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];
            $role = 'administrateur';
            $password = $_POST['password'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $user = [$role ,$full_name,$email , $hashed_password];
            $lastInsertId = $this->UserModel->register($user);

          
            
            $_SESSION['user_loged_in_id'] = $lastInsertId ;
            $_SESSION['user_loged_in_role'] = $role;
      
            if ($lastInsertId && $role == "enseignant") {
                header('Location: admin/dashboard');
            } else if ($lastInsertId && $role == "etudiant") {
                header('Location: client/dashboard');
            }                   
           
       
            exit;
        }}
   }
   public function handleRegister(){
  
  
      
      if ($_SERVER["REQUEST_METHOD"] == "POST"){
         if (isset($_POST['signup'])) {
            // echo "<pre>";
         //   var_dump($_POST);die();

             $full_name = $_POST['full_name'];
             $email = $_POST['email'];
             $role = $_POST['role'];
             $password = $_POST['password'];
             $hashed_password = password_hash($password, PASSWORD_DEFAULT);

             $user = [$role ,$full_name,$email , $hashed_password];

            //  echo "hl" ;
            // var_dump($user) ;

             $lastInsertId = $this->UserModel->register($user);

          
            
                 $_SESSION['user_loged_in_id'] = $lastInsertId ;
                 $_SESSION['user_loged_in_role'] = $role;
           
                 if ($lastInsertId && $role == "enseignant") {
                     header('Location: admin/dashboard');
                 } else if ($lastInsertId && $role == "etudiant") {
                     header('Location: teacher/index');
                 }                   
                
            
                 exit;
             
         }
     }
   }
   public function handleLogin(){


      if ($_SERVER["REQUEST_METHOD"] == "POST"){
          if (isset($_POST['login'])) {
              $email = $_POST['email'];
              $password = $_POST['password'];
              $userData = [$email,$password];
              
              $user = $this->UserModel->login($userData);
              $role = $user['role'] ; 
            // var_dump($user);die();
              $_SESSION['user_loged_in_id'] = $user["id"];
              $_SESSION['user_loged_in_role'] = $role;
              $_SESSION['user_loged_in_nome'] = $user['name'];
  
              if ($user && $role == "administrateur") {
                  header('Location: /admin/dashboard');
              } else if ($user && $role == "etudiant") {
                  header('Location: Client/dashboard.php');
              } else if ($user && $role == "enseignant") {
                  header('Location: Freelancer/dashboard.php');
              } 
             
          }
      }
 

   }

   public function logout() {

      
      // if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
      //  var_dump($_SESSION);die();
         if (isset($_SESSION['user_loged_in_id']) && isset($_SESSION['user_loged_in_role'])) {
             unset($_SESSION['user_loged_in_id']);
             unset($_SESSION['user_loged_in_role']);
             session_destroy();
            
             header("Location: /login");
             exit;
         }
   //   }
   }



}