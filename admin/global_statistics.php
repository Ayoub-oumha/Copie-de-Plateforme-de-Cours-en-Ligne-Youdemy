<?php
require_once '../auth/middleware.php';
requireAdminAuth();
require_once '../classes/StatisticsManagement.php';

$statisticsManagement = new StatisticsManagement();
$totalUsers = $statisticsManagement->getTotalUsers();
$totalCourses = $statisticsManagement->getTotalCourses();
$totalTeachers = $statisticsManagement->getTotalTeachers();
$totalTags = $statisticsManagement->getTotalTags();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques Globales</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/your/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<?php include 'nav_bar.php'; ?>

    <div class="container mx-auto mt-4">
        <h1 class="text-2xl font-bold mb-4">Statistiques Globales</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-lg font-bold">Total Utilisateurs</h2>
                <p class="text-2xl"><?php echo $totalUsers; ?></p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-lg font-bold">Total Cours</h2>
                <p class="text-2xl"><?php echo $totalCourses; ?></p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-lg font-bold">Total Enseignants</h2>
                <p class="text-2xl"><?php echo $totalTeachers; ?></p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-lg font-bold">Total Tags</h2>
                <p class="text-2xl"><?php echo $totalTags; ?></p>
            </div>
        </div>
    </div>
</body>
</html> 