<?php
require_once '../auth/middleware.php';
requireAuth(); 

require_once '../classes/CourseManagement.php';
$courseManagement = new CourseManagement();

if (isset($_GET['id'])) {
    $courseId = $_GET['id'];


    $course = $courseManagement->getCourseById($courseId);
    if (!$course) {
        header("Location: courses.php?error=Course not found");
        exit();
    }

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $courseManagement->deleteCourse($courseId);
        header("Location: courses.php?success=Course deleted successfully"); 
        exit();
    }
} else {
    header("Location: courses.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un Cours</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-4">
        <h1 class="text-2xl font-bold mb-4">Confirmer la Suppression</h1>
        <p>Êtes-vous sûr de vouloir supprimer le cours <strong><?php echo htmlspecialchars($course['title']); ?></strong> ?</p>
        <form action="" method="POST" class="mt-4">
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                Supprimer
            </button>
            <a href="courses.php" class="ml-4 px-4 py-2 bg-gray-300 text-black rounded-md hover:bg-gray-400">
                Annuler
            </a>
        </form>
    </div>
</body>
</html> 