<?php
require_once '../auth/middleware.php';
requireAuth(); 

require_once '../classes/CourseManagement.php';
$courseManagement = new CourseManagement();


$totalCourses = $courseManagement->getTotalCourses();
$totalStudents = $courseManagement->getTotalStudents();
$totalEnrollments = $courseManagement->getTotalEnrollments();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">
    <?php include 'nav_teacher.php'; ?> 

    <div class="container mx-auto mt-4">
        <h1 class="text-2xl font-bold mb-4">Statistiques</h1>
        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-xl font-semibold mb-2">Résumé des Statistiques</h2>
            <ul class="list-disc pl-5">
                <li>Nombre total de cours : <strong><?php echo $totalCourses; ?></strong></li>
                <li>Nombre total d'étudiants inscrits : <strong><?php echo $totalStudents; ?></strong></li>
                <li>Nombre total d'inscriptions : <strong><?php echo $totalEnrollments; ?></strong></li>
            </ul>
        </div>
    </div>
</body>
</html> 