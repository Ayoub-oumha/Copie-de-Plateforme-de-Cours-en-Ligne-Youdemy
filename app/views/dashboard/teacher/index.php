<?php echo  $_SESSION['user_loged_in_id'] ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Enseignant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <nav class="w-64 min-h-screen bg-gray-800 text-white">
            <div class="p-4">
                <h2 class="text-2xl font-bold mb-6">Dashboard</h2>
                <ul>
                    <li class="mb-3">
                        <a href="/teachers/dashboard" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fas fa-home mr-3"></i>
                            <span>Tableau de bord</span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="teachers/courses" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fas fa-book mr-3"></i>
                            <span>Mes cours</span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="/teachers/courses/create" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fas fa-plus mr-3"></i>
                            <span>Ajouter un cours</span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="/teachers/statistics" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fas fa-chart-bar mr-3"></i>
                            <span>Statistiques</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <h1 class="text-3xl font-bold mb-8">Tableau de bord Enseignant</h1>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Total Courses Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                            <i class="fas fa-book text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-gray-600 text-sm">Total des cours</h2>
                            <p class="text-2xl font-bold"><?= $data['totalCourses'] ?? 0 ?></p>
                        </div>
                    </div>
                </div>

                <!-- Total Students Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-gray-600 text-sm">Total des étudiants</h2>
                            <p class="text-2xl font-bold"><?= $data['totalStudents'] ?? 0 ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Courses Table -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b">
                    <h2 class="text-xl font-bold">Derniers cours</h2>
                </div>
                <div class="p-6">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b">
                                <th class="pb-4">Titre</th>
                                <th class="pb-4">Catégorie</th>
                                <th class="pb-4">Étudiants inscrits</th>
                                <th class="pb-4">Date de création</th>
                                <th class="pb-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($data['recentCourses']) && !empty($data['recentCourses'])): ?>
                                <?php foreach($data['recentCourses'] as $course): ?>
                                <tr class="border-b">
                                    <td class="py-4"><?= $course->title ?></td>
                                    <td class="py-4"><?= $course->category ?></td>
                                    <td class="py-4"><?= $course->enrolled_students ?></td>
                                    <td class="py-4"><?= $course->created_at ?></td>
                                    <td class="py-4">
                                        <a href="<?= URLROOT ?>/teachers/courses/edit/<?= $course->id ?>" 
                                           class="text-blue-500 hover:text-blue-700 mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= URLROOT ?>/teachers/courses/delete/<?= $course->id ?>" 
                                           class="text-red-500 hover:text-red-700"
                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="py-4 text-center text-gray-500">
                                        Aucun cours trouvé
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>