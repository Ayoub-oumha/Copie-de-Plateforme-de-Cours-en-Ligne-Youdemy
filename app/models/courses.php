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


        // Total number of users
        $query = $this->conn->prepare("SELECT * FROM  courses  ;");
        $query->execute();
        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        // $res = "ehllo" ;

        return $res;
    }
}
