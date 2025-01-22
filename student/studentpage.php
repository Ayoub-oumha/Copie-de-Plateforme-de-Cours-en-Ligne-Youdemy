<?php
require_once '../auth/middleware.php';
requireAuth(); 

require_once '../classes/CourseManagement.php';
$courseManagement = new CourseManagement();


$studentId = $_SESSION['user_id'];
$enrolledCourses = $courseManagement->getEnrolledCourses($studentId); 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gray-100 flex">
    <?php include 'nav_student.php'; ?>

    <div class="flex-1 p-8">
        <h1 class="text-2xl font-bold mb-6">Bienvenue, <?php echo $_SESSION['username']; ?></h1>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-gray-500 text-sm font-medium">Cours inscrits</h3>
                <p class="text-2xl font-bold"><?php echo count($enrolledCourses); ?></p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-gray-500 text-sm font-medium">Cours complétés</h3>
                <p class="text-2xl font-bold">0</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-gray-500 text-sm font-medium">Heures d'apprentissage</h3>
                <p class="text-2xl font-bold">0</p>
            </div>
        </div>

        <!-- Recent Courses -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">Mes cours récents</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($enrolledCourses as $course): ?>
                    <div class="border rounded-lg overflow-hidden">
                        <div class="p-4">
                            <h3 class="font-bold mb-2"><?php echo $course['title']; ?></h3>
                            <p class="text-gray-600 text-sm mb-4"><?php echo $course['description']; ?></p>
                            <a href="view_course.php?id=<?php echo $course['id']; ?>" 
                               class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Continuer
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>