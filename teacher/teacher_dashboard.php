<?php
require_once '../auth/middleware.php';
requireAuth(); 


require_once '../classes/CourseManagement.php';
$courseManagement = new CourseManagement();


$teacherId = $_SESSION['user_id']; 
$courses = $courseManagement->getCoursesByTeacher($teacherId); 


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Enseignant</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">
    <div><?php include 'nav_teacher.php'; ?> </div>
    

    <div class="container mx-auto mt-4">
        <h1 class="text-2xl font-bold mb-4">Tableau de Bord Enseignant</h1>

        <h2 class="text-xl font-semibold mb-2">Mes Cours</h2>
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Titre</th>
                    <th class="py-3 px-6 text-left">Description</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php foreach ($courses as $course): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left"><?php echo $course['id']; ?></td>
                        <td class="py-3 px-6 text-left"><?php echo $course['title']; ?></td>
                        <td class="py-3 px-6 text-left"><?php echo $course['description']; ?></td>
                        <td class="py-3 px-6 text-left">
                            <a href="edit_course.php?id=<?php echo $course['id']; ?>" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded">Modifier</a>
                            <a href="delete_course.php?id=<?php echo $course['id']; ?>" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
   
</body>
</html>
